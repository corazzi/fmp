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
Devbox Dashboard 
@show 
</title>

{{-- Font Awesome --}}
<link href="{{ asset('assets/css/font-awesome.min.css') }}" rel="stylesheet">
<link href="{{ asset('assets/css/bootstrap-tagsinput.css') }}" rel="stylesheet">
{{-- Base Styles --}}
<link href="{{ asset('assets/css/bootstrap.css') }}" rel="stylesheet">
<link href="{{ asset('assets/css/main.css') }}" rel="stylesheet">
<!--[if lt IE 9]>
    <script src="{{ asset('assets/js/html5shiv.js') }}"></script>
    <script src="{{ asset('assets/js/respond.min.js') }}"></script>
<![endif]-->

<!--[if IE 7]>
  <link rel="stylesheet" href="{{ asset('assets/css/font-awesome-ie7.min.css') }}">
<![endif]-->

</head>
<body>



<div class="navbar navbar-inverse navbar-static-top" role="navigation">     
    <div class="container">
 
        <a class="navbar-brand" href="{{ route('dashboard') }}">Project name</a>
              
        <ul class="nav navbar-nav pull-right">             
            <li class="dropdown">
                
                {{-- Desktop Icon --}}
                <a href="#" class="dropdown-toggle hidden-xs" data-toggle="dropdown">
                    <img src="//www.gravatar.com/avatar/{{ md5(strtolower(trim(Sentry::getUser()->email))) }}" class="nav-gravatar" alt="{{ Sentry::getUser()->first_name }}{{ Sentry::getUser()->last_name }}">  
                    {{ Sentry::getUser()->first_name }} {{ Sentry::getUser()->last_name }}
                    <b class="caret"></b>
                </a>

                {{-- Phone Icon --}}
                <a href="#" class="dropdown-toggle visible-xs" data-toggle="dropdown">
                    <img src="//www.gravatar.com/avatar/{{ md5(strtolower(trim(Sentry::getUser()->email))) }}" class="nav-gravatar" alt="{{ Sentry::getUser()->first_name }}{{ Sentry::getUser()->last_name }}">  
                    <b class="caret"></b>
                </a>


                <ul class="dropdown-menu">
                    <li><a href="">test</a></li>
                    <li><a href="">test</a></li>
                    <li class="divider"></li>
                    <li><a href="{{ route('logout') }}"> Logout</a></li>
                </ul>


            </li>
        </ul>

    </div>
</div>
    
        
{{-- Notifications --}}
@include('layout/notifications')

<div class="container">
    {{-- Content --}}
    @yield('content')
</div>
        

{{-- Base Javascript --}}
<script src="{{ asset('assets/js/jquery.js') }}"></script>
<script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
{{-- Tags Javasctipt --}}
<script src="{{ asset('assets/js/bootstrap-tagsinput.min.js') }}"></script>
<script src="{{ asset('assets/js/app.js') }}"></script> 

</body>
</html>