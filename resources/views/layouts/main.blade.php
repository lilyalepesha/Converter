<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
</head>
<body>
<header class="header">
    <div class="header__container container">
        <div class="header__menu">
            <nav class="header__nav">
                <ul class="header__list">
                        @if($alert = session('status'))
                            <p>{{$alert}}</p>
                        @endif
                        @guest
                        <li class="header__item"><a href="{{route('register.index')}}" class="header__link">Зарегстрироваться</a></li>
                        @endguest
                        @guest
                        <li class="header__item"><a href="{{route('login.index')}}" class="header__link">Войти в аккаунт</a></li>
                            @endguest
                            @auth
                        <li class="header__item"><a href="{{route('logout')}}" class="header__link">Выйти</a></li>
                            @endauth

                        @auth
                            @if(\Illuminate\Support\Facades\Auth::user()->role === \App\Enums\RoleEnum::ADMIN->value)
                                <li><a href="{{route('admin.index')}}">Войти в админ панель</a></li>
                                @endif
                            @endauth
                </ul>
            </nav>
        </div>
    </div>
</header>
    @yield('content')
</body>
</html>
