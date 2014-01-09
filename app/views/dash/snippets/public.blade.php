@extends('../../layout/dashboard')

{{-- Page title --}}
@section('title', 'Public Snippets')

{{-- Page content --}}
@section('content')
<div class="row">
	<div class="col-md-12">

		@if ($code_snippets->count())
		
		<h3 class="pull-left">Public Snippets</h3>

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

	                             
	            <thead>
		            <th>ID</th>
		            <th>Name</th>
		            <th>Description</th>
		            <th>Author</th>
		            <th>Created</th> 
		            <th>Updated</th>                                        
	            </thead>

	            <tbody>

	            <?php $id = $code_snippets->getFrom(); ?>

	            
	            @foreach ($code_snippets as $snippet)

	            <tr>
	            	
	            	<td>{{ $id++ }}</td>
	            

	            	
	            	<td><a href="{{ route('view-public-snippet', $snippet->slug) }}">{{ $snippet->title }}</a></td>
	            	<td>{{ $snippet->description }}</td>
	            	<td><a href="members/{{ $snippet->author; }}">{{ $snippet->author }}</a></td>
	            	<td>{{ $snippet->humanCreatedAt }}</td>
	            	<td>{{ $snippet->humanUpdatedAt }}</td>
	            </tr>

	            @endforeach

	         

	            </tbody>                
            
            </table>
        </div>

        {{-- Pagination --}}
        <?php echo $code_snippets->links(); ?>

        @else

        <p>No snippets returned <a href="{{ route('public-snippets') }}"><- Go Back</a></p> <div class="text-warning">(going to do this as a flash message eventually)</div>

        @endif

    </div>
</div>

@stop