@extends('../../layout/dashboard')

{{-- Page title --}}
@section('title', 'Add Snippet')

{{-- Page content --}}
@section('content')

<div class="row">

    <div class="large-6 columns content-holder">


	
	<h3>Lets add a snippet... YEAH!</h3>

        <form method="post" action="" role="form" class="" data-abide>

        <input type="hidden" name="_token" value="{{ csrf_token() }}" />

        <div class="row">
            <div class="large-12 columns">
                <label for="title">Snippet Title <small>required</small>
                    <input type="text" type="text" placeholder="Snippet title.." name="title" value="{{ Input::old('title') }}"/>
                </label>
                {{ $errors->first('title', '<label class="error">:message</label>') }}
            </div>
        </div>
		
        <button type="submit" class="btn btn-default">Publish</button>
            
        </form>

    </div>

    <div class="large-5 columns content-holder">
        <h3>Rules</h3>
        <ol style="padding:1rem 0;">
            <li>No Hyperlinks <small>if you have a resource link use the <a href="">Resource Section</a>.</small></li>
            <li>No Text, Code Only <small>if you have a user guide use the <a href="">User Guide Section</a>.</small></li>
            <li>No Duplicates <small>Please check if the snippet already exists.</small></li>
        </ol>

        <small style="font-decoration:underline;color:red">Abusing the sites features will result disciplinary action.</small>
    </div>

</div>
@stop