@extends('layout/beta_layout')

@section('title', 'Beta')

@section('content')

<div class="container">
	<div class="row">
		<div class="col-lg-12 beta-holder">

            <img class="icon" src="{{ asset('assets/img/code.png') }}">

            <h1>webrepo.io</h1>

            <p class="motto">A new era of <span class="green">web community</span> is coming. <br> Join our newsletter to keep updated with all the latest news.</p>
            
            <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">

                <form method="post" action="" autocomplete="off" role="form" class="form-inline">

                    <input type="hidden" name="_token" value="{{ csrf_token() }}" />
  
                    <input type="text" name="email" placeholder="Email Address..." class="form-control" style="width:40%" value="{{ Input::old('email') }}">
                    <input type="submit" class="btn btn-email" value="Submit">

                    {{ $errors->first('email', '<span class="help-block">:message</span>') }}

                </form>

            </div>

            <p id="open">Open to the public in....</p><div id="countdown">Loading...</div>
            <p id="time-format">DAYS &nbsp; &nbsp;  HOURS &nbsp; &nbsp; &nbsp;  MINS &nbsp; &nbsp; &nbsp;  SECS</p>

        </div>
    </div>
</div>

@stop