<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once('main.php');

class Calendar extends Main {

	public function index() {
		if($this->user_session['login_status'])
		{
			redirect(base_url('calendar'));
		}
		else
		{
			// User wasn't logged in, redirected to main page
			redirect(base_url('main'));
		}	
	}

	public function display($year = null, $month = null) {
		if($this->user_session['login_status'])
		{
			if (!$year) {
				$year = date('Y');
			}
			if (!$month) {
				$month = date('m');
			}
			
			$this->load->model('Calendar_model');
			
			if ($day = $this->input->post('day')) {
				$this->Calendar_model->add_calendar_data(
					"$year-$month-$day",
					$this->input->post('data')
				);
			}
			
			$data['calendar'] = $this->Calendar_model->generate($year, $month);
			
			$view_data['title'] = "Calendar";
			$view_data['url_list'] = array("main", "main");
			$view_data['nav_list'] = array("Fink Cabin", "Home");
			$view_data['in_or_out_url'] = array("logout");
			$view_data['in_or_out_title'] = array("Logout");
			$this->load->view('header', $view_data);
			$this->load->view('mycal', $data);
			
		}
		else
		{
			// User wasn't logged in, redirected to main page
			redirect(base_url('main'));
		}
	}
}
//eof