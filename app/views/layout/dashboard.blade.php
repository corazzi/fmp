<!--
    VIEWING THE SOURCE?
    That's cool, keep learning!
-->

<!DOCTYPE html>
<html lang="en">
<head>

<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="@yield('meta_description')">
<meta name="author" content="@yield('meta_author')">
<link rel="apple-touch-icon-precomposed" sizes="144x144" href="{{ asset('assets/ico/apple-touch-icon.png') }}">
<link rel="shortcut icon" href="{{ asset('assets/ico/favicon.png') }}">

{{-- Facebook OG --}}
<meta property="og:title" content="@yield('title') | WSLR"/>
<meta property="og:description" content="@yield('meta_description')"/>
<meta property="og:image" content="{{ asset('assets/ico/apple-touch-icon.png') }}">
<meta property="og:url" content="{{ URL::current() }}"/>
<meta property="og:site_name" content="WSLR"/>

{{-- Twitter Cards --}}
<meta name="twitter:card" content="summary">
<meta name="twitter:image" content="{{ asset('assets/ico/apple-touch-icon.png') }}">
<meta name="twitter:description" content="@yield('meta_description')">
<meta name="twitter:site" content="@WSLR">
<meta name="twitter:creator" content="@WSLR">

<title>@yield('title') | WSLR</title>

{{-- Font Awesome --}}
<link href="{{ asset('assets/css/font-awesome.min.css') }}" rel="stylesheet">
<link href="{{ asset('assets/css/bootstrap-tagsinput.css') }}" rel="stylesheet">
<link href="{{ asset('assets/css/bootstrap-dialog.css') }}" rel="stylesheet">
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
<script src="{{ asset('assets/js/bootstrap-dialog.js') }}"></script>
{{-- Tags Javasctipt --}}
<script src="{{ asset('assets/js/bootstrap-tagsinput.min.js') }}"></script>
<script src="{{ asset('assets/js/app.js') }}"></script> 

<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

</body>
</html>