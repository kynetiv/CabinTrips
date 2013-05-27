</head>
<body>
	<div class="below_nav"></div>
<?php $user_status = $this->session->userdata['user_session'];
	if(($user_status['login_status']) && (($user_status['user_level'] == 9)||($user_status['id'] == $current_user['id'])))
	{
		
		if($user_status['user_level'] == 9)
		{	echo "<h3 class='offset2'>Edit User #" . $current_user['id'] . "</h3>";
			echo "<div><a href='/dashboard/admin'><button class='btn btn-primary offset10'>Return to Dashboard</button></a></div>";
		}
		else
		{	echo "<h3 class='offset2'>Edit User</h3>";
			echo "<div><a href='/dashboard'><button class='btn btn-primary offset10'>Return to Dashboard</button></a></div>";
		}
		echo "<div class='container-fluid'>";
		echo "<div class='row-fluid'>";
		echo "<div class='span4'>";
		echo "<h5 class='offset5'> Edit User Information</h5>";
	$this->load->helper('form');
	echo form_open(base_url('/users/edit_info/' . $current_user['id']), 'class="form-horizontal"');
?>
		<div class="control-group">
			<label class="control-label" for="email"> Email: </label>
			<div class="controls">
				<input type="text" name="email" value="<?php echo $current_user['email'];?>" />
		<?php 				
				echo form_error('email'); 
		?>
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for "first_name"> First Name: </label>
			<div class="controls">
				<input type="text" name="first_name" value="<?php echo $current_user['first_name'];?>" />
		<?php 				
				echo form_error('first_name'); 
		?>
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for "last_name"> Last Name: </label>
			<div class="controls">
				<input type="text" name="last_name" value="<?php echo $current_user['last_name'];?>" />
		<?php 				
				echo form_error('last_name'); 
		?>
			</div>
		</div>
		<?php if($user_status['user_level'] == 9)
		{
			?>
		<div class="control-group">
			<label class="control-label" for "user_level"> User Level: </label>
			<div class="controls">
				<select name="user_level">
					<option value="<?php if($current_user['user_level'] == 9) {echo 9;} else{echo 8;}?>"><?php if($current_user['user_level'] == 9) {echo 'Admin';} else{echo 'User';}?></option>
					<?php if($current_user['user_level'] == 9)
					{	
						echo "<option value='8'>User</option>";
					}
					else
					{
						echo "<option value='9'>Admin</option>";
					}
					?>
				</select>
			</div>
		</div>
		<?php
	}
	?>
		<input type="hidden" name="current_id" value="<?php $user_status['id'];?>" />
		<div class="control-group offset4">
			<div class="controls">
				<input type="submit" value="Save" />
			</div>
		</div>
<?php  
	 echo form_close();
?>
</div><!--end of edit user informaiton form span4-->
<div class="span4">
	<h5 class="offset5">Change Password</h5>
<?php
	echo form_open(base_url('/users/edit_pass/' . $current_user['id']), 'class="form-horizontal"');
?>
		<div class="control-group">
			<label class="control-label" for="password"> Password: </label>
			<div class="controls">
				<input type="text" name="password" />
		<?php 				
				echo form_error('password'); 
		?>
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for "passconf"> Confirm Password: </label>
			<div class="controls">
				<input type="text" name="passconf"/>
		<?php 				
				echo form_error('passconf'); 
		?>
			</div>
		</div>
		<input type="hidden" name="current_user_id" value="<?php $user_status['id'];?>" />
		<div class="control-group offset2">
			<div class="controls">
				<input type="submit" value="Update Password" />
			</div>
		</div>
<?php 	echo form_close(); ?>
</div><!--end of edit password span4-->
</div>
</div>
<?php
	}
	else
	{
		echo "Admin Access Only, thank you.";
	}
	if($user_status['id'] == $current_user['id'])
	{	
		echo "<div class='clearfix offset2'>";
		echo"<h5>Edit Description</h5>";
		echo form_open(base_url('update_description'), 'class="form-horizontal"');
		echo "<textarea class='span9 well-large' name='description_text'></textarea>";
		echo"<input type='hidden' name='current_id' value='". $user_status['id'] . "' />";
		echo "<button type='submit' class='btn btn-success'>Update</button>";
		echo form_close();
		echo "</div>";
	}
?>

</body>
</html>