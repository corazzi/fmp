@extends('../../layout/dashboard')

{{-- Page title --}}
@section('title', 'Edit Profile')

{{-- Page content --}}
@section('content')

<div class="page-header">
    <div class="large-12 columns">
        <div class="title">
            <h4><i class="fa fa-user"></i> @yield('title') </h4>
        </div>
    </div>
</div>

<div class="breadcrumbs"> 
    <a href="{{ route('code-snippets') }}">Profile</a>
    <a class="unavailable">Edit</a>  
</div>

<div class="inner-content">

    <div class="large-2 columns">

        <div class="content-box">
            <ul class="side-nav">
                <li {{ (Request::is('me') ? 'class="active"' : '') }}><a href="{{ route('me-home')}}">Home</a></li>
                <li {{ (Request::is('me/content') ? 'class="active"' : '') }}><a href="{{ route('my-content') }}">My Content</a></li>
                <li {{ (Request::is('me/edit') ? 'class="active"' : '') }}><a href="{{ route('edit-profile') }}">Edit Profile</a></li>
            </ul>
        </div>

    </div>

    <div class="large-10 columns">
        <div class="content-box">
            Edit Profile stuffz
        </div>
    </div>

</div>

@stop