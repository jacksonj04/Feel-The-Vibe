<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ajax extends CI_Controller {

	function __construct()
	{
		if ( !$this->tweet->logged_in() )
		{
			// User isn't logged in! THROW A WOBBLER!
			echo json_encode(array('error' => 'You are not signed in. Fool.'));
		}
	}

	public function vibeup()
	{
	
		echo json_encode(array('message'=>'Vibe Up!'));
		
	}
}