<html>
<head>
<title>Upload Form</title>
</head>
<body>

<p>Upload your .fit, .gpx, .tcx or .pwx files below (we recommend uploading in smaller batches):</p>

<?php echo form_open_multipart('upload/do_upload');?>

<input type="file" name="powerfiles[]" size="20" multiple />

<br /><br />

<input type="submit" value="upload" />

</form>

</body>
</html>
