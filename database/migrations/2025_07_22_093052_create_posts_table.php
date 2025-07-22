<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();

            // 投稿者（固定で1なら外部キー制約は不要でも可）
            $table->foreignId('user_id')->default(1);

            $table->string('title');
            $table->string('slug')->unique(); // URL用
            $table->longText('body');

            // カテゴリ
            $table->foreignId('category_id')->nullable();

            // 公開状態
            $table->boolean('is_published')->default(false);
            $table->timestamp('published_at')->nullable();

            // アイキャッチ画像パス（任意）
            $table->string('eyecatch')->nullable();

            $table->timestamps(); // created_at, updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
