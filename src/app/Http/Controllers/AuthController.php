<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\Category;
use App\Models\Contact;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // 管理画面表示（/admin）
    public function admin()
    {
        // web.php側でmiddleware('auth')を設定済み。ログインユーザーのみアクセス可能
    $categories = Category::all();
    $contacts = Contact::with('category')->latest()->paginate(7);
    return view('admin', compact('categories', 'contacts'));
    }

    public function showLoginForm()
    {
        return view('auth.login');
    }

    // ログイン処理（LoginRequestでカスタムバリデーション＆メッセージ）
    public function login(LoginRequest $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            // 認証OK: 管理画面へ
            return redirect()->intended('/admin');
        }
        // 認証NG: カスタムエラーメッセージ
        return back()->withErrors([
            'email' => 'メールアドレスまたはパスワードが正しくありません'
        ])->withInput();
    }

        // 登録画面表示
    public function showRegisterForm()
    {
        return view('auth.register');
    }

    // 登録処理（RegisterRequestでカスタムバリデーション＆日本語メッセージ）
    public function register(RegisterRequest $request)
    {
        $data = $request->validated();

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        // 登録後すぐログインする
        Auth::login($user);

        return redirect('/admin');
    }
}