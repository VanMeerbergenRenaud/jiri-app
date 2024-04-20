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
            ->belongsToMany(Event::class, 'attendances', 'contact_id', 'event_id')
            ->withPivot(['role', 'token']);
    }

    public function contacts(): BelongsToMany
    {
        return $this->belongsToMany(
            Contact::class,
            'attendances',
            'event_id',
            'contact_id'
        );
    }

    public function projects(): BelongsToMany
    {
        return $this->belongsToMany(
            Project::class,
            'event_project',
            'event_id',
            'project_id'
        )
            ->withPivot('ponderation1', 'ponderation2', 'link');
    }

    public function attendances(): HasMany
    {
        return $this->hasMany(Attendance::class);
    }

    public function eventProjects(): HasMany
    {
        return $this->hasMany(EventProject::class);
    }

    public function students(): BelongsToMany
    {
        return $this
            ->belongsToMany(
                Contact::class,
                'attendances',
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
                'attendances',
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
}
