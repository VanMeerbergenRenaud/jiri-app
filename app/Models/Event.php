<?php
// app/Models/Event.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable = [
        'id',           // Identifiant de l'événement
        'name',         // Nom de l'événement
        'start_date',   // Date de début de l'événement
        'end_date',     // Date de fin de l'événement
    ];
}
