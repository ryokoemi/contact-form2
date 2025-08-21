@extends('layouts.app')

@section('title', '管理ユーザ登録 | FashionablyLate')

@section('css')
<link rel="stylesheet" href="{{ asset('css/register.css') }}">
@endsection

{{-- ヘッダー右端にloginボタンのみ --}}
@section('header-buttons')
    <a href="{{ route('login') }}" class="header-nav__button">Login</a>
@endsection

@section('content')
<div class="page-header">
    <div class="page-title">Register</div>
</div>
<div class="register-box">
    <form method="POST" action="{{ route('register') }}" class="register-form">
        @csrf
        <div class="form-group">
            <label for="name">お名前</label>
            <input type="text" name="name" id="name" value="{{ old('name') }}" placeholder="例: 山田 太郎">
            @error('name')
                <div class="error-message">※ {{ $message }}</div>
            @enderror
        </div>
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
        <button type="submit" class="button-register">登録</button>
    </form>
</div>
@endsection