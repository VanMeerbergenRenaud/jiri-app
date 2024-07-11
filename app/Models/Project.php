<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'url_readme',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function events()
    {
        return $this->belongsToMany(Event::class);
    }

    public function eventProjects(): HasMany
    {
        return $this->hasMany(EventProject::class);
    }

    // Un projet peut avoir plusieurs tâches
    public function tasks()
    {
        return $this->belongsToMany(Task::class, 'project_task');
    }
}
