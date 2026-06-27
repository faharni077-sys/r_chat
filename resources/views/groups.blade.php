<x-app-layout>

<div class="p-5">

    <div class="flex justify-between mb-5">

        <h1 class="text-2xl font-bold">
            👥 Group Chat
        </h1>

        <a href="{{ route('groups.create') }}"
   class="bg-green-500 text-white px-4 py-2 rounded">
            + Buat Grup
        </a>

    </div>

    @foreach($groups as $group)

        <a href="{{ route('group.show',$group->id) }}">

            <div class="border p-4 rounded mb-3 hover:bg-gray-100">

                👥 {{ $group->group_name }}

            </div>

        </a>


        <a href="{{ route('group.member.create', $group->id) }}"
   class="text-blue-600 ml-3">
    ➕ Tambah Anggota
</a>

    @endforeach

</div>

</x-app-layout>