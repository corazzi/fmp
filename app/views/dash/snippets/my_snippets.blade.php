@extends('../../layout/dashboard')

{{-- Page title --}}
@section('title', 'My Snippets')

{{-- Page content --}}
@section('content')

<div class="row">
	<div class="col-md-12">
		
		<h3 class="pull-left">My Snippets</h3>

		@if ($code_snippets->count())    

		{{-- Search Box --}}

		<div class="pull-right" style="width:30%;margin:10px 0;">
			
			{{ Form::open(['method' => 'GET']) }}

		    <div class="input-group">
			    
			    <input class="form-control"  placeholder="Search..." name="search" type="search"  required>	

			    <div class="input-group-btn">
				    <button class="btn btn-info" type="submit"><i class="glyphicon glyphicon-search"></i></button>
			    </div>

		    </div>

            {{ Form::close() }}

		</div>
	
	</div>
</div>

<div class="row">
    <div class="col-md-12">

        <div class="table-responsive">
            <table class="table table-hover">

            	<?php $i = $code_snippets->getFrom(); ?>
	                             
	            <thead>
		            <th>ID</th>
		            <th>Name</th>
		            <th>Privacy</th>
		            <th>Created</th>
		            <th>Updated</th>                       
		            <th>Action</th>                             
	            </thead>

	            <tbody>

	            <?php $id = $code_snippets->getFrom(); ?>

	            @foreach ($code_snippets as $snippet)

	                <tr>
	            	    <td>{{ $id++ }}</td>
	            	    <td><a href="{{ route('view-private-snippet', $snippet->slug) }}">{{ $snippet->title }}</a></td>
	            	    <td>{{ $snippet->state }}</td>
	            	    <td>{{ $snippet->humanCreatedAt }}</td>
	            	    <td>{{ $snippet->humanUpdatedAt }}</td>
	            	    <td><a href="{{ route('edit-snippet', $snippet->id) }}">Edit</a> | <a href="{{ route('delete-snippet', $snippet->id) }}">Delete</a></td>
	                </tr>

	            @endforeach

	         

	            </tbody>                
            
            </table>
        </div> <!-- ./end of table -->

        {{-- Pagination --}}
        <?php echo $code_snippets->links(); ?>

    </div>
</div>

@else

<div class="row">
	<div class="col-md-12">
		
		<h3>My Snippets</h3>
		<p>Well Hello, looks like you havnt save any snippets with us yet. Why not create one now? <a href="{{ route('add-snippet') }}">Add Snippet</a></p> 

	</div>
</div>

@endif

@stop