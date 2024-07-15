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
    public $contactType;
    public ContactForm $form;
    public $projects;
    public $evaluators;
    public $students;
    public $evaluationsOfEvaluators;
    public $evaluationsFromEvaluator;

    #[Validate('nullable|max:1000')]
    public $globalComment;

    public $showEditDialog = false;

    public function mount($contact)
    {
        $this->contact = $contact;
        $this->form->setContact($contact);

        $eventId = $this->contact->pivot->event_id;
        $contactId = $this->contact->id;

        $user = auth()->user();

        // The contact type is the role of the contact in the event -> it's the profile of the contact
        $this->contactType = $user->eventContacts()
            ->where('event_id', $eventId)
            ->where('contact_id', $contactId)
            ->first()
            ->role;

        $this->projects = $user->projectPonderations()
            ->with('project')
            ->where('event_id', $eventId)
            ->get();

        $this->globalComment = $user->eventGlobalComments()
            ->where('event_id', $eventId)
            ->where('contact_id', $contactId)
            ->first()
            ->globalComment ?? null;

        $this->students = $user->eventContacts()
            ->where('event_id', $eventId)
            ->where('role', 'student')
            ->get();

        $this->evaluators = $user->eventContacts()
            ->where('event_id', $eventId)
            ->where('role', 'evaluator')
            ->get();

        // Get the evaluations of all the evaluators that evaluated the student (student profil)
        $this->evaluationsOfEvaluators = $user->evaluatorsEvaluations()
            ->where('event_id', $eventId)
            ->where('contact_id', $contactId)
            ->where('status', 'evaluated')
            ->get();

        // Get the evaluations from an evaluator to all the student he evaluates (evaluator profil)
        $this->evaluationsFromEvaluator = $user->evaluatorsEvaluations()
            ->where('event_id', $eventId)
            ->where('event_contact_id', $contactId)
            ->where('status', 'evaluated')
            ->get();
    }

    public function saveContact()
    {
        $this->form->update();
        $this->contact->refresh();
        $this->reset('showEditDialog');
    }

    #[NoReturn] public function saveGlobalComment()
    {
        dd('need to save the global comment of the contact');
    }

    #[NoReturn] public function editContactRole()
    {
        dd('need to change the role of the contact');
    }

    /*
     * Evaluations:
     * 1. Get the evaluations of a student by all the evaluators
     * 2. Get the evaluations of an evaluator to all the students he evaluates
    */

    public function getProjectEvaluationsOfTheStudentS($project, $evaluator)
    {
        return $this->evaluationsOfEvaluators
            ->where('project_id', $project->project->id)
            ->where('event_contact_id', $evaluator->contact->id);
    }

    public function getProjectEvaluationsFromEvaluatorS($project, $student)
    {
        return $this->evaluationsFromEvaluator
            ->where('project_id', $project->project->id)
            ->where('contact_id', $student->contact->id);
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
        return $metrics['evaluatorCount'] > 0 ? $metrics['averageScore'] : '?';
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
