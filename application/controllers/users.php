<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once('main.php');

class Users extends Main{
	
	private function current_user_page($id='')
	{
		
		$this->load->model('users_profile_model');
		$current_edit_user = $this->users_profile_model->get_profile($id);
		return $view_data['current_user'] = array('id'            => $current_edit_user[0]->id,
												  'email'         => $current_edit_user[0]->email,
												  'first_name'    => $current_edit_user[0]->first_name,
												  'last_name'     => $current_edit_user[0]->last_name,
												  'user_level'    => $current_edit_user[0]->user_level,
												  'description'   => $current_edit_user[0]->description,
												  'registered_at' => $current_edit_user[0]->registered_at
											     );
	}

	public function show($id='')
	{	$view_data['session_data'] = $this->user_session;
		
		$view_data['user_profile'] = $this->current_user_page($id);

		$view_data['user_messages'] = $this->users_profile_model->get_messages($id);
		

		// $view_data['user_comments'] = $this->users_profile_model->get_comments($comment_message_id); 
		// this is preventing me from loading comments Where comment_message_id = message_id in the view. 
		//I need to do one query that gets comments and messages at the same time.

		$message_form  = "<textarea id='message_area' class='span4 well-large' name='message_text'></textarea>";
		$message_form .= "<input type='hidden' name='message_sender' value='" . $this->user_session['id'] . "'/>";
		$message_form .= "<input type='hidden' name='message_receiver' value='" . $view_data['user_profile']['id'] . "'/>";
		$message_form .= "<div class='controls'></div><button type='submit' class='btn btn-primary offset2'>Post to my wall!</button>";
		$view_data['message_form'] = $message_form;

		$view_data['title'] = "User Information";
		$view_data['url_list'] = array("main", "dashboard", "users/show/" . $this->user_session['id'] . "");

		if($this->user_session['user_level'] == 9)
		{
			$view_data['url_list'] = array("main", "dashboard/admin", "users/show/" . $this->user_session['id'] . "");
		}
		else
		{
			$view_data['url_list'] = array("main", "dashboard", "users/show/" . $this->user_session['id'] . "");
		}

		$view_data['nav_list'] = array("Fink Cabin", "Dashboard", "Profile");
		$view_data['in_or_out_url'] = array("logout");
		$view_data['in_or_out_title'] = array("Logout");
		$this->load->view('header', $view_data);
		$this->load->view('users');

	}

	public function process_message()
	{
		$message_text = $this->input->post('message_text');
		$message_sender = $this->input->post('message_sender');
		$message_receiver = $this->input->post('message_receiver');
		$this->load->model('users_profile_model');
		$this->users_profile_model->post_message($message_text, $message_sender, $message_receiver);

		redirect(base_url('users/show/' . $message_receiver)); 

	}

	public function process_comment()
	{
		$comment_text = $this->input->post('comment_text');
		$comment_message_id = $this->input->post('message_id');
		$comment_receiver_id = $this->input->post('comment_receiver');
		$this->load->model('users_profile_model');
		$this->users_profile_model->post_comment($comment_text, $comment_message_id);

		redirect(base_url('users/show/'. $comment_receiver_id));
	}

	public function new_user()
	{
		$view_data['title'] = "New User";
		$view_data['url_list'] = array("main", "dashboard/admin", "users/show/" . $this->user_session['id'] . "");
		$view_data['nav_list'] = array("Fink Cabin", "Dashboard", "Profile");
		$view_data['in_or_out_url'] = array("logout");
		$view_data['in_or_out_title'] = array("Logout");
		$this->load->view('header', $view_data);
		$this->load->view('new');

	}

	public function edit($id='')
	{	  
			
		$view_data['current_user'] = $this->current_user_page($id);

		$view_data['title'] = "Edit User";
	
		if($this->user_session['user_level'] == 9)
		{
			$view_data['url_list'] = array("main", "dashboard/admin", "users/show/" . $this->user_session['id'] . "");
		}
		else
		{
			$view_data['url_list'] = array("main", "dashboard", "users/show/" . $this->user_session['id'] . "");
		}
			$view_data['nav_list'] = array("Fink Cabin", "Dashboard", "Profile");
			$view_data['in_or_out_url'] = array("logout");
			$view_data['in_or_out_title'] = array("Logout");
			$this->load->view('header', $view_data);
			$this->load->view('edit');
	}

