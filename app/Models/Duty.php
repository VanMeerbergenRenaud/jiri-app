<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Duty extends Model
{
    /*
    * Duty est le concept qui lie un project et un jiri.
    * C'est l'idée d'un devoir à réaliser.
    * Il peut être caractérisé par des liens et des tâches.
    */

    use HasFactory;

    // event, project
    protected $fillable = [
        'event_id',
        'project_id',
        'name'
    ];

    public function event(): BelongsTo
    {
        return $this->belongsTo(Event::class);
    }

    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }

    public function implementations(): HasMany
    {
        return $this->hasMany(Implementation::class);
    }
}
