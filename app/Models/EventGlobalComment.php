<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class EventGlobalComment extends Model
{
    use HasFactory;

    protected $table = 'event_global_comment';

    protected $fillable = [
        'globalComment',
    ];

    // The global comment belongs to the evaluation of an event wrote by the user
    public function eventEvaluation(): BelongsTo
    {
        return $this->belongsTo(Event::class, 'event_id');
    }
}
