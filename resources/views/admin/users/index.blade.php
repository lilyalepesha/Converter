@extends('admin.layouts.main')

@section('content')
    <form action="{{route('users.user.index')}}" method="GET">
        <div class="input-group p-2">
            <input name="search" type="text" class="form-control" placeholder="Введите пользователя" aria-label="Пользователи" aria-describedby="basic-addon2">
            <div class="input-group-append">
                <button class="btn btn-outline-secondary" type="submit">Button</button>
            </div>
        </div>
    </form>
    <form action="{{route('users.user.index')}}" method="GET">
        <div class="form-group">
            <label for="exampleInputPassword1">Роль</label>
            <select name="filter" class="form-select" aria-label="Default select example">
                <option selected disabled>Выберите роль</option>
                <option value="1">Пользователь</option>
                <option value="2">Администратор</option>
            </select>
            @error('role')
            <span class="red">{{$message}}</span>
            @enderror
        </div>
        <button type="submit">Фильтр</button>
    </form>
    <table class="table pt-5">
        <thead>
        <tr>
            <th scope="col">Имя</th>
            <th scope="col">Email</th>
            <th scope="col">Информация о пользователе</th>
            <th scope="col">Редактировать</th>
            <th scope="col">Добавить</th>
            <th scope="col">Удалить</th>
            <th scope="col">Тип пользователя</th>
        </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
                <tr>
                    <td>{{$user->name}}</td>
                    <td>{{$user->email}}</td>
                    <td>
                        <form action="{{route('users.user.show', $user->id)}}" method="GET">
                            @csrf
                            <button type="submit" class="btn btn-block btn btn-info btn-sm">Показать информацию</button>
                        </form>
                    </td>
                    <td>
                        <form action="{{route('users.user.edit', $user->id)}}" method="GET">
                            @csrf
                            <button type="submit" class="btn btn-block btn-primary btn-sm">Редактировать</button>
                        </form>
                    </td>
                    <td>
                        <form action="{{route('users.user.create')}}" method="GET">
                            @csrf
                            <button type="submit" class="btn btn-block btn-success btn-sm">Добавить</button>
                        </form>
                    </td>
                    <td>
                        <form action="{{route('users.user.destroy', $user->id)}}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-block btn-danger btn-sm">Удалить</button>
                        </form>
                    </td>
                    <td>
                        <li>{{\App\Enums\RoleEnum::from($user->role)->label()}}</li>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    @if($users)
        <div class="d-flex justify-content-center">
            {{$users->links()}}
        </div>
    @endif
@endsection
