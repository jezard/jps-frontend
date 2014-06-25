<?php $this->load->helper('url'); ?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title><?php echo $title; ?></title>
</head>

<body>
<h1><a href="http://JoulePerSecond.com" title="JoulePerSecond.com">JoulePerSecond</a></h1>
<ul>
	<li><?php echo anchor('signup', 'Sign up for JoulePerSecond'); ?></li>
	<li><a href="/login/" title="Login">Login</a></li>
	<li><?php echo anchor('upload', 'Upload files'); ?></li>
</ul>
