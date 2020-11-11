<?php

namespace App\Http\Controllers;

use App\Events\MessagePosted;
use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Redis\RedisManager;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;

class MessageController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    public function index()
    {
        $message = Message::with('user')->latest()->paginate(50);
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
