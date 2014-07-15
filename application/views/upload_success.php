
<h3>Your file was successfully uploaded!</h3>
<ul>
<?php foreach ($multi_upload_data[] as $fileinfo[]):?>
<li><?php echo $fileinfo['raw_name']; ?></li>
<?php endforeach; ?>
</ul>
<p><?php echo anchor('upload', 'Upload more files'); ?></p>

