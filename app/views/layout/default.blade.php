<!--
    VIEWING THE SOURCE?
    That's cool, keep learning!
-->

<!DOCTYPE html>
<html lang="en">
<head>

<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="">
<meta name="author" content="">
<link rel="shortcut icon" href="">

<title>
@section('title')
    Devbox
@show
</title>


<!-- stylesheets -->
<link href="{{ asset('assets/css/bootstrap.css') }}" rel="stylesheet">
<link href="{{ asset('assets/css/main.css') }}" media="all" rel="stylesheet" type="text/css">

<!--[if lt IE 9]>
    <script src="{{ asset('assets/js/html5shiv.js') }}"></script>
    <script src="{{ asset('assets/js/respond.min.js') }}"></script>
<![endif]-->

<link rel="stylesheet" href="{{ asset('assets/css/font-awesome.css') }}">

<!--[if IE 7]>
  <link rel="stylesheet" href="{{ asset('assets/css/font-awesome-ie7.min.css') }}">
<![endif]-->

</head>
<body>

<div class="navbar navbar-inverse navbar-static-top" role="navigation">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
          
            <a class="navbar-brand" href="#">Project name</a>

        </div>

        <div class="navbar-collapse collapse">

            <ul class="nav navbar-nav navbar-right">
                <li {{ (Request::is('/') ? 'class="active"' : '') }}><a href="{{ route('home') }}">Home</a></li>
                <li {{ (Request::is('login') ? 'class="active"' : '') }}><a href="{{ route('login') }}">Login</a></li>
                <li {{ (Request::is('register') ? 'class="active"' : '') }}><a href="{{ route('register') }}">Register</a></li>
            </ul>

        </div><!--/.navbar-collapse -->
    </div>
</div>

<!-- Notifications -->
<div class="container">
    <div class="row">
        @include('layout/notifications')
    </div>
</div>

<!-- Content -->
@yield('content')


<!-- Javascript -->
<script src="{{ asset('assets/js/jquery.js') }}"></script>
<script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>

</body>
</html>