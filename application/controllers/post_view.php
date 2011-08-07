<?php
class Post_view extends CI_Controller {
	
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
				$head['title'] = $post['title'];
				$head['currentpage'] = null;
				
				$post['cap_user_details'] = $this->user->getid($post['cap_user']);
				
				preg_match_all('/<(p|li|h1|h2|h3|h4|h5|h6)>(.*?)<\/(\1)>/is', $post['content'], $post['paragraphs']);
				
				$post['comments'] = $this->db->where('post_id',$post['post_id'])->get('comments');
				
				$this->load->view('inc/head', $head);
				$this->load->view('post/index', $post);
				$this->load->view('inc/foot');
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
		
		$head = array('currentpage' => 'create');
	
		if ($this->input->post('create'))
		{
		
			if ($user = $this->user->getcurrent()){
		
				$url = $this->input->post('url');
				
				$this->load->model('parser');
				
				if ($this->parser->url($url))
				{
					if ($p = $this->post->add($url, $this->parser->title, $this->parser->content, NULL, 1, $user->user_id))
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
			}else{
				$data['error'] = 'You\'re not signed in!';
			}
		}
		
		$this->load->view('inc/head', $head);
		$this->load->view('post/create', $data);
		$this->load->view('inc/foot');
	}

} // EOF