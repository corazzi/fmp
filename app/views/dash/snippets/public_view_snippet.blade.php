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
    	<div class="text-success">{{ $snippet_data->title; }}</div>
    	<h5>Description</h5>
    	<div class="text-success">{{ $snippet_data->description; }}</div>
    	<h5>Code Snippet</h5>
    	<div class="text-success">{{ $snippet_data->code_snippet; }}</div>
    	<h5>Created at</h5>
    	<div class="text-success">{{ $snippet_data->created_at; }}</div>
    	<h5>Author</h5>
    	<div class="text-danger">{{ $snippet_data->author; }}</div>


        <div class="fb-share-button" data-href="{{ URL::current() }}" data-type="button"></div>

    </div>
</div>



@stop