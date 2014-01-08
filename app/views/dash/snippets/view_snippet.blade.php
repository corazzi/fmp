@extends('../../layout/dashboard')

{{-- Page title --}}
@section('title', $snippet_data->title)
@section('meta_description', $snippet_data->description)
@section('meta_author', $snippet_data->author)

{{-- Page content --}}
@section('content')

<div class="row">
    <div class="col-md-6">

    	<p>dump everything for now<p>

    	{{ var_dump($snippet_data) }}


    </div>
</div>

@stop