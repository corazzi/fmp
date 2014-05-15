@extends('../layout/dashboard')

{{-- Page title --}}
@section('title', 'News')

{{-- Page content --}}
@section('content')

<div class="page-header">
	<div class="large-12 columns">
        <div class="title">
            <h4><i class="fa fa-tag"></i> {{ ucfirst(Sentry::getUser()->username) }}s @yield('title')</h4>
        </div>
    </div>
</div>

<div class="inner-content news">

	<div class="large-4 columns">
		<div class="content-box">
			<p>Welcome to the news area of webrepo, here you can add up to five of your favorite RSS Feeds and keep up to date right here in your user area.</p>
		</div>

		<h5>Add RSS Feed</h5>
		<div class="content-box">
        
            <form action="{{ route('add-news') }}" method="post">

            	<input type="hidden" name="_token" value="{{ csrf_token() }}" />

                    <div class="row collapse add-news">
                        <div class="small-10 columns">
                            <input name="feed_url" type="text" placeholder="RSS Url">
                        </div>
                        <div class="small-2 columns">
                            <button type="submit" class="button postfix">Add</button>
                        </div>
                    </div>

           </form>


		</div>

		@if($saved_feeds->count() > 0)

		<h5>Feed Management</h5>

        <table>
            <thead>
                <tr>
                    <th width="920">Feed Name</th>
                    <th width="80">Action</th>
                </tr>
            </thead>
            <tbody>
			
			@foreach ($saved_feeds as $single_feed)
			    <tr>
                    <td>{{ $single_feed->title }}</td>
                    <td>
                        <a href="{{ route('delete-news', $single_feed->slug) }}" class="is-feed-delete" title="Delete Feed"><i class="fa fa-times"></i></a>
                    </td>
                </tr>
			@endforeach

            </tbody>
        </table>

        @endif

	</div>

	<div class="large-8 columns">

		@if($saved_feeds->count() > 0)



            @foreach ($all_feeds->get_items() as $feed)

                <div class="feed-content" style="width:100%;background:white;margin-bottom:20px;padding:10px;overflow:hidden;">
                    
                    <h4><a target="_blank" href="{{ $feed->get_permalink() }}">{{ $feed->get_title() }}</a></h4>

                    <hr> 

                    <p>{{ substr($feed->get_content(), 0, strpos($feed->get_content(), ' ', 400)) }}.....</p>
                    <small><a href="{{ $feed->get_permalink() }}" target="_blank" class="green-link"> (Read More)</a></small>

                    <hr>

                    <div class="feed-footer"
                        <a class="left" href="{{ $feed->get_feed()->subscribe_url() }}">{{ $feed->get_feed()->get_title() }}</a>
                        <span class="right">{{ $feed->get_date('j M Y'); }}</span>
                    </div>
  
                </div>

            @endforeach
                
        </div>

		@else 

            <p>You havnt saved any feeds with us yet, why not add one now using the add feed form.</p>
            
		@endif
		
	</div>

</div>
@stop