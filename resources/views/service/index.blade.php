@extends('layouts.main')
@section('title')
    Главная
@endsection
@section('content')
    <section class="hero">
        <div class="container hero__container">
            <h1 class="hero__title">Онлайн конвертер <span>изображений</span></h1>
            <form class="hero__form" action="{{route('service.store')}}" method="post" enctype="multipart/form-data">
                @csrf
                <label class="hero__label" for="image">
                    <span class="hero__text">Добавьте изображение</span>
                    <input class="hero__input" type='file' multiple name="image[]" id="image">
                    <span class="choose">Выберите файл</span>
                    @error('image')
                    <span class="error">{{$message}}</span>
                    @enderror
                </label>
                <label class="hero__label" for="width">
                    <span class="hero__text">Введите ширину изображения</span>
                    <input class="hero__input value="{{old('width')}}" type="text" name="width" placeholder="Ширина">
                    @error('width')
                    <span class="error">{{$message}}</span>
                    @enderror
                </label>
                <label class="hero__label" for="width">
                    <span class="hero__text">Введите высоту изображения</span>
                    <input class="hero__input value="{{old('height')}}" type="text" name="height" placeholder="Высота">
                    @error('height')
                    <span class="error">{{$message}}</span>
                    @enderror
                </label>
                <label class="hero__label" for="extension">
                    <span class="hero__text">Введите формат изображения</span>
                    <select class="hero__select" name="extension">
                        <option value="0" disabled selected>Выберите изображение</option>
                        <option value="jpg">jpg</option>
                        <option value="png">png</option>
                        <option value="jpeg">jpeg</option>
                    </select>
                </label>
                <button class="hero__button" type="submit">Отправить</button>
            </form>
        </div>
    </section>
@endsection
