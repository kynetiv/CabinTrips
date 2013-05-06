<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Timecard_model extends CI_Model
{
	public function get_days($current_date)
	{
		$sql = "SELECT * FROM periods WHERE periods.start_pay_period >= '?' AND periods.end_pay_period <= '?'";
		
		return $this->db->query($sql, array($current_date))->result();
	}
}