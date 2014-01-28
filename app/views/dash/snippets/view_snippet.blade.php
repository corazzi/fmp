@extends('../../layout/dashboard')

{{-- Page title --}}
@section('title', $snippet_data->title)
@section('meta_description', $snippet_data->description)
@section('meta_author', $snippet_data->author)

{{-- Page content --}}
@section('content')

<div class="row">
    <div class="col-md-6">

    	<h5>Title</h5>

    	{{ $snippet_data->title }}

    	@if ($snippet_data->description)
        
        <h5>Description</h5>

        @endif

    	{{ $snippet_data->description }}

    	<h5>Code Snippet</h5>

    	{{ $snippet_data->code_snippet }}

    	<h5>Privacy</h5>

    	{{ $snippet_data->state }}

    	@if ($snippet_data->credit)

    	<h5>Credit</h5>

    	{{ $snippet_data->credit }}

    	@endif

    	<h5>Tags</h5>

    	{{ $snippet_data->tags }}

    </div>
</div>

@stop