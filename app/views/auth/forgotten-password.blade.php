@extends('../layout/default')

{{-- Page title --}}
@section('title')
@section('title', 'Forgot Password')

{{-- Page content --}}
@section('content')

<div class="col-md-4">

    <div class="page-header">
        <h3>Forgot Password</h3>
    </div>

    <form method="post" action="" role="form">
        
        {{-- CSRF TOKEN --}} 
        <input type="hidden" name="_token" value="{{ csrf_token() }}" />

        {{-- Email --}} 
        <div class="form-group{{ $errors->first('email', ' has-error') }}">
            <label  for="email">Email</label>
            <input type="text" name="email" id="email" value="{{ Input::old('email') }}" class="form-control"/>
            {{ $errors->first('email', '<span class="help-block">:message</span>') }}
        </div>

        <hr>

        {{-- Form Actions --}} 
        <button type="submit" class="btn btn-default">Submit</button>
        
        <a class="btn" href="{{ route('home') }}">Cancel</a>

    </form>

</div>

@stop