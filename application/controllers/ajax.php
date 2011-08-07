<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ajax extends CI_Controller {

	function __construct()
	{
	
		parent::__construct();
		
		if ( !$this->tweet->logged_in() )
		{
			// User isn't logged in! THROW A WOBBLER!
			echo json_encode(array('error' => 'You are not signed in. Fool.'));
			
			die();
		}
	}

	public function vibeup()
	{
	
		if ($this->input->post('post') && $this->input->post('paragraph') && $this->input->is_ajax_request())
		{
			// We have post and paragraph. Validation time!
			$post_db = $this->db->where('post_id', $this->input->post('post'))->get('posts');
			
			if ($post_db->num_rows() == 1)
			{
				// Post exists, be happy
				$user = $this->user->getcurrent();
				$vibes_db = $this->db->where('post_id', $this->input->post('post'))->where('paragraph', $this->input->post('paragraph'))->where('user_id', $user->user_id)->get('vibes');
				// Test for existing vibes
				if ($vibes_db->num_rows() == 1)
				{
					// Vibe exists. Update.
					$vibe = array(
						'vibe'		=>	'up',
						'timestamp'	=>	time()
					);
					
					$this->db->where('post_id', $this->input->post('post'))->where('paragraph', $this->input->post('paragraph'))->where('user_id', $user->user_id)->update('vibes', $vibe);
					
				}
				
				else
				{
					// No vibe. Put one in.
					$vibe = array(
						'user_id'	=>	$this->user->getcurrent()->user_id,
						'post_id'	=>	$this->input->post('post'),
						'paragraph'	=>	$this->input->post('paragraph'),
						'vibe'		=>	'up',
						'timestamp'	=>	time()
					);
					
					$this->db->insert('vibes', $vibe);
				}
				
				echo json_encode(array('message' => 'Vibe up logged!'));
				
			}
			
			else
			{
				// Post doesn't exist, something has gone wrong.
				echo json_encode(array('error' => 'Post does not exist.'));
			}
		}
		else
		{
			echo json_encode(array('error'=>'Unable to complete vibe up.'));
		}
		
	}
	
	public function vibedown()
	{
	
		if ($this->input->post('post') && $this->input->post('paragraph') && $this->input->is_ajax_request()){
			// We have post and paragraph. Validation time!
			$post_db = $this->db->where('post_id', $this->input->post('post'))->get('posts');
			if ($post_db->num_rows() == 1){
				// Post exists, be happy
				$user = $this->user->getcurrent();
				$vibes_db = $this->db->where('post_id', $this->input->post('post'))->where('paragraph', $this->input->post('paragraph'))->where('user_id', $user->user_id)->get('vibes');
				// Test for existing vibes
				if ($vibes_db->num_rows() == 1){
					// Vibe exists. Update.
					$vibe = array(
						'vibe'		=>	'down',
						'timestamp'	=>	time()
					);
					
					$this->db->where('post_id', $this->input->post('post'))->where('paragraph', $this->input->post('paragraph'))->where('user_id', $user->user_id)->update('vibes', $vibe);
					
				}else{
					// No vibe. Put one in.
					$vibe = array(
						'user_id'	=>	$this->user->getcurrent()->user_id,
						'post_id'	=>	$this->input->post('post'),
						'paragraph'	=>	$this->input->post('paragraph'),
						'vibe'		=>	'down',
						'timestamp'	=>	time()
					);
					
					$this->db->insert('vibes', $vibe);
				}
				
				echo json_encode(array('message' => 'Vibe down logged!'));
				
			}else{
				// Post doesn't exist, something has gone wrong.
				echo json_encode(array('error' => 'Post does not exist.'));
			}
		}else{
			echo json_encode(array('error'=>'Unable to complete unvibe.'));
		}
		
	}
	
	public function unvibe()
	{
	
		if ($this->input->post('post') && $this->input->post('paragraph') && $this->input->is_ajax_request()){
			// We have post and paragraph. Validation time!
			$post_db = $this->db->where('post_id', $this->input->post('post'))->get('posts');
			if ($post_db->num_rows() == 1){
				// Post exists, be happy
				$user = $this->user->getcurrent();
				$vibes_db = $this->db->where('post_id', $this->input->post('post'))->where('paragraph', $this->input->post('paragraph'))->where('user_id', $user->user_id)->delete('vibes');
				
				echo json_encode(array('message' => 'Paragraph unvibed!'));
				
			}else{
				// Post doesn't exist, something has gone wrong.
				echo json_encode(array('error' => 'Post does not exist.'));
			}
		}else{
			echo json_encode(array('error'=>'Unable to complete vibe down.'));
		}
		
	}
	
	public function comment()
	{
	
		if ($this->input->post('post') && $this->input->post('paragraph') && $this->input->post('text') && $this->input->is_ajax_request())
		{
			// We have post and paragraph. Validation time!
			$post_db = $this->db->where('post_id', $this->input->post('post'))->get('posts');
			
			if ($post_db->num_rows() == 1)
			{
				// Post exists, be happy
				$user = $this->user->getcurrent();
				
				$comment = array(
					'user_id'	=>	$user->user_id,
					'post_id'	=>	$this->input->post('post'),
					'paragraph'	=>	$this->input->post('paragraph'),
					'text'		=>	$this->input->post('text')
				);
				
				echo json_encode(array('message' => 'Comment added!'));
				
			}
			
			else
			{
				// Post doesn't exist, something has gone wrong.
				echo json_encode(array('error' => 'Post does not exist.'));
			}
		}
		
		else
		{
			echo json_encode(array('error'=>'Unable to add comment.'));
		}
		
	}
}