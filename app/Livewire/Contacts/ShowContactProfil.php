<?php

namespace App\Livewire\Contacts;

use App\Livewire\Forms\ContactForm;
use JetBrains\PhpStorm\NoReturn;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithFileUploads;

class ShowContactProfil extends Component
{
    use WithFileUploads;

    public $contact;

    public $event;

    public $contactType;

    public ContactForm $form;

    public $projects;

    public $evaluators;

    public $students;

    public $evaluationsOfEvaluators;

    public $evaluationsFromEvaluator;

    #[Validate('nullable|min:3|max:1000')]
    public $globalComment;

    public $showEditDialog = false;

    public $showCommentDialog = false;

    public $commentSaved = false;

    public $evaluatorGlobalComment;

    public $evaluatorGlobalCote;

    public function mount($event, $contact)
    {
        $this->event = $event;
        $this->contact = $contact;

        $this->form->setContact($contact);

        // The contact type is the role of the contact in the event -> it's the profile of the contact
        $this->contactType = auth()->user()->eventContacts()
            ->where('event_id', $this->event->id)
            ->where('contact_id', $this->contact->id)
            ->first()
            ->role;

        $this->projects = auth()->user()->projectPonderations()
            ->with('project')
            ->where('event_id', $this->event->id)
            ->get();

        $this->students = auth()->user()->eventContacts()
            ->where('event_id', $this->event->id)
            ->where('role', 'student')
            ->get();

        $this->evaluators = auth()->user()->eventContacts()
            ->where('event_id', $this->event->id)
            ->where('role', 'evaluator')
            ->get();

        /*
         * Evaluations:
         * 1. Get the evaluations of all the evaluators that evaluated the student (student profil)
         * 2. Get the evaluations from an evaluator to all the student he evaluates (evaluator profil)
         * 3. Get the global comment of the admin user for the student
        */

        $this->evaluationsOfEvaluators = auth()->user()->evaluatorsEvaluations()
            ->where('event_id', $this->event->id)
            ->where('event_contact_id', $this->contact->id)
            ->where('status', 'evaluated')
            ->get();

        $this->evaluationsFromEvaluator = auth()->user()->evaluatorsEvaluations()
            ->where('event_id', $this->event->id)
            ->where('contact_id', $this->contact->id)
            ->where('status', 'evaluated')
            ->get();

        $this->globalComment = auth()->user()->eventGlobalComments()
            ->where('event_id', $this->event->id)
            ->where('contact_id', $this->contact->id)
            ->first()
            ->globalComment ?? null;
    }

    public function getGlobalEvaluatorInfos($info, $evaluatorId)
    {
        return auth()->user()->evaluatorGlobalComments()
            ->where('event_id', $this->event->id)
            ->where('contact_id', $evaluatorId)
            ->where('event_contact_id', $this->contact->id)
            ->first()->$info ?? null;
    }

    public function getGlobalEvaluatorInfosFromEvaluator($info, $studentId)
    {
        return auth()->user()->evaluatorGlobalComments()
            ->where('event_id', $this->event->id)
            ->where('contact_id', $this->contact->id)
            ->where('event_contact_id', $studentId)
            ->first()->$info ?? null;
    }

    public function saveContact()
    {
        $this->form->update();
        $this->contact->refresh();
        $this->reset('showEditDialog');
    }

    public function saveGlobalComment()
    {
        $this->validate([
            'globalComment' => 'nullable|min:3|max:1000',
        ]);

        auth()->user()->eventGlobalComments()
            ->updateOrCreate([
                'event_id' => $this->event->id,
                'contact_id' => $this->contact->id,
            ],
                ['globalComment' => $this->globalComment]
            );

        $this->reset('showCommentDialog');

        $this->commentSaved = true;
    }

    #[NoReturn]
    public function editContactRole()
    {
        dd('need to change the role of the contact');
    }

    /*
     * Scores:
     * 1. Calculate the total score, the number of evaluators and the average score
     * 2. Calculate the average score of a project
     * 3. Calculate the weighted score of a student
    */

    private function calculateScoreMetrics($projectId)
    {
        $projectEvaluations = $this->evaluationsOfEvaluators->where('project_id', $projectId);
        $totalScore = $projectEvaluations->sum('score');
        $evaluatorCount = $projectEvaluations->count('score');

        return [
            'totalScore' => $totalScore,
            'evaluatorCount' => $evaluatorCount,
            'averageScore' => $evaluatorCount > 0 ? ($totalScore / $evaluatorCount) : 0,
        ];
    }

    public function calculateAverageScore($projectId)
    {
        $metrics = $this->calculateScoreMetrics($projectId);

        $finalScore = $metrics['evaluatorCount'] > 0
            ? $metrics['averageScore']
            : 0;

        return number_format($finalScore, 2);
    }

    public function calculateWeightedScore($ponderationKey)
    {
        $totalWeightedScore = 0;
        $totalPonderation = 0;

        foreach ($this->projects as $project) {
            $metrics = $this->calculateScoreMetrics($project->project->id);
            $averageScore = $metrics['averageScore'];
            $ponderation = $project->$ponderationKey;

            $totalWeightedScore += $averageScore * ($ponderation / 100);
            $totalPonderation += $ponderation;
        }

        $finalGrade = $totalPonderation > 0
            ? ($totalWeightedScore / $totalPonderation) * 100
            : 0;

        return number_format($finalGrade, 2);
    }

    public function render()
    {
        return view('livewire.contacts.show-contact-profil');
    }
}
