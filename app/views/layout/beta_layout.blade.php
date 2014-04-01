<!DOCTYPE html>
<html lang="en">
<head>

<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="">
<meta name="author" content="jackthedev">
<link rel="shortcut icon" href="{{ asset('assets/ico/apple-touch-icon.png') }}">

{{-- Facebook OG --}}
<meta property="og:title" content="@yield('title') | webrepo.io"/>
<meta property="og:description" content=""/>
<meta property="og:image" content="{{ asset('assets/ico/apple-touch-icon.png') }}">
<meta property="og:url" content=""/>
<meta property="og:site_name" content="webrepo.io"/>

{{-- Twitter Cards --}}
<meta name="twitter:card" content="summary">
<meta name="twitter:image" content="{{ asset('assets/ico/apple-touch-icon.png') }}">
<meta name="twitter:description" content="">
<meta name="twitter:site" content="@webrepo.io">
<meta name="twitter:creator" content="@webrepo.io">

<link href="{{ asset('assets/css/foundation.css') }}" rel="stylesheet">
<link href="{{ asset('assets/css/normalize.css') }}" rel="stylesheet">
<link href="{{ asset('assets/css/beta.css') }}" media="all" rel="stylesheet" type="text/css">
<!--[if lt IE 9]><script src="{{ asset('assets/js/html5shiv.js') }}"></script><script src="{{ asset('assets/js/respond.min.js') }}"></script><![endif]-->


{{-- Notifications --}}
@include('layout/notifications')


{{-- Content --}}
@yield('content')


{{-- Javascript --}}
<script src="{{ asset('assets/js/jquery.js') }}"></script>
<script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/js/countdown.js') }}"></script>

</body>
</html>