@extends('../layout/dashboard')

{{-- Page title --}}
@section('title', 'Resource Management')

{{-- Page content --}}
@section('content')
<div class="page-header">

	<div class="large-6 columns">
        <div class="title">
            <h4>
            	<i class="fa fa-rocket"></i>
            	<a class="dash-title" href="{{ route('admin-resources') }}"> @yield('title') </a>
                <small><a href="{{ route('admin-activated-resources') }}" class="markdown">View Activated Resources</a></small>
            </h4>
        </div>
    </div>

</div>

<div class="breadcrumbs"> 
    <a href="{{ route('admin-home') }}">Administration</a>
    <a class="unavailable">Resource Management</a>
</div>


<div class="inner-content">

	<div class="large-12 columns">


	@if ($all_resources->count())

    <table>
 	    <thead>
		    <th width="300">Title</th>
		    <th width="400">URL</th>
		    <th width="300">User</th>
		    <th width="300">Created At</th>
		    <th width="200">Actions</th>
	    </thead>

	    <tbody>
		    @foreach ($all_resources as $resource)

		        <?php $user = Sentry::findUserById($resource->user_id); ?>

		        <tr>
		    	    <td>{{ $resource->title }}</td>
		    	    <td>{{ $resource->link }}</td>
		    	    <td>{{ $user->username }}</td>
		    	    <td>{{ $resource->humanCreatedAt }}</td>
		    	    <td>
		    	        <a href="{{ route('admin-delete-resource', $resource->id) }}" class="is-feed-delete" title="Delete Resource"><i class="fa fa-times"></i></a>
		    	        <a href="{{ route('admin-activate-resource', $resource->id) }}" class="is-feed-edit" title="Activate"><i class="fa fa-check"></i></a>
                        <a target="_blank" href="{{ $resource->link }}" class="is-feed-view" title="View Url"><i class="fa fa-eye"></i></a>

		    	    </td>

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
	


</div>



@stop