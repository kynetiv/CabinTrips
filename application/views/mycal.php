<script type="text/javascript">
	$(document).ready(function() {
		$('.calendar .day').click(function() {
			day_num = $(this).find('.day_num').html();
			day_data = prompt('Enter Stuff', $(this).find('.content').html());
			if (day_data != null) {
				
				$.ajax({
					url: window.location,
					type: 'POST',
					data: {
						day: day_num,
						data: day_data
					},
					success: function(msg) {
						location.reload();
					}						
				});
				
			}
			
		});
		
	});
		
</script>
</head>
<body>
	<div class="below_nav"></div>
	<?php echo $calendar; ?>
	
</body>
</html>