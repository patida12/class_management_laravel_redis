<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;

class Submission extends Model
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'assignment_id',
        'name',
        'path',
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function assignment()
    {
        return $this->belongsTo('App\Models\Assignment');
    }

    public function delete()
    {
        Storage::delete($this->path);
        $this->delete();
        return parent::delete();
    }
}
