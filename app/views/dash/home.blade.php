@extends('../layout/dashboard')

{{-- Page title --}}
@section('title')
@parent
@stop

{{-- Page content --}}
@section('content')

<div class="col-md-12">
Welcome to your dashboard, {{ Sentry::getUser()->first_name }}


<h5>Snippets</h5>
<ul>
	<li><a href="{{ URL::to('dashboard/snippets') }}">My Snippets</a></li>
	<li><a href="{{ URL::to('dashboard/snippets/public') }}">Public Snippets</a></li>
	<li><a href="{{ URL::to('dashboard/snippets/add') }}">Add Snippet</a></li>
</ul>

</div>

@stop