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

    public function implementations(): HasMany
    {
        return $this->hasMany(Implementation::class);
    }

    public function projects(): BelongsToMany
    {
        return $this->belongsToMany(
            Project::class,
            'implementations',
            'event_id',
            'project_id'
        );
    }

    public function attendances(): HasMany
    {
        return $this->hasMany(Attendance::class);
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
            ->withPivot('role','token')
            ->wherePivot('role', 'evaluator');
    }

    // Retrieve only the jiris of the authenticated user
    protected static function booted(): void
    {
        static::addGlobalScope(new Scopes\AuthUserScope());
    }
}
