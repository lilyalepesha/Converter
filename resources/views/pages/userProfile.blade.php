<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="{{asset('/dist/css/app/app.css')}}">
    <title>Profile</title>
</head>
<body>
    <main class="main">
        <div class="wrapper-profile">
            <section class="section__profile">
                <h1 class="profile_title">Добро пожаловать {{\Illuminate\Support\Facades\Auth::user()->name ?? null}}</h1>
                <div class="profile__block_image">
                    @if(\Illuminate\Support\Facades\Auth::user()->avatar)
                        <img class="profile_avatar" src="{{ asset('storage/avatar/' .
                                \Illuminate\Support\Facades\Auth::id() . '/' . auth()->user()->avatar) }}" alt="Avatar">
                    @else
                        <span>Загрузите изображение</span>
                    @endif
                </div>
                <form class="profile_form" action="{{route('profile.update', \Illuminate\Support\Facades\Auth::id())}}" method="POST"
                    enctype="multipart/form-data">
                    @method('PATCH')
                    @csrf
                    <div class="profile__wrapper">
                        <div class="profile__group">
                            <label class="profile__text" for="name">Имя:</label>
                            <input class="profile__input" type="text" name="name" placeholder="Введите имя" value="{{\Illuminate\Support\Facades\Auth::user()->name}}">
                            @error('name')
                            <span class="error">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="profile__group">
                            <label class="profile__text" for="email">Email:</label>
                            <input class="profile__input" type="text" name="email" placeholder="Введите email"
                                value="{{\Illuminate\Support\Facades\Auth::user()->email}}">
                            @error('email')
                            <span class="error">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="profile__group">
                            <label class="profile__text" for="password">Пароль:</label>
                            <input class="profile__input" type="password" name="password" placeholder="Введите пароль">
                            @error('password')
                            <span class="error">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="profile__group">
                            <label class="profile__text" for="password">Подтвердите пароль:</label>
                            <input class="profile__input" type="password" name="password_confirmation" placeholder="Пароль">
                            @error('password_confirmation')
                            <span class="error">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="profile__group">
                            <label class="profile__text" for="avatar">Аватар:</label>
                            <input class="profile__input" type="file" name="avatar" value="{{\Illuminate\Support\Facades\Auth::user()->avatar}}">
                            @error('avatar')
                            <span class="error">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="profile__group">
                            <button class="profile__button" type="submit">Отредактировать</button>
                        </div>
                    </div>
                </form>
            </section>
        </div>
    </main>
</body>
</html>
