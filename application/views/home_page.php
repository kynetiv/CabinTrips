</head>
<body>
<div class="below_nav">
<?php 
	  if(isset($logout_message))
	  {
	  	echo $logout_message;
	  }
?>	
</div>
	<div class="clearfix hero-unit span8 offset2">
		<h3>Welcome to the Fink Cabin</h3>
		<h4>This is a great time to plan your relaxing vaction so, let's get started!</h4>
		<a href="signin" class="btn-group">
			<button class="btn btn-primary">Cabin Up!</button>
		</a>
	</div>
	<div class="row-fluid">
		<div class="span3 offset2">
			<h4>New to the Cabin?</h4>
			<p>All those that visit the "Motherlode" 
				quickly realize they are amongst friends. 
				Sign in today to connect with your cabin mates 
				and plan your next trip!
			</p>
		</div>
		<div class="span3">
			<h4>Leave a Message!</h4>
			<p>What better way to stay connected than
			   leaving a message for your fellow cabiners!
			   Post messages and comments on your cabin wall!!
			</p>
		</div>
		<div class="span3">
			<h4>Plan your Trip!</h4>
			<p>Easy calendar system let's you book your stay,
			   add easy to access trip details, and inform others about
			   the next epic party coming up or that quiet getaway from the grind!
			</p>
		</div>
	</div>
</body>
</html>