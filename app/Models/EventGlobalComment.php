<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventGlobalComment extends Model
{
    use HasFactory;

    protected $table = 'event_global_comment';

    protected $fillable = [
        'globalComment',
    ];
}
