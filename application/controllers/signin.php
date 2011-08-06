<?php

	class Signin extends CI_Controller {
		
		function __construct()
		{
			parent::__construct();
			
			$this->load->library('tweet');
			
			// Enabling debug will show you any errors in the calls you're making, e.g:
			$this->tweet->enable_debug(TRUE);
			
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
			
			print_r($tokens);
			
			$user = $this->tweet->call('get', 'account/verify_credentials');
			
			echo '<p>' . $user->protected['screen_name'] . '</p>';
			
		}
	}