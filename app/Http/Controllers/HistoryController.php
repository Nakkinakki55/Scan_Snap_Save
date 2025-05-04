<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use App\Models\QrImage;

class HistoryController extends Controller
{
    // ユーザーの撮影履歴ページ
    public function index(Request $request)
    {
        $query = QrImage::where('user_id', Auth::id());

        // 検索条件
        if ($request->filled('filename')) {
            $query->where('image_path', 'like', "%{$request->filename}%");
        }
        if ($request->filled('start_date') && $request->filled('end_date')) {
            $query->whereBetween('created_at', [$request->start_date, $request->end_date]);
        }

        // ページネーション (50件ずつ)
        $images = $query->orderBy('created_at', 'desc')->paginate(50);

        return view('history', compact('images'));
    }

    // 画像の詳細ページ
    public function show($id)
    {
         // ユーザーが自分の画像のみを見ることができるように、user_id を確認
        $qrImage = QrImage::where('user_id', Auth::id())->findOrFail($id);
        
        // ビューに $qrImage を渡す
        return view('detail', compact('qrImage'));
    }
}



?>
