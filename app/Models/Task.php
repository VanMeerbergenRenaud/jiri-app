<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $table = 'tasks';

    protected $fillable = [
        'name',
    ];

    // Une tâche peut appartenir à un projet ou plusieurs
    public function projects()
    {
        return $this->belongsToMany(Project::class);
    }
}
