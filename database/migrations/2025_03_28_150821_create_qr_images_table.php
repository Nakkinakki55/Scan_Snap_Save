<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * マイグレーションの実行
     */
    public function up(): void
    {
        Schema::create('qr_images', function (Blueprint $table) {
            $table->id();  // 自動増分のID
            $table->unsignedBigInteger('user_id');  // ユーザーID（外部キーではなく単なる値）
            $table->string('qr_data');  // QRコードで読み取った内容
            $table->string('image_path');  // 画像のファイルパス
            $table->timestamps();  // created_at, updated_at を自動生成
        });
    }

    /**
     * マイグレーションの取り消し
     */
    public function down(): void
    {
        Schema::dropIfExists('qr_images');
    }
};
