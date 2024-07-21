<?php

namespace App\Livewire\Events\Show;

use Livewire\Component;

class SecondTable extends Component
{
    public $event;

    public $contacts;

    public $students;

    public $evaluators;

    public $projects;

    public function mount($event, $contacts, $students, $evaluators)
    {
        $this->event = $event;
        $this->contacts = $contacts;
        $this->students = $students;
        $this->evaluators = $evaluators;

        $this->projects = $this->event->projects;
    }

    /*
     * Scores:
     * 1. Find the score related to a student
     * 2. Calculate the average score of a student
     * 3. Calculate the sum of the scores of a student
     * 4. Calculate the global score of a student with ponderation 1 or 2
    */

    public function getScore($studentContactId, $evaluatorContactId, $projectId)
    {
        return auth()->user()->evaluatorsEvaluations()
            ->where('event_id', $this->event->id)
            ->where('event_contact_id', $studentContactId)
            ->where('project_id', $projectId)
            ->where('contact_id', $evaluatorContactId)
            ->where('status', 'evaluated')
            ->first()->score ?? null;
    }

    public function getAverageScore($studentContactId)
    {
        $scores = [];

        foreach ($this->evaluators as $evaluator) {
            foreach ($this->projects as $project) {
                $score = $this->getScore($studentContactId, $evaluator->contact->id, $project->id);
                if ($score) {
                    $scores[] = $score;
                }
            }
        }

        $averageScore = count($scores) > 0
            ? array_sum($scores) / count($scores)
            : null;

        return number_format($averageScore, 2);
    }

    public function calculateWeightedScore($ponderationKey, $studentContactId)
    {
        $totalWeightedScore = 0;
        $totalPonderation = 0;

        $ponderationsOfProjects = auth()->user()->projectPonderations()
            ->where('event_id', $this->event->id)
            ->get();

        foreach ($ponderationsOfProjects as $project) {
            $metrics = $this->calculateScoreMetrics($project->project->id, $studentContactId);
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

    private function calculateScoreMetrics($projectId, $studentContactId)
    {
        $evaluations = auth()->user()->evaluatorsEvaluations()
            ->where('event_id', $this->event->id)
            ->where('event_contact_id', $studentContactId)
            ->where('status', 'evaluated')
            ->get();

        $projectEvaluations = $evaluations->where('project_id', $projectId);

        $totalScore = $projectEvaluations->sum('score');
        $evaluatorCount = $projectEvaluations->count('score');

        return [
            'totalScore' => $totalScore,
            'evaluatorCount' => $evaluatorCount,
            'averageScore' => $evaluatorCount > 0
                ? ($totalScore / $evaluatorCount)
                : 0,
        ];
    }

    public function render()
    {
        return view('livewire.events.show.second-table');
    }
}
