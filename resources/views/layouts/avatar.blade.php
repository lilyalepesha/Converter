@auth
    <span>{{\Illuminate\Support\Facades\Auth::user()->name ?? null}}</span>
    @if(\Illuminate\Support\Facades\Auth::user()->avatar)
        <img class="avatar" width="40px" height="40px" src="{{ asset('storage/avatar/' .
            \Illuminate\Support\Facades\Auth::id() . '/' . auth()->user()->avatar) }}" alt="Avatar">
    @else
        <span>Загрузите изображение</span>
    @endif
@endauth

