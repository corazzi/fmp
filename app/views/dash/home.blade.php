@extends('../layout/dashboard')

{{-- Page title --}}
@section('title')
@parent
:: Home
@stop

{{-- Page content --}}
@section('content')

Welcome to your dashboard, {{ Sentry::getUser()->first_name }}


<h5>Snippets</h5>
<ul>
	<li><a href="{{ URL::to('dashboard/snippets') }}">My Snippet</a></li>
	<li><a href="{{ URL::to('dashboard/snippets/add-snippet') }}">Add Snippet</a></li>
</ul>


@stop