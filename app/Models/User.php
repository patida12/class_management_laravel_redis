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

    public function message() {
        return $this->hasMany(Message::class);
    }

    public function isTeacher()
    {
        return ($this->permission === 1);
    }

    public function getId()
    {
        return $this->id;
    }

    public function get()
    {
        return $this;
    }
}
