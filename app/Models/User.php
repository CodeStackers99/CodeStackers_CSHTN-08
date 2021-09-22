<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    const USER_TEACHER = 0;
    const USER_ADMIN = 1;
    const USER_STUDENT = 2;
    const STUDENT_BRANCH_AI = 3;
    const STUDENT_BRANCH_CS = 4;
    const STUDENT_BRANCH_DS = 5;
    const STUDENT_BRANCH_IT = 6;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $guarded = ['id'];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'verification_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // HELPER FUNCTIONS
    public function isAdmin()
    {
        return $this->role === self::USER_ADMIN;
    }

    public function isTeacher()
    {
        return $this->role === self::USER_TEACHER;
    }

    public function isStudent()
    {
        return $this->role === self::USER_STUDENT;
    }
}
