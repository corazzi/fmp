@extends('../layout/dashboard')

{{-- Page title --}}
@section('title', 'Administration')

{{-- Page content --}}
@section('content')

<div class="page-header">

	<div class="large-6 columns">
        <div class="title">
            <h4><i class="fa fa-cog"></i><a class="dash-title" href="{{ route('admin-home') }}"> @yield('title') </a></h4>
        </div>
    </div>

</div>

<div class="inner-content">
	
    <ul class="side-nav">
        <li><a href="{{ route('admin-snippets') }}">Code Snippets</a></li>
        <li><a href="{{ route('admin-guides') }}">User Guides</a></li>
        <li><a href="{{ route('admin-news') }}">News</a></li>
        <li><a href="{{ route('admin-resources') }}">Resources</a></li>
        <li><a href="{{ route('admin-users') }}">Users</a></li>


    </ul>


</div>



@stop