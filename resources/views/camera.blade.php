<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight text-center">
            QRコードの内容：<span class="font-semibold" id="qrText">{{ $qrData }}</span>
        </h2>
    </x-slot>

    <div class="py-2">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow sm:rounded-lg p-6">

                <video id="videoElement" class="w-full max-w-[640px] mx-auto rounded-lg mt-4" autoplay
                    playsinline></video>
                <div class="mt-6 text-center">
                    <button id="captureButton"
                        class="w-full py-[18px] text-lg bg-blue-600 text-white rounded-lg focus:outline-none hover:bg-blue-800 flex items-center justify-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-9 h-9">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M6.827 6.175A2.31 2.31 0 0 1 5.186 7.23c-.38.054-.757.112-1.134.175C2.999 7.58 2.25 8.507 2.25 9.574V18a2.25 2.25 0 0 0 2.25 2.25h15A2.25 2.25 0 0 0 21.75 18V9.574c0-1.067-.75-1.994-1.802-2.169a47.865 47.865 0 0 0-1.134-.175 2.31 2.31 0 0 1-1.64-1.055l-.822-1.316a2.192 2.192 0 0 0-1.736-1.039 48.774 48.774 0 0 0-5.232 0 2.192 2.192 0 0 0-1.736 1.039l-.821 1.316Z" />
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M16.5 12.75a4.5 4.5 0 1 1-9 0 4.5 4.5 0 0 1 9 0ZM18.75 10.5h.008v.008h-.008V10.5Z" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div id="message" class="text-center text-sm font-semibold mt-4"></div>

    <!-- モーダル -->
    <div id="popup-modal" class="hidden fixed inset-0 flex items-center justify-center z-50 bg-black/50">
        <div class="bg-white rounded-lg shadow max-w-md w-full p-6">
            <div class="text-center">
                <h3 class="mb-5 text-lg font-normal text-gray-700 ">
                    カメラ撮影ができました。次に進みますか？
                </h3>
                <p id="modalQrText" class="mb-4 text-sm text-gray-600  break-words"></p>
                <img id="modalPreviewImage" class="max-w-full rounded-lg shadow-lg mx-auto mb-4" />

                <div id="uploadingSpinner" class="hidden mb-4">
                    <svg class="animate-spin h-6 w-6 text-blue-600 mx-auto" xmlns="http://www.w3.org/2000/svg"
                        fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4">
                        </circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z" />
                    </svg>
                    <p class="text-sm text-gray-500 mt-2">アップロード中...</p>
                </div>

                <div id="modalButtons" class="flex justify-center gap-4">
                    <button id="modalYes"
                        class="w-24 text-white bg-blue-600 hover:bg-blue-800 font-medium rounded-lg text-sm px-5 py-2.5">
                        はい
                    </button>
                    <button id="modalNo"
                        class="w-24 text-gray-700 bg-white border border-gray-300 hover:bg-gray-100 rounded-lg text-sm px-5 py-2.5">
                        キャンセル
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- トースト通知 -->
    <div id="toast"
        class="hidden fixed bottom-4 right-4 bg-blue-600 text-white px-4 py-2 rounded-lg shadow-lg z-50 transition-opacity duration-300">
    </div>

    <form id="imageUploadForm" action="{{ route('upload-qr-image') }}" method="POST">
        @csrf
        <input type="hidden" name="qr_data" id="hiddenQrData" value="{{ $qrData }}">
        <input type="hidden" name="image_base64" id="imageBase64">
    </form>

    <script>
        const videoElement = document.getElementById("videoElement");
        const captureButton = document.getElementById("captureButton");
        const message = document.getElementById("message");

        const modal = document.getElementById("popup-modal");
        const modalQrText = document.getElementById("modalQrText");
        const modalPreviewImage = document.getElementById("modalPreviewImage");
        const modalYes = document.getElementById("modalYes");
        const modalNo = document.getElementById("modalNo");
        const modalButtons = document.getElementById("modalButtons");
        const uploadingSpinner = document.getElementById("uploadingSpinner");

        const toast = document.getElementById("toast");

        let uploadSucceeded = false;

        function showToast(message, isSuccess = true) {
            toast.textContent = message;
            toast.className = `fixed bottom-4 right-4 px-4 py-2 rounded-lg shadow-lg z-50 transition-opacity duration-300 ${isSuccess ? 'bg-green-600 text-white' : 'bg-red-600 text-white'
                }`;
            toast.classList.remove("hidden");

            setTimeout(() => {
                toast.classList.add("hidden");
            }, 3000);
        }

        async function initCamera() {
            try {
                const stream = await navigator.mediaDevices.getUserMedia({
                    video: { facingMode: "environment" }
                });
                videoElement.srcObject = stream;
            } catch (error) {
                console.error("カメラにアクセスできません:", error);
                message.textContent = "カメラにアクセスできません。";
                message.classList.add("text-red-600");
            }
        }

        captureButton.addEventListener("click", async () => {
            const canvas = document.createElement("canvas");
            const context = canvas.getContext("2d");

            // 元のサイズ
            const originalWidth = videoElement.videoWidth;
            const originalHeight = videoElement.videoHeight;

            // 高さ最大1080px（アスペクト比を保ってリサイズ）
            const maxHeight = 1080;
            let targetWidth = originalWidth;
            let targetHeight = originalHeight;

            if (originalHeight > maxHeight) {
                const ratio = maxHeight / originalHeight;
                targetWidth = originalWidth * ratio;
                targetHeight = maxHeight;
            }

            canvas.width = targetWidth;
            canvas.height = targetHeight;
            context.drawImage(videoElement, 0, 0, targetWidth, targetHeight);

            // JPEGで品質80に圧縮
            const compressedImageData = canvas.toDataURL("image/jpeg", 0.8);

            // モーダルに表示
            modalQrText.textContent = document.getElementById("qrText").textContent;
            modalPreviewImage.src = compressedImageData;
            document.getElementById("imageBase64").value = compressedImageData;

            modal.classList.remove("hidden");
            stopCamera();
        });

        modalYes.addEventListener("click", () => {
            if (uploadSucceeded) {
                window.location.href = "{{ route('dashboard') }}";
                return;
            }

            modalQrText.textContent = "アップロード中...";
            modalPreviewImage.src = "";
            uploadingSpinner.classList.remove("hidden");
            modalButtons.classList.add("hidden");

            uploadImage();
        });

        modalNo.addEventListener("click", () => {
            if (uploadSucceeded) {
                window.location.href = "{{ route('history') }}";
            } else {
                modal.classList.add("hidden");
                startCamera();
            }
        });

        function startCamera() {
            let stream = videoElement.srcObject;
            if (stream) {
                stream.getTracks().forEach(track => track.stop());
            }

            navigator.mediaDevices.getUserMedia({
                video: { facingMode: "environment" }
            }).then(stream => {
                videoElement.srcObject = stream;
            }).catch(error => {
                console.error("カメラにアクセスできません:", error);
                message.textContent = "カメラにアクセスできません。";
                message.classList.add("text-red-600");
            });
        }

        function stopCamera() {
            let stream = videoElement.srcObject;
            if (stream) {
                stream.getTracks().forEach(track => track.stop());
                videoElement.srcObject = null;
            }
        }

        function uploadImage() {
            fetch("{{ route('upload-qr-image') }}", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": document.querySelector('input[name="_token"]').value
                },
                body: JSON.stringify({
                    qr_data: document.getElementById("hiddenQrData").value,
                    image_base64: document.getElementById("imageBase64").value
                })
            })
                .then(response => response.json())
                .then(data => {
                    if (data.qr_image) {
                        modalQrText.textContent = "画像が正常にアップロードされました！";
                        uploadSucceeded = true;
                        showToast("アップロード成功しました");
                    } else {
                        throw new Error(data.error || "アップロードに失敗しました");
                    }
                })
                .catch(error => {
                    console.error("アップロードエラー:", error);
                    modalQrText.textContent = "アップロードに失敗しました。";
                    showToast("アップロード失敗", false);
                })
                .finally(() => {
                    uploadingSpinner.classList.add("hidden");
                    modalButtons.classList.remove("hidden");
                });
        }

        window.addEventListener("load", initCamera);
    </script>
</x-app-layout>