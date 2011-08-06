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
				$this->load->view('post/index', $post);
			}
			
			else
			{
				show_error($this->post->error_message);
			}
		}
	}
	
	function create()
	{
		$data = array(
			'success' => FALSE,
			'error' => FALSE
		);
		
		/*var_dump($this->input->post());
		
		var_dump($_POST);
		
		var_dump($this->input->post('create'));
		
		//die;
		*/
		$head = array('currentpage' => 'create');
	
		if ($this->input->post('create'))
		{			
			
			
			$url = $this->input->post('url');
			
			die(var_dump($url));
					
			if ($this->parser->url($url))
			{
				if ($p = $this->post->add($url, $this->parser->title, $this->parser->content))
				{
					$data['success'] = $p;
				}
				
				else
				{
					$data['error'] = $this->parser->error_message;
				}
			}
			
			else
			{
				$data['error'] = $this->parser->error_message;
			}
		}
		
		$this->load->view('inc/head', $head);
		$this->load->view('post/create', $data);
		$this->load->view('inc/foot');
	}

} // EOF