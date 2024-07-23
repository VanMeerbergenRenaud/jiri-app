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

        // Preload the necessary relationships in a single query
        $user = auth()->user()->load([
            'eventContacts' => function($query) use ($event) {
                $query->where('event_id', $event->id)->with(['contact' => function($query) {
                    $query->where('id', '!=', $this->contact->id);
                }]);
            },
            'projectPonderations' => function($query) use ($event) {
                $query->where('event_id', $event->id)->with('project');
            },
            'evaluatorsEvaluations' => function($query) use ($event) {
                $query->where('event_id', $event->id)->where('status', 'evaluated');
            },
            'eventGlobalComments' => function($query) use ($event, $contact) {
                $query->where('event_id', $event->id)->where('contact_id', $contact->id);
            },
            'evaluatorGlobalComments' => function($query) use ($event) {
                $query->where('event_id', $event->id);
            }
        ]);

        // Set contact type
        $this->contactType = $user->eventContacts()
            ->where('contact_id', $this->contact->id)
            ->where('event_id', $this->event->id)
            ->first()
            ->role ?? null;

        // Load the projects, students and evaluators
        $this->projects = $user->projectPonderations;

        $this->students = $user->eventContacts
            ->where('event_id', $this->event->id)
            ->where('role', 'student');

        $this->evaluators = $user->eventContacts
            ->where('event_id', $this->event->id)
            ->where('role', 'evaluator');

        // Load evaluations for a student and from an evaluator
        $this->evaluationsOfEvaluators = $user->evaluatorsEvaluations->where('event_contact_id', $this->contact->id);
        $this->evaluationsFromEvaluator = $user->evaluatorsEvaluations->where('contact_id', $this->contact->id);

        //  Load global comment
        $this->globalComment = $user->eventGlobalComments
            ->first()
            ->globalComment ?? null;
    }

    public function getGlobalCommentForStudent($evaluatorId)
    {
        return auth()->user()->evaluatorGlobalComments
            ->where('event_id', $this->event->id)
            ->where('contact_id', $evaluatorId)
            ->where('event_contact_id', $this->contact->id)
            ->first()
            ->globalComment ?? null;
    }

    public function getGlobalCommentForEvaluator($studentId)
    {
        return auth()->user()->evaluatorGlobalComments
            ->where('event_id', $this->event->id)
            ->where('contact_id', $this->contact->id)
            ->where('event_contact_id', $studentId)
            ->first()
            ->globalComment ?? null;
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
