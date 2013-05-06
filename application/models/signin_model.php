<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Signin_model extends CI_Model
{

	public function check_users($email, $password)
	{	
		$sql = "SELECT users.id, users.first_name, users.last_name, users.email, users.password, DATE_FORMAT(users.registered_at, '%M %D %Y') AS registered_at, users.description, users.user_level FROM users WHERE users.email = ? AND users.password = ?";
		
		return $this->db->query($sql, array($email, $password))->result();

	}

	public function just_email($email)
	{
		$sql ="SELECT users.email FROM users WHERE users.email = ?";

		return $this->db->query($sql, array($email))->result();
	}
}
//end of file