@extends('../layout/dashboard')

{{-- Page title --}}
@section('title', 'Dashboard')

{{-- Page content --}}
@section('content')

<div class="row">

	<div class="large-13 columns" style="background:black;color:white;">
		
Welcome to your dashboard, {{ Sentry::getUser()->username }}


<h5>Snippets</h5>
<ul>
	<li><a href="{{ route('my-snippets') }}">My Snippets</a></li>
	<li><a href="{{ route('add-snippet') }}">Add Snippet</a></li>
	<li><a href="{{ URL::to('snippets') }}">Public Snippets</a></li>
</ul>

<h5>User Guides</h5>

<ul>
	<li><a href="">View Guides</a></li>
	<li><a href="">Add Guide</a></li>
</ul>

<h5>News</h5>

<ul>
	<li><a href="">Add Feed</a></li>
	<li><a href="">View News</a></li>
</ul>

<h5>Profile</h5>

<ul>
	<li><a href="">My Profile</a></li>
	<li><a href="">Edit Profile</a></li>
</ul>

<h5>Resource Bucket</h5>

<ul>
	<li><a href="">Add Resource</a></li>
	<li><a href="">View Resources</a></li>
</ul>




	</div>


</div>




@stop