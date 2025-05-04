<x-app-layout>
    <div class="py-2">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow sm:rounded-lg p-6">
                <h2 class="text-center text-xl font-semibold text-gray-800 leading-tight mb-6">
                    アップロードした画像
                </h2>

                @if (isset($filename))
                    <div class="text-center">
                    <img src="{{ route('show-image', ['filename' => basename($filename)]) }}" alt="Uploaded Image">

                    </div>
                @else
                    <p class="text-center text-gray-500">画像が見つかりません。</p>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
