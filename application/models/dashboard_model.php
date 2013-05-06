<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard_model extends CI_Model {

	public function get_column_headers()
	{
		$sql = "SELECT 'ID', 'User', 'Email', 'Created At', 'User Level'";
		return $this->db->query($sql)->result();
	}

	public function get_users()
	{
		$start_tag = '<a href="users/show/';
		$mid_tag = '">';


		$sql = "SELECT users.id, CONCAT('" . $start_tag . "', users.id, '" . $mid_tag . "',  users.first_name, ' ', users.last_name, '</a>') as users, users.email, DATE_FORMAT(users.registered_at, '%M %D %Y'), CASE when users.user_level = 9 THEN 'Admin' ELSE 'User' END FROM users WHERE users.status_flag = 1";

		return $this->db->query($sql)->result();
	}

	public function get_admins()
	{
		$start_tag = '<a href="/users/show/';
		$action_start = '<a href="/users/edit/';
		$start_remove = '<a href="/users/remove/';
		$mid_tag = '">';



		$sql = "SELECT users.id, CONCAT('" . $start_tag . "', users.id, '" . $mid_tag . "',  users.first_name, ' ', users.last_name, '</a>'), users.email, DATE_FORMAT(users.registered_at, '%M %D %Y'), CASE when users.user_level = 9 THEN 'Admin' ELSE 'User' END, CONCAT('" . $action_start . "', users.id, '" . $mid_tag . "', 'EDIT', '  ', '" . $start_remove . "', users.id, '" . $mid_tag . "', 'REMOVE') FROM users WHERE users.status_flag = 1";

		return $this->db->query($sql)->result_array();
	}
}
//end of file