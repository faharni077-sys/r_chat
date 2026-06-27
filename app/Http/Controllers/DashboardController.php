<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\Message;
use Illuminate\Http\Request;
use App\Models\Conversation;
use App\Models\User;



class DashboardController extends Controller
{
    public function index(Request $request)
{
    $search = $request->search;

   $conversations = Conversation::where(function ($q) {
    $q->where('user_one', auth()->id())
      ->orWhere('user_two', auth()->id());
})
->orderByDesc('updated_at')
->get();

    $users = collect();

    foreach ($conversations as $conversation) {

        $otherUserId = $conversation->user_one == auth()->id()
            ? $conversation->user_two
            : $conversation->user_one;

        $otherUser = User::find($otherUserId);

        if (!$otherUser) continue;

        // cek apakah sudah disimpan di kontak
        $contact = Contact::where('user_id', auth()->id())
            ->where('contact_user_id', $otherUserId)
            ->first();

        $otherUser->nickname = $contact
            ? $contact->nickname
            : $otherUser->name;

        $lastMessage = Message::find($conversation->last_message_id);

        $otherUser->last_message = $lastMessage?->message ?? '';

        $otherUser->last_time = $lastMessage
            ? $lastMessage->created_at->format('H:i')
            : '';

        $users->push($otherUser);
    }

    return view('dashboard', compact('users', 'search'));
}
    }
