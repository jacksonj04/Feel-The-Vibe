<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {

	public function index()
	{
	
		$head['currentpage'] = 'home';
		
		$data['recents'] = $this->db->order_by('generated','desc')->limit(10)->get('posts');
	
		$this->load->view('inc/head', $head);
		$this->load->view('home', $data);
		$this->load->view('inc/foot');
	}
	
	public function about()
	{
	
		$head['currentpage'] = 'about';
		$head['title'] = 'About';
	
		$this->load->view('inc/head', $head);
		$this->load->view('about');
		$this->load->view('inc/foot');
	}
	
	public function help()
	{
	
		$head['currentpage'] = 'help';
		$head['title'] = 'Help';
	
		$this->load->view('inc/head', $head);
		$this->load->view('help');
		$this->load->view('inc/foot');
	}
}