<x-app-layout>
<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight text-center">
        {{ __('QRコードスキャン') }}
    </h2>
</x-slot>

<div class="py-2">
    <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white shadow sm:rounded-lg p-6">
            <div id="loadingMessage" class="text-center text-gray-700">
                🎥 カメラにアクセス中...（Webカメラを許可してください）
            </div>
            <canvas id="canvas" class="w-full max-w-[640px] mx-auto rounded-lg mt-4" hidden></canvas>
        </div>
    </div>
</div>

<!-- モーダル -->
<div id="popup-modal" tabindex="-1" class="hidden fixed inset-0 flex items-center justify-center z-50 bg-black/50">
    <div class="bg-white rounded-lg shadow max-w-md w-full p-6">
        <div class="text-center">
            <svg class="mx-auto mb-4 text-green-500 w-12 h-12 " xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M5 13l4 4L19 7"/>
            </svg>
            <h3 class="mb-5 text-lg font-normal text-gray-700 ">QRコードを読み取りました。次に進みますか？</h3>
            <p id="scannedText" class="mb-4 text-sm text-gray-600 break-words"></p>
            <div class="flex justify-center gap-4">
                <!-- はいボタンをクリックした際にフォームを送信する -->
                <button id="modalYes" type="button"
                        class="w-24 text-white bg-blue-600 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300  font-medium rounded-lg text-sm px-5 py-2.5">
                    はい
                </button>
                <button id="modalNo" type="button"
                        class="w-24 text-gray-700 bg-white border border-gray-300 hover:bg-gray-100 focus:outline-none focus:ring-4 focus:ring-gray-200 rounded-lg text-sm px-5 py-2.5">
                    キャンセル
                </button>
            </div>
        </div>
    </div>
</div>

<!-- フォーム -->
<form id="qrForm" action="{{ route('camera') }}" method="POST" class="hidden">
    @csrf
    <input type="hidden" name="qr_data" id="qrData">
</form>

{{-- jsQRと読み取りスクリプト --}}
<script src="{{ asset('js/jsQR.js') }}"></script>
<script src="{{ asset('js/qr_camera.js') }}"></script>

</x-app-layout>
