<h3>File processing in progress</h3>

<!-- this is the static outer frame use to house the ajax parse progress window  -->
<div id="parse-window">
	<!-- this is the dynamic inner section -->
	<div id="parse-progress">
		<!-- ajax content -->
	</div>
</div>
<script type="text/javascript">

//list of files, and progression
var files = [];
var progress = 0;

//do a query from the database getting the list of files
jQuery.getJSON(<?php echo '"'.$this->config->item('base_url').'index.php/process/joblist"'; ?>, function(result){
	jQuery.each(result, function(key, val){
		files.push(val);
	});
	//let the user know how many files are left to process
	jQuery('#parse-window').html('<p class="backlog">Files left to process: [<span class="highlight">' + files.length + '</span>]</p><progress value="'+ progress + '" max="' + files.length + '"</progress>');
	
	//decide whether more files still need to be processed, or whether to end now
	if(progress < files.length)
	{
		parseFiles();
	}
	else
	{
		console.log('alls done');
	}
});


function parseFiles(){
	console.log('parsing file: ' + files[progress].filename);
	jQuery.post(<?php echo '"'.$this->config->item('base_url').'index.php/process/parse"'; ?>, {filename: files[progress].filename,
																								filetype: files[progress].filetype
	}, function(data){
		console.log(data);
	});
	progress++;
}
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