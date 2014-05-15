@extends('../layout/dashboard')

{{-- Page title --}}
@section('title', 'User Guides')

{{-- Page content --}}
@section('content')

<div class="page-header">
	<div class="large-12 columns">
        <div class="title">
            <h4><i class="fa fa-book"></i> <a href="{{ route('user-guides') }}"> @yield('title') </a></h4>
        </div>
    </div>
</div>

<div class="inner-content user-guides">

    @if ($user_guides->count())
    
    <div class="large-4 large-push-8 columns sidebar">

        <a href="{{ route('add-guide') }}" class="add-button large-12 columns"> Add Guide </a>

        <h5>User Guides</h5>

        <div class="content-box">
            <p>Welcome {{ Sentry::getUser()->username }} to the user guide section of <b>webrepo.io</b>. This section provides useful guides from members of the community. Wether it be configuring a development enviroment or cool css tricks anything can be covered in this section.</p>
            <p>Feel you have something to add to this section? Why not post it, we dont bite and we love new guides!</p>
        </div>

    	<h5>Search Guides</h5>

        {{ Form::open(['method' => 'GET']) }}


        <div class="row collapse">
            <div class="small-10 columns">
                <input type="text" placeholder="Search guides.." name="search" type="search" required="required">
            </div>
            <div class="small-2 columns">
                <a href="" class="button postfix" type="submit">Go</a>
            </div>
        </div>


        {{ Form::close() }}

    </div>

    <div class="large-8 large-pull-4 columns">

    	@foreach ($user_guides as $guide)

    	    <div class="content-box guide">
                
                <div class="header">
                    <?php $user = Sentry::findUserById($guide->user_id);?>
                    <img src="{{ Gravatar::src($user->email)  }}">
                    <span class="title"><a href="{{ route('view-guide', $guide->slug) }}">{{ $guide->title }}</a></span>
                    <span class="author">By <a href="">{{ $user->username }}</a></span> 
                </div>

                    
                <div class="preview">
                    <pre><code>{{ Guide::blankRepoMarkdown($guide->content) }}</code></pre>
                </div>
    	    	
    	    	<?php 

				$tags = explode(',', $guide->tags); 
				$spaced_tags = str_replace(' ', '', $tags); 

				?>

                <div class="tags">
                    @foreach ($spaced_tags as $tag)
                        <a href="{{ route('view-tags-guides', $tag) }}"><span class="label">{{ $tag }}</span></a>
                    @endforeach
                </div>
                    
                <div class="posted">
                    Posted {{ $guide->humanCreatedAt }}
                </div>


    	    </div>

    	@endforeach

        {{-- Pagination --}}
        <?php echo $user_guides->links(); ?>
    	
    </div>

    @else 

    <div class="large-12 columns">
            
        <p>There are currently no user guides to view, why not create one <a class="green-link" href="{{ route('add-guide') }}">Click Here</a>.</p>

    </div>

    @endif


</div>

@stop