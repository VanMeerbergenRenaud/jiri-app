<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectPonderation extends Model
{
    use HasFactory;

    protected $table = 'project_ponderation';

    protected $fillable = [
        'ponderation1',
        'ponderation2'
    ];
}
