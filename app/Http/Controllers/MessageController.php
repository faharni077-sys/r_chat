<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Conversation;
use App\Models\Message;
use App\Events\MessageSent;

class MessageController extends Controller
{
    public function store(Request $request)
{


    $request->validate([

'receiver_id'=>'required',

'message'=>'nullable',

'image'=>'nullable|image|max:4096',

'file' => 'nullable|file|max:10240',

]);

    $image = null;

    if ($request->hasFile('image')) {

    $image = $request->file('image')
        ->store('chat-images','public');

}

    $file = null;

if ($request->hasFile('file')) {
    $file = $request->file('file')->store('files', 'public');
}

    

    
    $message = Message::create([
        'sender_id' => auth()->id(),
        'receiver_id' => $request->receiver_id,
        'message' => $request->message,
        'image' => $image,
        'file' => $file,
        'status' => 'sent',
    ]);

    
    event(new MessageSent($message));
    

    $userOne = min(auth()->id(), $request->receiver_id);
    $userTwo = max(auth()->id(), $request->receiver_id);

    Conversation::updateOrCreate(
        [
            'user_one' => $userOne,
            'user_two' => $userTwo,
        ],
        [
            'last_message_id' => $message->id,
        ]
    );

    return back();
}

public function destroy(Message $message)
{
if ($message->sender_id != auth()->id()) {
abort(403);
}


$message->update([
    'is_deleted' => true,
]);

return back();


}


}
