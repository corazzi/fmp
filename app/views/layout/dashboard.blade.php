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
<body class="dash">

<div class="fixed">
    <nav class="top-bar" data-topbar>

        <ul class="title-area">
            <li class="name"><h1><a href="{{ route('home') }}">webrepo.io <small>&#60;&#47;dashboard&#62;</small></a></h1></li>
            <li class="toggle-topbar menu-icon"><a href="#"></a></li>
        </ul>

        <section class="top-bar-section">

            <ul class="right">
                @if(Sentry::getUser()->hasAccess('admin'))
                <li><a href="{{ route('me-home') }}"> Admin</a></li>
                <li class="divider show-for-medium-up"></li> 
                @endif   
                <li {{ (Request::is('me') ? 'class="active"' : '') }}><a href="{{ route('me-home') }}"> Me</a></li>
                <li class="divider show-for-medium-up"></li>    
                <li><a href="{{ route('logout') }}"> Logout</a></li>
            </ul>

        </section>

    </nav>
</div>

<div class="nav-holder" role="navigation">

    <div class="user-card">
        <img class="round" src="{{ Gravatar::src(Sentry::getUser()->email) }}">
        <span class="username show-for-large-up">{{ ucfirst(Sentry::getUser()->username) }}</span>
        <span class="preference show-for-large-up">{{ Sentry::getUser()->preference }}</span>
    </div>

    <ul class="side-nav">
        <li {{ (Request::is('dashboard') ? 'class="active"' : '') }}><a href="{{ route('dashboard') }}">Dashboard</a></li>
        <li {{ (Request::is('snippets') ? 'class="active"' : '') }}><a href="{{ route('code-snippets') }}">Code Snippets</a></li>
        <li {{ (Request::is('guides') ? 'class="active"' : '') }}><a href="{{ route('user-guides') }}">User Guides</a></li>
        <li {{ (Request::is('news') ? 'class="active"' : '') }}><a href="{{ route('news-home') }}">My News</a></li>
        <li {{ (Request::is('resources') ? 'class="active"' : '') }}><a href="{{ route('resources-home') }}">Resources</a></li>
        <li {{ (Request::is('me') ? 'class="active"' : '') }}><a href="{{ route('me-home') }}">Profile</a></li>
    </ul>

</div>

<div class="content-holder">

    {{-- Content --}}
    @yield('content')

</div>
     
{{-- Javascript --}}
<script src="{{ asset('assets/js/jquery.min.js') }}"></script>
<script src="{{ asset('assets/js/jquery.autosize.min.js') }}"></script>
<script src="{{ asset('assets/js/foundation.min.js') }}"></script>
<script src="{{ asset('assets/js/highlight.min.js') }}"></script>
<script src="{{ asset('assets/js/toastr.min.js') }}"></script>
@if (Request::segment(2) == "add" || Request::segment(3) == "edit")
<script src="{{ asset('assets/js/tagmanager.min.js') }}"></script>

<script>
jQuery(function () {
    jQuery("#tm-input").tagsManager({
        prefilled: [{{ $string }}],
    }); 
});    
</script>
@endif
<script src="{{ asset('assets/js/app.min.js') }}"></script>
<script type="text/javascript">
    {{ Notification::showError('toastr.error(":message");') }}
    {{ Notification::showSuccess('toastr.success(":message");') }}
</script>

</body>
</html>