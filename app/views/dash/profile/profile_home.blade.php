@extends('../../layout/dashboard')

{{-- Page title --}}
@section('title', 'My Profile')

{{-- Page content --}}
@section('content')

<div class="page-header">
    <div class="large-12 columns">
        <div class="title">
            <h4><i class="fa fa-user"></i> My Profile</h4>
        </div>
    </div>
</div>


<div class="inner-content profile">

    <div class="large-3 columns">

        @include('layout/profile_nav')

    </div>

	<div class="large-9 columns">
		<div class="content-box profile-area">
			<p>Welcome to your profile area {{ Sentry::getUser()->username }} here you can edit your profile and looking at your previously save content aswell as your favourited content using the naviagation shown to the left.</p>
		</div>
	</div>

</div>

@stop