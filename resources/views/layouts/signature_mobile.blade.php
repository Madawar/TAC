<!doctype html>

<html lang="en" data-theme="fantasy">

<head>
    <meta charset="utf-8">
    <title>{{ env('APP_NAME') }}</title>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="{{ mix('/css/app.css') }}" rel="stylesheet">
    <link rel="icon" href="{{ asset('favicon.ico') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @stack('styles')
</head>

<body>








    @yield('content')



    <script src="{{ mix('js/plugins.js') }}"></script>
    <script src="{{ mix('js/app.js') }}"></script>
    @yield('pre_jquery')
    @yield('jquery')
</body>

</html>
