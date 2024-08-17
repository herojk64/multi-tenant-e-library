<!doctype html>
<html lang="{{app()->getLocale()}}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{config('app.name')}} {{isset($title)?'| '.$title:''}}</title>
    @vite('resources/css/app.css')
    @stack('styles')
    @filamentStyles
</head>
<body class="grid grid-rows-[auto_1fr_auto] bg-gray-100 min-h-screen margin-0 padding-0">
<x-landlord.partials._navbar />
{{$slot}}
<x-landlord.partials._footer />
<x-toaster-hub />
@vite('resources/js/app.js')
@stack('styles')
@filamentScripts
</body>
</html>
