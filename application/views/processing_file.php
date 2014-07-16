<h3>File processing in progress</h3>

<!-- this is the static outer frame use to house the ajax parse progress window  -->
<div id="parse-window">
	<!-- this is the dynamic inner section -->
	<div id="parse-progress">
		<!-- ajax content -->
	</div>
</div>
<script type="text/javascript">
//do a query from the database getting the list of files
jQuery.getJSON(<?php echo '"'.$this->config->item('base_url').'index.php/process/joblist"'; ?>, function(result){
	var files = [];
	jQuery.each(result, function(key, val){
		files.push(val);
	});
	jQuery('#parse-window').html('<p class="backlog">Files left to process: [<span class="highlight">' + files.length + '</span>]</p>');
});

//get a count and show number or files to process

//for each file

/*****PHP*******/

//read the contents of the file

//parse contents of file

//write contents of file to database

//delete file

//return done

/******JS******/

//show done

</script>
<p><?php //echo anchor('upload', 'Upload more files'); ?></p>