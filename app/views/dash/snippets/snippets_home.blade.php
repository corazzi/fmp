@extends('../../layout/dashboard')

{{-- Page title --}}
@section('title', 'Code Snippets')

{{-- Page content --}}
@section('content')

<div class="page-header">

	<div class="large-6 columns">
        <div class="title">
            <h4><i class="fa fa-code"></i><a class="dash-title" href="{{ route('code-snippets') }}"> @yield('title') </a></h4>
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

<div class="inner-content">

@if ($code_snippets->count())

	@foreach ($code_snippets as $snippet)

	<div class="large-4 medium-6 small-12 columns">
		<div class="snippet-block">
			<div class="title"><a href="{{ route('view-snippet', $snippet->slug) }}"><?php if(strlen($snippet->title) > 70){ echo substr($snippet->title,0,70)."<span class=\"green\">...</span>";}else{echo $snippet->title;}?></a></div>
			<div class="tags">

				<?php 

				$tags = explode( ',', $snippet->tags); 
				$spaced_tags = str_replace(' ', '', $tags); 

				?>

				@foreach ($spaced_tags as $tag)
                    <a href="{{ route('view-tags-snippets', $tag) }}"><span class="label">{{ $tag }}</span></a>
				@endforeach

			</div>
			<div class="code-preview">
				<pre><code><?php if(strlen($snippet->code_snippet) > 500){ echo substr($snippet->code_snippet,0,500);}else{echo $snippet->code_snippet;}?><code></pre>
			</div>
			<div class="about">
				<div class="left">	
                    <?php $user = Sentry::findUserById($snippet->user_id);?>
				            @if(is_null($user->avatar))
        <img src="{{ Gravatar::src($user->email) }}">
        @else 
        <img src="{{ "/uploads/avatar/".$user->avatar }}">
        @endif
				    <span class="username"><a href="">{{ $user->username }}</a></span>
				    <span class="posted">Posted {{ $snippet->humanCreatedAt }}</span>
			    </div>
			</div>
		</div>
	</div>

	@endforeach

    <div class="large-12 columns" style="padding:10px">
        {{-- Pagination --}}
        <?php echo $code_snippets->links(); ?>
    </div>

@else

	<div class="large-12 columns">
        <p>There are currently no code snippets to view, why not create one <a class="green-link" href="{{ route('add-snippet') }}">Click Here</a>.</p>
	</div>

@endif

</div>

@stop