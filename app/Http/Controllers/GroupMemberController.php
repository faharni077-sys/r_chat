<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\GroupMember;
use App\Models\User;

class GroupMemberController extends Controller
{
    public function create($group)
    {
        $users = User::where('id', '!=', auth()->id())->get();

        return view('add-member', compact('users', 'group'));
    }

    public function store(Request $request)
    {
        GroupMember::firstOrCreate([
            'group_id' => $request->group_id,
            'user_id' => $request->user_id,
        ]);

        return redirect()->route('group.show', $request->group_id);
    }
}