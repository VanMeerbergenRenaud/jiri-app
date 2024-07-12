<?php

namespace App\Models;

use Carbon\Carbon;
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

    public function events(): BelongsToMany
    {
        return $this
            ->belongsToMany(Event::class, 'event_contact', 'contact_id', 'event_id')
            ->withPivot(['role', 'token']);
    }

    public function contacts(): BelongsToMany
    {
        return $this->belongsToMany(
            Contact::class,
            'event_contact',
            'event_id',
            'contact_id'
        );
    }

    public function projects(): BelongsToMany
    {
        return $this->belongsToMany(
            Project::class,
            'project_ponderation',
            'event_id',
            'project_id'
        )
            ->withPivot('ponderation1', 'ponderation2');
    }

    public function eventContacts(): HasMany
    {
        return $this->hasMany(EventContact::class);
    }

    public function projectPonderation(): HasMany
    {
        return $this->hasMany(ProjectPonderation::class);
    }

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

    public function isAvailable()
    {
        $ending_at = Carbon::parse($this->starting_at)->addMinutes($this->duration);

        return $ending_at <= now();
    }

    public function status()
    {
        if ($this->isAvailable()) {
            return 'en cours'; // ou passé
        } else {
            return 'terminé';
        }
    }

    // Global comments
    public function eventGlobalComment(): HasMany
    {
        return $this->hasMany(EventGlobalComment::class);
    }

    public function evaluatorGlobalComment(): HasMany
    {
        return $this->hasMany(EvaluatorGlobalComment::class);
    }
}
