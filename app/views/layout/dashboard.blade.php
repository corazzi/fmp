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
<link rel="stylesheet" href="{{ asset('assets/css/font-awesome.css') }}">

<script src="{{ asset('assets/js/vendor/modernizr.js') }}"></script>

</head>
<body>

<nav class="top-bar" data-topbar>

    <ul class="title-area">
        <li class="name"><h1><a href="{{ route('home') }}">webrepo.io <small>&#60;&#47;dashboard&#62;</small></a></h1></li>
        <li class="toggle-topbar menu-icon"><a href="#"></a></li>
    </ul>

    <section class="top-bar-section">

        <ul class="right">
            @if(Sentry::getUser()->hasAccess('admin'))
            <li {{ (Request::is('me') ? 'class="active"' : '') }}><a href="{{ route('me-home') }}"> Admin</a></li>
            <li class="divider"></li> 
            @endif   
            <li {{ (Request::is('me') ? 'class="active"' : '') }}><a href="{{ route('me-home') }}"> Me</a></li>
            <li class="divider"></li>    
            <li><a href="{{ route('logout') }}"> Logout</a></li>
        </ul>

    </section>

</nav>

<div class="main-nav">

    <div class="profile-card">
        <img src="//www.gravatar.com/avatar/{{ md5(strtolower(trim(Sentry::getUser()->email))) }}">
        <h4 style="margin:  0">{{ Sentry::getUser()->username }}</h4>
        <span style="font-size:12px;">Web Developer</span>
    </div>

    <ul class="side-nav custom">
        <li><a href="#"><i class="fa fa-code"></i> Code Snippets</a></li>
        <li><a href="#"><i class="fa fa-book"></i> User Guides</a></li>
        <li><a href="#"><i class="fa fa-tag"></i> News Management</a></li>
        <li><a href="#"><i class="fa fa-external-link"></i> Resources</a></li>
    </ul>

</div>

<div class="main-content">

    {{-- Content --}}
    @yield('content')

</div>

        
{{-- Javascript --}}
<script src="{{ asset('assets/js/jquery.min.js') }}"></script>
<script src="{{ asset('assets/js/foundation.min.js') }}"></script>

<script>
    $(document).foundation();
</script>

</body>
</html>