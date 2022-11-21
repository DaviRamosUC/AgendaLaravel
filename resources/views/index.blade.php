<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}"  class="h-full bg-gray-50">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <title>Agenda</title>

</head>

<body class="h-full">
    <div id="app">
        <navigationbarcomponent></navigationbarcomponent>
        <router-view :key="$route.fullPath"/>
    </div>
    <script src="{{ mix('js/app.js') }}"></script>
</body>

</html>
