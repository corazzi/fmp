@extends('../../layout/dashboard')

{{-- Page title --}}
@section('title', 'Tag Search')

{{-- Page content --}}
@section('content')

<div class="page-header">

	<div class="large-6 columns">
        <div class="title">
            <h4><i class="fa fa-code"></i><a class="dash-title" href="{{ route('code-snippets') }}"> @yield('title') </a></h4>

        </div>
    </div>

   <div class="results"> Results for: <div class="label">{{ $tag }}</div></div>

</div>

<div class="breadcrumbs"> 
    <a href="{{ route('code-snippets') }}">Code Snippets</a>
    <a class="unavailable">Tag Search</a>  
</div>
    
<div class="inner-content">

@if ($code_snippets->count())

	@foreach ($code_snippets as $snippet)

	<div class="large-4 medium-6 small-12 columns">
		<div class="snippet-block">
			<div class="title"><a href="{{ route('view-snippet', $snippet->slug) }}"><?php if(strlen($snippet->title) > 70){ echo substr($snippet->title,0,70)."<span class=\"green\">...</span>";}else{echo $snippet->title;}?></a></div>
			<div class="tags">

				<?php $tags = explode( ',', $snippet->tags); ?>

				@foreach ($tags as $tag)
                    <a href=""><span class="label">{{ $tag }}</span></a>
				@endforeach

			</div>
			<div class="code-preview">
				<pre><code><?php if(strlen($snippet->code_snippet) > 500){ echo substr($snippet->code_snippet,0,500);}else{echo $snippet->code_snippet;}?><code></pre>
			</div>
			<div class="about">
				<div class="left">	
                    <?php $user = Sentry::findUserById($snippet->user_id);?>
				    <img src="{{ Gravatar::src($user->email) }}">
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
        <p class="not-available">No snippets exist with that tag, why not create one!? <a class="dash-link" href="{{ route('add-snippet') }}">Click Here</a>.</p>
	</div>

@endif

</div>

@stop