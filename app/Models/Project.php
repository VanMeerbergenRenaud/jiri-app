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

    // A project can belong to one or many events
    public function events(): BelongsToMany
    {
        return $this->belongsToMany(Event::class, 'project_ponderation');
    }

    // A project can have one or many ponderations
    public function projectPonderations(): HasMany
    {
        return $this->hasMany(ProjectPonderation::class);
    }

    // A project can have one or many evaluations
    public function evaluations(): HasMany
    {
        return $this->hasMany(EvaluatorEvaluation::class);
    }

    // A project can have one or many tasks
    public function tasks(): BelongsToMany
    {
        return $this->belongsToMany(Task::class, 'project_task');
    }
}
