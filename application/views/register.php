</head>
<body>
	<div class="below_nav">
<?php if(isset($email_taken))
	  {
	  	echo $email_taken;
	  }
	  if(isset($registration_complete))
	  {
	  	echo $registration_complete;
	  }
?>
		<div class="row">
			<h3 class="span4 offset2">Become a Finkineer!</h3>
		</div>
	</div>
<?php 	$this->load->helper('form');

	echo form_open(base_url('process_register'), 'class="form-horizontal"');
?>
		<div class="control-group">
			<label class="control-label" for="email"> Email </label>
			<div class="controls">
				<input type="text" name="email" />
		<?php 				
				echo form_error('email'); 
		?>
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for "first_name"> First Name: </label>
			<div class="controls">
				<input type="text" name="first_name" />
		<?php 				
				echo form_error('first_name'); 
		?>
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for "last_name"> Last Name: </label>
			<div class="controls">
				<input type="text" name="last_name" />
		<?php 				
				echo form_error('last_name'); 
		?>
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for "password"> Password </label>
			<div class="controls">
				<input type="password" name="password" />
		<?php 				
				echo form_error('password'); 
		?>
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for "passconf"> Confirm Password: </label>
			<div class="controls">
				<input type="password" name="passconf" />
		<?php 				
				echo form_error('passconf'); 
		?>
			</div>
		</div>
		<input type='hidden' name=''
		<div class="control-group offset2	">
			<div class="controls">
				<input type="submit" value="Register" />
			</div>
		</div>
<?php  
	 echo form_close();
?>
	<div class="control-group offset2">
		<ul id="reg_link" class="control-label">
			<li><a href="signin">Already have an account? Sign in!</a></li>
		</ul>
	</div>
</body>
</html>