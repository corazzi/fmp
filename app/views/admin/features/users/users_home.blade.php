@extends('../layout/dashboard')

{{-- Page title --}}
@section('title', 'User Management')

{{-- Page content --}}
@section('content')
<div class="page-header">

	<div class="large-6 columns">
        <div class="title">
            <h4><i class="fa fa-user"></i><a class="dash-title" href="{{ route('admin-guides') }}"> @yield('title') </a></h4>
        </div>
    </div>

    {{ Form::open(['method' => 'GET']) }}

    <div class="search large-6 columns">
        <div class="row collapse">
            <div class="small-10 columns">
                <input type="text" placeholder="Search users.." name="search" type="search" required="required">
            </div>
            <div class="small-2 columns">
                <a href="" class="button postfix" type="submit">Go</a>
            </div>
        </div>
    </div>

    {{ Form::close() }}

</div>

<div class="breadcrumbs"> 
    <a href="{{ route('admin-home') }}">Administration</a>
    <a class="unavailable"> @yield('title')</a>  
</div>


<div class="inner-content">
	<div class="large-12 columns">

		@if ($all_users->count())

        <table>
 	        <thead>
		        <th width="300">Username</th>
		        <th width="300">Email</th>
		        <th width="300">Preference</th>
		        <th width="150">Created</th>
		        <th width="150">Actions</th>
	        </thead>

	    <tbody>
		    
		    @foreach($all_users as $user)
		    <tr>
		    	<td>{{ $user->username }}</td>
		    	<td>{{ $user->email }}</td>
		    	<td>{{ $user->preference }}</td>
		    	<td>{{ $user->created_at->diffForHumans() }}</td>
		    	<td>
		    		<a href="" class="is-feed-delete" title="Delete User"><i class="fa fa-times"></i></a>
		    	    <a href="" class="is-feed-edit" title="Edit User"><i class="fa fa-pencil"></i></a>
		    	</td>
		    	
		    </tr>

		    @endforeach

		</tbody>


		@else 

		<p> No users uh oh?!</p>

		@endif
		

	</div>
</div>




@stop