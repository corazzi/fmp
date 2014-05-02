@extends('layout/default')

@section('title', 'Home')

@section('content')

{{-- Notifications --}}
<div class="home-notif">
    @include('layout/notifications/frontend_notifications')
</div>

<div class="header-bg">
    <div class="row">
        <div class="large-12 columns">
            
            <p id="welcome-text" class="welcome animated fadeInDownBig">Welcome to webrepo!</p>

            <img id="welcome-image" src="{{ asset('assets/pics/situe/desktop.png') }}">

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
	<a href="{{ route('register') }}" class="button btn">Register</a>
</div>

<div class="row">
    
    <div class="large-12 columns features">
    	<h2>Features</h2>
    	<div class="large-hr"></div>
        <p>Cras pellentesque in tortor ac sagittis. Praesent fermentum accumsan felis, eu dictum mauris venenatis in. </p>
    </div>

</div>

<div class="row feature-items">

	<div class="large-3 columns feature-item">
            
        <div class="home-icon">
            <i class="fa fa-code fa-2x"></i>
        </div>

		<h5>Code Snippets</h5>
		<div class="small-hr"></div>
		<p>Cras pellentesque in tortor ac sagittis. Praesent fermentum accumsan felis, eu dictum mauris venenatis in.</p>

	</div>

	<div class="large-3 columns feature-item">
            
        <div class="home-icon">
            <i class="fa fa-book fa-2x"></i>
        </div>

		<h5>User Guides</h5>
		<div class="small-hr"></div>
		<p>Cras pellentesque in tortor ac sagittis. Praesent fermentum accumsan felis, eu dictum mauris venenatis in.</p>

	</div>

	<div class="large-3 columns feature-item">
            
        <div class="home-icon">
            <i class="fa fa-tag fa-2x"></i>
        </div>

		<h5>News Management</h5>
		<div class="small-hr"></div>
		<p>Cras pellentesque in tortor ac sagittis. Praesent fermentum accumsan felis, eu dictum mauris venenatis in.</p>

	</div>

	<div class="large-3 columns feature-item">
            
        <div class="home-icon">
            <i class="fa fa-rocket fa-2x"></i>
        </div>

		<h5>Resource Bucket</h5>
		<div class="small-hr"></div>
		<p>Cras pellentesque in tortor ac sagittis. Praesent fermentum accumsan felis, eu dictum mauris venenatis in.</p>

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
	       
            <div class="quick-links">
	           <ul class="square">
                    <li><a data-reveal-id="AboutUs">About</a></li>
                    <li data-reveal-id="SiteGuidelines"><a>Guidelines</a></li>
                    <li data-reveal-id="TOS"><a>TOS</a></li>   
                </ul> 
            </div>

        </div>

        <div class="large-3 columns">
    	    
    	    <h5>Lets be social</h5>
    	    
    	    <div class="row">
    		    <div class="small-12 columns">

                    <div class="social">             
                        <ul>
                            <li>
                                <a target="_blank" title="twitter" href="//twitter.com/webrepoio">
                                    <i class="fa fa-twitter fa-2x"></i>
                                </a>
                            </li>
                            <li>
                                <a target="_blank" title="facebook" href="//www.facebook.com/pages/webrepoio/250484425128352">
                                    <i class="fa fa-facebook fa-2x"></i>
                                </a>
                            </li>
                            <li>
                                <a target="_blank" title="google" href="#">
                                    <i class="fa fa-google-plus fa-2x"></i>
                                </a>
                            </li>
                        </ul>
                    </div>  
                 
                </div>
    	    </div>

        </div>

        <div class="large-4 columns">
    	    
    	    <h5>Stay up to date</h5>
    	    <p>Cras pellentesque in tortor ac sagittis. Cras pellentesque in tortor ac sagittis.</p>
            
            <form method="post" action="{{ route('newsletter') }}">

            {{-- CSRF Token --}} 
            <input type="hidden" name="_token" value="{{ csrf_token() }}" />

            <div class="row">
                <div class="large-12 columns">
                    <div class="row collapse">
                        
                        <div class="small-9 columns">
                            <input type="text"  placeholder="Email Address.." name="email"  required>
                        </div>

                        <div class="small-3 columns">
                            <button class="button postfix btn" type="submit">Submit</button>
                        </div>
  
                    </div>
                </div>
		    </div>

            </form>

        </div>

    </div>
</div>


{{-- Modals --}}

<div id="AboutUs" class="reveal-modal small" data-reveal>
   
    <h3>About Webrepo</h3>

    <a class="close-reveal-modal">&#215;</a>
        
</div>


<div id="SiteGuidelines" class="reveal-modal small" data-reveal>
    
    <h3>Site Guidlines</h3>
    
    <a class="close-reveal-modal">&#215;</a>

</div>

<div id="TOS" class="reveal-modal small" data-reveal>
    
    <h3>Terms of Service</h3>
    
    <a class="close-reveal-modal">&#215;</a>
    
</div>



@stop
