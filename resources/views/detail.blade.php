<x-app-layout>
    <div class="py-4">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow sm:rounded-lg p-6">
                <h2 class="text-xl font-semibold text-gray-800 mb-4">画像詳細</h2>

                <div class="text-center">
                    <img src="{{ route('show-image', ['filename' => basename($qrImage->image_path)]) }}" alt="Uploaded Image" class="mx-auto mb-4 rounded shadow">
                    <p class="text-gray-600">QRデータ: {{ $qrImage->qr_data }}</p>
                    <p class="text-gray-600">アップロード日時: {{ $qrImage->created_at }}</p>
                </div>

                <div class="mt-4 text-center">
                    <a href="{{ route('history') }}" class="px-4 py-2 bg-gray-500 text-white rounded">戻る</a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
