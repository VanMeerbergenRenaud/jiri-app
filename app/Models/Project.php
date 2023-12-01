<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'tasks',
    ];

    protected $casts = [
        'tasks' => 'array',
    ];

    // Retrieve only the projects of the authenticated user
    protected static function booted(): void
    {
        static::addGlobalScope(new Scopes\AuthUserScope());
    }
}
