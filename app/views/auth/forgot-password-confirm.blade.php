@extends('../layout/default')

{{-- Page title --}}
@section('title', 'Create New Password')

{{-- Page content --}}
@section('content')

<div class="row">  
    <div class="large-offset-3 large-6 columns auth">

        <h2>Create New Password</h2>

        <div class="holder">

            {{-- Notifications --}}
            @include('layout/frontend_notifications')

	       <form method="post" action="" autocomplete="off" role="form">
        
                {{-- CSRF TOKEN --}}
                <input type="hidden" name="_token" value="{{ csrf_token() }}" />

                {{-- New Password --}}
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
                        <label for="password_confirm">Password</label>
                        <input class="{{ $errors->first('password_confirm', ' error') }}" type="password" name="password_confirm" />
                        {{ $errors->first('password_confirm', '<small class="error">:message</small>') }}
                    </div>
                </div>

                <hr>

                {{-- Form Actions --}}               
                <button type="submit" class="auth-btn large-12 medium-12 small-12">Confirm</button>
         
            </form>

        </div>

        <a href="{{ route('home') }}">Go back</a>

    </div>
</div>
@stop
