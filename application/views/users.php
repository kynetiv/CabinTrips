</head>
<body>
	<div class="below_nav"></div>	
<?php	

		if($session_data['id'] == $user_profile['id'])
	{
		echo "<a href='/users/edit/" . $session_data['id'] . "'><button class='btn btn-primary offset11'>Edit Profile</button></a>";
	}
?>
	<h3 class="offset1"><?php echo $user_profile['first_name'] . " " . $user_profile['last_name'];?></h3>
	<ul class="unstyled">
		<li class="offset1">Registered at: <?php echo $user_profile['registered_at']; ?></li>
		<li class="offset1">User ID: 	   <?php echo $user_profile['id']; ?></li>
		<li class="offset1">Email address: <?php echo $user_profile['email']; ?></li>
		<li class="offset1">Description:   <?php echo $user_profile['description']; ?></li>
	</ul>

	<div class="container offset1">
<?php
		$this->load->helper('form');
		echo form_open(base_url('/users/process_message'), 'class="form-horizontal"');
		echo $message_form;
		echo form_close();

	$counter = 0;	
	$previous_message_id = NULL;
	foreach($user_messages as $rows)
	{	
		if($previous_message_id != $rows['message_id'])
		{
			if($previous_message_id != NULL && ($rows['message_status_flag']!=0))
			{
				echo form_open(base_url('process_comment'), 'class="form-horizontal"');
				echo "<textarea name='comment_text'></textarea>";
				echo "<input type='hidden' name='comment_receiver' value='" . $user_profile['id'] . "' />";
				echo "<input type='hidden' name='message_id' value='" . $previous_message_id . "'/>";
				echo "<button type='submit' class='btn btn-success'>Comment</button>";
				echo form_close();
			}

			if($session_data['id'] == $rows['message_sender_id'] && ($rows['message_status_flag'] == 1))
			{   
				echo form_open(base_url('/users/remove_message/' . $rows['message_id']));	
				echo "<div class='alert'>";
				echo "<input type='submit' class='close' value='&times;'/>";
				echo "<p>On " . $rows['message_time'] . " - " . "<a href='/users/show/" . $rows['message_sender_id'] . "'>" . $rows['first_name'] . " " . $rows['last_name'] . "</a>" . " said: <br /><br />" . $rows['message'] . "</p>"; 
				echo "</div>";
				echo"<input type='hidden' name='current_page' value='" .$user_profile['id'] . "'/>";
				echo form_close();
			}
			elseif($rows['message_status_flag'] == 1)
			{
			echo "<p class='alert'>On " . $rows['message_time'] . " - " . "<a href='/users/show/" . $rows['user_id'] . "'>" . $rows['first_name'] . " " . $rows['last_name'] . "</a>" . " said: <br /><br />" . $rows['message'] . "</p>";
			}

				if($session_data['id'] == $rows['comment_sender_id'] && ($rows['comment_status_flag'] == 1))
				{
					echo form_open(base_url('/users/remove_comment/' . $rows['comment_id']));	
					echo "<div class='alert alert-info'>";
					echo "<input type='submit' class='close' value='&times;'/>";
						if($rows['message_id'] == $rows['comment_message_id'])
						{
							echo "<p>On " . $rows['comment_time'] . " - " . "<a href='/users/show/" . $rows['comment_sender_id'] . "'>" . $rows['comment_sender_first_name'] . " " . $rows['comment_sender_last_name'] . "</a>" . " said: <br /><br /> " . $rows['comment'] . "</p>";
						}
					echo "</div>";
					echo"<input type='hidden' name='current_page' value='" .$user_profile['id'] . "'/>";
					echo form_close();

				}
				else
				{
					if($rows['message_id'] == $rows['comment_message_id'] && ($rows['comment_status_flag'] == 1))
					{
						echo "<p class='alert alert-info'>On " . $rows['comment_time'] . " - " . "<a href='/users/show/" . $rows['comment_sender_id'] . "'>" . $rows['comment_sender_first_name'] . " " . $rows['comment_sender_last_name'] . "</a>" . " said: <br /><br /> " . $rows['comment'] . "</p>";
					}
				}
		}
		else
		{	
			if($session_data['id'] == $rows['comment_sender_id'] && ($rows['comment_status_flag'] == 1))
					{
						echo form_open(base_url('/users/remove_comment/' . $rows['comment_id']));	
						echo "<div class='alert alert-info'>";
						echo "<input type='submit' class='close' value='&times;'/>";
							if($rows['message_id'] == $rows['comment_message_id'])
							{
								echo "<p>On " . $rows['comment_time'] . " - " . "<a href='/users/show/" . $rows['comment_sender_id'] . "'>" . $rows['comment_sender_first_name'] . " " . $rows['comment_sender_last_name'] . "</a>" . " said: <br /><br /> " . $rows['comment'] . "</p>";
							}
						echo "</div>";
						echo"<input type='hidden' name='current_page' value='" .$user_profile['id'] . "'/>";
						echo form_close();

					}
					else
					{
						if($rows['message_id'] == $rows['comment_message_id'] && ($rows['comment_status_flag'] == 1))
						{
							echo "<p class='alert alert-info'>On " . $rows['comment_time'] . " - " . "<a href='/users/show/" . $rows['comment_sender_id'] . "'>" . $rows['comment_sender_first_name'] . " " . $rows['comment_sender_last_name'] . "</a>" . " said: <br /><br /> " . $rows['comment'] . "</p>";
						}
					}
		}
		$previous_message_id = $rows['message_id'];
		if(($counter +1) == (count($user_messages)))
		{
				echo form_open(base_url('process_comment'), 'class="form-horizontal"');
				echo "<textarea name='comment_text'></textarea>";
				echo "<input type='hidden' name='comment_receiver' value='" . $user_profile['id'] . "' />";
				echo "<input type='hidden' name='message_id' value='" . $previous_message_id . "'/>";
				echo "<button type='submit' class='btn btn-success'>Comment</button>";
				echo form_close();
		}

	$counter++;
	}
?>
	</div><!--end of container-->
</body>
</html>