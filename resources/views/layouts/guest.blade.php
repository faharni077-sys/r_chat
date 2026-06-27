<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>R-Chat</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased bg-[#efeae2]">

<div class="min-h-screen flex items-center justify-center p-8">

    <div class="w-full max-w-md bg-white rounded-2xl shadow-xl p-8">

        <div class="text-center mb-8">

            <img src="{{ asset('images/logo.webp') }}"
                 class="w-16 h-16 mx-auto mb-3">

            <h1 class="text-4xl font-bold text-[#00a884]">
                R-Chat
            </h1>

            <p class="text-gray-500 mt-2">
                Masuk ke akun R-Chat
            </p>

        </div>

        {{ $slot }}

    </div>

</div>

</body>
</html>