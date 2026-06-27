<x-app-layout>
<div class="flex h-screen">

    <!-- Sidebar -->
    <div class="w-1/4 bg-white border-r flex flex-col">
        <div class="flex items-center justify-between p-4 bg-[#202c33] text-white">

    <div class="font-bold text-2xl">
        💬 R-Chat
    </div>

    <a href="{{ route('contacts.index') }}"
       class="text-3xl hover:text-green-400"
       title="Tambah Kontak">
        +
    </a>

</div>

        <div class="p-3 bg-[#f0f2f5] border-b">
            <form method="GET" action="{{ route('dashboard') }}">

    <input
        type="text"
        name="search"
        value="{{ $search ?? '' }}"
        placeholder="Cari kontak..."
        class="w-full p-2 border rounded"
    >

</form>
        </div>

    @foreach($users as $user)

<a href="{{ route('chat.show', $user->id) }}">

<div class="flex items-center p-4 border-b hover:bg-gray-100
@if(isset($selectedUser) && $selectedUser->id == $user->id)
bg-green-100
@endif">

    <div class="w-12 h-12 rounded-full bg-green-500 text-white flex items-center justify-center font-bold">
        {{ strtoupper(substr($user->nickname,0,1)) }}
    </div>

    <div class="ml-3 flex-1 flex justify-between items-start">

        <div>

            <div class="font-semibold">
                {{ $user->nickname }}
            </div>

            <div class="text-sm text-gray-500 truncate">
                {{ $user->last_message }}
            </div>

        </div>

        <div class="text-xs text-gray-500">
            {{ $user->last_time }}
        </div>

    </div>

</div>

</a>

@endforeach
    </div>

    <!-- Area Chat -->
    <div class="flex-1 flex flex-col">

    @if(isset($selectedUser))

<div class="bg-[#202c33] text-white p-3 flex items-center justify-between">

    <div class="flex items-center gap-3">

        <div class="w-10 h-10 rounded-full bg-green-500 flex items-center justify-center font-bold">
            @if(isset($selectedUser))
                {{ strtoupper(substr($selectedUser->name,0,1)) }}
            @endif
        </div>

        <div>

            @if(isset($selectedUser))
                <div class="font-semibold">
                    {{ $selectedUser->name }}
                </div>

                <div class="text-xs text-gray-300">
    {{ $selectedUser->status }}
</div>
            @else
                Pilih Chat
            @endif

        </div>

    </div>

<div class="flex items-center gap-5">

    <button class="text-xl">
        📞
    </button>

    <button class="text-xl">
        🎥
    </button>

    <div class="relative">

        <button onclick="toggleMenu()" class="text-2xl">
            ⋮
        </button>

        <div id="menu"
             class="hidden absolute right-0 mt-2 w-52 bg-white rounded shadow-lg text-black z-50">

            <a href="#" class="block px-4 py-2 hover:bg-gray-100">
                👤 Profil
            </a>

            <a href="#" class="block px-4 py-2 hover:bg-gray-100">
                ⚙️ Pengaturan
            </a>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="w-full text-left px-4 py-2 hover:bg-gray-100">
                    🚪 Logout
                </button>
            </form>

        </div>

    </div>

</div>

</div>

<div
id="chatBox"
class="flex-1 p-4 overflow-y-auto"
style="
background-image:url('/images/wa-bg.jpg');
background-size:cover;
background-repeat:repeat;
">

@if(isset($messages))
    @foreach($messages as $message)

        @if($message->sender_id == auth()->id())

            <div class="flex justify-end mb-3">
                <div class="bg-green-500 text-white px-4 py-2 rounded-lg max-w-xs">

                    @if($message->image)

<img
    src="{{ asset('storage/'.$message->image) }}"
    class="rounded-lg mb-2 max-w-[250px]">

@endif
                    
                     @if($message->is_deleted)

<i class="text-gray-400"> 🗑 Pesan ini telah dihapus </i>

@else



                    {{ $message->message }}
@endif

                    <div class="text-xs mt-1 text-right">
                        

    {{ $message->created_at->format('H:i') }}

    @if($message->status == 'sent')
        ✔
    @elseif($message->status == 'delivered')
        ✔✔
    @elseif($message->status == 'seen')
        <span class="text-blue-300">✔✔</span>
    @endif


    <form
    method="POST"
    action="{{ route('message.destroy', $message->id) }}"
    onsubmit="return confirm('Hapus pesan ini?')">

    @csrf
    @method('DELETE')

    <button
        class="text-red-200 text-xs mt-1 hover:text-red-500">
        🗑 Hapus
    </button>

</form>
</div>
                    </div>
                </div>


        @else

            <div class="flex justify-start mb-3">
                <div class="bg-white border px-4 py-2 rounded-lg max-w-xs">

                    @if($message->image)

<img
    src="{{ asset('storage/'.$message->image) }}"
    class="rounded-lg mb-2 max-w-[250px]">

@endif

                    

                    @if($message->is_deleted)

<i class="text-gray-400">
    🗑 Pesan ini telah dihapus
</i>

@else

{{ $message->message }}

@endif

<div class="text-xs mt-1 text-right text-gray-500">
    {{ $message->created_at->format('H:i') }}
</div>



                </div>
            </div>

        @endif

    @endforeach
@endif

</div>

@if(isset($selectedUser))

<form
action="{{ route('message.send') }}"
method="POST"
enctype="multipart/form-data"
class="p-3 bg-[#f0f2f5] border-t">
    @csrf

    <input
        type="hidden"
        name="receiver_id"
        value="{{ $selectedUser->id }}"
    >

    <div class="flex gap-2">
        <input
            type="text"
            name="message"
            placeholder="Ketik pesan..."
            class="w-full p-3 rounded-full border focus:outline-none"
            
        >

        <label
for="image"
class="cursor-pointer text-3xl px-2">

📷

</label>

<input
type="file"
id="image"
name="image"
class="hidden">

        <button
            type="submit"
            class="bg-[#00a884] hover:bg-[#008f72] text-white px-6 rounded-full"
        >
            Kirim
        </button>
    </div>
</form>

@endif

    </div>

@else

<div class="flex-1 flex items-center justify-center bg-[#f8f9fa]">

    <div class="text-center">

        <div class="text-7xl mb-6">
            💬
        </div>

        <h1 class="text-3xl font-semibold text-gray-700">
            Selamat Datang di R-Chat
        </h1>

        <p class="mt-4 text-gray-500 max-w-md">
            Kirim dan terima pesan dengan cepat.
            Pilih kontak di sebelah kiri untuk memulai percakapan.
        </p>

        <p class="mt-10 text-sm text-gray-400">
            🔒 Pesan pribadi Anda terlindungi.
        </p>

    </div>

</div>

@endif
    
</div>
<script>
window.onload = function () {
    let chat = document.getElementById('chatBox');
    chat.scrollTop = chat.scrollHeight;
}
</script>

<script type="module">

window.Echo
.private('chat.{{ auth()->id() }}')
.listen('.message.sent', (e) => {

    location.reload();

});

</script>

<script>
function toggleMenu(){
    document.getElementById('menu').classList.toggle('hidden');
}
</script>
</x-app-layout>