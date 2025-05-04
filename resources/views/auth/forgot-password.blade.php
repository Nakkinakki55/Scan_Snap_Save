<x-guest-layout>
    <div class="mb-4 text-sm text-gray-600">
        {{ __('パスワードをお忘れですか？ご安心ください。ご登録のメールアドレスを入力していただければ、新しいパスワードを設定するためのリンクをお送りします。') }}
    </div>

    <!-- セッションステータス -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <!-- メールアドレス -->
        <div>
            <x-input-label for="email" :value="__('メールアドレス')" />
            <x-text-input id="email" class="border block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button>
                {{ __('パスワード再設定用リンクを送信') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
