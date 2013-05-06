<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once('signin_model.php');

class Register_model extends Signin_model{

	public function new_database()
	{
		$sql = "SELECT * FROM users";

		return $this->db->query($sql)->result();
	}

	public function register_users($first_name, $last_name, $email, $password)
	{
		$sql = "INSERT INTO users (first_name, last_name, email, password, registered_at, updated_at) VALUES (?, ?, ?, ?, NOW(), NOW())";

		$this->db->query($sql, array($first_name, $last_name, $email, $password));
	}

	public function register_admin($first_name, $last_name, $email, $password)
	{
		$sql = "INSERT INTO users (first_name, last_name, email, password, registered_at, updated_at, user_level) VALUES (?, ?, ?, ?, NOW(), NOW(), 9)";

		$this->db->query($sql, array($first_name, $last_name, $email, $password));
	}
}
//end of file