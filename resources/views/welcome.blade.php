<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>R-Chat</title>

    @vite(['resources/css/app.css','resources/js/app.js'])
</head>

<body class="bg-[#e5ddd5] min-h-screen flex items-center justify-center">

<div class="bg-white w-[1100px] h-[650px] rounded-xl shadow-2xl flex overflow-hidden">

    <!-- KIRI -->
    <div class="w-1/2 flex flex-col items-center justify-center p-10 pt-16">

        <div class="flex items-center gap-3 mb-6">

    <img
        src="/images/logo.webp"
        class="w-12 h-12"
    >

    <h1 class="text-4xl font-bold text-[#00a884]">
        R-Chat
    </h1>

</div>

<h2 class="text-2xl font-semibold text-gray-800 mb-6 text-center">
    Gunakan R-Chat di komputer Anda
</h2>

<div class="text-left text-gray-700 leading-8 mb-8">

    <p>1. Buka aplikasi R-Chat di HP.</p>

    <p>2. Pilih menu <b>Perangkat Tertaut</b>.</p>

    <p>3. Scan QR Code di bawah ini.</p>

</div>

        <img
           src="/images/qr.png"
           alt="QR Code"
           class="w-64 h-64 border rounded-lg shadow"
        />

        <p class="mt-5 text-green-600 font-medium">

        QR akan diperbarui dalam
        <span id="timer">55</span>
        detik

        </p>
        
        <div class="mt-5 flex items-center gap-3">

        <input
        type="checkbox"
        checked>

        <label class="text-gray-600">

        Tetap masuk di browser ini

        </label>

        </div>

        <p class="mt-6 text-gray-600 text-center">
            Scan QR Code untuk login
        </p>

    </div>

    <!-- KANAN -->
    <div class="w-1/2 bg-[#f8f9fa] flex flex-col justify-center px-14">

        <h2 class="text-3xl font-bold mb-8">

            Selamat Datang

        </h2>

        <p class="text-gray-500 mb-8">

            Login menggunakan akun R-Chat.

        </p>

        <a href="{{ route('login') }}"
    class="block w-full bg-[#00a884] text-white text-center py-4 rounded-lg hover:bg-[#00906f] transition">
    Login
</a>

        <a href="{{ route('register') }}"
        class="mt-4 border border-[#00a884] text-[#00a884] text-center py-3 rounded-lg font-semibold hover:bg-[#00a884] hover:text-white">

            Register

        </a>

    </div>

</div>

<script>

let waktu = 55;

setInterval(function(){

    waktu--;

    if(waktu<=0){

        waktu=55;

    }

    document.getElementById('timer').innerHTML = waktu;

},1000);

</script>

</body>
</html>