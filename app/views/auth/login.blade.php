@extends('../layout/default')

{{-- Page title --}}
@section('title', 'Login')

{{-- Page content --}}
@section('content')



<div class="row">  
    <div class="large-offset-3 large-6 columns auth">

        <h2>Login</h2>

        <div class="holder">

            {{-- Notifications --}}
            @include('layout/notifications/frontend_notifications')

            <form method="post" action="{{ route('login') }}" role="form">
                
            {{-- CSRF Token --}} 
            <input type="hidden" name="_token" value="{{ csrf_token() }}" />

           {{-- Email --}}
            <div class="row">
                <div class="large-12 columns">
                    <label for="email">Email</label>
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

            {{-- Remember me --}} 
            <div class="row">
                <div class="large-6 columns">
                    <input name="remember-me" id="remember-me" value="1" type="checkbox"><label for="remember-me">Remember Me</label>
                </div>
            </div>
        
            <hr>

            {{-- Form Actions --}} 
            <button type="submit" class="auth-btn large-12 medium-12 small-12">Login</button>
            

            </form>

        </div>

        <a href="{{ route('forgot-password') }}">Uh oh i forgot my password?!</a>

    </div>
</div>

@stop