<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once('main.php');

class Dashboard extends Main {

	public function index()
	{	
		//Check to see if user is logged in or boot them out
		if($this->user_session['login_status'])
		{	
			//Query list of users for display in dashboard table
			$this->load->model('dashboard_model');
			$user_dash_head = $this->dashboard_model->get_column_headers();
			$user_dash_table = $this->dashboard_model->get_users();
			
			//Build the table
			$dash_head = '<table class="table table-striped table-bordered span8">';
			$dash_head .= '<thead><tr>';
			foreach($user_dash_head AS $head_row) 
			{
				foreach($head_row AS $head_data)
				{
					$dash_head .= '<th>' . $head_data . '</th>';
				}
			}

			$dash_head .= '</tr></thead>';
			$dash_body ='<tbody>';
			foreach($user_dash_table AS $user_row)
			{
				$dash_body .= '<tr>';
				foreach($user_row AS $user_data)
				{
					$dash_body .= '<td>' . $user_data . '</td>';
				}
				$dash_body .= '</tr>';
			}
			$dash_body .='</tbody></table>';

			// Load view data
			$view_data['dash_head'] = $dash_head;
			$view_data['dash_body'] = $dash_body;
			$view_data['title'] = "User Dashboard";
			$view_data['url_list'] = array("main", "dashboard", "users/show/" . $this->session->userdata['user_session']['id'] . "");
			$view_data['nav_list'] = array("Fink Cabin", "Dashboard", "Profile");
			$view_data['in_or_out_url'] = array("logout");
			$view_data['in_or_out_title'] = array("Logout");
			
			// Load the view with view data
			$this->load->view('header', $view_data);
			$this->load->view('dashboard');
		}
		else
		{
			// User wasn't logged in, redirected to main page
			redirect(base_url('main'));
		}
	}
	public function admin()
	{
		// Admin view has additional edit and remove columns as well as add user link 
		if(($this->user_session['login_status'])&&($this->user_session['user_level'] == 9))
		{
			$this->load->model('dashboard_model');
			$user_dash_table = $this->dashboard_model->get_admins();

			// Table helper
			$this->load->library('table');
			$tmpl = array('table_open' => '<table class="table table-striped table-bordered span8"');
			$this->table->set_heading(array('ID', 'User', 'Email', 'Created At', 'User Level', 'Action'));
			$this->table->set_template($tmpl);
			$view_data['make_table'] = $this->table->generate($user_dash_table);

			// Load view data
			$view_data['title'] = "Admin Dashboard";
			$view_data['url_list'] = array("main", "dashboard/admin", "users/show/" . $this->session->userdata['user_session']['id'] . "");
			$view_data['nav_list'] = array("Fink Cabin", "Dashboard", "Profile");
			$view_data['in_or_out_url'] = array("logout");
			$view_data['in_or_out_title'] = array("Logout");

			// Load the view with view data
			$this->load->view('header', $view_data);
			$this->load->view('dashboard');
		}
	}
	public function logout()
	{	
		// Logout the current user and return to landing page
		$this->session->sess_destroy();
		$view_data['logout_message'] = "<h3 class='alert alert-info pull-right'>We will miss you, come back soon!</h3>";
		$view_data['title'] = "Home Page";
		$view_data['url_list'] = array("main", "main");
		$view_data['nav_list'] = array("Fink Cabin", "Home");
		$view_data['in_or_out_url'] = array("signin");
		$view_data['in_or_out_title'] = array("Sign in");
		$this->load->view('header', $view_data);
		$this->load->view('home_page');
	}
}
//end of file