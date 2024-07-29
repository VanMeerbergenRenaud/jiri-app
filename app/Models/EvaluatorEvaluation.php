<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class EvaluatorEvaluation extends Model
{
    use HasFactory;

    protected $table = 'evaluator_evaluation';

    protected $fillable = [
        'score',
        'comment',
        'status',
        'timer',
    ];

    // The evaluation belongs to an event
    public function event(): BelongsTo
    {
        return $this->belongsTo(Event::class);
    }

    // The evaluation belongs to a project
    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }

    // The evaluation belongs to a contact
    public function contact(): BelongsTo
    {
        return $this->belongsTo(Contact::class);
    }

    public function eventContact(): BelongsTo
    {
        return $this->belongsTo(EventContact::class);
    }
}
