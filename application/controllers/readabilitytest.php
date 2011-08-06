<?php
class Readabilitytest extends CI_Controller {
	
	function __construct()
	{
		parent::__construct();
	}
	
	function index()
	{
		$this->load->model('parser');
		$url = 'http://www.bbc.co.uk/news/world-us-canada-14428930';
		
		$this->parser->url($url);
		
		var_dump($this->parser->title);
		var_dump($this->parser->body);		
	}

} // EOF