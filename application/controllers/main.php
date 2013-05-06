<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Main extends CI_Controller {

	protected $view_data = array();

	protected $user_session = NULL;

	public function __construct()
	{
		parent::__construct();
		
		$this->user_session = $this->session->userdata('user_session');
		
	}

	public function index()
	{
		$view_data['title'] = "Home Page";
		$view_data['url_list'] = array("main", "main");
		$view_data['nav_list'] = array("Fink Cabin", "Home");
		$view_data['in_or_out_url'] = array("signin");
		$view_data['in_or_out_title'] = array("Sign in");
		$this->load->view('header', $view_data);
		$this->load->view('home_page');
	}

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */