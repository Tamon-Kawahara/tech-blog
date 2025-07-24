<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ContactController;

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

// 認証が必要な投稿操作（投稿CRUD系）
Route::middleware('auth')->group(function () {
    Route::resource('posts', PostsController::class)
        ->except(['show']) // ←これでshowを除外
        ->parameters(['posts' => 'slug'])
        ->names([
            'index' => 'posts.index',
            'create' => 'posts.create',
            'store' => 'posts.store',
            'edit' => 'posts.edit',
            'update' => 'posts.update',
            'destroy' => 'posts.destroy',
        ]);
});

// 一般公開：投稿一覧（トップページ）
Route::get('/', [PostsController::class, 'index'])->name('posts.index');

// 一般公開：投稿詳細（slugで表示）
Route::get('/posts/{post:slug}', [PostsController::class, 'show'])->name('posts.show');

Route::get('/tags/{slug}', [\App\Http\Controllers\TagController::class, 'show'])->name('tags.show');

Route::get('/categories/{slug}', [CategoryController::class, 'show'])->name('categories.show');

// お問い合わせフォームの表示
Route::get('/contact', [\App\Http\Controllers\ContactController::class, 'show'])->name('contact.show');
Route::get('/contact/thanks', function () {
    return view('contact.thanks');
})->name('contact.thanks');

// フォーム送信（保存処理）
Route::post('/contact', [\App\Http\Controllers\ContactController::class, 'store'])->name('contact.store');


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
