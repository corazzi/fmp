@extends('../../layout/dashboard')

{{-- Page title --}}
@section('title', 'Public Snippets')

{{-- Page content --}}
@section('content')
<div class="row">
	<div class="col-md-12">
		
		<h3 class="pull-left">Public Snippets</h3>

		{{-- Example Search Box --}}
		
		<div class="pull-right" style="width:30%;margin:10px 0;">		
			<form class="navbar-form" role="search">
		        
		        <div class="input-group">
			        <input type="text" class="form-control" placeholder="Search" name="srch-term" id="srch-term" required>
			        <div class="input-group-btn">
				        <button class="btn btn-info" type="submit"><i class="glyphicon glyphicon-search"></i></button>
			        </div>
		        </div>

		    </form>
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
		            <th>Description</th>
		            <th>Author</th>
		            <th>Created</th>                                         
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