<?php
	$uploadQty = count($fileinfo);
	$files = 'files were';
	if($uploadQty == 1) $files = 'file was'; //pet hate of mine using plural word with multiple numeral (1 files etc...)
?>
<h3><?php echo $uploadQty.' '.$files.' successfully uploaded!'; ?></h3>
<ol>
<?php 
	foreach($fileinfo as $filemeta)
	{
		//show the original filename (also remove the hashed prefix)
		echo '<li>'.substr($filemeta['orig_name'],34).'</li>';
	}
?>
</ol>
<p><?php echo anchor('upload', 'Upload more files'); ?></p>

