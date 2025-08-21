@extends('layouts.app')

@section('title', 'お問い合わせ確認 | FashionablyLate')

@section('css')
<link rel="stylesheet" href="{{ asset('css/confirm.css') }}">
@endsection

@section('content')
<div class="confirm">
    <h2 class="confirm__title">Confirm</h2>

    <form action="{{ route('contacts.store') }}" method="post">
        @csrf

        <!-- hiddenで値を全て保持（送信or修正時用） -->
        <input type="hidden" name="last_name" value="{{ $inputs['last_name'] }}">
        <input type="hidden" name="first_name" value="{{ $inputs['first_name'] }}">
        <input type="hidden" name="gender" value="{{ $inputs['gender'] }}">
        <input type="hidden" name="email" value="{{ $inputs['email'] }}">
        <input type="hidden" name="tel1" value="{{ $inputs['tel1'] }}">
        <input type="hidden" name="tel2" value="{{ $inputs['tel2'] }}">
        <input type="hidden" name="tel3" value="{{ $inputs['tel3'] }}">
        <input type="hidden" name="address" value="{{ $inputs['address'] }}">
        <input type="hidden" name="building" value="{{ $inputs['building'] }}">
        <input type="hidden" name="category_id" value="{{ $inputs['category_id'] }}">
        <input type="hidden" name="detail" value="{{ $inputs['detail'] }}">

        <table class="confirm__table">
            <tr>
                <th class="confirm__label">お名前</th>
                <td class="confirm__value">{{ $inputs['last_name'] }}&nbsp;{{ $inputs['first_name'] }}</td>
            </tr>
            <tr>
                <th class="confirm__label">性別</th>
                <td class="confirm__value">
                @if($inputs['gender'] == '1')
                    男性
                @elseif($inputs['gender'] == '2')
                    女性
                @else
                    その他
                @endif
            </td>
            </tr>
            <tr>
                <th class="confirm__label">メールアドレス</th>
                <td class="confirm__value">{{ $inputs['email'] }}</td>
            </tr>
            <tr>
                <th class="confirm__label">電話番号</th>
                <td class="confirm__value">{{ $inputs['tel1'] }}-{{ $inputs['tel2'] }}-{{ $inputs['tel3'] }}</td>
            </tr>
            <tr>
                <th class="confirm__label">住所</th>
                <td class="confirm__value">{{ $inputs['address'] }}</td>
            </tr>
            <tr>
                <th class="confirm__label">建物名</th>
                <td class="confirm__value">{{ $inputs['building'] }}</td>
            </tr>
            <tr>
                <th class="confirm__label">お問い合わせの種類</th>
                <td class="confirm__value">{{ $inputs['category_content'] }}</td>
            </tr>
            <tr>
                <th class="confirm__label">お問い合わせ内容</th>
                <td class="confirm__value">{{ $inputs['detail'] }}</td>
            </tr>
        </table>
        
        <div class="confirm__actions">
            <button type="submit" name="action" value="back" class="button">修正</button>
            <button type="submit" class="button button--primary">送信</button>
        </div>
    </form>
</div>
@endsection