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
    	    <input type="text" class="form-control" name="title" value="{{ Input::old('title') }}">
    	    {{ $errors->first('title', '<span class="help-block">:message</span>') }}
        </div>

        <div class="form-group {{ $errors->has('description') ? 'has-error' : '' }}">
            <label for="description">Description</label>
            <textarea type="text" rows="2" class="form-control" name="description">{{ Input::old('description') }}</textarea>
            {{ $errors->first('description', '<span class="help-block">:message</span>') }}
        </div>

        <div class="form-group {{ $errors->has('code_snippet') ? 'has-error' : '' }}">
            <label for="code_snippet">Code Snippet</label>
            <textarea type="text" cols="50" rows="7" id="code" class="form-control" name="code_snippet">public static function() { echo &quot;Hello World!&quot;; }</textarea>
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
               
        <div class="form-group {{ $errors->has('tags') ? 'has-error' : '' }}">
            <label for="tags">Tags</label>  
            <input type="text" placeholder="Add tags"  data-role="tagsinput" name="tags" class="form-control" value="{{ Input::old('tags') }}"/>
            {{ $errors->first('tags', '<span class="help-block">:message</span>') }}
        </div>

        <button type="reset" class="btn">Reset</button>
		<button type="submit" class="btn btn-default">Publish</button>

        

                
        </form>

    </div>

</div>
@stop