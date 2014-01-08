@extends('../../layout/dashboard')

{{-- Page title --}}
@section('title', 'Edit Snippet')

{{-- Page content --}}
@section('content')


<div class="row">
    <div class="col-md-6">

    	<h3>Edit Snippet</h3>

    	<form method="post" action="" autocomplete="off" role="form" class="snippet-form">

    	<input type="hidden" name="_token" value="{{ csrf_token() }}" />

        <div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
    	    <label for="title">Title</label>
    	    <input type="text" class="form-control" name="title" value="{{ Input::old('title', $code_snippet->title) }}">
    	    {{ $errors->first('title', '<span class="help-block">:message</span>') }}
        </div>

        <div class="form-group {{ $errors->has('description') ? 'has-error' : '' }}">
            <label for="description">Description</label>
            <textarea type="text" rows="2" class="form-control" name="description">{{ Input::old('description', $code_snippet->description) }}</textarea>
            {{ $errors->first('description', '<span class="help-block">:message</span>') }}
        </div>

        <div class="form-group {{ $errors->has('code_snippet') ? 'has-error' : '' }}">
            <label for="code_snippet">Code Snippet</label>
            <textarea type="text" cols="50" rows="7" id="code" class="form-control" name="code_snippet">{{ Input::old('code_snippet', $code_snippet->code_snippet) }}</textarea>
            {{ $errors->first('code_snippet', '<span class="help-block">:message</span>') }}
        </div>

        <div class="form-group">
            <label class="radio-inline">
                <input name="state" type="radio" value="public"  <? if($code_snippet->state == 'public'){ echo "checked";} ?>> Public
            </label>
            <label class="radio-inline">
                <input name="state" type="radio" value="private" <? if($code_snippet->state == 'private'){ echo "checked";} ?>>  Private
            </label>
        </div>


        <div class="form-group {{ $errors->has('tags') ? 'has-error' : '' }}">
            <label for="tags">Tags</label>  
            <input type="text" placeholder="Add tags"  data-role="tagsinput" name="tags" class="form-control" value="{{ Input::old('tags', $code_snippet->tags) }}"/>
            {{ $errors->first('tags', '<span class="help-block">:message</span>') }}
        </div>


        <button type="reset" class="btn">Reset</button>
		<button type="submit" class="btn btn-default">Publish</button>


    	</form>
	
    </div>
</div>

@stop