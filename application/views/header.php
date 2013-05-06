<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title><?=$title;?></title>
	<link rel="stylesheet" type="text/css" href="/assets/css/bootstrap.css" />
	<link rel="stylesheet" type="text/css" href="/assets/css/style.css">
	<link rel="stylesheet" type="text/css" href="/assets/css/bootstrap-responsive.css" />
	<script type="text/javascript" href="/assets/js/bootstrap.js"></script>
	<script type="text/javascript" href="/assets/js/bootstrap.min.js"></script>
	<script src="/assets/js/jquery.js"></script>
    <script src="/assets/js/bootstrap-transition.js"></script>
    <script src="/assets/js/bootstrap-alert.js"></script>
    <script src="/assets/js/bootstrap-modal.js"></script>
    <script src="/assets/js/bootstrap-dropdown.js"></script>
    <script src="/assets/js/bootstrap-scrollspy.js"></script>
    <script src="/assets/js/bootstrap-tab.js"></script>
    <script src="/assets/js/bootstrap-tooltip.js"></script>
    <script src="/assets/js/bootstrap-popover.js"></script>
    <script src="/assets/js/bootstrap-button.js"></script>
    <script src="/assets/js/bootstrap-collapse.js"></script>
    <script src="/assets/js/bootstrap-carousel.js"></script>
    <script src="/assets/js/bootstrap-typeahead.js"></script>
    <script src="/assets/js/bootstrap-affix.js"></script>
    
	<div id="navbar" class="navbar navbar-inverse navbar-fixed-top">
	 	<div class="navbar-inner">
		 	<div class="container">
				<ul class="nav">
				<?php for ($nav_link = 0; $nav_link < count($nav_list); $nav_link++):?>
					<li><a href="/<?=$url_list[$nav_link];?>"><?=$nav_list[$nav_link];?></a></li>	
				<?php endfor;?>
				</ul>
				<ul class="nav pull-right">
					<?php for ($nav_io = 0; $nav_io < 1; $nav_io++):?>
					<li><a href="/<?=$in_or_out_url[$nav_io];?>"><?=$in_or_out_title[$nav_io];?></a></li>
					<?php endfor;?>
				</ul>
			</div><!--end of navbar-inner-->	
		</div><!--end of container-->	
	</div><!--end of navbar-->