<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Pusher\Pusher;

class MessageController extends Controller
{
    public function index()
    {
        $users = User::where('id', '!=' , Auth::id())->get();
        return view('message.index', compact('users'));
    }
    public function create()
    {
        //
    }
    public function store(Request $request)
    {
        //
    }
    public function show($id)
    {
        $my_id = Auth::id();
        $messages = Message::where(function ($query) use ($id, $my_id) {
            $query->where('from', $my_id)->where('to', $id);
        })->orWhere(function ($query) use ($id, $my_id) {
            $query->where('from', $id)->where('to', $my_id);
        })->get();
        return view('message.message', compact('messages'));
    }
    public function edit($id)
    {
        //
    }
    public function update(Request $request, $id)
    {
        //
    }
    public function destroy($id)
    {
        //
    }
    public function sendMessage(Request $request) {
        $from = Auth::id();
        $to = $request->receiver_id;
        $message = $request->message;

        $data = new Message();
        $data->from = $from;
        $data->to = $to;
        $data->message = $message;
        $data->save();
        $options = array(
            'cluster' => 'ap1',
            'useTLS' => true
        );
        $pusher = new Pusher(
            'bc3fd55ce2605f3cfa30',
            '7de13203b7e9bacfb8fd',
            '1142093',
            $options
        );
        $data = [
            'from' => $from,
            'to' => $to,
        ];
        $pusher->trigger('my-channel', 'my-event', $data);
    }
}
