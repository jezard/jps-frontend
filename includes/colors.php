<?php
    header("Content-type: text/css; charset: UTF-8");
?>
<?php
	$gray_gradient = "background: #98989c; /* Old browsers */
		background: -moz-linear-gradient(top,  #98989c 0%, #76767a 100%, #76767a 101%); /* FF3.6+ */
		background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#98989c), color-stop(100%,#76767a), color-stop(101%,#76767a)); /* Chrome,Safari4+ */
		background: -webkit-linear-gradient(top,  #98989c 0%,#76767a 100%,#76767a 101%); /* Chrome10+,Safari5.1+ */
		background: -o-linear-gradient(top,  #98989c 0%,#76767a 100%,#76767a 101%); /* Opera 11.10+ */
		background: -ms-linear-gradient(top,  #98989c 0%,#76767a 100%,#76767a 101%); /* IE10+ */
		background: linear-gradient(to bottom,  #98989c 0%,#76767a 100%,#76767a 101%); /* W3C */
		filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#98989c', endColorstr='#76767a',GradientType=0 ); /* IE6-9 */";

	$red_gradient ="background: #d90000; /* Old browsers */
		background: -moz-linear-gradient(top,  #d90000 0%, #c10000 100%); /* FF3.6+ */
		background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#d90000), color-stop(100%,#c10000)); /* Chrome,Safari4+ */
		background: -webkit-linear-gradient(top,  #d90000 0%,#c10000 100%); /* Chrome10+,Safari5.1+ */
		background: -o-linear-gradient(top,  #d90000 0%,#c10000 100%); /* Opera 11.10+ */
		background: -ms-linear-gradient(top,  #d90000 0%,#c10000 100%); /* IE10+ */
		background: linear-gradient(to bottom,  #d90000 0%,#c10000 100%); /* W3C */
		filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#d90000', endColorstr='#c10000',GradientType=0 ); /* IE6-9 */";

	$green_gradient = "background: #6dd300; /* Old browsers */
		background: -moz-linear-gradient(top,  #6dd300 0%, #5eb300 100%); /* FF3.6+ */
		background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#6dd300), color-stop(100%,#5eb300)); /* Chrome,Safari4+ */
		background: -webkit-linear-gradient(top,  #6dd300 0%,#5eb300 100%); /* Chrome10+,Safari5.1+ */
		background: -o-linear-gradient(top,  #6dd300 0%,#5eb300 100%); /* Opera 11.10+ */
		background: -ms-linear-gradient(top,  #6dd300 0%,#5eb300 100%); /* IE10+ */
		background: linear-gradient(to bottom,  #6dd300 0%,#5eb300 100%); /* W3C */
		filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#6dd300', endColorstr='#5eb300',GradientType=0 ); /* IE6-9 */";

	$dark_green_gradient ="background: #417c00; /* Old browsers */
		background: -moz-linear-gradient(top,  #417c00 0%, #396c00 100%); /* FF3.6+ */
		background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#417c00), color-stop(100%,#396c00)); /* Chrome,Safari4+ */
		background: -webkit-linear-gradient(top,  #417c00 0%,#396c00 100%); /* Chrome10+,Safari5.1+ */
		background: -o-linear-gradient(top,  #417c00 0%,#396c00 100%); /* Opera 11.10+ */
		background: -ms-linear-gradient(top,  #417c00 0%,#396c00 100%); /* IE10+ */
		background: linear-gradient(to bottom,  #417c00 0%,#396c00 100%); /* W3C */
		filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#417c00', endColorstr='#396c00',GradientType=0 ); /* IE6-9 */";

	$orange_gradient = "background: #fb4b02;
		background: -moz-linear-gradient(top, #fb4b02 0%, #db4000 100%);
		background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#fb4b02), color-stop(100%,#db4000));
		background: -webkit-linear-gradient(top, #fb4b02 0%,#db4000 100%);
		background: -o-linear-gradient(top, #fb4b02 0%,#db4000 100%);
		background: -ms-linear-gradient(top, #fb4b02 0%,#db4000 100%);
		background: linear-gradient(to bottom, #fb4b02 0%,#db4000 100%);
		filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#fb4b02', endColorstr='#db4000',GradientType=0 );";

?>

<?php 
	if(isset($_COOKIE['theme'])){
		$color = $_COOKIE['theme'];
	}else{
		$color = 'gray';
	}
?>


<?php if($color == 'green'): ?>
	body{
		background: url(/images/bg-img.jpg) fixed #ccc; background-size:cover;
	}
	h1.primary-heading{
		color:white;
		text-shadow: 0 -1px #0d0d0d;
	}
	#home-nav-btn{
		background: url(/images/logo-small.png) right center no-repeat #fff;
	}
	.logo-img{
		background: url(/images/logo-small.png) center; background-size:cover;
	}
	.section-ln {
		border: 1px #ddd solid;
		background-color: #f5f5f5;
	}
	table, .chart, #calendar, .basic-form, .forum-container, .content-container {
		/*background-color: #f9f9f9;*/
	}
	table, .chart, #calendar, .basic-form, .forum-container, .content-container{
		color: #666;
		/*border: 1px #fff solid;*/
	}
	nav.top-nav li:hover{
		<?php echo $orange_gradient; ?>
	}
	.hdr-container{
		<?php echo $green_gradient; ?>

	}
	nav.top-nav li{
		border: 1px solid #5EB300;
		<?php echo $dark_green_gradient; ?>

	}

	/*h3::after{
		background: url(/images/arrow_down.png);
	}*/
	progress[value]::-webkit-progress-value {
	  background-image:
		   -webkit-linear-gradient(top,  #6dd300 0%,#5eb300 100%);
	}
	progress[value]::-moz-progress-bar { 
	  background-image:
		   -moz-linear-gradient(top,  #6dd300 0%,#5eb300 100%);
	}
	.m-header {
		background-color: #5EB300!important;
	}
	.jps-em span:nth-of-type(1){
		color:#fb4b02;
	}
	.warning{
		<?php echo $orange_gradient; ?>
	}
	a, a:visited, a:active {
		color:#fb4b02;
	}
	.btn-red{
		<?php echo $orange_gradient; ?>
	}
	.dp_calendar .div_dates li.has_events {
		<?php echo $orange_gradient; ?>
	}
	.dp_calendar .calendar_list #list li {
		<?php echo $green_gradient; ?>
	}
	.footer-links-text li a{
		color:#6dd300;
	}
	.footer-links-text-right li a{
		color:#fb4b02;
	}
	.intro{
		color:white;
	}
	.fp-ride{
		background-image:url(/images/fp-icons/ride-wht.png);
	}
	.fp-upload{
		background-image:url(/images/fp-icons/upload-wht.png);
	}
	.fp-engage{
		background-image:url(/images/fp-icons/engage-wht.png);
	}
	.fp-learn{
		background-image:url(/images/fp-icons/learn-wht.png);
	}
	.fp-develop{
		background-image:url(/images/fp-icons/develop-wht.png);
	}
	.signup-cta{
		<?php echo $orange_gradient; ?>
	}
	.signup-cta a{
		color:white;
	}
	#home-nav-btn a {
		color: #fb4b02;
	}
	.nav-toggle {
	  	background: url(/images/icons/menu.png) no-repeat 5px center #fff;
	}
	#filter-update .default-btn{
		color: #fb4b02;
	}



}

<?php endif; ?>
<?php if($color == 'gray'): ?>
	body{
		/*background: url(/images/GridBg.png) #DFDFE1 fixed;*/
		background: rgb(255,255,255); /* Old browsers */
	}

	#home-nav-btn{
		background: url(/images/logo-small-gray.png) right center no-repeat #000;
	}
	.logo-img{
		background: url(/images/logo-small-gray.png) center; background-size:cover;
	}
	table, .chart, #calendar, .basic-form, .forum-container, .content-container {
		/*background-color: #F3F3F3;
	}
	table, .chart, #calendar, .basic-form, .forum-container, .content-container{
		color: #666;
		/*border: 1px #fff solid;*/
	}
	nav.top-nav li:hover{

	}
	.hdr-container{
		<?php echo $gray_gradient; ?>

	}
	nav.top-nav li{
		border: 1px solid #BA3801;
		<?php echo $red_gradient; ?>

	}


	progress[value]::-webkit-progress-value {
	  background-image:
		   -webkit-linear-gradient(top,  #6dd300 0%,#5eb300 100%);
	}
	progress[value]::-moz-progress-bar { 
	  background-image:
		   -moz-linear-gradient(top,  #6dd300 0%,#5eb300 100%);
	}
	.m-header {
		background-color: #d90000!important;
	}
	.jps-em span:nth-of-type(1){
		color:#d90000;
	}
	.warning{
		<?php echo $red_gradient; ?>
	}
	a, a:visited, a:active {
		color:#d90000;
	}
	.btn-red{
		<?php echo $red_gradient; ?>
	}
	.dp_calendar .div_dates li.has_events {
		<?php echo $red_gradient; ?>
	}
	.dp_calendar .calendar_list #list li {
		<?php echo $gray_gradient; ?>
	}

	.fp-ride{
		background-image:url(/images/fp-icons/ride-red.png);
	}
	.fp-upload{
		background-image:url(/images/fp-icons/upload-red.png);
	}
	.fp-engage{
		background-image:url(/images/fp-icons/engage-red.png);
	}
	.fp-learn{
		background-image:url(/images/fp-icons/learn-red.png);
	}
	.fp-develop{
		background-image:url(/images/fp-icons/develop-red.png);
	}
	.signup-cta{
		<?php echo $red_gradient; ?>
	}
	.signup-cta a{
		color:white;
	}
	#home-nav-btn a {
		color: #d90000;
	}
	.nav-toggle {
	  	background: url(/images/icons/menu.png) no-repeat 5px center #d90000;
	}
	#filter-update .default-btn{
		color: #d90000;
	}

}

<?php endif; ?>