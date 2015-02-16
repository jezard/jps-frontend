<section class="section-ln">
	<h3>Upload files</h3>
	<div class="content-container upload-form">
		<p><?php echo $message; ?></p>
		<?php echo form_open_multipart('upload/do_upload');?>

		<input type="file" name="powerfiles[]" size="20" multiple />

		<br /><br />

		<button class="btn-default" type="submit">Upload</button>

		</form>
	</div>
	<span class="warning"><strong>Important Note:</strong> Do not navigate away during uploading and processing of files</span>
</section>
