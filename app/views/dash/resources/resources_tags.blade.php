@extends('../layout/dashboard')

{{-- Page title --}}
@section('title', 'Resources Tags')

{{-- Page content --}}
@section('content')

<div class="page-header">

	<div class="large-6 columns">
        <div class="title">
            <h4>
            	<i class="fa fa-rocket"></i>
            	<a class="dash-title" href="{{ route('resources-home') }}"> @yield('title') </a>
                <small><a href="{{ route('add-resource') }}" class="markdown">Submit a Resource</a></small>
            </h4>
        </div>
    </div>

     <div class="results"> Results for: <div class="label">{{ $tag }}</div></div>
</div>

<div class="inner-content">

	<div class="large-12 columns">


	@if ($all_resources->count())

    <table>
 	    <thead>
		    <th width="300">Title</th>
		    <th width="400">URL</th>
		     <th width="400">Tags</th>
		    <th width="300">Submitted By</th>
		    <th width="300">Created At</th>
	    </thead>

	    <tbody>
		    @foreach ($all_resources as $resource)

		        <?php $user = Sentry::findUserById($resource->user_id); ?>

		        <tr>
		    	    <td><a target="_blank" href="{{ $resource->link }}">{{ $resource->title }}</a></td>
		    	    <td><a target="_blank" href="{{ $resource->link }}">{{ $resource->link }}</a></td>
		    	    <td>
		    	    	
				<?php 

				$tags = explode( ',', $resource->tags); 
				$spaced_tags = str_replace(' ', '', $tags); 

				?>

				@foreach ($spaced_tags as $tag)
                    <a href="{{ route('view-tags-resources', $tag) }}"><span class="label">{{ $tag }}</span></a>
				@endforeach

		    	    </td>
		    	    <td>{{ $user->username }}</td>
		    	    <td>{{ $resource->humanCreatedAt }}</td>
		        </tr>

		    @endforeach

	    </tbody>
   </table>

    <div style="padding:10px">
        {{-- Pagination --}}
        <?php echo $all_resources->links(); ?>
    </div>

    @else 


        <p> No resources available at this time. </p>


    

    @endif

    </div>



@stop