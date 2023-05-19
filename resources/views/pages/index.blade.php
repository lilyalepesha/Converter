<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="{{asset('/dist/css/app/app.css')}}">
    <link rel="stylesheet" href="{{asset('fonts/stylesheet.css')}}">
    <script src="{{asset('/dist/js/libs/appLibs.js')}}" defer></script>
    <script src="{{asset('/dist/js/app/app.js')}}" defer></script>
</head>
<body class="body__index noscroll">
    <div class="preloader" id="preloader">
        <div class="custom-loader"></div>
    </div>
    <div class="wrapper">
        <header>
            <div class="container container_header">
                <div class="header_logo">
                    <img src="{{asset('/images/logo-uploadfile.png')}}" alt="logo" height="70px">
                </div>
                <nav class="buttons__account">
                    @guest
                    <ul class="buttons__guest">
                        <li>
                            <button class="button__login" type="button">
                                <a href="{{route('login.index')}}">Войти</a>
                            </button>
                        </li>
                        <li>
                            <button class="button__register-profile" type="button">
                                <a href="{{route('register.index')}}">Регистрация</a>
                            </button>
                        </li>
                    </ul>
                    @endguest
                    @auth
                    <ul class="user__list">
                        <li class="user__List_item">
                            @include('layouts.avatar')
                        </li>
                        <ul class="user__List_dropdown-item">
                            <li>
                                <a href="{{route('profile.index')}}">Профиль</a>
                            </li>
                            <li>
                                @can('isAdmin')
                                    <a href="{{route('admin.index')}}">Админка</a>
                                @endcan
                            </li>
                            <li>
                                <form action="{{route('logout')}}" method="POST">
                                    @csrf
                                    <button class="button__register-profile" type="submit">Выйти</button>
                                </form>
                            </li>
                        </ul>
                    </ul>
                    @endauth
                </nav>
                <div class="hamb__field" id="hamb">
                    <span class="bar"></span>
                    <span class="bar"></span>
                    <span class="bar"></span>
                </div>
            </div>
            <div class="popup" id="popup"></div>
        </header>
        <div class="content">
            <div class="main-header">
                <div class="layers">
                    <div class="layer__header">
                        <div class="layers__caption"><p>Самый быстрый конвертер</p></div>
                        <div class="layers__title">uploadfile</div>
                    </div>
                    <div class="layer layers__base"
                        style="background-image: url({{asset('images/layer-base.png')}})"></div>
                    <div class="layer layers__middle"
                        style="background-image: url({{asset('images/layer-middle.png')}})"></div>
                    <div class="layer layers__front"
                        style="background-image: url({{asset('images/layer-front.png')}})"></div>
                </div>
            </div>
            <div class="main-article" style="background-image: url({{asset('images/dungeon.jpg')}})">
                <div class="main_block_article">
                    <div class="main-article__content">
                        @guest
                            <h2 class="main-article__header">Пройдите регистрацию</h2>
                            <p class="main-article__paragraph">
                                <a href="{{route('register.index')}}">Зарегистрируйтесь</a> или <a
                                    href="{{route('login.index')}}">войдите</a> в личный кабинет, таким образом Вы сможете
                                использовать конвертер
                            </p>
                        @endguest
                    </div>
                </div>
                @auth
                    <form class="hero__form" method="POST" enctype="multipart/form-data"
                        action="{{route('service.store')}}">
                        <h2 class="main-article__header_show">Онлайн конвертер</h2>
                        <div class="hero_block">
                            <div class="one_block_hero">
                                @csrf
                                <label class="hero__label" for="image">
                                    <span class="hero__text">Добавьте изображение</span>
                                    <input class="image_input none" type='file' multiple name="image[]" id="image">
                                    <div class="choose hero__input add_hero">
                                        <p class="title_choose">Выберите файл</p>
                                    </div>
                                    @error('image.*')
                                    <span class="error">{{$message}}</span>
                                    @enderror
                                    @error('image')
                                    <span class="error">{{$message}}</span>
                                    @enderror
                                </label>
                                <label class="hero__label" for="width">
                                    <span class="hero__text">Введите ширину изображения</span>
                                    <input class="hero__input" value="{{old('width')}}" type="text" name="width"
                                        placeholder="Ширина">
                                    @error('width')
                                    <span class="error">{{$message}}</span>
                                    @enderror
                                </label>
                            </div>
                            <div class="two_block_hero">
                                <label class="hero__label">
                                    <span class="hero__text">Введите формат изображения</span>
                                    <div class="select__input">
                                        <div class="input_block_select" id="input_block_select">
                                            <input class="value_select" type="hidden" name="extension">
                                            <div class="info_block_select" id="info_block_line">Выберете формат</div>
                                            <svg class="line" id="select_line_low" width="14" height="8" viewBox="0 0 14 8"
                                                fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M1 1L6.97308 7L12.9462 1" stroke="white"/>
                                            </svg>
                                        </div>
                                        <div class="body__select">
                                            <div class="select__item" data-value="jpg">jpg</div>
                                            <div class="select__item" data-value="png">png</div>
                                            <div class="select__item" data-value="jpeg">jpeg</div>
                                        </div>
                                    </div>
                                </label>
                                <label class="hero__label" for="width">
                                    <span class="hero__text">Введите высоту изображения</span>
                                    <input class="hero__input" value=" {{old('height')}}" type="text" name="height"
                                        placeholder="Высота">
                                    @error('height')
                                    <span class="error">{{$message}}</span>
                                    @enderror
                                </label>
                            </div>
                        </div>
                        <button class="hero__button" type="submit">Отправить</button>
                    </form>
                @endauth
                <div class="copy">© UploadFile</div>
            </div>
        </div>
    </div>
</body>
</html>
