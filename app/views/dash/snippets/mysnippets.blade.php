@extends('../../layout/dashboard')

{{-- Page title --}}
@section('title')
@parent :: My Snippets 
@stop

{{-- Page content --}}
@section('content')
<div class="row">
    <div class="col-md-12">

        <div class="table-responsive">
            <table class="table table-hover">
	                             
	            <thead>
		            <th>ID</th>
		            <th>Name</th>
		            <th>Description</th>
		            <th>Privacy</th>
		            <th>Created</th>                       
		            <th>Action</th>                             
	            </thead>

	            <tbody>

	            @foreach ($code_snippets as $snippet)

	            <tr>
	            	<td>{{ $snippet->title }}</td>
	            	<td>{{ $snippet->description }}</td>
	            	<td>{{ $snippet->state }}</td>
	            	<td>{{ $snippet->created_at }}</td>
	            	<td><a href="">Edit</a> | <a href="{{ route('/snippets/delete', $snippet->id) }}">Delete</a></td>
	            </tr>

	            @endforeach

	            </tbody>                
            
            </table>
        </div> <!-- ./end of table -->

    </div>
</div>
@stop