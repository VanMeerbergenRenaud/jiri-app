<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProjectPonderation extends Model
{
    use HasFactory;

    protected $table = 'project_ponderation';

    protected $fillable = [
        'ponderation1',
        'ponderation2',
    ];

    // The project ponderation belongs to an event
    public function event(): BelongsTo
    {
        return $this->belongsTo(Event::class);
    }

    // The project ponderation belongs to a project
    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }
}
