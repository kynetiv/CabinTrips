</head>
<body>
	<div class="below_nav">
<?php if(isset($invalid_login))
	  {
	  	echo $invalid_login;
	  }
?>
		<div class="row">
			<h3 class="span4 offset2">Sign In</h3>
		</div>
	</div>
<?php 	$this->load->helper('form');

	echo form_open(base_url('process_signin'), 'class="form-horizontal"');
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
			<label class="control-label" for "password"> Password </label>
			<div class="controls">
				<input type="password" name="password" />
		<?php 				
				echo form_error('password'); 
		?>
			</div>
		</div>
		<div class="control-group offset1">
			<div class="controls">
				<input type="submit" value="Sign in" />
			</div>
		</div>
<?php  
	 echo form_close(); 
?>
	<div class="control-group offset1">
		<ul id="reg_link" class="control-label">
			<li><a href="register">Don't have an account? Register today!</a></li>
		</ul>
	</div>
</body>
</html>