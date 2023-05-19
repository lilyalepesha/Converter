<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{asset('/dist/css/app/app.css')}}">
    <link rel="stylesheet" href="{{asset('fonts/stylesheet.css')}}">

    <title>Вход</title>
</head>
<body class="body_login">
    <main class="main_vhod">
        <div class="registration-cssave">
            <form class = "form_vhod" method="post" action="{{route('login.store')}}">
                @csrf
                <h3 class="text-center">ВХОД</h3>
                <div class="form-group">
                    <input type="text" class="auth__input_user" name="email"  value="{{old('email')}}" required="required">
                    <span>Email</span>
                    <i></i>
                </div>
                @error('email')
                <span class="errorMes">{{$message}}</span>
                @enderror
                <div class="form-group">
                    <input type="password" class="auth__input_user" name="password" value="{{old('password')}}" required="required">
                    <span>Password</span>
                    <i></i>
                </div>
                @error('password')
                <span class="errorMesTwo">{{$message}}</span>
                @enderror
                <div class="form-group">
                    <button class="button__vhod" type="submit">Вход в аккаунт</button> <br>
                        <div class="buttons_main_page">
                            <a class="button__main__page" href="{{route('service.index')}}">На главную</a>
                            <a class="button__main__page" href="{{route('forget.index')}}">Забыли пароль?</a>
                        </div>
                    </div>
                </form>
        </div>
    </main>
    <footer></footer>
    <script type="text/javascript" src="{{asset('js/script.js')}}"></script>
</body>
</html>



