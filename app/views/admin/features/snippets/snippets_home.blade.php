@extends('../layout/dashboard')

{{-- Page title --}}
@section('title', 'Snippet Management')

{{-- Page content --}}
@section('content')
	
<div class="page-header">

	<div class="large-6 columns">
        <div class="title">
            <h4><i class="fa fa-code"></i><a class="dash-title" href="{{ route('admin-snippets') }}"> @yield('title') </a></h4>
        </div>
    </div>

    {{ Form::open(['method' => 'GET']) }}

    <div class="search large-6 columns">
        <div class="row collapse">
            <div class="small-10 columns">
                <input type="text" placeholder="Search snippets.." name="search" type="search" required="required">
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
    <a class="unavailable">Snippet Management</a>  
</div>


<div class="inner-content">

    <div class="large-12 columns">

	@if ($all_snippets->count())

    <table>
 	    <thead>
		    <th width="300">Name</th>
		    <th width="200">Author</th>
		    <th width="200">State</th>
		    <th width="150">Yay Votes</th>
		    <th width="150">Nay Votes</th>
		    <th width="100">Favorites</th>
		    <th width="100">Actions</th>
	    </thead>

	    <tbody>
		    @foreach ($all_snippets as $snippet)

		        <?php $user = Sentry::findUserById($snippet->user_id); ?>

		        <tr>
		    	    <td>{{ $snippet->title }}</td>
		    	    <td>{{ $user->username }}</td>
		    	    <td>{{ $snippet->state }}</td>
		    	    <td>{{ Admin::getSnippetsAllYay($snippet->id) }}</td>
		    	    <td>{{ Admin::getSnippetsAllNay($snippet->id) }}</td>
		    	    <td>{{ Admin::getSnippetsFavorites($snippet->id) }}</td>
		    	    <td>
		    	        <a href="{{ route('admin-delete-snippet', $snippet->slug) }}" class="is-feed-delete" title="Delete Snippet"><i class="fa fa-times"></i></a>
                        <a href="{{ route('admin-edit-snippet', $snippet->slug) }}" class="is-feed-edit" title="Edit Snippet"><i class="fa fa-pencil"></i></a>
                        <a target="_blank" href="{{ route('view-snippet', $snippet->slug) }}" class="is-feed-view" title="View Snippet"><i class="fa fa-eye"></i></a>
		    	    </td>

		        </tr>

		    @endforeach

	    </tbody>
   </table>

    <div style="padding:10px">
        {{-- Pagination --}}
        <?php echo $all_snippets->links(); ?>
    </div>

    @else 

    <p> No snippets availabled at this time. </p>

    @endif

</div>


</div>	


@stop