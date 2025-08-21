@extends('layouts.app')

@section('title', 'お問い合わせフォーム | FashionablyLate')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

{{-- ヘッダー右端のボタンは無し。@section('header-buttons')の記載も無し --}}

@section('content')
<div class="contact">
    <h2 class="contact__title">Contact</h2>

    <form action="{{ route('contacts.confirm') }}" method="post" class="contact__form">
        @csrf
        <table class="contact__table">
            <!-- お名前 -->
            <tr class="contact__row">
                <th class="contact__label">お名前 <span class="contact__required">※</span></th>
                <td class="contact__field">
                    <input type="text" name="last_name" class="contact__input contact__input--short"
                        value="{{ old('last_name') }}" placeholder="例: 山田">
                    @error('last_name')
                        <div class="error-message">※ {{ $message }}</div>
                    @enderror
                    <input type="text" name="first_name" class="contact__input contact__input--short contact__input--spaced"
                        value="{{ old('first_name') }}" placeholder="例: 太郎">
                    @error('first_name')
                        <div class="error-message">※ {{ $message }}</div>
                    @enderror
                </td>
            </tr>

            <!-- 性別 -->
            <tr class="contact__row">
                <th class="contact__label">性別 <span class="contact__required">※</span></th>
                <td class="contact__field contact__field--radio">
                    <label class="contact__radio">
                        <input type="radio" name="gender" value="1" {{ old('gender')=='1' ? 'checked' : '' }}> 男性
                    </label>
                    <label class="contact__radio">
                        <input type="radio" name="gender" value="2" {{ old('gender')=='2' ? 'checked' : '' }}> 女性
                    </label>
                    <label class="contact__radio">
                        <input type="radio" name="gender" value="3" {{ old('gender')=='3' ? 'checked' : '' }}> その他
                    </label>
                    @error('gender')
                        <div class="error-message">※ {{ $message }}</div>
                    @enderror
                </td>
            </tr>

            <!-- メールアドレス -->
            <tr class="contact__row">
                <th class="contact__label">メールアドレス <span class="contact__required">※</span></th>
                <td class="contact__field">
                    <input type="email" name="email" class="contact__input contact__input--full"
                        value="{{ old('email') }}" placeholder="例: test@example.com">
                    @error('email')
                        <div class="error-message">※ {{ $message }}</div>
                    @enderror
                </td>
            </tr>

            <!-- 電話番号 -->
            <tr class="contact__row">
                <th class="contact__label">電話番号 <span class="contact__required">※</span></th>
                <td class="contact__field">
                    <input type="text" name="tel1" class="contact__input contact__input--tel" value="{{ old('tel1') }}">
                    <span class="contact__tel-hyphen">-</span>
                    <input type="text" name="tel2" class="contact__input contact__input--tel" value="{{ old('tel2') }}">
                    <span class="contact__tel-hyphen">-</span>
                    <input type="text" name="tel3" class="contact__input contact__input--tel" value="{{ old('tel3') }}">
                    @error('tel1')
                        <div class="error-message">※ {{ $message }}</div>
                    @enderror
                    @error('tel2')
                        <div class="error-message">※ {{ $message }}</div>
                    @enderror
                    @error('tel3')
                        <div class="error-message">※ {{ $message }}</div>
                    @enderror
                </td>
            </tr>

            <!-- 住所 -->
            <tr class="contact__row">
                <th class="contact__label">住所 <span class="contact__required">※</span></th>
                <td class="contact__field">
                    <input type="text" name="address" class="contact__input contact__input--full"
                        value="{{ old('address') }}" placeholder="例: 東京都渋谷区千駄ヶ谷1-2-3">
                    @error('address')
                        <div class="error-message">※ {{ $message }}</div>
                    @enderror
                </td>
            </tr>

            <!-- 建物名 -->
            <tr class="contact__row">
                <th class="contact__label">建物名</th>
                <td class="contact__field">
                    <input type="text" name="building" class="contact__input contact__input--full"
                        value="{{ old('building') }}" placeholder="例: 千駄ヶ谷マンション101">
                    @error('building')
                        <div class="error-message">※ {{ $message }}</div>
                    @enderror
                </td>
            </tr>

            <!-- お問い合わせの種類 -->
            <tr class="contact__row">
                <th class="contact__label">お問い合わせの種類 <span class="contact__required">※</span></th>
                <td class="contact__field">
                    <select name="category_id" class="contact__select">
                        <option value="">選択してください</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ old('category_id')==$category->id ? 'selected' : '' }}>
                                {{ $category->content }}
                            </option>
                        @endforeach
                    </select>
                    @error('category_id')
                        <div class="error-message">※ {{ $message }}</div>
                    @enderror
                </td>
            </tr>

            <!-- お問い合わせ内容 -->
            <tr class="contact__row">
                <th class="contact__label">お問い合わせ内容 <span class="contact__required">※</span></th>
                <td class="contact__field">
                    <textarea name="detail" class="contact__textarea"
                        placeholder="お問い合わせ内容をご記載ください">{{ old('detail') }}</textarea>
                    @error('detail')
                        <div class="error-message">※ {{ $message }}</div>
                    @enderror
                </td>
            </tr>
        </table>

        <div class="contact__actions">
            <button type="submit" class="button button--primary">確認画面</button>
        </div>
    </form>
</div>
@endsection