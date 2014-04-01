@extends('../../layout/dashboard')

{{-- Page title --}}
@section('title', 'Search Results | Public Snippets')

{{-- Page content --}}
@section('content')

@if ($code_snippets->count())

<div class="row">
	<div class="large-12 columns snippets">

		<h3>{{ Request::get('search') }}</h3>

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

<div class="row">
    <div class="large-12 columns">


        <table>
  
	            <thead>
		            <th>ID</th>
		            <th width="600">Name</th>
		            <th width="200">Author</th>
		            <th width="200">Created</th> 
                                       
	            </thead>

	            <tbody>

	            <?php $id = $code_snippets->getFrom(); ?>
	            
	            @foreach ($code_snippets as $snippet)

	                <tr>
	            	    <td>{{ $id++ }}</td>
	            	    <td><a href="{{ route('view-public-snippet', $snippet->slug) }}">{{ $snippet->title }}</a></td>
	            	    <td><a href="">{{ $snippet->author }}</a></td>
	            	    <td>{{ $snippet->humanCreatedAt }}</td>
	                </tr>

	            @endforeach

	            </tbody>                
            
            </table>


        {{-- Pagination --}}
        <?php echo $code_snippets->links(); ?>

        <table>


    </div>
</div>

@else

<div class="row">
	<div class="col-md-12">
		
		<h3>{{ Request::get('search') }}</h3>
		<p>No snippets returned <a href="{{ route('public-snippets') }}">Go Back</a></p> 

	</div>
</div>

@endif

@stop