@extends('../../layout/dashboard')

{{-- Page title --}}
@section('title', $guide_data->title)

{{-- Page content --}}
@section('content')

<div class="page-header">
    <div class="large-12 columns">
        <div class="title">
            <h4><i class="fa fa-book"></i> {{ $guide_data->title }}</h4>
        </div>
    </div>
</div>

<div class="breadcrumbs"> 
    <a href="{{ route('user-guides') }}">User Guides</a>
    <a class="unavailable">View Guide</a>  
</div>

<div class="inner-content user-guides">

	<div class="large-4 large-push-8 columns">

		<h5>Author</h5>

		<div class="content-box author">
		            @if(is_null($user->avatar))
        <img class="round" src="{{ Gravatar::src($user->email) }}">
        @else 
        <img class="round" src="{{ "/uploads/avatar/".$user->avatar }}">
        @endif

            <div class="info">
                <span class="username"><a class="username" href="">{{ ucfirst($user->username) }}</a></span>
                <span class="preference">{{ $user->preference }}</span>
            </div>
	    </div>


@if($guide_data->user_id != Sentry::getUser()->id)

        @if (empty($ratings))

        <h5>Useful?</h5>

        <div class="helpful content-box">
        
            <form method="post" action="{{ route('yay-guide', $guide_data->slug) }}" role="form">
                <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                <button title="Vote Yay" type="submit" class="button small yay large-6 medium-6 small-6"> <i class="fa fa-thumbs-up"></i> Yay </button>
            </form>
            <form method="post" action="{{ route('nay-guide', $guide_data->slug) }}" role="form">
                <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                <button title="Vote Nay" href="#" class="button small nay large-6 medium-6 small-6"><i class="fa fa-thumbs-down"></i> Nay </button>
            </form>

        </div>

        @elseif (array_sum($good_ratings) == "0")
        
        {{-- 
            do nothing - better than showing 0 users found this helpful
         --}}

        @else 


        <h5>Useful?</h5>

        <div class="helpful content-box">

            <div class="ratings-done">
                <span class="number">{{ array_sum($good_ratings) }}</span> {{ array_sum($good_ratings) == 1 ? 'member' : 'members' }} found this snippet useful <b data-tooltip class="has-tip" title="Thanks for voting!">including you</b>.
            </div>

        </div>

        @endif

@endif


        <h5>Tags</h5>

        <div class="content-box">
            @foreach ($tags as $tag)
                <?php $spaced_tag = str_replace(' ', '', $tag); ?>
                <a href="{{ route('view-tags-guides', $spaced_tag)}}"><span class="label">{{ $tag }}</span></a>
            @endforeach
        </div>

	</div>

	<div class="large-8 large-pull-4 columns">
		<div class="content-box view-guide">

            <div class="description">
                <h5>User Guide</h5>
            </div>

            <div class="favorite">

                @if($guide_data->user_id == Sentry::getUser()->id || Sentry::getUser()->hasAccess('admin'))
                    <a href="{{ route('delete-guide', $guide_data->slug)}}" class="is-me-delete" title="Delete Guide"><i class="fa fa-times"></i></a>
                    <a href="{{ route('edit-guide', $guide_data->slug)}}" class="is-me-edit" title="Edit Guide"><i class="fa fa-pencil"></i></a>
                @endif
                
                @if ($favorited = in_array($guide_data->id, $favorites))
                    <form method="post" action="{{ route('un-favorite-guide', $guide_data->slug) }}" role="form">
                @else 
                    <form method="post" action="{{ route('favorite-guide', $guide_data->slug) }}" role="form">
                @endif
                    <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                    <button class="icon {{ $favorited ? 'favorited' : 'not-favorited' }}" title="{{ $favorited ? 'Unfavorite Guide' : 'Favorite Guide'}}" type="submit"> <i class="fa fa-star"></i> </button>
                </form>
                
            </div>

            <hr>

         

           {{ $guide_content }}

     


		</div>

        <div class="add-comment">
            
            <h5>Comments</h5>

            <p>Why not give {{ $user->username }} some feedback....</p>
            
            <form method="post" action="{{ route('comment-guide', $guide_data->slug) }}" role="form">
                <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                <textarea rows="5" class="{{ $errors->first('comment', ' error') }}" name="comment" type="text">{{ Input::old('comment') }}</textarea>
                {{ $errors->first('comment', '<small class="error">:message</small>') }}
                <button class="button tiny left" type="submit">Submit</button>
                <span class="char-count right"></span>
            </form>

        </div>

	</div>

        <div class="large-8 end columns comments">

        @foreach ($comments as $comment)

        <?php $comment_user = Sentry::findUserById($comment->user_id); ?>
       
        <div class="single-comment">
            <div class="large-2 columns">
        @if(is_null($comment_user->avatar))
        <img  src="{{ Gravatar::src($comment_user->email) }}">
        @else 
        <img src="{{ "/uploads/avatar/".$comment_user->avatar }}">
        @endif
            </div>
            <div class="large-10 columns">
                <h6>{{ $comment_user->username }} <span class="green">&#8226;</span> <small>{{ $comment->created_at }}</small></h6>
                <p>{{ $comment->comment }}</p>
            </div>
        </div>

        <hr>

        @endforeach

    </div>  
    
</div>

@stop