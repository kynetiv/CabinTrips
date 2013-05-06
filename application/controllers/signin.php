<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once('main.php');

class Signin extends Main {

	public function index()
	{
		$view_data['title'] = "Sign In";
		$view_data['url_list'] = array("main", "main");
		$view_data['nav_list'] = array("Fink Cabin", "Home");
		$view_data['in_or_out_url'] = array("signin");
		$view_data['in_or_out_title'] = array("Sign in");
		$this->load->view('header', $view_data);
		$this->load->view('signin');
	}

	public function process_signin()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters('<span class="help-inline">', '</span>');
		$this->form_validation->set_rules('email', 'Email', 'valid_email|required');
		$this->form_validation->set_rules('password', 'Password', 'min_length[8]|required');

		if($this->form_validation->run() === FALSE)
		{	
			$view_data['title'] = "Sign In";
			$view_data['url_list'] = array("main", "main");
			$view_data['nav_list'] = array("Fink Cabin", "Home");
			$view_data['in_or_out_url'] = array("signin");
			$view_data['in_or_out_title'] = array("Sign in");
			$this->load->view('header', $view_data);
			$this->load->view('signin');
		}
		else
		{
			$email_post = $this->input->post('email');
			$password_post = md5($this->input->post('password'));

			$this->load->model('signin_model');

			$check_email= $this->signin_model->check_users($email_post, $password_post);

			if($check_email == !NULL)	
			{	
				$user = array('id' => $check_email[0]->id,
						'email' => $check_email[0]->email,
						'first_name' => $check_email[0]->first_name,
						'last_name' => $check_email[0]->last_name,
						'password' => $check_email[0]->password,
						'user_level' => $check_email[0]->user_level,
						'registered_at' => $check_email[0]->registered_at,
						'description' => $check_email[0]->description,
						'login_status' => TRUE);

				$this->session->set_userdata('user_session', $user);

				if($user['user_level'] == 9)
				{
					redirect(base_url('dashboard/admin'));
				}
				else
				{
					redirect(base_url('dashboard'));
				}
			}
			else
			{
				redirect(base_url('invalid_email_password'));
			}
		}
	}
	public function invalid_email_password()
	{
		$view_data['invalid_login'] = "<h3 class='alert alert-error'>Well, that's either a bad email, the wrong password or bad day...</h3>";
		$view_data['title'] = "Sign In";
		$view_data['url_list'] = array("main", "main");
		$view_data['nav_list'] = array("Fink Cabin", "Home");
		$view_data['in_or_out_url'] = array("signin");
		$view_data['in_or_out_title'] = array("Sign in");
		$this->load->view('header', $view_data);
		$this->load->view('signin');
	}	
	
}
//end of file