<!DOCTYPE html>
<!--[if IE 9]><html class="lt-ie10" lang="en" > <![endif]-->
<html class="no-js" lang="en" >
<head>

<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>@yield('title') | Webrepo.io</title>

<meta name="description" content="An online web resource repository. Store, share and collaborate with other members of the online web community.">
<meta name="author" content="Jack Keenan">
<link rel="icon" type="image/png" href="{{ asset('assets/images/favicon.png') }}">
<link rel="apple-touch-icon" href="{{ asset('assets/images/apple_touch_icon.png') }}"/>

{{-- Twitter Card --}}
<meta name="twitter:card" content="summary">
<meta name="twitter:site" content="@webrepoio">
<meta name="twitter:creator" content="@jackthedev">
<meta name="twitter:title" content="webrepo.io">
<meta name="twitter:description" content="An online web resource repository. Store, share and collaborate with other members of the online web community.">
<meta name="twitter:image" content="{{ asset('assets/images/apple_touch_icon.png') }}">

{{-- Facebook OG --}}
<meta property="og:title" content="Webrepo.io - Online web resource repository"/>
<meta property="og:image" content="{{ asset('assets/images/apple_touch_icon.png') }}"/>
<meta property="og:site_name" content="webrepo.io"/>
<meta property="og:url" content="http://webrepo.io"/>
<meta property="og:description" content="An online web resource repository. Store, share and collaborate with other members of the online web community."/>
    
{{-- Stylesheets --}}
<link rel="stylesheet" href="{{ asset('assets/css/app.css') }}">
<script src="{{ asset('assets/js/modernizr.min.js') }}"></script>

</head>
<body {{ (!Request::is('/') ? 'class="auth-bg"' : '') }}>

<div class="contain-to-grid {{ (Request::is('home') ? 'fixed' : '') }}">
    <nav class="top-bar" data-topbar>

        <ul class="title-area">
            <li class="name">
                <h1><a href="{{ route('home') }}">webrepo.io</a></h1>
            </li>
            <li class="toggle-topbar menu-icon"><a href="#"></a></li>
        </ul>

        <section class="top-bar-section">

            <ul class="right">
                <li {{ (Request::is('/') ? 'class="active"' : '') }}><a href="{{ route('home') }}"><i class="fa fa-home"></i><span class="show-for-small-only">Home</span></a></li>
                <li {{ (Request::is('login') ? 'class="active"' : '') }}><a href="{{ route('login') }}">Login</a></li>
                <li {{ (Request::is('register') ? 'class="active"' : '') }}><a href="{{ route('register') }}">Register</a></li>
            </ul>

        </section>

    </nav>
 
</div>


{{-- Content --}}
@yield('content')

<div id="copyright">
    <div class="row">
        <div class="large-12 columns">
            <p>&#169; Copyright 2014, webrepo.io</p>
        </div>
    </div>
</div>


{{-- Javascript --}}
<script src="{{ asset('assets/js/jquery.min.js') }}"></script>
<script src="{{ asset('assets/js/foundation.min.js') }}"></script>
<script src="{{ asset('assets/js/fastclick.min.js') }}"></script>
<script src="{{ asset('assets/js/home.min.js') }}"></script>

</script>
</body>
</html>