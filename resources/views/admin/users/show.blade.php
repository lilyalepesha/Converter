@extends('admin.layouts.main')
@section('content')

    <table class="table table-bordered">
        <thead>
        <tr>
            <th>Пользователь</th>
            <th>Email пользователя</th>
            <th>Изображения</th>
            <th>Архивы</th>
            <th>Количество изображений</th>
            <th>Количество архивов</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td>{{ $user->name }}</td>
            <td>{{$user->email}}</td>
            <td>
                @foreach($relations->images as $image)
                    <div class="d-flex justify-content-center mb-3">
                        <img width="100px" height="100px" src="{{ asset('storage/images/' . $image->path) }}"
                             alt="Фото не найдено">
                    </div>
                @endforeach
            </td>
            <td>
                @foreach($relations->zips as $zip)
                    <div class="d-flex justify-content-center mb-3">
                        {{ $zip->name }}
                    </div>
                @endforeach
            </td>
            <td>{{$relations->images_count}}</td>
            <td>{{$relations->zips_count}}</td>
        </tr>
        </tbody>
    </table>
@endsection
