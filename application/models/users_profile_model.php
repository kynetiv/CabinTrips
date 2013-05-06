<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Users_profile_model extends CI_Model {

	public function get_profile($id)
	{
		$sql = "SELECT *, DATE_FORMAT(users.registered_at, '%M %D %Y') AS registered_at FROM users WHERE users.id = ?";
		
		return $this->db->query($sql, array($id))->result();
	}

	public function get_messages($id)
	{
		$sql = "SELECT users.id as user_id, users.first_name, users.last_name, messages.id AS message_id, messages.message, 
				messages.sender_id AS message_sender_id, messages.receiver_id AS message_receiver_id, 
				DATE_FORMAT(messages.created_at, '%M %D %Y') as message_time, messages.status_flag AS message_status_flag, 
				comments.comment, comments.id AS comment_id, comments.message_id AS comment_message_id, comments.comment_sender_first_name, 
				comments.comment_sender_last_name, comments.comment_sender_id as comment_sender_id, DATE_FORMAT(comments.created_at, '%M %D %Y') as comment_time, 
				comments.status_flag AS comment_status_flag
				FROM messages 
				LEFT JOIN users ON messages.sender_id = users.id
				LEFT JOIN comments ON messages.id = comments.message_id
				WHERE messages.receiver_id = ? AND messages.status_flag = 1
				ORDER BY messages.id DESC, comments.id ASC";

		return $this->db->query($sql, array($id))->result_array();
	}

	public function post_message($message_text, $message_sender, $message_receiver)
	{

		$sql = "INSERT INTO messages (message, sender_id, receiver_id, created_at) VALUES (?, ?, ?, now())";

		$this->db->query($sql, array($message_text, $message_sender, $message_receiver));

	}

	public function post_comment($comment_text, $comment_message_id)
	{	
		$user_profile = $this->session->userdata['user_session'];

		$sql ="INSERT INTO comments (comment, comment_sender_id, comment_sender_first_name, comment_sender_last_name, message_id, created_at) VALUES (?, ?, ?, ?, ?, NOW())";

		$this->db->query($sql, array($comment_text, $user_profile['id'], $user_profile['first_name'], $user_profile['last_name'], $comment_message_id));

	}

	public function edit_users($id)
	{
		$sql = "SELECT users.id, users.email, users.first_name, users.last_name, users.description, users.registered_at, 
				CASE WHEN users.user_level = 9 THEN 'Admin' ELSE 'User' END AS user_level FROM users WHERE users.id = ?";

		return $this->db->query($sql, array($id))->result();

	}

	public function check_email($email, $id)
	{
		$sql = "SELECT users.email FROM users WHERE users.email = ? AND users.id != ?";

		return $this->db->query($sql, array($email, $id))->result();

	}

	public function update_user($email, $first_name, $last_name, $level, $id)
	{
		$sql = "UPDATE users SET users.email = ?, users.first_name = ?, users.last_name = ?, users.user_level = ?, users.updated_at = NOW() 
				WHERE users.id = ?";

		$this->db->query($sql, array($email, $first_name, $last_name, $level, $id));

	}
	public function update_pass($id, $email)
	{
		$sql = "UPDATE users SET users.password = ? WHERE users.id = ?";

		$this->db->query($sql, array($email, $id));
	}
	public function remove_user($id)
	{
		$sql = "UPDATE users SET users.status_flag = 0 WHERE users.id = ?";
		$this->db->query($sql, array($id));
	}

	public function remove_message($id)
	{
		$sql = "UPDATE messages SET messages.status_flag = 0 WHERE messages.id = ?";

		$this->db->query($sql, array($id));
	}

	public function remove_comment($id)
	{
		$sql = "UPDATE comments SET comments.status_flag = 0 WHERE comments.id = ?";

		$this->db->query($sql, array($id));
	}

	public function update_description($description, $current_id)
	{
		$sql = "UPDATE users SET description = ? WHERE users.id = ?";

		$this->db->query($sql, array($description, $current_id));
	}
}
//end of file