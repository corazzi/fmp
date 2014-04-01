<!DOCTYPE html>
<!--[if IE 9]><html class="lt-ie10" lang="en" > <![endif]-->
<html class="no-js" lang="en" >
<head>

<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>@yield('title') | webrepo.io</title>

{{-- Stylesheets --}}
<link rel="stylesheet" href="{{ asset('assets/css/normalize.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/foundation.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/font-awesome.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/app.css') }}">

<script src="{{ asset('assets/js/vendor/modernizr.js') }}"></script>

</head>
<body>


<nav class="top-bar" data-topbar>

    <ul class="title-area">
        <li class="name">
            <h1><a href="{{ route('home') }}">webrepo.io</a></h1>
        </li>
        <li class="toggle-topbar menu-icon"><a href="#"></a></li>
    </ul>

    <section class="top-bar-section">
        
        <!-- Right Nav Section -->
        <ul class="right">
            
            <li class="has-dropdown">

                <a href="#">{{ Sentry::getUser()->username }}</a>

                
                <ul class="dropdown">
                    <li><a href="{{ route('logout') }}"> Logout</a></li>
                </ul>
            </li>
        </ul>

    </section>

</nav>

<div class="green-bar"></div>

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
<script src="{{ asset('assets/js/vendor/jquery.js') }}"></script>
<script src="{{ asset('assets/js/foundation.min.js') }}"></script>

<script>
    $(document).foundation();
</script>

</body>
</html>