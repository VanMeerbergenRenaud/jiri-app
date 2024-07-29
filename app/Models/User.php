<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    /**
     * Initial tables : events, contacts, projects
     */
    public function events(): HasMany
    {
        return $this->hasMany(Event::class);
    }

    public function contacts(): HasMany
    {
        return $this->HasMany(Contact::class);
    }

    public function projects(): HasMany
    {
        return $this->hasMany(Project::class);
    }

    /**
     * Tables related to a specific event
     */

    // Contacts associated with an event
    public function eventContacts(): hasManyThrough
    {
        return $this->hasManyThrough(EventContact::class, Event::class);
    }

    // Tasks associated with an event
    public function tasks(): HasMany
    {
        return $this->hasMany(Task::class);
    }

    // Ponderations of a project in an event
    public function projectPonderations(): hasManyThrough
    {
        return $this->hasManyThrough(ProjectPonderation::class, Event::class);
    }

    // Evaluation information from an event
    public function evaluatorsEvaluations(): hasManyThrough
    {
        return $this->hasManyThrough(EvaluatorEvaluation::class, Event::class);
    }

    // Comment from an event to a student
    public function eventGlobalComments(): HasManyThrough
    {
        return $this->hasManyThrough(EventGlobalComment::class, Event::class);
    }

    // Comment from an evaluator to a student
    public function evaluatorGlobalComments(): HasManyThrough
    {
        return $this->hasManyThrough(EvaluatorGlobalComment::class, Event::class);
    }

    // Status of an evaluation
    public function evaluatorEvaluationStatuses(): HasManyThrough
    {
        return $this->hasManyThrough(EvaluatorEvaluationStatus::class, Event::class);
    }
}
