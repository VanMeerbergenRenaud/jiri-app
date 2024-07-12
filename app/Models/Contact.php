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
            ->belongsToMany(Event::class, 'event_contact', 'contact_id', 'event_id')
            ->withPivot(['role', 'token']);
    }

    public function eventContacts(): HasMany
    {
        return $this->hasMany(EventContact::class);
    }

    public function projectPonderation(): HasMany
    {
        return $this->hasMany(ProjectPonderation::class);
    }
}
