<x-mail::message>
    Здравствуйте!

    Нажмите на кнопку чтобы перейти на страницу сброса пароля!

    <x-mail::button :url="$url" color="success">
        Сбросить пароль
    </x-mail::button>

    Спасибо,<br>
    {{ config('app.name') }}
</x-mail::message>
