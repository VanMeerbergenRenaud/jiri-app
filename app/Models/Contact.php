<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Contact extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'firstname',
        'email',
        'avatar',
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

    public function projects(): BelongsToMany
    {
        return $this
            ->belongsToMany(Project::class, 'implementations', 'contact_id', 'project_id')
            ->withPivot(['urls', 'scores', 'tasks']);
    }

    public function attendances()
    {
        return $this->hasMany(Attendance::class);
    }

    public function implementations(): HasMany
    {
        return $this->HasMany(Implementation::class);
    }
}
