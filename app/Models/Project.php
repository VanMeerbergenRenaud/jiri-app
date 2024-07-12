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

    protected $table = 'projects';

    protected $fillable = [
        'name',
        'description',
        'url_readme',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function events(): BelongsToMany
    {
        return $this->belongsToMany(Event::class, 'project_ponderation');
    }

    public function projectPonderation(): HasMany
    {
        return $this->hasMany(ProjectPonderation::class);
    }

    // Un projet peut avoir plusieurs tâches
    public function tasks(): BelongsToMany
    {
        return $this->belongsToMany(Task::class, 'project_task');
    }
}
