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
	
		if (isset($this->input->post('post')) && isset($this->input->post('paragraph'))){
			// We have post and paragraph. Validation time!
			$post_db = $this->db->where('post_id', $this->input->post('post'))->get('posts');
			if ($post_db->num_rows() == 1){
				// Post exists, be happy
			}else{
				// Post doesn't exist, something has gone wrong.
				echo json_encode(array('error' => 'Post does not exist.'));
			}
		}else{
			echo json_encode(array('error'=>'Unable to complete vibe up.'));
		}
		
	}
}