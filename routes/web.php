<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostsController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


// 管理者だけがアクセスする投稿関連（認証必須）
Route::middleware('auth')->group(function () {
    Route::resource('posts', PostsController::class)->except(['index', 'show']);
});

// 🏠 トップページ（投稿一覧）
Route::get('/', [PostsController::class, 'index'])->name('home');

// 🛠️ 投稿作成・編集・削除など（IDを使う）
Route::resource('posts', PostsController::class)->except(['show']);

// 🔍 投稿の詳細表示（slugを使う）
Route::get('/posts/{post:slug}', [PostsController::class, 'show'])->name('posts.show');



Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
