<?php
class Readability-test extends CI_Controller {
	
	function __construct()
	{
		parent::__construct();
	}
	
	function index()
	{
		$this->load->library('readability');
		
		
	}

} // EOF