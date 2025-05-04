<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'ScanSnapSave') }}</title>
    @laravelPWA
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

    <!-- Styles / Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    @vite(['resources/js/app.js'])
    
</head>

<body class="bg-[#FDFDFC] text-[#1b1b18] flex p-6 lg:p-8 items-center min-h-screen flex-col">

    <!-- 上部ナビゲーション -->
    <header class="w-full bg-black text-white py-4 px-6 shadow-md">
        @if (Route::has('login'))
            <nav class="flex items-center justify-end gap-4 max-w-7xl mx-auto">
                @auth
                <a href="{{ url('/dashboard') }}"
                    class="px-5 py-2 rounded-md bg-blue-600 text-white hover:bg-blue-500 font-medium text-sm transition">
                    ダッシュボードへ
                </a>
                @else
                    <a href="{{ route('login') }}"
                        class="px-5 py-2 rounded-md border border-white text-white hover:bg-white hover:text-black font-medium text-sm transition">
                        ログイン
                    </a>

                    @if (Route::has('register'))
                    <a href="{{ route('register') }}"
                        class="px-5 py-2 rounded-md bg-blue-600 text-white hover:bg-blue-500 font-medium text-sm transition">
                        新規登録
                    </a>
                    @endif
                @endauth
            </nav>
        @endif
    </header>



    <!-- アプリ紹介セクション -->
    <section class="w-full lg:max-w-3xl text-center px-4">

        <div class="flex flex-col items-center justify-center mb-2">
            <img src="{{ asset('images/logo.svg') }}" alt="ScanSnapSave Logo" class="h-[255px] w-auto" />


            <!-- 説明文 -->
            <p class="text-gray-700 leading-relaxed text-base">
                <strong>ScanSnapSave</strong> は、QRコードを読み取り、画像と共にサーバーへ送信し、
                その内容を保存・閲覧できるアプリです。
                PWA（Progressive Workers Association）により、スマホのホーム画面からネイティブアプリのように使えます。
            </p>

            <!-- 特徴リスト -->
            <ul class="mt-4 text-sm text-gray-600 list-disc list-inside text-left mx-auto max-w-md">
                <li>PC・タブレット・スマホ にも対応</li>
                <li>iPhone・Android どちらにも対応</li>
                <li>アプリストアからインストール不要（URLを開くだけ）</li>
                <li>開発・運用コストを削減</li>
            </ul>

            <p class="mt-4 text-gray-700">
                スマホやPC1台でQRコードのスキャンから画像保存・内容管理まで、すべてこのアプリでできます。
            </p>
    </section>
    <script src="{{ asset('js/jsQR.js') }}"></script>
</body>

</html>