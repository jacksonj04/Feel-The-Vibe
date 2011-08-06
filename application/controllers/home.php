<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {

	public function index()
	{
	
		$head['currentpage'] = 'home';
	
		$this->load->view('inc/head');
		$this->load->view('home');
		$this->load->view('inc/foot');
	}
}