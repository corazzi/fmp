@extends('../../layout/dashboard')

{{-- Page title --}}
@section('title', 'Add Snippet')

{{-- Page content --}}
@section('content')

<div class="row">

    <div class="col-md-6">
	
	<h3>Add Snippet</h3>

        <form method="post" action="" autocomplete="off" role="form" class="snippet-form">

        <input type="hidden" name="_token" value="{{ csrf_token() }}" />

        <div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
    	    <label for="title">Title</label>
    	    <input type="text" class="form-control" name="title" value="{{ Input::old('title') }}" placeholder="Snippet title..">
    	    {{ $errors->first('title', '<span class="help-block">:message</span>') }}
        </div>

        <div class="form-group {{ $errors->has('description') ? 'has-error' : '' }}">
            <label for="description">Description</label>
            <textarea type="text" rows="2" class="form-control" name="description" placeholder="Brief description of the snippet.. (optional)">{{ Input::old('description') }}</textarea>
            {{ $errors->first('description', '<span class="help-block">:message</span>') }}
        </div>

        <div class="form-group {{ $errors->has('code_snippet') ? 'has-error' : '' }}">
            <label for="code_snippet">Code Snippet</label>
            <textarea type="text" cols="50" rows="7" id="code" class="form-control" name="code_snippet" placeholder="public static function() { echo &quot;Hello World!&quot;; }">{{ Input::old('code_snippet') }}</textarea>
            {{ $errors->first('code_snippet', '<span class="help-block">:message</span>') }}
        </div>

        <div class="form-group">
            <label class="radio-inline">
                {{ Form::radio('state', 'public', true); }} Public
            </label>
            <label class="radio-inline">
                {{ Form::radio('state', 'private'); }}  Private
            </label>
        </div>

        <div class="form-group {{ $errors->has('credit') ? 'has-error' : '' }}">
            <label for="credit">Credit</label>
            <input type="text" class="form-control" name="credit" value="{{ Input::old('credit') }}" placeholder="Credit to.. (optional)">
            {{ $errors->first('credit', '<span class="help-block">:message</span>') }}
        </div>
               
        <div class="form-group {{ $errors->has('tags') ? 'has-error' : '' }}">
            <label for="tags">Tags</label>  
            <input type="text" placeholder="Add tags"  data-role="tagsinput" name="tags" class="form-control tags" value="{{ Input::old('tags') }}"/>
            {{ $errors->first('tags', '<span class="help-block">:message</span>') }}
        </div>

        <button type="reset" class="btn">Reset</button>
		<button type="submit" class="btn btn-default">Publish</button>

        

                
        </form>

    </div>

</div>
@stop