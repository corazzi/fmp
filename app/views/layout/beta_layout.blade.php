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
<meta property="og:title" content="Webrepo.io BETA - Online web resource repository"/>
<meta property="og:image" content="{{ asset('assets/images/apple_touch_icon.png') }}"/>
<meta property="og:site_name" content="webrepo.io"/>
<meta property="og:url" content="http://webrepo.io"/>
<meta property="og:description" content="An online web resource repository. Store, share and collaborate with other members of the online web community."/>
    
{{-- Stylesheets --}}
<link rel="stylesheet" href="{{ asset('assets/css/app.css') }}">
<script src="{{ asset('assets/js/modernizr.min.js') }}"></script>

</head>
<body {{ (!Request::is('/') ? 'class="beta-body"' : '') }}>

{{-- Content --}}
@yield('content')

{{-- Javascript --}}
<script src="{{ asset('assets/js/jquery.min.js') }}"></script>
<script src="{{ asset('assets/js/foundation.min.js') }}"></script>
<script src="{{ asset('assets/js/fastclick.min.js') }}"></script>
<script src="{{ asset('assets/js/app.min.js') }}"></script>
<script src="{{ asset('assets/js/countdown.min.js') }}"></script>

</body>
</html>