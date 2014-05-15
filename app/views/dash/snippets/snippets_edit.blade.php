@extends('../../layout/dashboard')

{{-- Page title --}}
@section('title', $snippet_data->title)


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
    <a href="{{ route('code-snippets') }}">Code Snippets</a>
    <a class="unavailable">Edit Snippet</a>  
</div>

<div class="inner-content">


    <div class="large-6 large-push-6 columns">
        <div class="content-box">

            <form class="add" method="post" action="{{ route('edit-snippet-post', $snippet_data->slug) }}" role="form">
        
                <input type="hidden" name="_token" value="{{ csrf_token() }}" />

                <div class="large-12 columns">
                    <label for="title">Title</label>
                    <input class="{{ $errors->first('title', ' error') }}" type="text" name="title" value="{{ Input::old('title', $snippet_data->title) }}" />
                    {{ $errors->first('title', '<small class="error">:message</small>') }}
                </div>

                <div class="large-12 columns">
                    <label for="description">Description</label>
                    <textarea rows="5" class="{{ $errors->first('description', ' error') }}" name="description" type="text">{{ Input::old('description', $snippet_data->description) }}</textarea>
                    {{ $errors->first('description', '<small class="error">:message</small>') }}
                </div>

                <div class="large-6 medium-6 small-12 columns">
                    <label for="hidden_tags">Tags</label>
                    <input id="tm-input" class="tags" type="text" name="tags" placeholder="Add tag"/>
                    {{ $errors->first('hidden-tags', '<small class="error">The tags field is required.</small>') }}
                </div>

                <div class="large-6 medium-6 small-12 columns">
                    <label>Visibility</label>
                    <input type="radio" name="state" value="public" id="public" {{ $snippet_data->state == 'public' ? 'checked' : ''}}><label class="{{ $errors->first('state', ' error') }}" for="public">Public</label>
                    <input type="radio" name="state" value="private" id="private" {{ $snippet_data->state == 'private' ? 'checked' : ''}}><label class="{{ $errors->first('state', ' error') }}" for="private">Private</label>
                </div>

                <div class="large-12 columns">
                    <button class="large-12" type="submit">Update</button>
                </div>

        </div>
    </div>
    
    <div class="large-6 large-pull-6 columns">
        <div class="content-box">

                

                <div class="large-12 columns add">
                    <label for="code_snippet">Code Snippet</label>
                    <textarea id="resize" class="{{ $errors->first('code_snippet', ' error') }}" name="code_snippet" type="text">{{ Input::old('code_snippet', $snippet_data->code_snippet) }}</textarea>
                    {{ $errors->first('code_snippet', '<small class="error">:message</small>') }}
                </div>

                
            </div>
        </div>


    </form>

</div>
@stop