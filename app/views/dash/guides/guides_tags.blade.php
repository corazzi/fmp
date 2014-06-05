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
    <a href="{{ route('code-snippets') }}">User Guides</a>
    <a class="unavailable">Tag Search</a>  
</div>
    
<div class="inner-content user-guides">

    @if ($user_guides->count())
    

        @foreach ($user_guides as $guide)
         <div class="large-6 medium-12 small-12 columns end">

            <div class="content-box guide">
                
                <div class="header">
                    <?php $user = Sentry::findUserById($guide->user_id);?>
                            @if(is_null($user->avatar))
        <img src="{{ Gravatar::src($user->email) }}">
        @else 
        <img src="{{ "/uploads/avatar/".$user->avatar }}">
        @endif
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
            
        <p>There are no guides with that tag, why not create one <a class="green-link" href="{{ route('add-guide') }}">Click Here</a>.</p>

    </div>

    @endif


</div>

@stop