<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ChatGroup;
use App\Models\GroupMessage;
use App\Events\GroupMessageSent;

class GroupChatController extends Controller
{
    public function show($id)
    {
        $group = ChatGroup::with('members.user')->findOrFail($id);

        $messages = GroupMessage::where('group_id', $id)
            ->orderBy('created_at')
            ->get();

        return view('group-chat', compact('group', 'messages'));
    }

    public function send(Request $request)
    {
        $request->validate([
    'group_id' => 'required',
    'message' => 'nullable',
    'image' => 'nullable|image|max:2048',
]);

        $image = null;

if ($request->hasFile('image')) {
    $image = $request->file('image')->store('group-images', 'public');
}

$message = GroupMessage::create([
    'group_id' => $request->group_id,
    'sender_id' => auth()->id(),
    'message' => $request->message,
    'image' => $image,
]);

broadcast(new GroupMessageSent($message))->toOthers();

return back();
    }

    public function index()
    {
    $groups = \App\Models\ChatGroup::all();

    return view('groups', compact('groups'));
    }


    public function create()
    {
    return view('create-group');
    }

    public function store(Request $request)
    {
    $request->validate([
    'name' => 'required'
]);

ChatGroup::create([
    'group_name' => $request->name,
    'admin_id' => auth()->id(),
]);

return redirect()->route('groups.index');
    }
}