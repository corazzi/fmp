@extends('layout/default')

@section('title', 'Welcome to Webrepo.io the new era of web community, aimed at providing vital educational resources for web developers and designers.')

@section('content')

{{-- Notifications --}}
<div class="home-notif">
    @include('layout/notifications/frontend_notifications')
</div>

<div class="header-bg">
    <div class="row">
        <div class="large-12 columns">


                <p id="welcome-text" class="welcome animated fadeInDownBig">Welcome to Webrepo!</p>
           


                 <img id="welcome-image" src="{{ asset('assets/pics/situe/desktop.png') }}"> 
 
            
        </div>
    </div>
</div>

<div class="new-era">An new era of web community is here!</div>

<div class="row">
    <div class="large-push-2 large-8 columns welcome">
    	
    	<h2>Welcome</h2>
    	<div class="large-hr"></div>
    	<p>Hello and welcome to all new Webrepo web community. Webrepo aims to provide you with everything you need to progress in your web related learning curve. All of Webrepos content is submitted by its community so why not submit yours today!</p>

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
        <p>Take a sneek peek at the awesome features Webrepo has to offer! </p>
    </div>

</div>

<div class="row feature-items">

	<div class="large-3 columns feature-item">
            
        <div class="home-icon">
            <i class="fa fa-code fa-2x"></i>
        </div>

		<h5>Code Snippets</h5>
		<div class="small-hr"></div>
		<p>Store and share useful code snippets with the community or browse our ever growing library.</p>

	</div>

	<div class="large-3 columns feature-item">
            
        <div class="home-icon">
            <i class="fa fa-book fa-2x"></i>
        </div>

		<h5>User Guides</h5>
		<div class="small-hr"></div>
		<p>Check out our ever growing collection of user guides to help with your latest project or submit your own.</p>

	</div>

	<div class="large-3 columns feature-item">
            
        <div class="home-icon">
            <i class="fa fa-tag fa-2x"></i>
        </div>

		<h5>News Management</h5>
		<div class="small-hr"></div>
		<p>Keep up to date with all your favorite web related news right here in your Webrepo user area.</p>

	</div>

	<div class="large-3 columns feature-item">
            
        <div class="home-icon">
            <i class="fa fa-rocket fa-2x"></i>
        </div>

		<h5>Resource Bucket</h5>
		<div class="small-hr"></div>
		<p>Looking for a resource for your next project? Great we have hundreds freshly submitted from our users.</p>

	</div>

</div>



<div class="footer">
	<div class="row">

	    <div class="large-3 columns">
		    
		    <h4>Webrepo.io</h4>
		    <p>We aim to provide you with everything you need, to help you throughout your web career.</p>

	    </div>

	    <div class="large-2 columns">
	        
	        <h5>Quick Links</h5>    
	       
            <div class="quick-links">
	           <ul class="square">
                    <li><a data-reveal-id="AboutUs">About</a></li>
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
                                <a target="_blank" title="twitter" href="//twitter.com/Webrepoio">
                                    <i class="fa fa-twitter fa-2x"></i>
                                </a>
                            </li>
                            <li>
                                <a target="_blank" title="facebook" href="//www.facebook.com/pages/Webrepoio/250484425128352">
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
    	    <p>Keep up to date with our latest news by submitting your email address below.</p>
            
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

    <p>Webrepo is a space for web developers to find, share and vote on quality solutions to code and design problems.</p>
        
</div>


<div id="TOS" class="reveal-modal large" data-reveal>
    
    <h3>Terms of Service</h3>
    
    <a class="close-reveal-modal">&#215;</a>


<p>Welcome to Webrepo. ("Webrepo", "our", "us" or "we") provides the Webrepo website. The following terms and conditions govern all use of the website and all content, services and products available at or through the website. The Website is owned and operated by Webrepo. The Website is offered subject to your acceptance without modification of all of the terms and conditions contained herein and all other operating rules, policies (including, without limitation, our Privacy Policy) and procedures that may be published from time to time on this Site (collectively, the Agreement).</p>

<p>Please read this Agreement carefully before accessing or using the Website. By accessing or using any part of the web site, you agree to become bound by the terms and conditions of this agreement. If you do not agree to all the terms and conditions of this agreement, then you may not access the Website or use any services. If these terms and conditions are considered an offer by Webrepo, acceptance is expressly limited to these terms. The Website is available only to individuals who are at least 13 years old.</P>

<h4>Your Webrepo Account and Site.</h4>

<p>If you create an account on the Website, you are responsible for maintaining the security of your account and its content, and you are fully responsible for all activities that occur under the account and any other actions taken in connection with the Website. You must not describe or assign content to your account in a misleading or unlawful manner, including in a manner intended to trade on the name or reputation of others, and we may change or remove any data that it considers inappropriate or unlawful, or otherwise likely to cause us liability. You must immediately notify us of any unauthorized uses of your account or any other breaches of security. We will not be liable for any acts or omissions by You, including any damages of any kind incurred as a result of such acts or omissions.</P>

</div>



@stop
