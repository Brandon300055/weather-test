<!doctype html>
<html class="no-js" lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    {{--    <title>{{ config('app.name', 'Weather APP) }}</title>--}}
    <meta name="description" content="weather">
    <meta name="keywords" content="weather">
    <meta name="viewport" content="width=device-width, initial-scale=0.9">

    <meta name="author" content="Brandon Stewart">

    <!-- Favicon-->
    {{--    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">--}}

    <!-- App Styles CSS-->
    <link rel="stylesheet" rel="preload" as="style" href="{{ asset('css/app.css') }}" >

    @yield('page-css')

</head>
<body class="antialiased">

@yield('content')

<footer class="footer">
    <div class="text-right">
        <div class="copy-right">Copyright © {{ date("Y") }}  Brandon, LLC. All rights reserved.</div>
    </div>
</footer>

@yield('page-scripts')

</body>
</html>
