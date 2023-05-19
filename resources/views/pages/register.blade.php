<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{asset('/dist/css/app/app.css')}}">
    <link rel="stylesheet" href="{{asset('fonts/stylesheet.css')}}">
    <title>Регистрация</title>
</head>
<body class="body">
    <div class="background-registr"></div>
    <main class="main_vhod">
        <div class="registration">
                <h3 class="registration__title">РЕГИСТРАЦИЯ</h3>
                <form class = "form_register" method="post" action="{{route('register.store')}}" enctype="multipart/form-data">
                    @csrf
                    <div class="form__box_one">
                        <div class="form-groupReg">
                            <input class="auth__input" type="text" name="name" id="name" value="{{old('name')}}" required="required">
                            <span>Имя</span>
                            <i></i>
                        </div>
                        @error('name')
                        <span class="errorReg1">{{$message}}</span>
                        @enderror
                        <div class="form-groupReg">
                            <input class="auth__input" type="text" name="email" id="email" value="{{old('email')}}" required="required">
                            <span>Email</span>
                            <i></i>
                        </div>
                        @error('email')
                        <span class="errorReg2_registr">{{$message}}</span>
                        @enderror
                        <div class="form-groupReg">
                            <input class="auth__input" type="password" name="password" id="password" value="{{old('password')}}" required="required">
                            <span>Password</span>
                            <i></i>
                        </div>
                        @error('password')
                        <span class="errorReg3_registr">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="form__box_two">
                        <div class="form-groupReg">
                            <input class="auth__input" type="password" name="password_confirmation"
                                   value="{{old('password_confirmation')}}" required="required">
                            <span>Сonfirm password</span>
                            <i></i>
                        </div>
                        @error('avatar')
                        <span class="errorReg4_registr">{{$message}}</span>
                        @enderror
                        <input class="auth__input_file" type="file" name="avatar">
                        <div class="form-groupReg">
                            <button class="button__registr" type="submit" >Зарегистрироватся</button>
                        </div>
                    </div>
                </form>
                <div class="block__link_registr">
                    <a class="button__main" href="{{route('service.index')}}">На главную</a>
                    <a class="button__main" href="{{route('service.index')}}">Войти</a>
                </div>
        </div>
    </main>
    <footer></footer>
    <script type="text/javascript" src="{{asset('js/script.js')}}"></script>
</body>
</html>




