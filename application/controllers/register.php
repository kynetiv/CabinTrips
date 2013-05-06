<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once('main.php');

class Register extends Main {

	public function index()
		{
			$view_data['title'] = "Register";
			$view_data['url_list'] = array("main", "main");
			$view_data['nav_list'] = array("Fink Cabin", "Home");
			$view_data['in_or_out_url'] = array("signin");
			$view_data['in_or_out_title'] = array("Sign in");
			$this->load->view('header', $view_data);
			$this->load->view('register');
		}

	public function process_register()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters('<span class="help-inline">', '</span>');
		$this->form_validation->set_rules('email', 'Email', 'valid_email|required|xss_clean');
		$this->form_validation->set_rules('first_name', 'First Name', 'alpha|required|xss_clean');
		$this->form_validation->set_rules('last_name', 'Last Name', 'alpha|required|xss_clean');
		$this->form_validation->set_rules('password', 'Password', 'matches[passconf]|min_length[8]|required|xss_clean');
		$this->form_validation->set_rules('passconf', 'Password', 'min_length[8]|required|xss_clean');

			if($this->form_validation->run() === FALSE)
			{	
				if($this->user_session['user_level'] == 9)
				{
					$view_data['title'] = "New User";
					$view_data['url_list'] = array("main", "dashboard/admin", "users/show/" . $this->user_session['id'] . "");
					$view_data['nav_list'] = array("Fink Cabin", "Dashboard", "Profile");
					$view_data['in_or_out_url'] = array("logout");
					$view_data['in_or_out_title'] = array("Logout");
					$this->load->view('header', $view_data);
					$this->load->view('new');
				}
				else
				{

					$view_data['title'] = "Register";
					$view_data['url_list'] = array("main", "main");
					$view_data['nav_list'] = array("Fink Cabin", "Home");
					$view_data['in_or_out_url'] = array("signin");
					$view_data['in_or_out_title'] = array("Sign in");
					$this->load->view('header', $view_data);
					$this->load->view('register');
				}
			}
			else
			{

				$email_post = $this->input->post('email');
				$password_post = md5($this->input->post('password'));

				$this->load->model('signin_model');
				$email_register_check = $this->signin_model->check_users($email_post, $password_post);
				$just_email_check = $this->signin_model->just_email($email_post);

				if($email_register_check == NULL && $just_email_check == NULL)
				{
					$register_first_name = $this->input->post('first_name');
					$register_last_name = $this->input->post('last_name');
					$register_email = $this->input->post('email');
					$register_password = md5($this->input->post('password'));

					$this->load->model('register_model');
					$new_database = $this->register_model->new_database();

					if(!$new_database)
					{
						$this->register_model->register_admin($register_first_name, $register_last_name, $register_email, $register_password);
					}
					else
					{
						$this->register_model->register_users($register_first_name, $register_last_name, $register_email, $register_password);
					}

					redirect(base_url('registration_complete'));
				}	
				else
				{
					redirect(base_url('registration_email_taken'));
				}
			}
	}
	public function registration_email_taken()
	{
		if($this->session->userdata === TRUE)
		{
			$user_status = $this->session->userdata['user_session'];
			if($user_status['user_level'] == 9)
			{
				$view_data['email_taken'] = "<h3 class='alert alert-error'>Well, that email is already registered...</h3>";
				$view_data['title'] = "New User";
				$view_data['url_list'] = array("main", "dashboard/admin", "users/show/" . $this->session->userdata['user_session']['id'] . "");
				$view_data['nav_list'] = array("Fink Cabin", "Dashboard", "Profile");
				$view_data['in_or_out_url'] = array("logout");
				$view_data['in_or_out_title'] = array("Logout");
				$this->load->view('header', $view_data);
				$this->load->view('new');
			}
		}
		else
		{
			$view_data['email_taken'] = "<h3 class='alert alert-error'>Well, that email is already registered...</h3>";
			$view_data['title'] = "Register";
			$view_data['url_list'] = array("main", "main");
			$view_data['nav_list'] = array("Fink Cabin", "Home");
			$view_data['in_or_out_url'] = array("signin");
			$view_data['in_or_out_title'] = array("Sign in");
			$this->load->view('header', $view_data);
			$this->load->view('register');
		}

	}
		public function registration_complete(){
			if($this->session->userdata === TRUE)
			{
				$user_status = $this->session->userdata['user_session'];
				if($user_status['user_level'] == 9)
				{
					$view_data['registration_complete'] = "<h3 class='alert alert-success'>You're all set! Welcome aboard!!</h3>";
					$view_data['title'] = "New User";
					$view_data['url_list'] = array("main", "dashboard/admin", "users/show/" . $this->session->userdata['user_session']['id'] . "");
					$view_data['nav_list'] = array("Fink Cabin", "Dashboard", "Profile");
					$view_data['in_or_out_url'] = array("logout");
					$view_data['in_or_out_title'] = array("Logout");
					$this->load->view('header', $view_data);
					$this->load->view('new');
				}
			}
			else
			{
				$view_data['registration_complete'] = "<h3 class='alert alert-success'>You're all set! Welcome aboard!!</h3>";
				$view_data['title'] = "Register";
				$view_data['url_list'] = array("main", "main");
				$view_data['nav_list'] = array("Fink Cabin", "Home");
				$view_data['in_or_out_url'] = array("signin");
				$view_data['in_or_out_title'] = array("Sign in");
				$this->load->view('header', $view_data);
				$this->load->view('register');
			}	
	}

}
//end of file