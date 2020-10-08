<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Assignment extends Model
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'path',
    ];

    public function submissions()
    {
        return $this->hasMany('App\Models\Submission');
    }

    public function delete()
    {
        $this->submissions()->delete();
        return parent::delete();
    }
}