		public function edit_info($id='')
		{
			$this->load->library('form_validation');
			$this->form_validation->set_error_delimiters('<span class="help-inline">', '</span>');
			$this->form_validation->set_rules('email', 'Email', 'valid_email|required|xss_clean');
			$this->form_validation->set_rules('first_name', 'First Name', 'alpha|required|xss_clean');
			$this->form_validation->set_rules('last_name', 'Last Name', 'alpha|required|xss_clean');

			$view_data['current_user'] = $this->current_user_page($id);

				if($this->form_validation->run() === FALSE)
				{	
					$view_data['title'] = "Edit User";
					$user_session_data = $this->session->userdata['user_session'];
					if($user_session_data['user_level'] == 9)
					{
						$view_data['url_list'] = array("main", "dashboard/admin", "users/show/" . $this->user_session['id'] . "");
					}
					else
					{
						$view_data['url_list'] = array("main", "dashboard", "users/show/" . $this->user_session['id'] . "");
					}
					$view_data['nav_list'] = array("Fink Cabin", "Dashboard", "Profile");
					$view_data['in_or_out_url'] = array("logout");
					$view_data['in_or_out_title'] = array("Logout");
					$this->load->view('header', $view_data);
					$this->load->view('edit');
				}
				else
				{
					$email_post = $this->input->post('email');

					$this->load->model('users_profile_model');
					$edit_info_check = $this->users_profile_model->check_email($email_post, $id);
					if($edit_info_check == NULL)
					{
						$update_email = $this->input->post('email');
						$update_first_name = $this->input->post('first_name');
						$update_last_name = $this->input->post('last_name');
						$update_user_level = $this->input->post('user_level');
						$this->users_profile_model->update_user($update_email, $update_first_name, $update_last_name, $update_user_level, $id);
						
						redirect(base_url('users/edit/' . $id));
					}
					else
					{
						echo "sorry, that email is currently, in use. Please go back and try again.";
					}
				}
			}
	public function edit_pass($id='')
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('password', 'Password', 'matches[passconf]|min_length[8]|required|xss_clean');
		$this->form_validation->set_rules('passconf', 'Password', 'min_length[8]|required|xss_clean');

		$view_data['current_user'] = $this->current_user_page($id);

		
		if($this->form_validation->run() === FALSE)
		{
			if($this->form_validation->run() === FALSE)
			{	
				$view_data['title'] = "Edit User";
			

				if($this->user_session['user_level'] == 9)
				{
					$view_data['url_list'] = array("main", "dashboard/admin", "users/show/" . $this->user_session['id'] . "");
				}
				else
				{
					$view_data['url_list'] = array("main", "dashboard", "users/show/" . $this->user_session['id'] . "");
				}
					$view_data['nav_list'] = array("Fink Cabin", "Dashboard", "Profile");
					$view_data['in_or_out_url'] = array("logout");
					$view_data['in_or_out_title'] = array("Logout");
					$this->load->view('header', $view_data);
					$this->load->view('edit');

			}
		}
		else
		{
			$password_post = md5($this->input->post('password'));
			$this->load->model('users_profile_model');
			$this->users_profile_model->update_pass($id, $password_post);
			echo "word, its updated!";
			// redirect(base_url('users/edit/' . $id));
		}
	}

	public function remove($id='')
	{

		$this->load->model('users_profile_model');
		$this->users_profile_model->remove_user($id);
		redirect(base_url('/dashboard/admin'));
	}

	public function remove_message($id='')
	{
		$goback_to = $this->input->post('current_page');
		$this->load->model('users_profile_model');
		$this->users_profile_model->remove_message($id);

		redirect(base_url('/users/show/' . $goback_to));
	}

	public function remove_comment($id='')
	{
		$goback_to = $this->input->post('current_page');
		$this->load->model('users_profile_model');
		$this->users_profile_model->remove_comment($id);

		redirect(base_url('/users/show/' . $goback_to));
	}

	public function update_description() 
	{
		$description = $this->input->post('description_text');
		$current_id = $this->input->post('current_id');
		$this->load->model('users_profile_model');
		$this->users_profile_model->update_description($description, $current_id);

	}

}
//end of file