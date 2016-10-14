<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title> WheelsMada | Administation </title>
    <meta name="robots" content="noindex, nofollow">
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.6 -->
    <link rel="stylesheet" href="{{ asset('admin/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/dist/css/AdminLTE.min.css') }}">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="{{ asset('admin/dist/css/skins/_all-skins.min.css') }}">
    <!-- iCheck -->
    <link rel="stylesheet" href="{{ asset('admin/plugins/iCheck/all.css') }}">
    <!-- jvectormap -->
    <link rel="stylesheet" href="{{ asset('admin/plugins/jvectormap/jquery-jvectormap-1.2.2.css') }}">
    <!-- Date Picker -->
    <link rel="stylesheet" href="{{ asset('admin/plugins/datepicker/datepicker3.css') }}">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="{{ asset('admin/plugins/daterangepicker/daterangepicker.css') }}">
    <!-- bootstrap wysihtml5 - text editor -->
    <link rel="stylesheet" href="{{ asset('admin/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css') }}">
    <!-- Custom stylsheet for administration -->
    <link rel="stylesheet" href="{{ asset('admin/css/custo.css') }}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
    <!-- jQuery 2.2.3 -->
    <script src="{{ asset('admin/plugins/jQuery/jquery-2.2.3.min.js') }}"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBAgK9nP3WBrdcQko2cZr00njBL54u-j6w&libraries=geometry,places"></script>
    <!-- Theme style -->
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    @yield('head')
</head>
<body class="
        @if(Request::is('login')) hold-transition login-page
        @else hold-transition skin-blue sidebar-mini
        @endif">
@if(!Request::is('login'))
    <div class="wrapper">

        @include('absolute.admin-header')

        @include('absolute.aside-admin')
        <div class="img-loader hidden">
            <img src="{{asset('img/744 (1).gif')}}" alt="Loading...">
        </div>

        @endif
        <div id="ajaxify">

            @yield('content')

        </div>

        @yield('script')

        @if(!Request::is('login'))

            <!-- Bootstrap 3.3.6 -->
        <script src="{{ asset('admin/bootstrap/js/bootstrap.min.js') }}"></script>

        <!-- jQuery ScrollTo Plugin -->
        <script src="//balupton.github.io/jquery-scrollto/lib/jquery-scrollto.js"></script>

        <!-- History.js -->
        <script src="//browserstate.github.io/history.js/scripts/bundled/html4+html5/jquery.history.js"></script>
            <script src="{{ asset('admin/plugins/iCheck/icheck.min.js') }}"></script>
            <script>

/*
 $(function() {

 var $link = $('.histo-link');
 var ajaxify = $('#ajaxify');
 var load = $('.img-loader');
                ajaxify.css('min-height',$(window).height());

                $link.click(function(event) {
                    event.preventDefault();
                    load.removeClass('hidden');
                    var href = $(this).attr('href');
                    if(History.pushState) {
                        History.pushState({},'EveryCycle',href);
                    } else {
                        history.pushState({},'EveryCycle',href);
                    }
                    $.ajax({
                        url : href,
                        method : 'GET'
                    }).done(function(data) {
                        ajaxify.children().remove();
                        ajaxify.append(data);
                        load.addClass('hidden');
                    }).fail(function(data) {
                        load.addClass('hidden');
                    })

                });

            });
            */
        </script>
        <!-- AdminLTE App -->
        <script src="{{asset('admin/dist/js/app.js')}}"></script>
   </div>
@endif
</body>
</html>