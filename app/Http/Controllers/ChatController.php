<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\User;
use App\Models\Message;
use App\Http\Controllers\DashboardController;

class ChatController extends Controller
{
    public function show($id)
    {
        $dashboard = new DashboardController();

$data = $dashboard->index(request());

$users = $data->getData()['users'];

        $selectedUser = User::findOrFail($id);
        Message::where('sender_id', $id)
        ->where('receiver_id', auth()->id())
        ->where('status', 'sent')
        ->update([
        'status' => 'delivered'
        ]);


        Message::where('sender_id', $id)
        ->where('receiver_id', auth()->id())
        ->where('status', 'delivered')
        ->update([
        'status' => 'seen'
        ]);

$selectedUser->status = $selectedUser->is_online
    ? 'Online'
    : 'Offline';

        $messages = Message::where(function ($q) use ($id) {
            $q->where('sender_id', auth()->id())
              ->where('receiver_id', $id);

        })->orWhere(function ($q) use ($id) {

            $q->where('sender_id', $id)
              ->where('receiver_id', auth()->id());

        })->orderBy('created_at')->get();

        return view('dashboard', compact(
            'users',
            'selectedUser',
            'messages'
        ));
    }
}