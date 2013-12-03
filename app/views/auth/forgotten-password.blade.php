@extends('../layout/default')

{{-- Page title --}}
@section('title')
@parent
:: Forgot Password
@stop

{{-- Page content --}}
@section('content')
<div class="container">
	<div class="row">
        <div class="col-md-4">


        <div class="page-header">
            <h3>Forgot Password</h3>
        </div>

        <form method="post" action="" class="form-horizontal">
        
            <!-- CSRF Token -->
            <input type="hidden" name="_token" value="{{ csrf_token() }}" />

            <!-- Email -->
            <div class="control-group{{ $errors->first('email', ' has-error') }}">
            
                <label class="control-label" for="email">Email</label>
                
                <div class="controls">
                    <input type="text" name="email" id="email" value="{{ Input::old('email') }}" class="form-control"/>
                    {{ $errors->first('email', '<span class="help-block">:message</span>') }}
                </div>

            </div>

            <hr>

            <!-- Form actions -->
            <div class="control-group">
                <div class="controls">
          
                    <button type="submit" class="btn">Submit</button>
                    <a class="btn" href="{{ route('home') }}">Cancel</a>
                    
                </div>
            </div>
        
        </form>

    </div>

    </div>
</div>
@stop