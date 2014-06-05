@extends('../layout/dashboard')

{{-- Page title --}}
@section('title', 'News Management')

{{-- Page content --}}
@section('content')

<div class="page-header">

	<div class="large-6 columns">
        <div class="title">
            <h4><i class="fa fa-tag"></i><a class="dash-title" href="{{ route('admin-news') }}"> @yield('title') </a></h4>
        </div>
    </div>

</div>

<div class="breadcrumbs"> 
    <a href="{{ route('admin-home') }}">Administration</a>
    <a class="unavailable">News Management</a>
</div>

<div class="inner-content">

	<div class="large-12 columns">
	
	@if ($all_news->count())

    <table>
 	    <thead>
		    <th width="300">Title</th>
		    <th width="400">URL</th>
		    <th width="300">User</th>
		    <th width="200">Actions</th>
	    </thead>

	    <tbody>
		    @foreach ($all_news as $news)

		        <?php $user = Sentry::findUserById($news->user_id); ?>

		        <tr>
		    	    <td>{{ $news->title }}</td>
		    	    <td>{{ $news->url }}</td>
		    	    <td>{{ $user->username }}</td>
		    	    <td>
		    	        <a href="{{ route('admin-delete-news', $news->id) }}" class="is-feed-delete" title="Delete News"><i class="fa fa-times"></i></a>
                        <a target="_blank" href="{{ $news->url }}" class="is-feed-view" title="View Url"><i class="fa fa-eye"></i></a>
		    	    </td>

		        </tr>

		    @endforeach

	    </tbody>
   </table>

    <div style="padding:10px">
        {{-- Pagination --}}
        <?php echo $all_news->links(); ?>
    </div>

    @else 

    <p> No news available at this time. </p>

    @endif

</div>

</div>


@stop