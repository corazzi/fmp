@extends('../layout/default')

{{-- Page title --}}
@section('title')
@parent
:: Login
@stop

{{-- Page content --}}
@section('content')



<div class="container">
	<div class="row">

        <div class="col-md-4">

		<div class="page-header">
            <h3>Login</h3>
        </div>

        

       <form method="post" action="{{ route('login') }}" class="form-horizontal">
                <!-- CSRF Token -->
                <input type="hidden" name="_token" value="{{ csrf_token() }}" />

                <!-- Email -->
                <div class="control-group{{ $errors->first('email', ' has-error') }}">
                        <label class="control-label" for="email">Email</label>
                        <div class="controls">
                                <input type="text" name="email" id="email" value="{{ Input::old('email') }}" class="form-control" />
                                {{ $errors->first('email', '<span class="help-block">:message</span>') }}
                        </div>
                </div>

                <!-- Password -->
                <div class="control-group{{ $errors->first('password', ' has-error') }}">
                        <label class="control-label" for="password">Password</label>
                        <div class="controls">
                                <input type="password" name="password" id="password" value="" class="form-control"/>
                                {{ $errors->first('password', '<span class="help-block">:message</span>') }}
                        </div>
                </div>

                <!-- Remember me -->
                <div class="control-group">
                        <div class="controls">
                        <label class="checkbox">
                                <input type="checkbox" name="remember-me" id="remember-me" value="1" /> Remember me
                        </label>
                        </div>
                </div>

                <hr>

                <!-- Form actions -->
                <div class="control-group">
                        <div class="controls">
                   

                                <button type="submit" class="btn">Sign in</button>

                                <a href="{{ route('forgot-password') }}" class="btn btn-link">I forgot my password</a>
                        </div>
                </div>
        </form>
		</div>
	</div>
</div>


@stop