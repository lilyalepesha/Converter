<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{asset('/dist/css/app/app.css')}}">
    <title>Скачивание архивов</title>
</head>
<body>

<div class="wrapper_download">
    <div class="main_block">
        <div class="main_block__title">
            <h1>Список архивов пользователя</h1>
        </div>
        <div class="main_block__body">
            <ul>
                @foreach ($zipNames->zips as $zip)
                    <li><a href="{{url('storage/zipArchives/' . $zip->name . '.zip')}}" download>{{$zip->name}}</a></li>
                @endforeach
            </ul>
        </div>
        <div class="main_block__button">
            <button>
                @if(isset($lastArchive))
                    <a class="download_archive"
                       href="{{url('storage/zipArchives/' . $lastArchive->first('name')->name . '.zip')}}" download>
                        Скачать
                        последний архив</a>
                @endif
            </button>
        </div>
    </div>
</div>
</body>
</html>
