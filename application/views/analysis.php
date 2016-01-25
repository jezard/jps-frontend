<article  id="dashboard"></article>
<?php $access_token = (get_token() != "") ? get_token() : "unknown" ?>
<iframe id="analysis-container" allowTransparency="true" scrolling="no" src="http://joulepersecond.com:8080/analysis/<?php echo $access_token.'/'; ?>"></iframe>

<?php
	if(isset($_COOKIE['theme'])){
	  $color = $_COOKIE['theme'];
	}else{
	  $color = 'gray';
	}
?>
<script>
  $('#dashboard').writeCapture().load("http://joulepersecond.com:8080/dashboard/<?php echo $access_token.'/'.$color; ?>");
</script>