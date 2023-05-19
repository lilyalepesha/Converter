<!DOCTYPE html>
<html lang="en">
<head> </head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{asset('/dist/css/app/app.css')}}">
    <link rel="stylesheet" href="{{asset('fonts/stylesheet.css')}}">
    <title>Восстановление</title>
</head>
<body class="body-forgot">
    <div class="background-forgot"></div>
    <main class="main_vhod">
        <div class="forgot_form">
                <form class = "form_vhod" method="post" action="{{route('forget.store')}}">
                    @csrf
                    <h3 class="text-center">Восстановление пароля</h3>
                    <div class="form-group__forgot">
                        <input class="form-control-forgot item" type="text" name="email" id="email" required="required">
                        <span>Email</span>
                        <i></i>
                    </div>
                    <div class="form-group__button">
                        <button class="button__forgot" type="submit">Восстановить</button>
                    </div>
                </form>
        </div>
    </main>
    <footer></footer>
    <script type="text/javascript" src="/public/js/script.js"></script>
</body>
</html>



