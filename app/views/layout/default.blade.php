<!DOCTYPE html>
<!--[if IE 9]><html class="lt-ie10" lang="en" > <![endif]-->
<html class="no-js" lang="en" >
<head>

<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>@yield('title') | webrepo.io</title>

{{-- Stylesheets --}}
<link rel="stylesheet" href="{{ asset('assets/css/app.css') }}">
<script src="{{ asset('assets/js/vendor/modernizr.js') }}"></script>

</head>
<body>

<div class="contain-to-grid fixed">
    <nav class="top-bar" data-topbar>

        <ul class="title-area">
            <li class="name">
                <h1><a href="{{ route('home') }}">webrepo.io</a></h1>
            </li>
            <li class="toggle-topbar menu-icon"><a href="#"></a></li>
        </ul>

        <section class="top-bar-section">
        
             <!-- Right Nav Section -->
<!--             <ul class="right">
                <li {{ (Request::is('home') ? 'class="active"' : '') }}><a href="{{ route('home') }}">Home</a></li>
                <li {{ (Request::is('login') ? 'class="active"' : '') }}><a href="{{ route('login') }}">Login</a></li>
                <li {{ (Request::is('register') ? 'class="active"' : '') }}><a href="{{ route('register') }}">Register</a></li>
            </ul>  -->
            <div class="custom-nav right">
                
                <a data-reveal-id="myModalLogin">Login</a>
                <span style="color:green;padding:0 0.5rem;font-weight:700;color:#7ce295;">|</span>
                <a data-reveal-id="myModalRegister">Register</a>

            </div>

        </section>

    </nav>
 
</div>



{{-- Content --}}
@yield('content')


{{-- Javascript --}}
<script src="{{ asset('assets/js/jquery.js') }}"></script>
<script src="{{ asset('assets/js/foundation.min.js') }}"></script>
<script>
$(document).foundation();


$(document).ready(function () {
    if ({{ Input::old('autoOpenModal', 'false') }}) {
        $('#myModalLogin').foundation('reveal', 'open');
    }
});
</script>

</script>
</body>
</html>