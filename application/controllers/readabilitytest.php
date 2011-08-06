<?php
class Readabilitytest extends CI_Controller {
	
	function __construct()
	{
		parent::__construct();
	}
	
	function index()
	{
		$this->load->library('readability');
		
		$url = 'http://www.bbc.co.uk/news/world-us-canada-14428930';
		$html = file_get_contents($url);
		
		$raw = $this->readability->get($html);
		
		echo $raw;
		
	}

} // EOF