<x-app-layout>

<div class="flex h-screen">

    <div class="w-full flex flex-col">

        <div class="bg-[#202c33] text-white p-4">

            <div class="text-xl font-bold">
                👥 {{ $group->group_name }}
            </div>

            <div class="text-sm mt-2 text-gray-300">
    Anggota:
    @foreach($group->members as $member)
        {{ $member->user->name }}@if(!$loop->last), @endif
    @endforeach
</div>


            @if(auth()->id() == $group->admin_id)

<a href="{{ route('group.member.create', $group->id) }}"
class="bg-blue-500 text-white px-3 py-2 rounded">
➕ Tambah Anggota
</a>

@endif

        </div>

        <div class="flex-1 overflow-y-auto p-4 bg-gray-100">

            @foreach($messages as $message)

                <div class="mb-3">

                    <div class="font-bold">
                        {{ $message->sender->name }}
                    </div>

                    <div class="bg-white rounded p-3 inline-block">

                        @if($message->image)

<img
src="{{ asset('storage/'.$message->image) }}"
class="rounded-lg mb-2 max-w-[250px]">

@endif

@if($message->message)

{{ $message->message }}

@endif

                    </div>

                </div>

            @endforeach

        </div>

        <form
        action="{{ route('group.send') }}"
        method="POST"
        enctype="multipart/form-data"
        class="p-3 bg-white flex gap-2">

            @csrf

            <input
                type="hidden"
                name="group_id"
                value="{{ $group->id }}"
            >

            <input
                type="text"
                name="message"
                class="w-full border rounded-full p-3"
                placeholder="Ketik pesan grup..."
            >

            <label for="image" class="text-3xl cursor-pointer">
            📷
            </label>

            <input
            type="file"
            id="image"
            name="image"
            class="hidden">

            <button
                class="bg-green-600 text-white px-5 rounded-full">
                Kirim
            </button>

        </form>

    </div>

</div>


@vite('resources/js/app.js')

<script type="module">

window.Echo
.channel('group.{{ $group->id }}')
.listen('.group.message.sent', (e) => {

    console.log(e);

    location.reload();

});

</script>
</x-app-layout>