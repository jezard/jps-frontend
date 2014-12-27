<?php session_start(); ?>
<?php $this->load->helper('url'); ?>
<?php $this->load->helper('cookie'); ?>
<?php $loggedIn = false; ?>
<?php $display = 'class="logged-out"'; ?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<!-- <link href='http://fonts.googleapis.com/css?family=Lato:100,300,400,700,100italic,300italic,400italic' rel='stylesheet' type='text/css'> -->
<link rel='stylesheet' href='<?php echo $this->config->item('base_url'); ?>css/style.css' type='text/css' media='all' />
<link rel='stylesheet' href='<?php echo $this->config->item('base_url'); ?>css/light.css' type='text/css' media='all' />


<link href="http://joulepersecond.com/js/calendar/css/dp_calendar.css" type="text/css" rel="stylesheet" />
<link href="http://joulepersecond.com/js/calendar/themes/ui-lightness/jquery.ui.all.css" type="text/css" rel="stylesheet" />


<script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="//use.typekit.net/mbs5qua.js"></script>
<!-- jQuery --> 
<!-- <script src='js/jquery-1.5.2.min.js'></script> --> 
<!-- required plugins --> 
<script src="http://joulepersecond.com/js/calendar/ui/jquery.ui.core.js"></script> 
<script src="http://joulepersecond.com/js/calendar/ui/jquery.ui.position.js"></script> 
<script src="http://joulepersecond.com/js/calendar/ui/jquery.ui.datepicker.js"></script> 
<script src="http://joulepersecond.com/js/calendar/js/date.js"></script> 
<script src="http://joulepersecond.com/js/calendar/js/jquery.dp_calendar.js"></script>

<script>try{Typekit.load();}catch(e){}</script>
<title><?php echo $title; ?></title>
</head>

<body>

<?php

	if ($this->input->cookie('valid_user'))
	{
		$message = "Welcome " . $this->input->cookie('valid_user', false) . "!<br>";
		$loggedIn = true;
		$display = 'class="logged-in"';
	}
	  
	else
	{
		$message = "Welcome guest!<br>";
	}
?>

<header class="site-header">
	<div class="grid grid-pad">
		<div class="hdr-container">
			<div class="logo">
				<a href="<?php echo $this->config->item('base_url'); ?>" title="<?php echo $this->config->item('site_name'); ?> ">
					<img src="<?php echo $this->config->item('base_url'); ?>images/logo-small.png" alt="JoulePerSecond.com" />
				</a> 
			</div>
		
			<nav class="top-nav col-1-1">
			<ul>
				<li id="signup" <?php echo $display; ?> ><?php echo anchor('signup', 'Sign up');?></li>
				<li id="login" <?php echo $display; ?> ><?php echo anchor('login', 'log in');?></li>
				<li id="upload" <?php echo $display; ?> ><?php echo anchor('upload', 'Upload files'); ?></li>
				<li id="activity" <?php echo $display; ?> ><?php echo anchor('activity', 'Activity'); ?></li>
				<li id="analysis" <?php echo $display; ?> ><?php echo anchor('analysis', 'Analysis'); ?></li>
				<li id="myaccount" <?php echo $display; ?> ><?php echo anchor('myaccount', 'My Account'); ?></li>
				<li id="signout" <?php echo $display; ?> ><?php echo anchor('signout', 'log out');?></li>
			</ul>
			</nav>
		</div>

	</div>
</header>
<main>
<div class="grid grid-pad">
	<aside class="message"><?php echo $message; ?></aside>
