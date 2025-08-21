<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'FashionablyLate')</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
    <link rel="stylesheet" href="{{ asset('css/common.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Inika:wght@400;700&family=Noto+Sans+JP:wght@400;700&display=swap" rel="stylesheet">
    @yield('css')
</head>
<body>
 @if(!isset($noHeader))
  <header class="header">
    <div class="header__inner">
      <div class="header__logo-area">
        <a class="header__logo" href="/">FashionablyLate</a>
      </div>
      <div class="header__button-area">
        @yield('header-buttons')
      </div>
    </div>
  </header>
  @endif
  <main>
    @yield('content')
  </main>
  @yield('js')
<!--
<header class="header">
  <div class="header__inner">
    <div class="header__logo-area">
      <a class="header__logo" href="/">FashionablyLate</a>
    </div>
    <div class="header__button-area">
      @auth
        @if(Request::is('admin*'))
          <form class="form" method="POST" action="{{ route('logout') }}">
            @csrf
            <button class="header-nav__button">Logout</button>
          </form>
        @endif
      @endauth
    </div>
  </div>
</header>
  <main>
    @yield('content')
  </main>
  @yield('js')
-->
</body>
</html>