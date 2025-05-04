<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\CameraController;
use App\Http\Controllers\ImageUploadController;
// web.php ルーティング設定
use App\Http\Controllers\HistoryController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();

    return redirect('/home');
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();

    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');


Route::post('/camera', [CameraController::class, 'passQrToCamera'])
    ->middleware(['auth', 'verified'])
    ->name('camera');

// 画像取得（ログインユーザーのみ）
Route::get('/show-image/{filename}', [ImageUploadController::class, 'getImage'])
    ->middleware('auth') // ログインユーザーのみアクセス可
    ->name('show-image');


Route::middleware(['auth', 'verified'])->group(function () {
    Route::post('/upload-qr-image', [ImageUploadController::class, 'uploadAndStore'])
        ->name('upload-qr-image');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/history', [HistoryController::class, 'index'])->name('history');
    Route::get('/detail/{id}', [HistoryController::class, 'show'])->name('detail');
});

require __DIR__ . '/auth.php';
