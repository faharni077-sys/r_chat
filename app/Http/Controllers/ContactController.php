<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use App\Models\User;

class ContactController extends Controller
{
    public function index()
    {
        $contacts = Contact::where('user_id', auth()->id())
                    ->with('contact')
                    ->get();

        return view('contacts.index', compact('contacts'));
    }

    public function create()
    {
    return view('contacts.create');
    }

    public function store(Request $request)
    {
        $request->validate([
        'first_name' => 'required',
        'phone' => 'required',
    ]);

    $user = User::where('phone', $request->phone)->first();

    if (!$user) {
        return back()->with('error', 'Nomor HP belum terdaftar di R-Chat.');
    }

    Contact::updateOrCreate(
    [
        'user_id' => auth()->id(),
        'contact_user_id' => $user->id,
    ],
    [
        'nickname' => trim($request->first_name.' '.$request->last_name),
    ]
);

    return redirect()->route('contacts.index')
        ->with('success', 'Kontak berhasil ditambahkan.');

    }

    
}