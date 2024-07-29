<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class EventContact extends Model
{
    use HasFactory;

    protected $table = 'event_contact';

    protected $fillable = [
        'role',
        'token',
        'contact_id',
        'event_id',
    ];

    // The evenContact belongs to an event
    public function event(): BelongsTo
    {
        return $this->belongsTo(Event::class);
    }

    // The evenContact belongs to a contact
    public function contact(): BelongsTo
    {
        return $this->belongsTo(Contact::class);
    }

    // The evenContact has many evaluations
    public function evaluations(): HasMany
    {
        return $this->hasMany(EvaluatorEvaluation::class);
    }
}
