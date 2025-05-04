<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- 名前 -->
        <div>
            <x-input-label for="name" :value="__('お名前')" />
            <x-text-input id="name" class="block mt-1 w-full text-black border border-black" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- メールアドレス -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('メールアドレス')" />
            <x-text-input id="email" class="block mt-1 w-full text-black border border-black" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- パスワード -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('パスワード')" />
            <x-text-input id="password" class="block mt-1 w-full text-black border border-black" type="password" name="password" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- パスワード（確認） -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('パスワード（確認）')" />
            <x-text-input id="password_confirmation" class="block mt-1 w-full text-black border border-black" type="password" name="password_confirmation" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <!-- 登録ボタン -->
        <div class="mt-4 text-right">
            <x-primary-button class="w-1/2 ml-auto h-14 flex items-center justify-center text-xl font-bold">
                {{ __('新規登録') }}
            </x-primary-button>
        </div>

        <!-- すでに登録済みの場合 -->
        <div class="flex items-center justify-between mt-4">
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 " href="{{ route('login') }}">
                {{ __('すでに登録済みですか？') }}
            </a>
        </div>
    </form>
</x-guest-layout>
