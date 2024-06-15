<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    @vite(['resources/js/app.js','resources/css/app.css'])
    <style>
        body{
            min-height: 100svh;
        }
    </style>
</head>
<body>
<nav>
    <div>
        @guest()
        <a href="{{route('filament.auth.login')}}">Login</a>
        @endguest
        @auth()
            <a href="{{to_route('filament.admin.pages.dashboard')}}">Dashboard</a>
            @endauth
    </div>
</nav>
<main>
    Welcome to book store
</main>
</body>
</html>
