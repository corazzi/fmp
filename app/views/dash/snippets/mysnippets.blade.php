@extends('../../layout/dashboard')

{{-- Page title --}}
@section('title')
@parent :: My Snippets 
@stop

{{-- Page content --}}
@section('content')
<div class="col-md-12">

    <h2>My Snippets</h2>

<div>

    <table class="table table-bordered table-responsive col-md-12 ">
        <thead>
            <tr>
                <th>#</th>
                <th>Title</th>
                <th>Description</th>
                <th>State</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
    
        @foreach ($code_snippets as $code_snippet)

            <tr>
                <td> {{ $code_snippet->title }} </td>
                <td> {{ $code_snippet->description }} </td>
                <td> {{ $code_snippet->state }} </td>
                <td>  Update - Delete   </td>
            </tr>

        @endforeach
         
        </tbody>
    </table>

</div>
@stop