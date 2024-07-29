<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class EvaluatorEvaluationStatus extends Model
{
    use HasFactory;

    protected $table = 'evaluator_evaluation_statuses';

    protected $fillable = [
        'status',
        'public',
    ];

    public function event(): BelongsTo
    {
        return $this->belongsTo(Event::class);
    }
}
