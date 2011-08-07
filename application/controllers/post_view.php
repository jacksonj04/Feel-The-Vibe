<?php
class Post_view extends CI_Controller {
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('post');
	}
	
	function index($series, $page = 1)
	{
		
		if ($series)
		{
			$post = $this->post->get($series, $page);
			
			$post['series'] = $series;
			
			$series_count = $this->db->where('series_id', $series)->get('posts');
			
			$post['seriestotal'] = $series_count->num_rows();
			$post['seriesnumber'] = $page;
			
			if ($post)
			{
				$head['title'] = $post['title'];
				$head['currentpage'] = null;
				
				$post['cap_user_details'] = $this->user->getid($post['cap_user']);
				
				preg_match_all('/<(p|li|h1|h2|h3|h4|h5|h6)>(.*?)<\/(\1)>/is', $post['content'], $post['paragraphs']);
				
				$post['comments'] = $this->post->comments($post['post_id']);
								
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
				
				$posts_db = $this->db->where('original_url', $url)->get('posts');
				
				// Check to see if we know about this already
				if ($posts_db->num_rows() == 0 || $this->input->post('forceparse')){
				
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
				
					// Things already exist. Tell the user.
					
					$data['exists'] = $posts_db;
					$data['url'] = $url;
				
				}
			}else{
				$data['error'] = 'You\'re not signed in!';
			}
		}
		
		$this->load->view('inc/head', $head);
		$this->load->view('post/create', $data);
		$this->load->view('inc/foot');
	}
	
	function createmulti()
	{
		$data = array(
			'success' => FALSE,
			'error' => FALSE
		);
		
		$head = array('currentpage' => 'create');
		
		if ($this->input->post('create'))
		{
		
			if ($user = $this->user->getcurrent())
			{
		
				$urls = $this->input->post('multiurl[]');
				
				die(var_dump($urls));
				
				$posts_db = $this->db->where('original_url', $url)->get('posts');
				
				
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
					

			}
			
			else
			{
				$data['error'] = 'You\'re not signed in!';
			}
		}
		
		$this->load->view('inc/head', $head);
		$this->load->view('post/createmulti', $data);
		$this->load->view('inc/foot');
	}

} // EOF