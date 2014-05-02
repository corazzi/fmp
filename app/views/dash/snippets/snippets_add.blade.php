@extends('../../layout/dashboard')

{{-- Page title --}}
@section('title', 'Add Snippet')

{{-- Page content --}}
@section('content')

<div class="page-header">

    <div class="large-6 columns">
        <div class="title">
            <h4><i class="fa fa-code"></i> @yield('title')</h4>
        </div>
    </div>

</div>

<div class="inner-content">

<div class="large-6 medium-12 small-12 columns">
    <div class="content-box">

        <form class="add" method="post" action="{{ route('add-snippet') }}" role="form">

            <input type="hidden" name="_token" value="{{ csrf_token() }}" />

            <div class="large-12 columns">
                <label for="title">Title</label>
                <input class="{{ $errors->first('title', ' error') }}" type="text" name="title" value="{{ Input::old('title') }}" />
                {{ $errors->first('title', '<small class="error">:message</small>') }}
            </div>


            <div class="large-12 columns">
                <label for="description">Description</label>
                <textarea rows="4" class="{{ $errors->first('description', ' error') }}" name="description" type="text">{{ Input::old('description') }}</textarea>
                {{ $errors->first('description', '<small class="error">:message</small>') }}
            </div>

            <div class="large-6 medium-6 small-12 columns">
                <label for="hidden_tags">Tags</label>
                <input id="tm-input" class="tags" type="text" name="tags" placeholder="Add tag"/>
                {{ $errors->first('hidden-tags', '<small class="error">The tags field is required.</small>') }}
            </div>

            <div class="large-6 medium-6 small-12 columns">
                <label>Visibility</label>
                <input type="radio" name="state" value="public" id="public" checked><label class="{{ $errors->first('state', ' error') }}" for="public">Public</label>
                <input type="radio" name="state" value="private" id="private"><label class="{{ $errors->first('state', ' error') }}" for="private">Private</label>
            </div>

            <div class="large-12 columns">
                <label for="code_snippet">Code Snippet</label>
                <textarea rows="5" class="{{ $errors->first('code_snippet', ' error') }}" name="code_snippet" type="text">{{ Input::old('code_snippet') }}</textarea>
                {{ $errors->first('code_snippet', '<small class="error">:message</small>') }}
            </div>
            
            <div class="large-12 columns">
                <button type="submit">Add Snippet</button>
            </div>
            
        </form>

    </div>
</div>


<div class="large-6 medium-12 small-12 columns">
    <div class="code-rules">
        <h3>Do's</h3>
        <ol>
            <li>Share quality code</li>
            <li>Post any language or markup</li>
            <li>Be descriptive</li>
            <li>Add relevant tags</li>
            <li>Be a boss!</li>
        </ol>

        <h3>Dont's</h3>
        <ol>
            <li>No Hyperlinks</li>
            <li>Strictly code only</li>
            <li>Non irrelevant material</li>
            <li>Attempt to hack us (that would be silly)</li>
        </ol>
        <small>Abusing the sites features will result disciplinary action.</small>
    </div>
</div>

</div>

@stop