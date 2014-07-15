<?php
	$uploadQty = count($fileinfo);
	$files = 'files were';
	if($uploadQty == 1) $files = 'file was'; //pet hate of mine using plural word with multiple numeral (1 files etc...)
?>
<h3><?php echo $uploadQty.' '.$files.' successfully uploaded!'; ?></h3>
<ul>
<?php 
	foreach($fileinfo as $filemeta)
	{
		echo '<li>'.$fileinfo['raw_name'].'</li>'
	}
?>
</ul>
<p><?php echo anchor('upload', 'Upload more files'); ?></p>

