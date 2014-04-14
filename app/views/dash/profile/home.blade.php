@extends('../../layout/dashboard')

{{-- Page title --}}
@section('title', 'My Profile')

{{-- Page content --}}
@section('content')



	<div class="row content-holder">
		<div class="large-12 columns">
			<h3>{{ Sentry::getUser()->username }}</h3>
			<p></p>
		</div>
	</div>



@stop