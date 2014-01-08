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

        {{-- First Name --}}
        <div class="form-group{{ $errors->first('first_name', ' has-error') }}">
            <label for="first_name">First Name</label>
            <input type="text" name="first_name" id="first_name" value="{{ Input::old('first_name') }}" class="form-control"/>
            {{ $errors->first('first_name', '<span class="help-block">:message</span>') }}
        </div>

        {{-- Last Name --}}
        <div class="form-group{{ $errors->first('last_name', ' has-error') }}">
            <label for="last_name">Last Name</label>
            <input type="text" name="last_name" id="last_name" value="{{ Input::old('last_name') }}" class="form-control"/>
            {{ $errors->first('last_name', '<span class="help-block">:message</span>') }}      
        </div>

        {{-- Email --}}
        <div class="form-group{{ $errors->first('email', ' has-error') }}">
            <label for="email">Email</label>              
            <input type="text" name="email" id="email" value="{{ Input::old('email') }}" class="form-control"/>
            {{ $errors->first('email', '<span class="help-block">:message</span>') }}             
        </div>

        {{-- Email Confirm --}}
        <div class="form-group{{ $errors->first('email_confirm', ' has-error') }}">
            <label for="email_confirm">Confirm Email</label>
            <input type="text" name="email_confirm" id="email_confirm" value="{{ Input::old('email_confirm') }}" class="form-control"/>
            {{ $errors->first('email_confirm', '<span class="help-block">:message</span>') }}
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