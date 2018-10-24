<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>ISP Systems</title>
    <!-- Bootstrap 3.3.2 -->
    <link href="{{ asset('/bower_components/bootstrap/dist/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css"/>
    <!-- Font Awesome Icons -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
    <!-- Ionicons -->
    <link href="http://code.ionicframework.com/ionicons/2.0.0/css/ionicons.min.css" rel="stylesheet" type="text/css"/>
    <!-- Theme style -->
    <link href="{{ asset('/bower_components/admin-lte/dist/css/AdminLTE.min.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('/bower_components/admin-lte/dist/css/skins/skin-purple-light.min.css')}}" rel="stylesheet" type="text/css"/>
    <!-- ICheck -->
    <link rel="stylesheet" href="{{ asset('/bower_components/admin-lte/plugins/iCheck/all.css') }}">
    <!-- Main Style -->
    <link rel="stylesheet" href="{{ asset('css/main.css') }}" type="text/css"/>
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
    @yield('css')
</head>
<body class="@yield('pagename')">
    <div class="login-box">
        <div class="login-logo">
            <a href="/">
                <strong>ISP </strong>
                System
            </a>
        </div>
        <div class="login-box-body">
            @yield('content')
        </div>
    </div>

<!-- jQuery 2.1.3 -->
<script src="{{ asset ('/bower_components/jquery/dist/jquery.min.js') }}"></script>
<!-- Bootstrap 3.3.2 JS -->
<script src="{{ asset ('/bower_components/bootstrap/dist/js/bootstrap.min.js') }}" type="text/javascript"></script>
<!-- AdminLTE App -->
<script src="{{ asset ('/bower_components/admin-lte/dist/js/adminlte.min.js') }}" type="text/javascript"></script>
<!-- iCheck -->
<script src="{{ asset('/bower_components/admin-lte/plugins/iCheck/icheck.min.js') }}"></script>
@yield('js')
</body>
</html>
