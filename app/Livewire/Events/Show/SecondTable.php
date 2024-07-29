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

    public $evaluations;

    public $ponderations;

    public function mount($event, $contacts, $students, $evaluators, $projects)
    {
        $this->event = $event;
        $this->contacts = $contacts;
        $this->students = $students;
        $this->evaluators = $evaluators;
        $this->projects = $projects;

        // Load evaluations and ponderations with eager loading
        $this->evaluations = auth()->user()->evaluatorsEvaluations()
            ->with('event', 'project', 'contact')
            ->where('event_id', $event->id)
            ->where('status', 'evaluated')
            ->get();

        $this->ponderations = auth()->user()->projectPonderations()
            ->with('project')
            ->where('event_id', $event->id)
            ->get();
    }

    public function getScore($studentContactId, $evaluatorContactId, $projectId)
    {
        $evaluation = $this->evaluations->where('event_contact_id', $studentContactId)
            ->where('contact_id', $evaluatorContactId)
            ->where('project_id', $projectId)
            ->first();

        return $evaluation->score ?? null;
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

        foreach ($this->ponderations as $projectPonderation) {
            $metrics = $this->calculateScoreMetrics($projectPonderation->project->id, $studentContactId);
            $averageScore = $metrics['averageScore'];
            $ponderation = $projectPonderation->$ponderationKey;

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
        $projectEvaluations = $this->evaluations
            ->where('project_id', $projectId)
            ->where('event_contact_id', $studentContactId);

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
