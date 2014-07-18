
<p><?php echo $message; ?></p>
<?php echo form_open_multipart('upload/do_upload');?>

<input type="file" name="powerfiles[]" size="20" multiple />

<br /><br />

<input type="submit" value="upload" />

</form>
