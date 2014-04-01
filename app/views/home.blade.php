@extends('layout/default')

@section('title', 'Home')

@section('content')


<div style="background-image:url({{ asset('assets/images/header-bg.jpg') }});background-size: 100%; height:500px;position:relative;">
    <div class="row">
        <div class="large-12 columns">
            <p style="text-align:center;font-size:35px;color:#fff;font-weight:200;padding:2.5rem 0;" class="animated bounceInDown">Welcome to webrepo!</p>
            <p style="text-align:center;font-size:35px;color:#fff"></p>
        </div>
    </div>
</div>

<div class="new-era">An new era of web community is here!</div>

<div class="row">
    <div class="large-push-2 large-8 columns welcome">
    	
    	<h2>Welcome</h2>
    	<div class="large-hr"></div>
    	<p>Cras pellentesque in tortor ac sagittis. Praesent fermentum accumsan felis, eu dictum mauris venenatis in. Donec porttitor id felis et varius. Morbi eu eros nulla. Nunc a nisl diam. Mauris lacinia mi eros, in ultrices sapien fringill at. Cras sit amet tristique diam.</p>

    </div>
</div>

<div class="sign-up">
	Why not sign up today?
	<a data-reveal-id="myModalRegister" class="button btn">Register</a>
</div>

<div class="row">
    
    <div class="large-12 columns features">
    	<h2>Features</h2>
    	<div class="large-hr"></div>
    </div>

    <div class="row features-items">

	    <div class="large-3 columns">
		    <h5>Code Snippets</h5>
		    <div class="small-hr"></div>
		    <p>Cras pellentesque in tortor ac sagittis. Praesent fermentum accumsan felis, eu dictum mauris venenatis in.</p>
	    </div>

	    <div class="large-3 columns">
		    <h5>User Guides</h5>
		    <div class="small-hr"></div>
		    <p>Cras pellentesque in tortor ac sagittis. Praesent fermentum accumsan felis, eu dictum mauris venenatis in.</p>
	    </div>

	    <div class="large-3 columns">
		    <h5>News Management</h5>
		    <div class="small-hr"></div>
		    <p>Cras pellentesque in tortor ac sagittis. Praesent fermentum accumsan felis, eu dictum mauris venenatis in.</p>
	    </div>

	    <div class="large-3 columns">
		    <h5>Resource Bucket</h5>
		    <div class="small-hr"></div>
		    <p>Cras pellentesque in tortor ac sagittis. Praesent fermentum accumsan felis, eu dictum mauris venenatis in.</p>
	    </div>

    </div>

</div>

<div class="footer">
	<div class="row">

	    <div class="large-3 columns">
		    
		    <h4>webrepo.io</h4>
		    <p>Cras pellentesque in tortor ac sagittis. Praesent fermentum accumsan felis, eu dictum mauris venenatis in.</p>

	    </div>

	    <div class="large-2 columns">
	        
	        <h5>Quick Links</h5>    
	        
	        <ul class="square">
                <li><a>About</a></li>
                <li><a>Guidelines</a></li>
                <li><a>TOS</a></li>
                <li><a>Contact</a></li>    
            </ul> 

        </div>

        <div class="large-3 columns">
    	    
    	    <h5>Lets be social...</h5>
    	    
    	    <div class="row social">
    		    <div class="small-4 columns"><b>LOL</b></div>
    		    <div class="small-4 columns"><b>LOL</b></div>
    		    <div class="small-4 columns"><b>LOL</b></div>
    	    </div>

        </div>

        <div class="large-4 columns">
    	    
    	    <h5>Stay up to date!</h5>
    	    <p style="padding:0.5rem 0;">Cras pellentesque in tortor ac sagittis. Cras pellentesque in tortor ac sagittis.</p>
            
            <div class="row">
                <div class="large-12 columns">
                    <div class="row collapse">
                        
                        <div class="small-9 columns">
                            <input type="text"  placeholder="Email Address.." name="search" type="search"  required>
                        </div>

                        <div class="small-3 columns">
                            <button class="button postfix btn" type="submit">Submit</button>
                        </div>
  
                    </div>
                </div>
		    </div>

        </div>

    </div>
</div>


{{-- Modals --}}

<div id="myModalLogin" class="reveal-modal small" data-reveal>
   
    <h2>Login</h2>
        
        <form method="post" action="{{ route('login') }}">
                
        
        {{-- CSRF Token --}} 
        <input type="hidden" name="_token" value="{{ csrf_token() }}" />

        {{-- Email --}} 

        <label for="email"> Email
            <input type="text" name="email" id="email" value="{{ Input::old('email') }}" />
        </label>
        {{ $errors->first('email', '<label class="error">:message</label>') }}
    
       {{-- Password --}}

        <label for="password"> Email
            <input type="password" name="password" id="password" value=""/>
        </label>
        {{ $errors->first('password', '<label class="error">:message</label>') }}  

        {{-- Remember me --}} 
        <input name="remember-me" value="1" id="remember-me" type="checkbox"><label for="remember-me">Remember me</label>

        <hr>

        {{-- Form Actions --}} 
        <button type="submit" class="button">Sign in</button>
        <a href="{{ route('forgot-password') }}">I forgot my password</a>        
        <a class="close-reveal-modal">&#215;</a>

</div>


<div id="myModalRegister" class="reveal-modal small" data-reveal>
    <h2>Register</h2>
    <a class="close-reveal-modal">&#215;</a>
</div>


<div class="copyright">
    <div class="row">
        <div class="large-12 columns">
            <p>2014, webrepo.io all rights reservers la de da.</p>
        </div>
    </div>
</div>

@stop
