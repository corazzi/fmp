@extends('../layout/default')

{{-- Page title --}}
@section('title', 'Forgot Password')

{{-- Page content --}}
@section('content')

<div class="row">  
    <div class="large-offset-3 large-6 columns auth">

        <h2>Forgot Password</h2>
        
        <div class="holder">

            {{-- Notifications --}}
            @include('layout/frontend_notifications')

            <form method="post" action="" role="form">
        
            {{-- CSRF TOKEN --}} 
            <input type="hidden" name="_token" value="{{ csrf_token() }}" />

            {{-- Email --}} 
            <div class="row">
                <div class="large-12 columns">
                    <label for="email">Email</label>
                    <input class="{{ $errors->first('email', ' error') }}" type="text" name="email" value="{{ Input::old('email') }}" />
                    {{ $errors->first('email', '<small class="error">:message</small>') }}
                </div>
            </div>

            <hr>

            {{-- Form Actions --}} 
            <button type="submit" class="auth-btn large-12 medium-12 small-12">Submit</button>    
            
            </form>

        </div>

        <a href="{{ route('home') }}">Go back</a>


    </div>
</div>


@stop