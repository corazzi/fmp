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

            	<?php $i = $code_snippets->getFrom(); ?>
	                             
	            <thead>
		            <th>ID</th>
		            <th>Name</th>
		            <th>Description</th>
		            <th>Privacy</th>
		            <th>Created</th>                       
		            <th>Action</th>                             
	            </thead>

	            <tbody>

	            <?php $id = $code_snippets->getFrom(); ?>

	            @foreach ($code_snippets as $snippet)

	            <tr>
	            	<td>{{ $id++ }}</td>
	            	<td>{{ $snippet->title }}</td>
	            	<td>{{ $snippet->description }}</td>
	            	<td>{{ $snippet->state }}</td>
	            	<td>{{ $snippet->created_at }}</td>
	            	<td><a href="{{ route('/snippets/edit', $snippet->id) }}">Edit</a> | <a href="{{ route('/snippets/delete', $snippet->id) }}">Delete</a></td>
	            </tr>

	            @endforeach

	         

	            </tbody>                
            
            </table>
        </div> <!-- ./end of table -->

        {{-- Pagination --}}
        <?php echo $code_snippets->links(); ?>

    </div>
</div>

@stop