<?php
	$uploadQty = count($fileinfo);
	$files = 'files were';
	if($uploadQty == 1) $files = 'file was'; //pet hate of mine using plural word with multiple numeral (1 files etc...)
?>
<section class="section-ln">
	<h3><?php echo $uploadQty.' '.$files.' successfully uploaded!'; ?></h3>
	<div class="content-container upload-form">
	<ol>
	<?php 
		foreach($fileinfo as $filemeta)
		{
			//show the original filename (also remove the hashed prefix)
			echo '<li>'.substr($filemeta['orig_name'],34).'</li>';
		}
	?>
	</ol>
	<?php
	/*
	$this->load->helper(array('url'));
	redirect('/process', 'refresh');
	*/
	?>
	<p class="wait"><?php echo anchor('process', 'Preparing to process your files. Click here if nothing happens within 5 seconds');?></p>
</section>
<script type="text/javascript">
	var link = jQuery('.wait a').attr('href');
	setTimeout(function(){window.location.href=link}, 1000)
</script>

