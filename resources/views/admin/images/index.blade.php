@extends('admin.layouts.main')

@section('content')
    <form action="{{ route('zips.index') }}" method="GET">
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
            <th>Изображения</th>
            <th>Ширина</th>
            <th>Высота</th>
            <th>Тип</th>
            <th>Количество изображений</th>
        </tr>
        </thead>
        <tbody>
        @foreach($users as $user)
            <tr>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                @if($user->images_count === 0)
                    <td>Пользователь не загрузил архивы</td>
                @else

                        @foreach($user->images as $image)
                            <td class="d-flex justify-content-center">
                                <img width="100px" height="100px"
                                     src="{{asset('storage/images/' . $image->path)}}"
                                     alt="Фото не найдено">
                            </td>
                        @endforeach
                    <td>
                        @foreach($user->images as $image)
                            <div class="row">
                                @if(is_null($image->width))
                                    <span>{{ $image->original_width }}</span>
                                @else
                                    <span>{{ $image->width }}</span>
                                @endif
                            </div>
                        @endforeach
                    </td>
                    <td>
                        @foreach($user->images as $image)
                            <div class="row">
                                @if(is_null($image->height))
                                    <span>{{ $image->original_height }}</span>
                                @else
                                    <span>{{ $image->height }}</span>
                                @endif
                            </div>
                        @endforeach
                    </td>
                    <td>
                        @foreach($user->images as $image)
                            <div class="row">
                                <span>{{ $image->type }}</span>
                            </div>
                        @endforeach
                    </td>
                @endif
                <td>{{ $user->images_count }}</td>
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
