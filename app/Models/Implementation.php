<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Implementation extends Model
{
    use HasFactory;

    public function contact(): BelongsTo
    {
        return $this->belongsTo(Contact::class);
    }

    public function event(): BelongsTo
    {
        return $this->belongsTo(Event::class);
    }

    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }

    public function getScoresAttribute($value)
    {
        return json_decode($value);
    }

    public function getUrlsAttribute($value)
    {
        return json_decode($value);
    }

    public function getTasksAttribute($value)
    {
        return json_decode($value);
    }
}
