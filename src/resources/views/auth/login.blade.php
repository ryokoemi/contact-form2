@extends('layouts.app')

@section('title', '管理者ログイン | FashionablyLate')

@section('css')
<link rel="stylesheet" href="{{ asset('css/login.css') }}">
@endsection

{{-- ヘッダー右端にregisterボタン --}}
@section('header-buttons')
    <a href="{{ route('register') }}" class="header-nav__button">Register</a>
@endsection

@section('content')
<div class="page-header">
    <div class="page-title">Login</div>
</div>
<div class="register-box">
    <form method="POST" action="{{ route('login') }}" class="register-form">
        @csrf
        <div class="form-group">
            <label for="email">メールアドレス</label>
            <input type="text" name="email" id="email" value="{{ old('email') }}" placeholder="例: test@example.com">
            @error('email')
                <div class="error-message">※ {{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="password">パスワード</label>
            <input type="password" name="password" id="password" placeholder="例: coachetech106">
            @error('password')
                <div class="error-message">※ {{ $message }}</div>
            @enderror
        </div>
        <button type="submit" class="button-register">ログイン</button>
    </form>
</div>
@endsection