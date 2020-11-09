<?php

namespace App\Http\Controllers;

use App\Events\MessagePosted;
use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;

class MessageController extends Controller
{
    public function index()
    {
        if ($messages = Redis::get('messages.all')) {
            return json_decode($messages);
        }
        $messages = Message::with('user')->get();
        Redis::set('messages.all', $messages);

        return view('home');
    }

    public function store()
    {
        $user = Auth::user();
        $message = Message::create(['message'=> request()->get('message'), 'user_id' => $user->id]);
        broadcast(new MessagePosted($message, $user))->toOthers();

        return $message;
    }
}
