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
<script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="//use.typekit.net/mbs5qua.js"></script>
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
