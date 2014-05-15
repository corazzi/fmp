@extends('../layout/dashboard')

{{-- Page title --}}
@section('title', 'User Guides')

{{-- Page content --}}
@section('content')

<?php

    $request = e(Request::get('search'));

?>


<div class="page-header">
	<div class="large-12 columns">
        <div class="title">
            <h4><i class="fa fa-book"></i> <a href="">@yield('title')</a>
            <small> Results for: <?php if(strlen($request) > 35){echo "".substr($request, 0, 35)."<span class=\"dots\">...</span>";}else{echo $request;} ?></small></h4>
        </div>
    </div>
</div>

<div class="breadcrumbs"> 
    <a href="{{ route('user-guides') }}">User Guides</a>
    <a class="unavailable">Search Results</a>  
</div>


<div class="inner-content user-guides">

    @if ($user_guides->count())
    

        @foreach ($user_guides as $guide)
        
         <div class="large-6 medium-12 small-12 columns end">

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

                    $tags = explode( ',', $guide->tags); 
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

            </div>


        @endforeach


        {{-- Pagination --}}
        <?php echo $user_guides->links(); ?>
        
    
    @else 

    <div class="large-12 columns">
            
        <p>There are no guide results for that term, why not create one <a class="green-link" href="{{ route('add-guide') }}">Click Here</a>.</p>

    </div>

    @endif


</div>

@stop