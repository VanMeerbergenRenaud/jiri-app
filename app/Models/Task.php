<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Task extends Model
{
    use HasFactory;

    protected $table = 'tasks';

    protected $fillable = [
        'name',
    ];

    // A task can belong to one or many projects
    public function projects(): BelongsToMany
    {
        return $this->belongsToMany(Project::class);
    }
}
