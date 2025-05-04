<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- <title>{{ config('app.name', 'ScanSnapSave') }}</title> -->
    <title>{{ config('app.name', 'ScanSnapSave') }}</title>
    @laravelPWA
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <!-- 通常のファビコン -->
    <link rel="icon" type="image/x-icon" href="{{ asset('images/favicon.ico') }}">

    <!-- Apple端末用アイコン（ホーム画面追加時に表示） -->
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('images/favicon.ico') }}">

    <!-- Android用アイコン（PWA対応なども含む） -->
    <link rel="manifest" href="{{ asset('webmanifest') }}">

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    @vite(['resources/js/app.js'])
</head>

<body class="font-sans text-gray-900 antialiased">
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100 ">
        <div>
            <a href="/">
                <img src="{{ asset('images/logo.svg') }}" alt="Logo" class="w-[55%] h-auto max-w-sm mx-auto" />
            </a>

        </div>

        <div class="w-[90%] sm:max-w-md px-6 py-4 bg-white  shadow-md overflow-hidden sm:rounded-lg">
            {{ $slot }}
        </div>
    </div>
</body>

</html>