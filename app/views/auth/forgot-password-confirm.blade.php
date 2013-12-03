@extends('../layout/default')

{{-- Page title --}}
@section('title')
@parent
:: Forgot Password Confirmation
@stop

{{-- Page content --}}
@section('content')
<div class="col-md-6">

	<div class="page-header">
        <h3>Create New Password</h3>
    </div>

	<form method="post" action="" autocomplete="off" role="form">
        
        {{-- CSRF TOKEN --}}
        <input type="hidden" name="_token" value="{{ csrf_token() }}" />

        {{-- New Password --}}
        <div class="form-group {{ $errors->first('password', ' error') }}">
            <label for="password">New Password</label>
            <input type="password" class="form-control" name="password" id="password" value="{{ Input::old('password') }}" />
            {{ $errors->first('password', '<span class="help-block">:message</span>') }}       
        </div>

        {{-- Password Confirm --}}
        <div class="form-group {{ $errors->first('password_confirm', ' error') }}">
            <label for="password_confirm">Password Confirmation</label>
            <input type="password" class="form-control" name="password_confirm" id="password_confirm" value="{{ Input::old('password_confirm') }}" />
            {{ $errors->first('password_confirm', '<span class="help-block">:message</span>') }}
        </div>

        <hr>

        {{-- Form Actions --}}               
        <button type="submit" class="btn btn-default">Submit</button>
        <a class="btn" href="{{ route('home') }}">Cancel</a>
         
    </form>
</div>
@stop
