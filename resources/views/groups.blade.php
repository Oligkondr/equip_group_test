<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laravel & Bootstrap</title>

    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body>
<div class="container mt-5">
    <div>
        Bootstrap успешно установлен и работает!
        <ul>
            @foreach($groups as $group)
                @include('tree')
            @endforeach
        </ul>
    </div>
</div>
</body>
</html>
