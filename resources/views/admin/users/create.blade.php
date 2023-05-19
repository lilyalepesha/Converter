@extends('admin.layouts.main')

@section('content')
<form method="POST" action="{{route('users.user.store')}}">
    @csrf
    <div class="card-body">
        <div class="form-group">
            <label for="exampleInputEmail1">Имя</label>
            <input name="name" class="form-control" id="exampleInputEmail1" placeholder="Enter email" value="{{$user->name ?? "email"}}">
            @error('name')
                <span class="red">{{$message}}</span>
            @enderror
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Email адрес</label>
            <input name="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email" {{$user->email ?? "email"}}>
            @error('email')
                <span class="red">{{$message}}</span>
            @enderror
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Password</label>
            <input name="password" type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
            @error('password')
                <span class="red">{{$message}}</span>
            @enderror
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Роль</label>
            <select name="role" class="form-select" aria-label="Default select example">
                <option selected value="1">Выберите роль</option>
                <option value="1">Пользователь</option>
                <option value="2">Администратор</option>
            </select>
            @error('role')
            <span class="red">{{$message}}</span>
            @enderror
        </div>
    </div>
    <!-- /.card-body -->

    <div class="card-footer">
        <button type="submit" class="btn btn-primary">Добавить</button>
    </div>
</form>
@endsection
