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
<!-- Bootstrap -->
<link href="http://joulepersecond.com/bootstrap-3.3.2/css/bootstrap.min.css" rel="stylesheet">
<link rel='stylesheet' href='<?php echo $this->config->item('base_url'); ?>css/light.css' type='text/css' media='all' />
<link href="http://joulepersecond.com/bootstrap-3.3.2/css/bootstrap-theme.css" rel="stylesheet">


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


<script src="https://apis.google.com/js/client:platform.js"></script>
<script src="http://joulepersecond.com/js/main.js"></script>
<script src="http://joulepersecond.com/bootstrap-3.3.2/js/bootstrap.min.js"></script>




<script>try{Typekit.load();}catch(e){}</script>
<title><?php echo $title; ?></title>
</head>

<body>

<?php

	if ($this->input->cookie('valid_user'))
	{
		$message = "logged in as " . $this->input->cookie('valid_user', false);
		$loggedIn = true;
		$display = 'class="logged-in main-nav-item"';
	}
	  
	else
	{
		$message = "Welcome guest!<br>";
		$display = 'class="logged-out main-nav-item"';
	}
?>

<header class="site-header">

		<div class="hdr-container">

			<a class="logo" href="<?php echo $this->config->item('base_url'); ?>" title="<?php echo $this->config->item('site_name'); ?>" style="background: url(<?php echo $this->config->item('base_url'); ?>images/logo-small.png) center; background-size:cover"></a> 

			<?php if ($this->input->cookie('valid_user')): ?>
				<a class="user-img" href="<?php echo $this->config->item('base_url'); ?>" title="<?php echo $message; ?> " style="background: url(<?php echo $user_image; ?>) center; background-size:cover"></a> 
			<?php endif; ?>
		
			<nav class="top-nav col-1-1">
			<ul>
				<li id="signup" style="background-color:#FB4B02" <?php echo $display; ?> ><img class="menu-icon" src="<?php echo $this->config->item('base_url'); ?>images/icons/sign-up.png" alt="sign-up"/><?php echo anchor('signup', 'Sign up');?></li>
				<li id="login" <?php echo $display; ?> ><img class="menu-icon" src="<?php echo $this->config->item('base_url'); ?>images/icons/log-in.png" alt="log-in"/><?php echo anchor('login', 'Log in');?></li>
				<li id="upload" <?php echo $display; ?> ><img class="menu-icon" src="<?php echo $this->config->item('base_url'); ?>images/icons/upload.png" alt="upload"/><?php echo anchor('upload', 'Upload files'); ?></li>
				<li id="activity" <?php echo $display; ?> ><img class="menu-icon" src="<?php echo $this->config->item('base_url'); ?>images/icons/activity.png" alt="activity"/><?php echo anchor('activity', 'Activity'); ?></li>
				<li id="analysis" <?php echo $display; ?> ><img class="menu-icon" src="<?php echo $this->config->item('base_url'); ?>images/icons/analysis.png" alt="analysis"/><?php echo anchor('analysis', 'Analysis'); ?></li>
				<li id="myaccount" <?php echo $display; ?> ><img class="menu-icon" src="<?php echo $this->config->item('base_url'); ?>images/icons/my-account.png" alt="my-account"/><?php echo anchor('myaccount', 'My Account'); ?></li>
				<li id="forum" <?php echo $display; ?> ><img class="menu-icon" src="<?php echo $this->config->item('base_url'); ?>images/icons/forum.png" alt="forum"/><?php echo anchor('forum', 'Forum'); ?></li>
				<!-- we coud do with hiding this button for google users -->
				<li id="signout" <?php echo $display; ?> >
					<img class="menu-icon" src="<?php echo $this->config->item('base_url'); ?>images/icons/log-out.png" alt="log-out"/>
					<?php if( $this->input->cookie('social_user') == 'no'): ?>
						<?php echo anchor('signout', 'log out');?>
					<?php else: ?>
						<?php echo anchor('socialsignout', 'log out');?>
					<?php endif; ?>
				</li>
			</ul>
			</nav>
		</div>

</header>
<main>
<div class="grid grid-pad">
