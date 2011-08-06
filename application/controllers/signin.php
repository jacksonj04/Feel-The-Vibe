<?php

	class Signin extends CI_Controller {
		
		function __construct()
		{
			parent::__construct();
			
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
			
			$user = $this->tweet->call('get', 'account/verify_credentials');
			
			// Try find an existing user from this token.
			$user_db = $this->db->where('oauth_token', $tokens['oauth_token'])->get('users');
		
			if ($user_db->num_rows() == 0 ) {
			
				// This is a new user. Insertify!
				
				$user_new = array(
					'twitter'				=>	$user->screen_name,
					'name'					=>	$user->name,
					'oauth_token'			=>	$tokens['oauth_token'],
					'oauth_token_secret'	=>	$tokens['oauth_token_secret']
				);
			
				$this->db->insert('users', $user_new);
			
			}else{
			
				// This is a returning user with changed details. Updatify!
				
				$user_update = array(
					'twitter'				=>	$user->screen_name,
					'name'					=>	$user->name
				);
			
				$this->db->where->('oauth_token', $tokens['oauth_token'])->update('users', $user_update);
			
			}
			
			// All is theoretically good. Go home.
			
			redirect();
			
		}
	}