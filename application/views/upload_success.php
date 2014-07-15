
<h3>Your file was successfully uploaded!</h3>
<?php
foreach($data as $fileinfo)
{
	 $filename =  $fileinfo['raw_name'];
	echo $filename.'<br>';
}
?>
<p><?php echo anchor('upload', 'Upload more files'); ?></p>

