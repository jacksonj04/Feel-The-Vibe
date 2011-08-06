<?php

	class Signin extends CI_Controller {
		
		function __construct()
		{
			parent::__construct();
			
			$this->load->library('tweet');
			
			// Enabling debug will show you any errors in the calls you're making, e.g:
			$this->tweet->enable_debug(TRUE);
			
			// If you already have a token saved for your user
			// (In a db for example) - See line #37
			// 
			// You can set these tokens before calling logged_in to try using the existing tokens.
			// $tokens = array('oauth_token' => 'foo', 'oauth_token_secret' => 'bar');
			// $this->tweet->set_tokens($tokens);
			
		}
		
		function index()
		{
			if ( !$this->tweet->logged_in() )
			{
				// This is where the url will go to after auth.
				// ( Callback url )
				
				$this->tweet->set_callback(site_url('signin/auth'));
				
				// Send the user off for login!
				$this->tweet->login();
			}
			else
			{
			
				// We already have a signed in user. Bundle them back off to the home page.
			
				redirect();
				
			}
		}
		
		// User is coming back from authentication. Add/update database accordingly.
		function auth()
		{
			$tokens = $this->tweet->get_tokens();
			
			// $user = $this->tweet->call('get', 'account/verify_credentiaaaaaaaaals');
			// 
			// Will throw an error with a stacktrace.
			
			print_r($tokens);
			
			$user = $this->tweet->call('get', 'account/verify_credentials');
			
		}
	}