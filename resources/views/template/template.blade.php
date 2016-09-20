<!doctype html>
<html>
<head >
    <meta http-equiv="Content-type" content="text/html;charset=utf-8">
    <meta name="description" content="">
    <link rel="stylesheet" href="{{ asset('css/custo.css') }}">
    <link rel="stylesheet" href="{{ asset('bower_components/bootstrap/dist/css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('font-awesome-4.6.3/css/font-awesome.css')}}">
    <link rel="stylesheet" href="{{ asset('css/animate.css') }}">
    <script src="{{ asset('bower_components/jquery/dist/jquery.js') }}"></script>

    <title>@yield('title')</title>
    @yield('head')
</head>
<body>

@yield('content')

@yield('script')

@yield('footer')

<script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->

</body>
</html>
