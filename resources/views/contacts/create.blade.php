<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Kontak - R-Chat</title>

    @vite(['resources/css/app.css','resources/js/app.js'])
</head>

<body class="bg-gray-100">

<div class="max-w-md mx-auto min-h-screen bg-white shadow">

    <!-- Header -->
    <div class="flex items-center gap-4 p-4 border-b">

        <a href="{{ route('contacts.index') }}" class="text-2xl">
            ←
        </a>

        <h1 class="text-2xl font-semibold">
            Tambah Kontak
        </h1>

    </div>

    <form action="{{ route('contacts.store') }}" method="POST">

        @csrf

        <div class="p-5 space-y-5">

            <div>
                <label class="block mb-2 font-medium">
                    Nama Depan
                </label>

                <input
                    type="text"
                    name="first_name"
                    class="w-full border rounded-lg p-3"
                    required>
            </div>

            <div>
                <label class="block mb-2 font-medium">
                    Nama Belakang (Opsional)
                </label>

                <input
                    type="text"
                    name="last_name"
                    class="w-full border rounded-lg p-3">
            </div>

            <div>
                <label class="block mb-2 font-medium">
                    Nomor HP
                </label>

                <input
                    type="text"
                    name="phone"
                    placeholder="08xxxxxxxxxx"
                    class="w-full border rounded-lg p-3"
                    required>
            </div>

            <button
                class="w-full bg-green-500 text-white py-3 rounded-lg font-semibold">

                Simpan Kontak

            </button>

        </div>

    </form>

    @if(session('error'))
    <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
        {{ session('error') }}
    </div>
@endif

</div>

</body>
</html>