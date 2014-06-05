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
            <li class="name"><h1><a href="{{ route('home') }}">webrepo.io <small>&#60;&#47;{{ (Request::segment(1) == 'admin' ? 'admin' : 'dashboard') }}&#62;</small></a></h1></li>
            <li class="toggle-topbar menu-icon"><a href="#"></a></li>
        </ul>

        <section class="top-bar-section">

            <ul class="right">
                @if(Sentry::getUser()->hasAccess('admin'))
                <li {{ (Request::segment(1) == 'admin' ? 'class="active"' : '') }}><a href="{{ route('admin-home') }}"> Admin</a></li>
                <li class="divider show-for-medium-up"></li> 
                @endif   
                <li {{ (Request::segment(1) == 'me' ? 'class="active"' : '') }}><a href="{{ route('me-home') }}"> Me</a></li>
                <li class="divider show-for-medium-up"></li>    
                <li><a href="{{ route('logout') }}"> Logout</a></li>
            </ul>

        </section>

    </nav>
</div>

<div class="nav-holder" role="navigation">

    <div class="user-card show-for-large-up">
        @if(is_null(Sentry::getUser()->avatar))
        <img class="round" src="{{ Gravatar::src(Sentry::getUser()->email) }}">
        @else 
        <img class="round" src="{{ "/uploads/avatar/".Sentry::getUser()->avatar }}">
        @endif
        <span class="username">{{ ucfirst(Sentry::getUser()->username) }}</span>
        <span class="preference">{{ Sentry::getUser()->preference }}</span>
    </div>



    <div id="side-navigation" class="show-for-medium-up">
        <ul>
            
            <li {{ (Request::segment(1) == 'dashboard' ? 'class="active"' : '') }}>
                <a href="{{ route('dashboard')}}">
                    <i class="fa fa-home"></i><span>Dashboard</span>
                </a>
            </li>

            <li {{ (Request::segment(1) == 'snippets' ? 'class="active"' : '') }} class="sub-menu">
              
                <a href="javascript:void(0);">
                    <i class="fa fa-code"></i>
                        <span>Code Snippets</span>
                    <i class="arrow fa fa-angle-right right show-for-large-up"></i>
                </a>

                <ul>

                    <li {{ (Request::is('snippets/add')? 'class="active"' : '') }}>
                        <a href="{{ route('add-snippet') }}"><i class="fa fa-pencil show-for-medium-only"></i><span>Submit Snippet</span></a>
                    </li>
                    
                    <li {{ (Request::is('snippets')? 'class="active"' : '') }}>
                        <a href="{{ route('code-snippets') }}"><i class="fa fa-eye show-for-medium-only"></i><span>Browse Snippets</span></a>
                    </li>

                </ul>
            </li>

            <li {{ (Request::segment(1) == 'guides' ? 'class="active"' : '') }}  class="sub-menu">
                <a href="javascript:void(0);"><i class="fa fa-book"></i><span>User Guides</span><i class="arrow fa fa-angle-right right show-for-large-up"></i></a>
                <ul>

                    <li {{ (Request::is('guides/add')? 'class="active"' : '') }}>
                        <a href="{{ route('add-guide') }}"><i class="fa fa-pencil show-for-medium-only"></i><span>Submit Guide</span></a>
                    </li>
                    
                    <li {{ (Request::is('guides')? 'class="active"' : '') }}>
                        <a href="{{ route('user-guides') }}"> <i class="fa fa-eye show-for-medium-only"></i><span>Browse Guides</span></a>
                    </li>

                </ul>
            </li>

            <li {{ (Request::segment(1) == 'news' ? 'class="active"' : '') }}>
                <a href="{{ route('news-home') }}"><i class="fa fa-tag"></i><span>News</span></a>
            </li>

            <li {{ (Request::segment(1) == 'resources' ? 'class="active"' : '') }} class="sub-menu">
                <a href="javascript:void(0);"><i class="fa fa-rocket"></i><span class="hide-text-nav-tab">Resources</span><i class="arrow fa fa-angle-right right show-for-large-up"></i></a>
                <ul>

                    <li {{ (Request::is('resources/add')? 'class="active"' : '') }}>
                        <a href="{{ route('add-resource') }}"><i class="fa fa-pencil show-for-medium-only"></i><span>Add Resource</span></a>
                    </li>
                    
                    <li {{ (Request::is('resources') ? 'class="active"' : '') }}>
                        <a  href="{{ route('resources-home') }}"><i class="fa fa-eye show-for-medium-only"></i><span>Browse Resources</span></a>
                    </li>

                </ul>
            </li>


            <li {{ (Request::segment(1) == 'me' ? 'class="active"' : '') }} class="sub-menu show-for-large-up">
                <a href="javascript:void(0);"><i class="fa fa-user "></i><span>Profile</span><i class="arrow fa fa-angle-right right show-for-large-up"></i></a>
                <ul>

                    <li {{ (Request::is('me') ? 'class="active"' : '') }}>
                        <a href="{{ route('me-home') }}">Me</a>
                    </li>
                    
                    <li {{ (Request::is('me/content') ? 'class="active"' : '') }}>
                        <a href="{{ route('my-content') }}">My Content</a>
                    </li>

                    <li {{ (Request::is('me/edit') ? 'class="active"' : '') }}>
                        <a href="{{ route('edit-profile') }}">Edit Profile</a>
                    </li>

                    <li {{ (Request::is('me/change-password') ? 'class="active"' : '') }}>
                        <a href="{{ route('change-password') }}">Change Password</a>
                    </li>

                </ul>
            </li>

            @if(Sentry::getUser()->hasAccess('admin'))
            <li {{ (Request::segment(1) == 'admin' ? 'class="active"' : '') }}>
                <a href="{{ route('admin-home') }}"><i class="fa fa-cog"></i><span>Administration</span></a>
            </li>
            @endif


        </ul>
    </div>

</div>

<div class="content-holder">

    {{-- Content --}}
    @yield('content')

</div>
     
{{-- Javascript --}}
<script src="{{ asset('assets/js/jquery.min.js') }}"></script>
<script src="{{ asset('assets/js/jquery.autosize.min.js') }}"></script>
<script src="{{ asset('assets/js/foundation.min.js') }}"></script>
<script src="{{ asset('assets/js/nav.min.js') }}"></script>
<script src="{{ asset('assets/js/highlight.min.js') }}"></script>
<script src="{{ asset('assets/js/toastr.min.js') }}"></script>
@if (Request::segment(2) == "add" || Request::segment(3) == "edit" || Request::segment(4) == "edit")
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