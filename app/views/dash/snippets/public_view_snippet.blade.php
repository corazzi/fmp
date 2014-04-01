@extends('../../layout/dashboard')

{{-- Page title --}}
@section('title', $snippet_data->title)
@section('meta_description', $snippet_data->description)
@section('meta_author', $snippet_data->author)

{{-- Page content --}}
@section('content')

<div class="row">
    <div class="large-6 columns">

        <h5>Title</h5>
    	<div class="text-success">{{ $snippet_data->title; }}</div>

        
        @if ($snippet_data->description)
    	
        <h5>Description</h5>
    	<div class="text-success">{{ $snippet_data->description; }}</div>
        
        @endif

    	<h5>Code Snippet</h5>
    	<p>{{ $snippet_data->code_snippet; }}</p>
        
        @if ($snippet_data->credit)
        
        <h5>Credit</h5>
        <div class="text-success">{{ $snippet_data->credit; }}</div>
        
        @endif

    	<h5>Updated</h5>
    	<div class="text-success">{{ $snippet_data->humanUpdatedAt; }}</div>
    	<h5>Author</h5>
    	<div class="text-danger">{{ $snippet_data->author; }}</div>

        <br>


    </div>
</div>



@stop