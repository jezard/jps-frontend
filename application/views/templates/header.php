<?php $this->load->helper('url'); ?>
<?php $this->load->helper('cookie'); ?>
<?php $loggedIn = false; ?>
<?php $display = 'class="logged-out"'; ?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<link href='http://fonts.googleapis.com/css?family=Lato:100,300,400,700,100italic,300italic,400italic' rel='stylesheet' type='text/css'>
<link rel='stylesheet' href='<?php echo $this->config->item('base_url'); ?>css/style.css' type='text/css' media='all' />
<title><?php echo $title; ?></title>
</head>

<body>
<?php

if ($this->input->cookie('valid_user'))
{
	echo "Welcome " . $this->input->cookie('valid_user', false) . "!<br>";
	$loggedIn = true;
	$display = 'class="logged-in"';
}
  
else
{
	echo "Welcome guest!<br>";
}
?>
<h1><a href="<?php echo $this->config->item('base_url'); ?>" title="<?php echo $this->config->item('site_name'); ?> "><?php echo $this->config->item('site_name'); ?></a></h1>

<ul>
	<li id="signup" <?php echo $display; ?> ><?php echo anchor('signup', 'Sign up for '.$this->config->item('site_name')); ?></li>
	<li id="login" <?php echo $display; ?> ><?php echo anchor('login', 'log in to '.$this->config->item('site_name')); ?></li>
	<li id="signout" <?php echo $display; ?> ><?php echo anchor('signout', 'log out of '.$this->config->item('site_name')); ?></li>
	<li id="myaccount" <?php echo $display; ?> ><?php echo anchor('myaccount', 'My Account'); ?></li>
	<li id="analysis" <?php echo $display; ?> ><?php echo anchor('analysis', 'Analysis'); ?></li>
	<li id="upload" <?php echo $display; ?> ><?php echo anchor('upload', 'Upload files'); ?></li>
</ul>
