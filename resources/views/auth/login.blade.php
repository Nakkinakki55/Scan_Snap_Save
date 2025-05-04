<x-guest-layout>
    <!-- セッションステータス -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- メールアドレス -->
        <div>
            <x-input-label for="email" :value="'メールアドレス'" />
            <x-text-input id="email" class="border block mt-1 w-full text-black" type="email" name="email" :value="old('email')" required
                autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- パスワード -->
        <div class="mt-4">
            <x-input-label for="password" :value="'パスワード'" />
            <x-text-input id="password" class="border block mt-1 w-full text-black" type="password" name="password" required
                autocomplete="current-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- ログイン状態を保持 -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox"
                    class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500"
                    name="remember">
                <span class="ms-2 text-sm text-gray-600">ログイン状態を保持する</span>
            </label>
        </div>

        <!-- ログインボタン -->
        <div class="mt-4 text-right">
            <x-primary-button class="w-1/2 ml-auto h-14 flex items-center justify-center text-xl font-bold">
                ログイン
            </x-primary-button>
        </div>

        <!-- パスワードをお忘れですか？ -->
        <div class="flex items-center justify-between mt-4">
            @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 "
                    href="{{ route('password.request') }}">
                    パスワードをお忘れですか？
                </a>
            @endif
        </div>
    </form>
</x-guest-layout>
