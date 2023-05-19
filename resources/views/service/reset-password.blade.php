@extends('layouts.main')
@section('title')
    Сброс пароля
@endsection
@section('content')
    <section class="reset_pass">
        <div class="reset_pass__container">
            <h1 class="reset_pass__title">
                Сброс пароля
            </h1>
            <form action="{{route('password.update')}}" method="post">
                @csrf
                <input type="hidden" value="{{$token}}" name="token">
                <span>Email</span><br>
                <input type="text" name="email"><br>
                <span>Пароль</span><br>
                <input type="text" name="password"><br>
                <span>Пароль</span><br>
                <input type="text" name="password_confirmation"><br>
                <button>Отправить</button>
            </form>
        </div>
    </section>
@endsection
