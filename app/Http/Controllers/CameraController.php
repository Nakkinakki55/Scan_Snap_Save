<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CameraController extends Controller
{
    public function passQrToCamera(Request $request)
    {
        // QRコードのデータを保持
        $qrData = $request->input('qr_data'); // POSTされたQRコードのデータを受け取る

        // 受け取ったQRコードのデータを次のページに渡す
        return view('camera', compact('qrData'));
    }
    
}
