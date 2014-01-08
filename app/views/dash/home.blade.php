@extends('../layout/dashboard')

{{-- Page title --}}
@section('title', 'Dashboard')

{{-- Page content --}}
@section('content')

<div class="col-md-12">
Welcome to your dashboard, {{ Sentry::getUser()->first_name }}


<h5>Snippets</h5>
<ul>
	<li><a href="{{ route('my-snippets') }}">My Snippets</a></li>
	<li><a href="{{ route('add-snippet') }}">Add Snippet</a></li>
	<li><a href="{{ URL::to('snippets') }}">Public Snippets</a></li>
</ul>

<h5>Tutorials</h5>

<ul>
	<li><a href="">Community Tutorials</a></li>
	<li><a href="">Staff Submitted Tutorials</a></li>
</ul>

<h5>News</h5>
<ul>
	<li><a href="">Add Feed</a></li>
	<li><a href="">View Web News</a></li>
</ul>

<h5>Profile</h5>
<ul>
	<li><a href="">My Profile</a></li>
	<li><a href="">Edit Profile</a></li>
</ul>



</div>

@stop