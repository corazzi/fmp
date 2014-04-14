@extends('layout/beta_layout')

@section('title', 'Beta')

@section('content')
<div class="row">		
    <div class="large-8 large-offset-2 medium-10 medium-offset-1 small-12 columns beta-holder">

        {{-- Notifications --}}
        @include('layout/frontend_notifications')

        <img class="icon" src="{{ asset('assets/pics/icons/beta_code.png') }}">

        <h1>webrepo.io</h1>

        <p class="motto">A new era of <span class="green">web community</span> is coming. <br> Join our newsletter to keep updated with all the latest news.</p>
            
            <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">

                <form method="post" action="">

                    <input type="hidden" name="_token" value="{{ csrf_token() }}" />

                    <div class="row">
                        <div class="large-12 columns">
                            <div class="row collapse">
                        
                                <div class="small-offset-1 small-8 columns">
                                    <input type="text"  placeholder="Email Address.." name="email" value="{{ Input::old('email') }}">
                                </div>

                                <div class="small-2 columns end">
                                    <button class="button postfix btn" type="submit">Submit</button>
                                </div>
  
                            </div>
                        </div>
                    </div>


                    {{ $errors->first('email', '<span class="error-text">^ :message</span>') }}

                </form>

            </div>

            <p id="open">Open to the public in....</p><div id="countdown">Loading...</div>
            <p id="time-format">DAYS &nbsp; &nbsp;  HOURS &nbsp; &nbsp; &nbsp;  MINS &nbsp; &nbsp; &nbsp;  SECS</p>

    </div>
</div>


@stop