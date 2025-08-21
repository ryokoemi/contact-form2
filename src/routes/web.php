<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ContactController;


Route::middleware('auth')->group(function () {
    Route::get('/admin', [ContactController::class, 'admin'])->name('contacts.admin');
});

// お問い合わせフォーム関連
Route::get('/', [ContactController::class, 'index'])->name('contacts.index');
Route::post('/contacts/confirm', [ContactController::class, 'confirm'])->name('contacts.confirm');
Route::post('/contacts/store', [ContactController::class, 'store'])->name('contacts.store');
Route::get('/contacts/thanks', [ContactController::class, 'thanks'])->name('contacts.thanks');

// 詳細データ取得API
Route::get('/admin/contacts/{id}', [ContactController::class, 'show'])->name('admin.contacts.show');

Route::get('/admin/export', [ContactController::class, 'export'])->name('contacts.export');
Route::delete('/admin/contacts/{id}', [ContactController::class, 'destroy'])->name('contacts.destroy');

// ログイン画面表示
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
// ログイン処理
Route::post('/login', [AuthController::class, 'login']);

Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

Route::post('/logout', function () {
    Auth::logout();
    return redirect()->route('login'); // ここでlogin画面にリダイレクト
})->name('logout');