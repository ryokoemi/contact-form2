@extends('layouts.app')

@section('title', 'お問い合わせ完了 | FashionablyLate')

@section('css')
<link rel="stylesheet" href="{{ asset('css/thanks.css') }}">
@endsection

{{-- サンクスページはヘッダー不要なので @section('header-link') は書かない --}}

@section('content')
<div class="thanks">
    <div class="thanks__background">Thank You</div>
    <div class="thanks__content">
        <p class="thanks__message">お問い合わせありがとうございました</p>
        <a href="{{ route('contacts.index') }}" class="button button--primary thanks__button">HOME</a>
    </div>
</div>
@endsection