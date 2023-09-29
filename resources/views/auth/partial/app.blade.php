<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>@if(isset($site_title)) {{$site_title}} @endif| Log in</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset('plugins/fontawesome-free/css/all.min.css')}}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="{{asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('dist/css/adminlte.min.css')}}">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>

<body class="hold-transition login-page">
    <script type="text/javascript">
        var csrfToken = $('[name="csrf_token"]').attr('content');
        setInterval(refreshToken, 3600000); // 1 hour 
        function refreshToken() {
            $.get('refresh-csrf').done(function(data) {
                csrfToken = data; // the new token
            });
        }
        setInterval(refreshToken, 3600000); // 1 hour 
    </script>
    {{-- <div class="container"><a class="navbar-brand  d-flex align-items-center" href="{{route('view.home')}}">
    <img src="{{asset('front/img/logo.jpg')}}" alt="" width="30" style="width: 33%; align-items:center;margin-left: 0%;margin-left: 34%;margin-top: -5%;"></a>
    </div>
    --}}
    <div class="login-box">
        <div class="login-logo">
            <a href="javascript:void(0)"><b>{{Config::get('constants.SITE_NAME')}}</b></a>
        </div>
        <!-- /.login-logo -->
        @yield('content')
    </div>


    <!-- /.login-box -->

    <!-- jQuery -->
    <script src="{{asset('plugins/jquery/jquery.min.js')}}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{asset('plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <!-- AdminLTE App -->
    <script src="{{asset('dist/js/adminlte.min.js')}}"></script>

    @yield('page-script')

</body>

</html>