<?php
class Readabilitytest extends CI_Controller {
	
	function __construct()
	{
		parent::__construct();
	}
	
	function index()
	{
		$this->load->model('parser');
		$this->load->model('post');
		
		$url = 'http://www.bbc.co.uk/news/world-us-canada-14428930';
		
		if ($this->parser->url($url))
		{
			echo $this->post->add($this->parser->title, $this->parser->content);
		}
		
		else
		{
			echo $this->parser->error_message;
		}
		
		
	}
	

} // EOF