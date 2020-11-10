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
        // if ($messages = Redis::get('messages.all')) {
        //     return json_decode($messages);
        // }
        $message = Message::with('user')->get();
        //Redis::set('messages.all', $messages);

        return $message;
    }

    public function store()
    {
        $user = Auth::user();

        $message = new Message();
        $message->message = request()->get('message', '');
        $message->user_id = $user->id;
        $message->save();

        broadcast(new MessagePosted($message, $user))->toOthers();
        return ['message' => $message->load('user')];
    }
}
