@extends('layouts.app')

@section('title', 'お問い合わせ管理 | FashionablyLate')

@section('css')
<link rel="stylesheet" href="{{ asset('css/admin.css') }}">
@endsection

@section('header-buttons')
    <form method="POST" action="{{ route('logout') }}" style="display: inline;">
        @csrf
        <button class="header-nav__button">Logout</button>
    </form>
@endsection

@section('content')
<div class="admin">
    <h2 class="admin__title">Admin</h2>


<!-- 検索フォーム -->
<div class="admin__search-form">
  <form method="GET" action="{{ route('contacts.admin') }}">
    <div class="admin__search-row">
      <input type="text" name="keyword" value="{{ request('keyword') }}" class="admin__input admin__input--keyword" placeholder="名前・メール">
      <select name="gender" class="admin__select admin__select--gender">
        <option value="">性別</option>
        <option value="1" {{ request('gender')=='1' ? 'selected' : '' }}>男性</option>
        <option value="2" {{ request('gender')=='2' ? 'selected' : '' }}>女性</option>
        <option value="3" {{ request('gender')=='3' ? 'selected' : '' }}>その他</option>
      </select>
      <select name="category_id" class="admin__select admin__select--category">
        <option value="">お問い合わせの種類</option>
        @foreach($categories as $category)
        <option value="{{ $category->id }}" {{ request('category_id')==$category->id ? 'selected' : '' }}>{{ $category->content }}</option>
        @endforeach
      </select>
      <input type="date" name="date" value="{{ request('date') }}" class="admin__input admin__input--date">
      <button type="submit" class="button button--search">検索</button>
      <a href="{{ route('contacts.admin') }}" class="button button--reset">リセット</a>
    </div>
    <div class="admin__export-row">
      <button formaction="{{ route('contacts.export') }}" formmethod="GET" class="button button--export">エクスポート</button>
    </div>
  </form>
</div>

    <!-- 一覧テーブル -->
    <table class="admin__table">
        <tr>
            <th class="admin__th">お名前</th>
            <th class="admin__th">性別</th>
            <th class="admin__th">メールアドレス</th>
            <th class="admin__th">お問い合わせの種類</th>
            <th class="admin__th admin__th--actions">詳細</th>
        </tr>
        @forelse($contacts as $contact)
        <tr>
            <td class="admin__td">{{ $contact->last_name }} {{ $contact->first_name }}</td>
            <td class="admin__td">
                @if($contact->gender==1) 男性
                @elseif($contact->gender==2) 女性
                @else その他
                @endif
            </td>
            <td class="admin__td">{{ $contact->email }}</td>
            <td class="admin__td">{{ $contact->category->content ?? '' }}</td>
            <td class="admin__td admin__td--actions">
                <button type="button" class="admin__button--detail" onclick="showContactDetail({{ $contact->id }})">詳細</button>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="5" class="admin__td admin__td--empty">該当データはありません</td>
        </tr>
        @endforelse
    </table>

    <!-- ページネーション -->
    <div class="admin__pagination">
        {{ $contacts->links() }}
    </div>
</div>

<!-- 詳細モーダル -->
<div id="contact-modal">
    <div class="modal-content" id="modal-content" style="position:relative;">
<button type="button" class="modal-close" onclick="closeModal()">&times;</button>
        <div id="modal-detail-area"></div>
    </div>
</div>
@endsection

<!-- 管理用JS（Ajaxで詳細・削除連携） -->
 @section('js')
<script>
function showContactDetail(id) {
    fetch('/admin/contacts/' + id)
        .then(res => res.text())
        .then(html => {
            console.log(html); // ←追加
            document.getElementById('modal-detail-area').innerHTML = html;
            document.getElementById('contact-modal').classList.add('active');
        });
}

function closeModal() {
    document.getElementById('contact-modal').classList.remove('active');
}
function deleteContact(id) {
    if(confirm('本当に削除しますか？')) {
        fetch('/admin/contacts/' + id, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN' : '{{ csrf_token() }}'
            },
        }).then(res => {
            if(res.ok) window.location.reload();
        });
    }
}
</script>
@endsection