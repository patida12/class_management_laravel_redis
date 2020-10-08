<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Message extends Model
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'message',
        'sender_id',
        'receiver_id',
        'isread',
    ];

    public function sender()
    {
        return $this->belongsTo('App\Models\User', 'id');
    }

    public function receiver()
    {
        return $this->belongsTo('App\Models\User', 'id');
    }
}
