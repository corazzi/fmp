@extends('../../layout/dashboard')

{{-- Page title --}}
@section('title', $guide_data->title)


{{-- Page content --}}
@section('content')
<div class="page-header">
    <div class="large-12 columns">
        <div class="title">
            <h4><i class="fa fa-pencil"></i> @yield('title')</h4>
        </div>
    </div>
</div>

<div class="breadcrumbs"> 
    <a href="{{ route('user-guides') }}">User Guides</a>
    <a class="unavailable">Edit Guide</a>  
</div>

<div class="inner-content">

    <div class="large-4 large-push-8 columns">
        <div class="content-box">

            <form action="{{ route('edit-guide-post', $guide_data->slug) }}" method="post" class="add">

                <input type="hidden" name="_token" value="{{ csrf_token() }}" />

                <div class="large-12 columns">
                    <label for="title">Title</label>
                    <input class="{{ $errors->first('title', ' error') }}" type="text" name="title" value="{{ Input::old('title', $guide_data->title) }}" />
                    {{ $errors->first('title', '<small class="error">:message</small>') }}
                </div>


                <div class="large-12 columns">
                    <label for="hidden_tags">Tags</label>
                    <input id="tm-input" class="tags" type="text" name="tags" placeholder="Add tag"/>
                    {{ $errors->first('hidden-tags', '<small class="error">The tags field is required.</small>') }}
                </div>


                <div class="large-12 columns">
                    <button class="large-12" type="submit">Update</button>
                </div>
            

        </div>
    </div>


    <div class="large-8 large-pull-4 columns">
        <div class="content-box">

                <div class="large-12 columns add">
                    <label for="content">Content <small class="markdown" data-reveal-id="markdownModal">Markdown Enabled (?)</small></label>
                    <textarea id="resize" class="{{ $errors->first('content', ' error') }}" name="content" type="text">{{ Input::old('content', $guide_data->content) }}</textarea>
                    {{ $errors->first('content', '<small class="error">:message</small>') }}
                </div>


            </form>

        </div>
    </div>

    

</div>


@stop