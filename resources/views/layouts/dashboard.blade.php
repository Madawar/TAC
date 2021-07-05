<!doctype html>

<html lang="en">

<head>
    <meta charset="utf-8">
    <title>{{ env('APP_NAME') }}</title>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="{{ asset('/css/app.css') }}" rel="stylesheet">
    <link rel="icon" href="{{ asset('favicon.ico') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Cabin+Sketch&display=swap" rel="stylesheet">
    @routes
    @stack('styles')
</head>

<body class="">

    @include('layouts.header')
    <div class="md:flex flex-col md:flex-row md:min-h-screen  w-full ">

        <div class=" md:flex flex-col md:flex-row md:min-h-screen  w-full space-x-2" id="main-app">
            <div class="w-full md:w-3/4">
                <div class="heading border-b border-gray-100 border-opacity-90 ">
                    @section('main-heading')

                @show

                </div>
                @yield('content')

            </div>
            <div class="md:w-1/4 md:visible md:border-l md:border-gray-100 md:border-opacity-90 w-full ">
                <div class="heading border-b border-gray-100 border-opacity-90">
                    @section('secondary-heading')

                    @show

                </div>
                @yield('secondary-content')
            </div>
        </div>
    </div>
    @stack('pre_scripts')

    <script src="{{ asset('js/plugins.js') }}"></script>
    <script src="{{ asset('js/app.js') }}"></script>


    @yield('pre_jquery')
    @yield('jquery')
</body>

</html>
