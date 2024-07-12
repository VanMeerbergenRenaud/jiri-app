<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EvaluatorEvaluation extends Model
{
    use HasFactory;

    protected $table = 'evaluator_evaluation';

    protected $fillable = [
        'score',
        'comment',
        'status',
        'timer',
        'public',
    ];

    public function project()
    {
        return $this->belongsTo(Project::class, 'project_id');
    }
}
