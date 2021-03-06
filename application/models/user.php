<?php
class User extends CI_Model
{

	function __construct()
	{
		parent::__construct();
	}
	
	function getcurrent()
	{		
		if ($this->tweet->logged_in()){
			$tokens = $this->tweet->get_tokens();
			$user_db = $this->db->where('oauth_token', $tokens['oauth_token'])->get('users');
			return $user_db->row();
		}else{
			// No user. Return false.
			return false;
		}
	}
	
	function getid($id)
	{		
		$user_db = $this->db->where('user_id', $id)->get('users');
		if ($user_db->num_rows() == 1){
			return $user_db->row();
		}else{
			// No user. Return false.
			return false;
		}
	}

}