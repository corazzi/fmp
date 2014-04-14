@extends('../layout/default')

{{-- Page title --}}
@section('title', 'Register')

{{-- Page content --}}
@section('content')

<div class="row">  
    <div class="large-offset-3 large-6 columns auth">

        <h2>Register</h2>

        <div class="holder">

           <form method="post" action="{{ route('register') }}" role="form" autocomplete="off">
                
            {{-- CSRF Token --}}
            <input type="hidden" name="_token" value="{{ csrf_token() }}" />

            {{-- Username --}}
            <div class="row">
                <div class="large-12 columns">
                    <label for="username">Username</label>
                    <input class="{{ $errors->first('username', ' error') }}" type="text" name="username" value="{{ Input::old('username') }}" />
                    {{ $errors->first('username', '<small class="error">:message</small>') }}
                </div>
            </div>

            {{-- Email --}}
            <div class="row">
                <div class="large-12 columns">
                    <label for="email">Email Address</label>
                    <input class="{{ $errors->first('email', ' error') }}" type="text" name="email" value="{{ Input::old('email') }}" />
                    {{ $errors->first('email', '<small class="error">:message</small>') }}
                </div>
            </div>

            {{-- Password --}}
            <div class="row">
                <div class="large-12 columns">
                    <label for="password">Password</label>
                    <input class="{{ $errors->first('password', ' error') }}" type="password" name="password" />
                    {{ $errors->first('password', '<small class="error">:message</small>') }}
                </div>
            </div>

            {{-- Password Confirm --}}
            <div class="row">
                <div class="large-12 columns">
                    <label for="password_confirm">Confirm Password</label>
                    <input class="{{ $errors->first('password_confirm', ' error') }}" type="password" name="password_confirm" />
                    {{ $errors->first('password_confirm', '<small class="error">:message</small>') }}
                </div>
            </div>

            <hr>

            {{-- Form Actions --}}
            <button type="submit" class="auth-btn large-12 medium-12 small-12">Sign up</button>

            </form>

        </div>

    </div>
</div>		
@stop