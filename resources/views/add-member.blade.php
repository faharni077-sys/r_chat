<x-app-layout>

<div class="max-w-xl mx-auto mt-10">

<h1 class="text-2xl font-bold mb-5">
Tambah Anggota
</h1>

<form method="POST" action="{{ route('group.member.store') }}">
@csrf

<input type="hidden" name="group_id" value="{{ $group }}">

<select
name="user_id"
class="w-full border rounded p-3 mb-4">

@foreach($users as $user)

<option value="{{ $user->id }}">
{{ $user->name }}
</option>

@endforeach

</select>

<button
class="bg-green-600 text-white px-5 py-2 rounded">

Tambah

</button>

</form>

</div>

</x-app-layout>