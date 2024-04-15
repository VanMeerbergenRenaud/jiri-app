<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * Determine if the user is an evaluator.
     *
     * @return bool
     */
    public function isEvaluator(): bool
    {
        return $this->role === 'evaluator';
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    // Using Gravatar for user profile image
    public function avatarUrl()
    {
        $hash = md5(strtolower(trim($this->email)));
        return "https://www.gravatar.com/avatar/$hash";
    }

    public function events(): HasMany
    {
        return $this->hasMany(Event::class);
    }

    public function contacts(): HasMany
    {
        return $this->HasMany(Contact::class);
    }

    public function projects(): HasMany
    {
        return $this->hasMany(Project::class);
    }

    public function attendances(): hasManyThrough
    {
        return $this->hasManyThrough(Attendance::class, Event::class);
    }

    public function duties()
    {
        return $this->hasManyThrough(Duty::class, Event::class);
    }

    public function implementations()
    {
        return $this->hasManyThrough(Implementation::class, Event::class);
    }
}
