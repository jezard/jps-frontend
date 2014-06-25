<?php $this->load->helper('url'); ?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<link href='http://fonts.googleapis.com/css?family=Lato:100,300,400,700,100italic,300italic,400italic' rel='stylesheet' type='text/css'>
<link rel='stylesheet' href='http://joulepersecond.com/css/style.css' type='text/css' media='all' />
<title><?php echo $title; ?></title>
</head>

<body>
<h1><a href="http://JoulePerSecond.com" title="JoulePerSecond.com">JoulePerSecond</a></h1>
<ul>
	<li><?php echo anchor('signup', 'Sign up for JoulePerSecond'); ?></li>
	<li><?php echo anchor('login', 'log in to JoulePerSecond'); ?></li>
	<li><?php echo anchor('myaccount', 'My Account'); ?></li>
	<li><?php echo anchor('analysis', 'Analysis'); ?></li>
	<li><?php echo anchor('upload', 'Upload files'); ?></li>
</ul>
