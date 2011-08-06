<?php
ini_set('display_errors', 1);
error_reporting(-1);
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
			die(var_dump($this->parser->content));
			if ($p = $this->post->add($this->parser->title, $this->parser->content))
			{
				echo $p;	
			}
			
			else
			{
				echo $this->post->error_message;
			}
		}
		
		else
		{
			echo $this->parser->error_message;
		}
		
		
	}
	

} // EOF