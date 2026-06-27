<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kontak - R-Chat</title>

    @vite(['resources/css/app.css','resources/js/app.js'])
</head>

<body class="bg-gray-100">

<div class="max-w-md mx-auto bg-white min-h-screen shadow">

    <!-- Header -->
    <div class="flex items-center gap-3 p-4 border-b">

        <a href="{{ route('dashboard') }}"
           class="text-2xl">
            ←
        </a>

        <h1 class="text-2xl font-semibold">
            Kontak
        </h1>

    </div>

    <!-- Search -->
    <div class="p-4">

        <input
            type="text"
            placeholder="Cari kontak..."
            class="w-full border rounded-full px-4 py-2">

    </div>

    <!-- Tombol Tambah -->
    <div class="px-4">

        <a href="{{ route('contacts.create') }}"
           class="block bg-green-500 text-white text-center rounded-lg py-3 font-semibold">

            + Tambah Kontak Baru

        </a>

    </div>

    <!-- List Kontak -->

    <div class="mt-5">

        @foreach($contacts as $contact)

<a href="{{ route('chat.show', $contact->contact->id) }}"
   class="flex items-center gap-3 p-4 border-b hover:bg-gray-100">

    <div class="w-12 h-12 rounded-full bg-green-500 text-white flex items-center justify-center font-bold">
        {{ strtoupper(substr($contact->nickname,0,1)) }}
    </div>

    <div>
        <h2 class="font-semibold">
            {{ $contact->nickname }}
        </h2>

        <p class="text-gray-500 text-sm">
            {{ $contact->contact->phone }}
        </p>
    </div>

</a>

@endforeach

    </div>

</div>

</body>
</html>