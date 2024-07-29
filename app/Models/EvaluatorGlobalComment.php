<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class EvaluatorGlobalComment extends Model
{
    use HasFactory;

    protected $table = 'evaluator_global_comment';

    protected $fillable = [
        'globalComment',
        'globalCote',
    ];

    // The global comment belongs to the evaluation of an event wrote by the evaluator
    public function evaluatorEvaluation(): BelongsTo
    {
        return $this->belongsTo(EvaluatorEvaluation::class, 'evaluator_evaluation_id');
    }
}
