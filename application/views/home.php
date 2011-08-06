
<!doctype html> 
<!--[if IEMobile 7 ]><html class="no-js iem7" lang="en"><![endif]--> 
<!--[if lt IE 7 ]><html class="no-js ie ie6" lang="en"><![endif]--> 
<!--[if IE 7 ]><html class="no-js ie ie7" lang="en"><![endif]--> 
<!--[if IE 8 ]><html class="no-js ie ie8" lang="en"><![endif]--> 
<!--[if IE 9 ]><html class="no-js ie ie9" lang="en"><![endif]--> 
<!--[if (gte IE 9)|!(IE)]><!--><html class="no-js not-ie" lang="en"><!--<![endif]--> 
<head> 
	<meta charset="utf-8"> 
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> 
	<link rel="dns-prefetch" href="//cwd.online.lincoln.ac.uk"> 
	<link rel="dns-prefetch" href="//c94471.r71.cf3.rackcdn.com"> 
	<link rel="dns-prefetch" href="//c94471.ssl.cf3.rackcdn.com"> 
	<link rel="dns-prefetch" href="//c95725.r25.cf3.rackcdn.com"> 
	<link rel="dns-prefetch" href="//c95725.ssl.cf3.rackcdn.com"> 
 
	<title>Feel The Vibe</title> 
	<meta name="description" content="Make any web page a document you can comment on paragraph by paragraph."> 
	<meta name="author" content="Team Feel The Vibe"> 
	
	<meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1.0"> 
	<link rel="shortcut icon" href="http://c94471.r71.cf3.rackcdn.com/favicon.ico"> 
	<link rel="apple-touch-icon" href="http://c94471.r71.cf3.rackcdn.com/icon.png"> 
 
	<link rel="stylesheet" href="http://c94471.r71.cf3.rackcdn.com/cwd.css"> 
	<script src="http://c94471.r71.cf3.rackcdn.com/modernizr.js"></script> 
	
</head> 
 
<body> 
 
	<header id="cwd_header" role="banner" style="background:#A174B3;"> 
	
		<section class="cwd_container"> 
	
			<hgroup class="grid_12" id="cwd_hgroup" style="background:none;"> 
						
				<a href="/"> 
					<h1>Feel The Vibe</h1> 
					<h2>Share your inane ramblings with the world.</h2> 
				</a> 
							
			</hgroup> 
 
		</section> 
			
	</header> 
	
	<nav class="cwd_container" role="navigation"> 
		<ul id="cwd_navigation" class="grid_12">  
			<li class="current"><a href="/">.current</a></li>  
	        <li class="dropdown"><a href="#">.dropdown</a> 
	        	<ul> 
	        		<li><a href="#">Lorem</a></li> 
	        		<li><a href="#">Ipsum</a></li> 
	        	</ul> 
	        </li>  
	        <li><a href="#">Lorem Ipsum</a></li> 
    	</ul>  
	</nav> 
	
	<section class="cwd_container" id="cwd_content" role="main"> 
	
		<div class="grid_8"> 
				
			<h1>Got something to say?</h1>
			
			<p>Feel The Vibe lets you take any web page and turn it into a document you can comment on paragraph by paragraph. Take a news article and add your annotations and opinions, share your views on the latest government white paper, let people instantly comment on your work and more.</p>
			
			<p>Coming really really soon.</p>
			
		</div> 
		
		<aside class="grid_4 last"> 
			
			<div class="box bg_light"> 
			
				<?php
				
				if ( !$this->tweet->logged_in() )
				{
					
					echo '<h3>Sign In</h3>
					
					<p>Oh no, you\'re not signed in yet!</p>
					
					<p><a href="' . site_url('signin') . '"><img src="' . base_url() . 'img/signin.png" title="Sign in with Twitter"></a></p>';
					
				}
				else
				{
				
					echo '<h3>Hello Again!</h3>
					
					<p>You\'re already signed in. That\'s cool.</p>
					
					<p>If you really want to you can <a href="' . site_url('signout') . '">sign out</a>.</p>';
					
				}
			
				?>
			
			</div>
					
		</aside> 
 
	
	</section> 
 
 
	<footer class="cwd_container" id="cwd_footer" role="contentinfo"> 
	
		<!--
		If you require additional footer links uncomment this block and remove the 'push_6' class from the <section> below
		<section class="grid_6">
			<ul>
				<li><a href="#">A link</a></li>
				<li><a href="#">A link</a></li>
			</ul>		
		</section>
		 --> 
		
		<section class="push_6 grid_6 last"> 
			<p class="align-right"> 
				<small> 
					&copy; Team Feel The Vibe
				</small> 
			</p> 
		</section> 
			
	</footer> 
 
	<!-- Put all JavaScript code below this line --> 
	<script src="http://c94471.r71.cf3.rackcdn.com/jquery.js" type="text/javascript"></script> 
	<!--[if (lt IE 9) & (!IEMobile)]>
		<script src="http://c94471.r71.cf3.rackcdn.com/DOMAssistantCompressed-2.8.js"></script>
		<script src="http://c94471.r71.cf3.rackcdn.com/selectivizr-1.0.1.js"></script>
		<script src="http://c94471.r71.cf3.rackcdn.com/respond.min.js"></script>
	<![endif]--> 
	<script src="http://c94471.r71.cf3.rackcdn.com/cwd.js" type="text/javascript"></script> 
		
</body> 
</html>