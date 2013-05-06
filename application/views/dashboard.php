</head>
<body>
	<div class="below_nav"></div>
	<h3 class="offset1">All Cabineers</h3>
<?php $user_status = $this->session->userdata['user_session'];
if(($user_status['login_status']) && ($user_status['user_level'] == 9))
{
	echo "<div><a href='/users/new'><button class='btn btn-primary offset10'>Add User</button></a></div>";
}
?>
		<div class="container hero-unit span9 offset1">
<?php	
		 	if(isset($dash_head) && isset($dash_body))
		 	{
		 		echo $dash_head;
		 		echo $dash_body;
		 	}
		 	if(isset($make_table))
		 	{
		 		echo $make_table;
		 	}
?>
	</div>
</body>
</html>