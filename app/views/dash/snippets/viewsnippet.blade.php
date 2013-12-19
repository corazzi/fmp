@extends('../../layout/dashboard')

{{-- Page title --}}
@section('title')
View Snippet :: @parent 
@stop

{{-- Page content --}}
@section('content')

<div class="row">
    <div class="col-md-6">

    	<p>dump everything for now<p>

    	{{ var_dump($code_snippet) }}


    </div>
</div>

@stop