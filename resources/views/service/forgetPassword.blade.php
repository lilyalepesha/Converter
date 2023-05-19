@extends('layouts.main')
@section('title')
    Забыли пароль?
@endsection
@section('content')
    <section class="forget">
        <div class="forget__container container">
            <h1 class="forget__title">Забыли пароль?</h1>
            <form class="forget__form" action="{{route('forget.store')}}" method="post">
                @csrf
                <label for="email" class="forget__label">
                    <span class="forget__text">Введите email: </span>
                    <input type="email" class="forget__input" name="email"  placeholder="Email" value="{{old('email')}}">
                    @error('email')
                    <span class="error">{{$message}}</span>
                    @enderror
                </label>
                <button class="forget__button" type="submit">Отправить</button>
            </form>
        </div>
    </section>
@endsection
