const video = document.createElement("video");
const canvasElement = document.getElementById("canvas");
const canvas = canvasElement.getContext("2d");
const loadingMessage = document.getElementById("loadingMessage");

// モーダル関連
const scannedText = document.getElementById("scannedText");
const modal = document.getElementById("popup-modal");
const modalYes = document.getElementById("modalYes");
const modalNo = document.getElementById("modalNo");

let isDialogShown = false; // モーダル表示状態のフラグ

function drawLine(begin, end, color) {
    canvas.beginPath();
    canvas.moveTo(begin.x, begin.y);
    canvas.lineTo(end.x, end.y);
    canvas.lineWidth = 4;
    canvas.strokeStyle = color;
    canvas.stroke();
}

navigator.mediaDevices.getUserMedia({ video: { facingMode: "environment" } }).then(function(stream) {
    video.srcObject = stream;
    video.setAttribute("playsinline", true);
    video.play();
    requestAnimationFrame(tick);
});

function tick() {
    if (video.readyState === video.HAVE_ENOUGH_DATA) {
        loadingMessage.hidden = true;
        canvasElement.hidden = false;

        canvasElement.height = video.videoHeight;
        canvasElement.width = video.videoWidth;
        canvas.drawImage(video, 0, 0, canvasElement.width, canvasElement.height);
        const imageData = canvas.getImageData(0, 0, canvasElement.width, canvasElement.height);
        const code = jsQR(imageData.data, imageData.width, imageData.height, {
            inversionAttempts: "dontInvert",
        });

        // QRコードが読み取れている場合
        if (code && !isDialogShown) {
            // QRコードのデータが空でないことを確認
            if (code.data && code.data.trim() !== "") {
                // データをモーダルに表示
                scannedText.innerText = code.data;

                // QRコードの位置に線を引く
                drawLine(code.location.topLeftCorner, code.location.topRightCorner, "#FF3B58");
                drawLine(code.location.topRightCorner, code.location.bottomRightCorner, "#FF3B58");
                drawLine(code.location.bottomRightCorner, code.location.bottomLeftCorner, "#FF3B58");
                drawLine(code.location.bottomLeftCorner, code.location.topLeftCorner, "#FF3B58");

                // モーダルを表示する前にフラグをセット
                isDialogShown = true;
                modal.classList.remove("hidden");

                // モーダルのボタンの動作
                modalYes.onclick = () => {
                    // QRコードのデータをフォームに設定して送信
                    document.getElementById("qrData").value = code.data;
                    document.getElementById("qrForm").submit(); // POST送信
                };

                modalNo.onclick = () => {
                    modal.classList.add("hidden");
                    isDialogShown = false; // モーダルを閉じた後にフラグをリセット
                };
            }
        }
    }
    requestAnimationFrame(tick);
}