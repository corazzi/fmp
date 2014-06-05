@extends('../layout/dashboard')

{{-- Page title --}}
@section('title', 'Guide Management')

{{-- Page content --}}
@section('content')

<div class="page-header">

	<div class="large-6 columns">
        <div class="title">
            <h4><i class="fa fa-book"></i><a class="dash-title" href="{{ route('admin-guides') }}"> @yield('title') </a></h4>
        </div>
    </div>

    {{ Form::open(['method' => 'GET']) }}

    <div class="search large-6 columns">
        <div class="row collapse">
            <div class="small-10 columns">
                <input type="text" placeholder="Search guides.." name="search" type="search" required="required">
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
    <a class="unavailable">Guide Management</a>  
</div>


<div class="inner-content">
	
	@if ($user_guides->count())

    <table>
 	    <thead>
		    <th width="300">Name</th>
		    <th width="300">Author</th>
		    <th width="150">Yay Votes</th>
		    <th width="150">Nay Votes</th>
		    <th width="150">Favorites</th>
		    <th width="150">Actions</th>
	    </thead>

	    <tbody>
		    @foreach ($user_guides as $guide)

		        <?php $user = Sentry::findUserById($guide->user_id); ?>

		        <tr>
		    	    <td>{{ $guide->title }}</td>
		    	    <td>{{ $user->username }}</td>
		    	    <td>{{ Admin::getGuidesAllYay($guide->id) }}</td>
		    	    <td>{{ Admin::getGuidesAllNay($guide->id) }}</td>
		    	    <td>{{ Admin::getGuidesFavorites($guide->id) }}</td>
		    	    <td>
		    	        <a href="{{ route('admin-delete-guide', $guide->slug) }}" class="is-feed-delete" title="Delete Guide"><i class="fa fa-times"></i></a>
                        <a href="{{ route('admin-edit-guide', $guide->slug) }}" class="is-feed-edit" title="Edit Guide"><i class="fa fa-pencil"></i></a>
                        <a target="_blank" href="{{ route('view-guide', $guide->slug) }}" class="is-feed-view" title="View Guide"><i class="fa fa-eye"></i></a>
		    	    </td>

		        </tr>

		    @endforeach

	    </tbody>
   </table>

    <div class="large-12 columns" style="padding:10px">
        {{-- Pagination --}}
        <?php echo $user_guides->links(); ?>
    </div>

    @else 

    <p> No guides available at this time. </p>

    @endif

</div>


@stop