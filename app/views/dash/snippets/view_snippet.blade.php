@extends('../../layout/dashboard')

{{-- Page title --}}
@section('title')
{{ $snippet_data->title; }} :: View Snippet :: @parent 
@stop

{{-- Page content --}}
@section('content')

<div class="row">
    <div class="col-md-6">

    	<p>dump everything for now<p>

    	{{ var_dump($snippet_data) }}


    </div>
</div>

@stop