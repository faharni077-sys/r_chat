<x-app-layout>

<div class="max-w-lg mx-auto mt-10">

    <h1 class="text-2xl font-bold mb-5">
        👥 Buat Group
    </h1>

    <form action="{{ route('groups.store') }}" method="POST">

        @csrf

        <input
            type="text"
            name="name"
            placeholder="Nama Group"
            class="w-full border rounded p-3 mb-4"
        >

        <button
            class="bg-green-600 text-white px-5 py-3 rounded">
            Buat Group
        </button>

    </form>

</div>

</x-app-layout>