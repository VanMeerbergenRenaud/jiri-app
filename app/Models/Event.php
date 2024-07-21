<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'starting_at',
        'duration',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // An event can have one or more contacts
    public function contacts(): BelongsToMany
    {
        return $this->belongsToMany(
            Contact::class,
            'event_contact',
            'event_id',
            'contact_id'
        );
    }

    // An event can have one or more projects
    public function projects(): BelongsToMany
    {
        return $this->belongsToMany(
            Project::class,
            'project_ponderation',
            'event_id',
            'project_id'
        );
    }

    // An event can have one or more contacts assigned to it
    public function eventContacts(): HasMany
    {
        return $this->hasMany(EventContact::class);
    }

    // An event can have one or more students assigned to it
    public function students(): BelongsToMany
    {
        return $this
            ->belongsToMany(
                Contact::class,
                'event_contact',
                'event_id',
                'contact_id'
            )
            ->withPivot('role')
            ->wherePivot('role', 'student');
    }

    // An event can have one or more evaluators assigned to it
    public function evaluators(): BelongsToMany
    {
        return $this
            ->belongsToMany(
                Contact::class,
                'event_contact',
                'event_id',
                'contact_id'
            )
            ->withPivot('role', 'token')
            ->wherePivot('role', 'evaluator');
    }

    // An event can have one or more ponderations assigned to a project
    public function projectPonderations(): HasMany
    {
        return $this->hasMany(ProjectPonderation::class);
    }

    // An event can have one or more evaluations from the evaluators
    public function evaluatorsEvaluations(): HasMany
    {
        return $this->hasMany(EvaluatorEvaluation::class);
    }

    // An event can have one or more global comments wrote by the user for a student
    public function eventGlobalComments(): HasMany
    {
        return $this->hasMany(EventGlobalComment::class);
    }

    // An event can have one or more global comments wrote by the evaluator for a student
    public function evaluatorGlobalComments(): HasMany
    {
        return $this->hasMany(EvaluatorGlobalComment::class);
    }

    // An event can available, current, paused, finished or coming soon
    public function isAvailable()
    {
        return $this->starting_at < now() && $this->started_at === null && $this->paused_at === null && $this->finished_at === null;
    }

    public function isCurrent()
    {
        return $this->started_at !== null && $this->paused_at === null && $this->finished_at === null;
    }

    public function isPaused()
    {
        return $this->started_at !== null && $this->paused_at !== null && $this->finished_at === null;
    }

    public function isFinished()
    {
        return $this->finished_at !== null;
    }
}
