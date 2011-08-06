<?php
class View extends CI_Controller {
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('post');
	}
	
	function index()
	{
		$series = $this->uri->segment(1);
		$page = $this->uri->segment(2);
		
		if ( ! $page)
		{
			$page = 1;
		}
		
		if ($series)
		{
			$post = $this->post->get($series, $page);
			
			if ($post)
			{
				$this->load->view('post/view', $post);
			}
			
			else
			{
				show_error($this->post->error_message);
			}
		}
	}

} // EOF