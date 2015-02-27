<?php session_start(); ?>
<?php $this->load->helper('url'); ?>
<?php $this->load->helper('cookie'); ?>
<?php $loggedIn = false; ?>
<?php $display = 'class="logged-out"'; ?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<!-- <link href='http://fonts.googleapis.com/css?family=Lato:100,300,400,700,100italic,300italic,400italic' rel='stylesheet' type='text/css'> -->
<link rel='stylesheet' href='<?php echo $this->config->item('base_url'); ?>css/style.css' type='text/css' media='all' />
<!-- Bootstrap -->
<link href="<?php echo $this->config->item('base_url'); ?>/bootstrap-3.3.2/css/bootstrap.min.css" rel="stylesheet">
<link rel='stylesheet' href='<?php echo $this->config->item('base_url'); ?>css/light.css' type='text/css' media='all' />
<link href="<?php echo $this->config->item('base_url'); ?>/bootstrap-3.3.2/css/bootstrap-theme.css" rel="stylesheet">

<link href="<?php echo $this->config->item('base_url'); ?>/js/calendar/css/dp_calendar.css" type="text/css" rel="stylesheet" />
<link href="<?php echo $this->config->item('base_url'); ?>/js/calendar/themes/ui-lightness/jquery.ui.all.css" type="text/css" rel="stylesheet" />
<link rel="stylesheet" href="<?php echo $this->config->item('base_url'); ?>/js/responsive-nav.js-master/responsive-nav.css">





<script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="//use.typekit.net/mbs5qua.js"></script>
<!-- jQuery --> 
<!-- <script src='js/jquery-1.5.2.min.js'></script> --> 
<!-- required plugins --> 
<script src="<?php echo $this->config->item('base_url'); ?>/js/calendar/ui/jquery.ui.core.js"></script> 
<script src="<?php echo $this->config->item('base_url'); ?>/js/calendar/ui/jquery.ui.position.js"></script> 
<script src="<?php echo $this->config->item('base_url'); ?>/js/calendar/ui/jquery.ui.datepicker.js"></script> 
<script src="<?php echo $this->config->item('base_url'); ?>/js/calendar/js/date.js"></script> 
<script src="<?php echo $this->config->item('base_url'); ?>/js/calendar/js/jquery.dp_calendar.js"></script>


<script src="https://apis.google.com/js/client:platform.js"></script>
<script src="<?php echo $this->config->item('base_url'); ?>/js/main.js"></script>
<script src="<?php echo $this->config->item('base_url'); ?>/bootstrap-3.3.2/js/bootstrap.min.js"></script>
<script src="<?php echo $this->config->item('base_url'); ?>/js/responsive-nav.js-master/responsive-nav.js"></script>




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
	<nav class="nav-collapse">
		<ul>
			<li id="home-nav-btn" style="background: url(<?php echo $this->config->item('base_url'); ?>images/logo-small.png) right center no-repeat #fff" id="home-btn" <?php echo $display; ?> ><?php echo anchor('/', 'JoulePerSecond.com');?></li>
			<li id="signup-mob" <?php echo $display; ?> ><a href="https://joulepersecond.com/index.php/login">Sign Up</a></li>
			<li id="login-mob" <?php echo $display; ?> ><a href="https://joulepersecond.com/index.php/login">Log In</a></li>
			<li id="upload-mob" <?php echo $display; ?> ><a href="http://joulepersecond.com/index.php/upload">Upload Files</a></li>
			<li id="activity-mob" <?php echo $display; ?> ><a href="http://joulepersecond.com/index.php/activity">Activity</a></li>
			<li id="analysis-mob" <?php echo $display; ?> ><a href="http://joulepersecond.com/index.php/analysis">Analysis</a></li>
			<li id="myaccount-mob" <?php echo $display; ?> ><a href="https://joulepersecond.com/index.php/myaccount">My Account</a></li>
			<li id="forum-mob" <?php echo $display; ?> ><?php echo anchor('forum', 'Forum'); ?></li>
			<!-- we coud do with hiding this button for google users -->
			<li id="signout" <?php echo $display; ?> >
				<?php if( $this->input->cookie('social_user') == 'no'): ?>
					<?php echo anchor('signout', 'log Out');?>
				<?php else: ?>
					<?php echo anchor('socialsignout', 'log Out');?>
				<?php endif; ?>
			</li>
		</ul>
	</nav>


	<div class="hdr-container">

		<a class="logo" href="<?php echo $this->config->item('base_url'); ?>" title="<?php echo $this->config->item('site_name'); ?>" style="background: url(<?php echo $this->config->item('base_url'); ?>images/logo-small.png) center; background-size:cover"></a> 
		<div class="jps"><a class="logo" href="<?php echo $this->config->item('base_url'); ?>" title="<?php echo $this->config->item('site_name'); ?>">JoulePerSecond <span>Beta</span></a></div>

		<?php if ($this->input->cookie('valid_user')): ?>
			<a class="user-img" href="<?php echo $this->config->item('base_url'); ?>" title="<?php echo $message; ?> " style="background: url(<?php echo $user_image; ?>) center; background-size:cover"></a> 
		<?php endif; ?>
	
		<nav class="top-nav col-1-1">
		<ul>
			<li id="signup" style="background-color:#FB4B02" <?php echo $display; ?> ><img class="menu-icon" src="<?php echo $this->config->item('base_url'); ?>images/icons/sign-up.png" alt="sign-up"/><a href="https://joulepersecond.com/index.php/login">Sign Up</a></li>
			<li id="login" <?php echo $display; ?> ><img class="menu-icon" src="<?php echo $this->config->item('base_url'); ?>images/icons/log-in.png" alt="log-in"/><a href="https://joulepersecond.com/index.php/login">Log In</a></li>
			<li id="upload" <?php echo $display; ?> ><img class="menu-icon" src="<?php echo $this->config->item('base_url'); ?>images/icons/upload.png" alt="upload"/><a href="http://joulepersecond.com/index.php/upload">Upload Files</a></li>
			<li id="activity" <?php echo $display; ?> ><img class="menu-icon" src="<?php echo $this->config->item('base_url'); ?>images/icons/activity.png" alt="activity"/><a href="http://joulepersecond.com/index.php/activity">Activity</a></li>
			<li id="analysis" <?php echo $display; ?> ><img class="menu-icon" src="<?php echo $this->config->item('base_url'); ?>images/icons/analysis.png" alt="analysis"/><a href="http://joulepersecond.com/index.php/analysis">Analysis</a></li>
			<li id="myaccount" <?php echo $display; ?> ><img class="menu-icon" src="<?php echo $this->config->item('base_url'); ?>images/icons/my-account.png" alt="my-account"/><a href="https://joulepersecond.com/index.php/myaccount">My Account</a></li>
			<li id="forum" <?php echo $display; ?> ><img class="menu-icon" src="<?php echo $this->config->item('base_url'); ?>images/icons/forum.png" alt="forum"/><?php echo anchor('forum', 'Forum'); ?></li>
			<!-- we coud do with hiding this button for google users -->
			<li id="signout" <?php echo $display; ?> >
				<img class="menu-icon" src="<?php echo $this->config->item('base_url'); ?>images/icons/log-out.png" alt="log-out"/>
				<?php if( $this->input->cookie('social_user') == 'no'): ?>
					<?php echo anchor('signout', 'Log Out');?>
				<?php else: ?>
					<?php echo anchor('socialsignout', 'Log Out');?>
				<?php endif; ?>
			</li>
		</ul>
		</nav>
	</div>

</header>

<main>
<div class="grid grid-pad">
