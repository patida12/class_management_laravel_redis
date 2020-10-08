<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  int  $sender_id
     * @param  int  $receiver_id
     * @return \Illuminate\Http\Response
     */
    public function index($sender_id, $receiver_id)
    {
        $sender = User::find($sender_id);
        $receiver = User::find($receiver_id);
        $messages = DB::select(
            'SELECT * FROM messages WHERE (sender_id=? AND receiver_id=?) OR (sender_id=? AND receiver_id=?)',
            [$sender_id, $receiver_id, $receiver_id, $sender_id]
        );

        $unReadMessages = DB::select('SELECT id FROM messages WHERE sender_id=? AND receiver_id=?', [$receiver_id, $sender_id]);
        foreach($unReadMessages as $message) {
            DB::update('UPDATE messages SET isread=true WHERE id=?', [$message->id]);
        }

        return view(
            'message.index',
            ['messages' => $messages, 'sender' => $sender, 'receiver' => $receiver]
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'message' => ['required', 'string', 'max:255'],
        ]);
        $message = new Message();
        $message->message = $request->message;
        $message->sender_id = $request->sender_id;
        $message->receiver_id = $request->receiver_id;
        $message->save();

        return redirect()->action(
            [MessageController::class, 'index'],
            ['sender_id' => $message->sender_id, 'receiver_id' => $message->receiver_id]
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'message' => ['required', 'string', 'max:255'],
        ]);
        $message = Message::find($id);
        $message->message = $request->message;
        $message->sender_id = $request->sender_id;
        $message->receiver_id = $request->receiver_id;
        $message->save();

        return redirect()->action(
            [MessageController::class, 'index'],
            ['sender_id' => $message->sender_id, 'receiver_id' => $message->receiver_id]
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $message = Message::find($id);
        $sender_id = $message->sender_id;
        $receiver_id = $message->receiver_id;

        $message->delete();

        return redirect()->action(
            [MessageController::class, 'index'],
            ['sender_id' => $sender_id, 'receiver_id' => $receiver_id]
        );
    }
}
