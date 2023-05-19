@extends('admin.layouts.main')

@section('content')
    <form action="{{route('zips.index')}}" method="GET">
        <div class="input-group p-2">
            <input name="search" type="text" class="form-control" placeholder="Введите пользователя" aria-label="Пользователи" aria-describedby="basic-addon2">
            <div class="input-group-append">
                <button class="btn btn-outline-secondary" type="submit">Button</button>
            </div>
        </div>
    </form>
    <table class="table table-bordered">
        <thead>
        <tr>
            <th>Пользователь</th>
            <th>Email пользователя</th>
            <th>Архивы</th>
            <th>Количество архивов</th>
        </tr>
        </thead>
        <tbody>
        @foreach($users as $user)

            <tr>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                @if($user->zips_count === 0)
                    <td>Пользователь не загрузил архивы</td>
                @else
                    <td>
                        @foreach($user->zips as $zip)
                            <div class="table">
                                <span>{{$zip->name}}</span>
                            </div>
                        @endforeach
                    </td>
                @endif
                <td>{{ $user->zips_count }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
    @if(isset($users))
        <div class="d-flex justify-content-center">
            {{ $users->links() }}
        </div>
    @endif
@endsection
