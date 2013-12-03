@extends('../layout/default')

{{-- Page title --}}
@section('title')
@parent
:: Login
@stop

{{-- Page content --}}
@section('content')

<div class="col-md-4">

	<div class="page-header">
        <h3>Login</h3>
    </div>

    <form method="post" action="{{ route('login') }}" role="form">
                
        {{-- CSRF Token --}} 
        <input type="hidden" name="_token" value="{{ csrf_token() }}" />

        {{-- Email --}} 
        <div class="form-group{{ $errors->first('email', ' has-error') }}">
            <label for="email">Email</label>
            <input type="text" class="form-control" name="email" id="email" value="{{ Input::old('email') }}" class="form-control" />
            {{ $errors->first('email', '<span class="help-block">:message</span>') }}
        </div>

        {{-- Password --}} 
        <div class="from-group{{ $errors->first('password', ' has-error') }}">
            <label for="password">Password</label> 
            <input type="password" class="form-control" name="password" id="password" value="" class="form-control"/>
            {{ $errors->first('password', '<span class="help-block">:message</span>') }}
        </div>

        {{-- Remember me --}} 
        <div class="checkbox">
            <label>
                <input type="checkbox" name="remember-me" id="remember-me" value="1" /> Remember me
            </label>
        </div>
        
        <hr>

        {{-- Form Actions --}} 
        <button type="submit" class="btn btn-default">Sign in</button>
        <a href="{{ route('forgot-password') }}" class="btn btn-link">I forgot my password</a>

    </form>
</div>

@stop