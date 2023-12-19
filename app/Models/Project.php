<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
    ];

    // A project have a list of tasks
    protected $with = ['tasks'];

   /*protected $casts = [
        'tasks' => Task::class,
    ];*/

    public function tasks(): HasMany
    {
        return $this->hasMany(Task::class);
    }

    public function events(): BelongsToMany
    {
        return $this->belongsToMany(Event::class, 'duties', 'project_id', 'event_id');
    }

    public function duties(): HasMany
    {
        return $this->hasMany(Duty::class);
    }
}
