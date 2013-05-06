<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Users_profile_model extends CI_Model {

	public function get_profile($id)
	{
		$sql = "SELECT * FROM users WHERE users.id ='"$id"'";

		return $this->db->query($sql)-result();
	}

}
//end of file