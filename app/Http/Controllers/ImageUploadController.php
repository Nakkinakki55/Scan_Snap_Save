<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use App\Models\QrImage;

class ImageUploadController extends Controller
{
    public function uploadAndStore(Request $request)
    {
        if (!Auth::check()) {
            return response()->json(['error' => '認証が必要です'], 401);
        }

        $base64Image = $request->input('image_base64');
        $qrData = $request->input('qr_data');

        if (!$base64Image || !$qrData) {
            return response()->json(['error' => '画像またはQRデータが見つかりません'], 400);
        }

        // Base64データの前処理
        $base64Image = str_replace('data:image/jpeg;base64,', '', $base64Image);
        $base64Image = str_replace(' ', '+', $base64Image);
        $imageData = base64_decode($base64Image);

        if (!$imageData) {
            return response()->json(['error' => '画像のデコードに失敗しました'], 400);
        }

        // ユーザーごとのフォルダに保存
        $filename = 'camera_uploads/' . Auth::id() . '/' . uniqid() . '.png';

        try {
            // S3 にアップロード（非公開）
            Storage::disk('s3')->put($filename, $imageData, 'private');

            // DBにQRデータ、画像パス、ユーザーIDを保存
            $qrImage = QrImage::create([
                'user_id' => Auth::id(),  // ユーザーIDを追加
                'qr_data' => $qrData,
                'image_path' => $filename,
            ]);

            return response()->json([
                'message' => '画像をアップロードし、データを保存しました',
                'qr_image' => $qrImage,
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'アップロードまたは保存に失敗しました', 'details' => $e->getMessage()], 500);
        }
    }

    public function getImage($filename)
    {
        $userId = Auth::id();
        $path = "camera_uploads/{$userId}/{$filename}";

        // 画像が存在するか確認
        if (!Storage::disk('s3')->exists($path)) {
            return response()->json(['error' => '画像が見つかりません'], 404);
        }

        // S3 から画像を取得
        try {
            $imageData = Storage::disk('s3')->get($path);
            $mimeType = Storage::disk('s3')->mimeType($path);

            // デバッグログを追加（ログを確認してください）
            \Log::info("画像の取得成功: " . $path);

            return response($imageData, 200)->header('Content-Type', $mimeType);
        } catch (\Exception $e) {
            return response()->json(['error' => '画像の取得に失敗しました', 'details' => $e->getMessage()], 500);
        }
    }
}
