<h3>File processing in progress</h3>

<!-- this is the static outer frame use to house the ajax parse progress window  -->
<div id="parse-window">
	<!-- this is the dynamic inner section -->
	<div id="parse-progress">
		<!-- ajax content -->
	</div>
	<div id="parse-results"></div>
</div>
<script type="text/javascript">

//list of files, and progression
var files = [];
var progress = 0;
var totalfiles = 0;

//do a query from the database getting the list of files
function getJobList(){
	jQuery.getJSON(<?php echo '"'.$this->config->item('base_url').'index.php/process/joblist"'; ?>, function(result){
		jQuery.each(result, function(key, val){
			files.push(val);
		});

		//set the value of total files now before depletion - only set on the first iteration else progress bar total figure will be out
		if(progress == 0)
		{
			totalfiles = files.length;
		}

		//let the user know how many files are left to process
		jQuery('#parse-progress').html('<p class="backlog">Files left to process: [<span class="highlight">' + files.length + '</span>]</p><progress value="'+ progress + '" max="' + totalfiles + '"></progress>');
		
		//decide whether more files still need to be processed, or whether to end now
		if(files.length > 0)
		{
			//if an error stop execution
			if(progress > totalfiles){
				console.log('Error: Breaking ajax loop');
			}
			else
			{
				parseFiles();
			}
		}
		else
		{
			console.log('alls done');
		}
	});
}
getJobList();


function parseFiles(){
	console.log('parsing file: ' + files[0].filename);
	jQuery.post(<?php echo '"'.$this->config->item('base_url').'index.php/process/parse"'; ?>, {filename: files[0].filename,
																								filetype: files[0].filetype
	}, function(data){
		console.log(data);
		jQuery.ajax({
			url: "http://joulepersecond.com:8080/process/activity/" + data,
			xhrFields: {
		      withCredentials: true
		   }
		}).done(function(){
			progress++;
			console.log('progress: ' + progress, 'files-length: ' + files.length);
			files = [];
			getJobList();
		});
		
	});
}

</script>
<p><?php //echo anchor('upload', 'Upload more files'); ?></p>
