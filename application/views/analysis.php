<article  id="dashboard"></article>
<?php $uid = rc4($this->config->item('rc4_cypher'), get_user()); ?>
<?php $uid = ($uid != "") ? $uid : "unknown" ?>
<iframe id="analysis-container" allowTransparency="true" scrolling="no" src="http://joulepersecond.com:8080/analysis/<?php echo urlencode($uid).'/'; ?>"></iframe>

<?php
	if(isset($_COOKIE['theme'])){
	  $color = $_COOKIE['theme'];
	}else{
	  $color = 'gray';
	}
?>
<script>
  $('#dashboard').writeCapture().load("http://joulepersecond.com:8080/dashboard/<?php echo urlencode($uid).'/'.$color; ?>");
</script>