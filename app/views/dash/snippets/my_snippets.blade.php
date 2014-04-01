@extends('../../layout/dashboard')

{{-- Page title --}}
@section('title', 'My Snippets')

{{-- Page content --}}
@section('content')

@if ($code_snippets->count())  

<div class="row content-holder">
	<div class="snippets large-12 columns">

		<h3>My Snippets</h3>

		{{-- Search Box --}}

		<div class="search-box">
			
			{{ Form::open(['method' => 'GET']) }}

            <div class="row">
                <div class="large-12 columns">
                    <div class="row collapse">
                        <div class="small-10 columns">
                          <input type="text"  placeholder="Search..." name="search" type="search"  required>
                        </div>
                        <div class="small-2 columns">
                            <button class="button postfix" type="submit">Go</button>
                        </div>
                    </div>
                </div>
		    </div>

		    {{ Form::close() }}

		</div>

	</div>
</div>

<div class="row content-holder">
    <div class="large-12 columns">

            <table>

            	<?php $i = $code_snippets->getFrom(); ?>
	                             
	            <thead>
		            <th>ID</th>
		            <th width="500">Name</th>
		            <th width="100">Privacy</th>
		            <th width="150">Created</th>
		            <th width="150">Updated</th>                       
		            <th width="150">Action</th>                             
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
	            	    <td><a href="{{ route('edit-snippet', $snippet->id) }}">Edit</a> | <a onClick="deleteDialog()" class="btn_delete" href="{{ route('delete-snippet', $snippet->id) }}">Delete</a></td>
	                </tr>

	            @endforeach

	         

	            </tbody>                
            
            </table>

        {{-- Pagination --}}
        <?php echo $code_snippets->links(); ?>

    </div>
</div>

@else

<div class="row">
	<div class="large-12 columns">
		
		<h3>My Snippets</h3>
		<p>Well Hello, looks like you havnt save any snippets with us yet. Why not create one now? <a href="{{ route('add-snippet') }}">Add Snippet</a></p> 

	</div>
</div>

@endif

@stop