<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'fullname',
        'username',
        'password',
        'email',
        'phonenumber',
        'permission',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function submissions()
    {
        return $this->hasMany('App\Models\Submission');
    }

    public function messages()
    {
        return $this->hasMany('App\Models\Message', 'sender_id');
    }

    public function isTeacher()
    {
        return ($this->permission === 1);
    }
}
