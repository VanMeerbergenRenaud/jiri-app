<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;

class EventProject extends Pivot
{
    use HasFactory;

    protected $fillable = [
        'event_id',
        'project_id',
        'ponderation1',
        'ponderation2',
    ];

    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}
