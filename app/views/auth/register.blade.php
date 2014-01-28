@extends('../layout/default')

{{-- Page title --}}
@section('title', 'Register')

{{-- Page content --}}
@section('content')

<div class="col-md-4">

	<div class="page-header">
        <h3>Register</h3>
    </div>

    <form method="post" action="{{ route('register') }}" role="form" autocomplete="off">
                
        {{-- CSRF Token --}}
        <input type="hidden" name="_token" value="{{ csrf_token() }}" />

        {{-- Username --}}
        <div class="form-group{{ $errors->first('username', ' has-error') }}">
            <label for="username">Username</label>
            <input type="text" name="username" id="username" value="{{ Input::old('username') }}" class="form-control"/>
            {{ $errors->first('username', '<span class="help-block">:message</span>') }}
        </div>


        {{-- Email --}}
        <div class="form-group{{ $errors->first('email', ' has-error') }}">
            <label for="email">Email</label>              
            <input type="text" name="email" id="email" value="{{ Input::old('email') }}" class="form-control"/>
            {{ $errors->first('email', '<span class="help-block">:message</span>') }}             
        </div>

        {{-- Password --}}
        <div class="form-group{{ $errors->first('password', ' has-error') }}">
            <label for="password">Password</label>
            <input type="password" name="password" id="password" value="" class="form-control"/>
            {{ $errors->first('password', '<span class="help-block">:message</span>') }}
        </div>

        {{-- Password Confirm --}}
        <div class="form-group{{ $errors->first('password_confirm', ' has-error') }}">
            <label for="password_confirm">Confirm Password</label>
            <input type="password" name="password_confirm" id="password_confirm" value=""  class="form-control"/>
            {{ $errors->first('password_confirm', '<span class="help-block">:message</span>') }}           
        </div>

        <hr>

        {{-- From Actions --}}
        <button type="submit" class="btn">Sign up</button>

    </form>

</div>
		
@stop