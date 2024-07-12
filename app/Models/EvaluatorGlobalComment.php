<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EvaluatorGlobalComment extends Model
{
    use HasFactory;

    protected $table = 'evaluator_global_comment';

    protected $fillable = [
        'globalComment',
        'globalCote',
    ];
}
