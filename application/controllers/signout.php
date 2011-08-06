<?php

class Signout extends CI_Controller {
	
	function __construct()
	{
		parent::__construct();
		
	}
	
	function index()
	{
			
		// Sign the user out.
		$this->tweet->logout();
		
		redirect();

	}

}

//