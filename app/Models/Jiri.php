<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jiri extends Model
{
    use HasFactory;


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function students()
    {
        return $this
            ->belongsToMany(Contact::class, 'attendances', 'jiri_id', 'contact_id')
            ->withPivot('role')
            ->wherePivot('role', 'student');
    }

    public function evaluators()
    {
        return $this
            ->belongsToMany(Contact::class, 'attendances', 'jiri_id', 'contact_id')
            ->withPivot('role')
            ->wherePivot('role', 'evaluator');
    }
}
