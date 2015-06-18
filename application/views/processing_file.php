

<!-- this is the static outer frame use to house the ajax parse progress window  -->
<section class="section-ln">
	<span class="warning"><strong>File processing:</strong> Do not navigate away during uploading and processing of files</span>
	<div class="content-container">
		<p><span class="note">Please be patient. We are now pre-processing your ride data into a format where it can be retrieved and read quickly and efficiently.<br>If file processing <em>fails</em>, sign out and back in again - some browsers do not store persistent cookies correctly under some circumstances. If this solves the issue,don't choose the remember me option at sign in.</span></p>
		<div id="parse-window">
			<!-- this is the dynamic inner section -->
			<div id="parse-progress">
				<!-- ajax content -->
			</div>
			<div id="parse-results"></div>
		</div>
	</div>
</section>
<script type="text/javascript">

//list of files, and progression
var files = [];
var progress = 0;
var totalfiles = 0;


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
			jQuery('#parse-results').html('<p>' + localStorage.getItem("joulepersecond.com/upload_status") + '</p>');
			localStorage.setItem("joulepersecond.com/upload_status", '');
		}
	});
	
}
getJobList();



function parseFiles(){
	var status
	console.log('parsing file: ' + files[0].filename);
	jQuery.post(<?php echo '"'.$this->config->item('base_url').'index.php/process/parse"'; ?>, {filename: files[0].filename,
																								filetype: files[0].filetype
	}, function(data){
		console.log(data);
		jQuery.ajax({
			url: "http://joulepersecond.com:8080/process/activity/" + data,
			xhrFields: {
		      withCredentials: true,
		      dataType: 'jsonp'
		   }
		}).done(function(){
			progress++;
			console.log('progress: ' + progress, 'files-length: ' + files.length);
			status = localStorage.getItem("joulepersecond.com/upload_status");
			if (status == null) status = '';
			localStorage.setItem("joulepersecond.com/upload_status", status + '<br>' + files[0].filename.slice(34) + ": Succeeded");
			files = [];
			getJobList();
		}).fail(function(){
			status = localStorage.getItem("joulepersecond.com/upload_status");
			if (status == null) status = '';
			localStorage.setItem("joulepersecond.com/upload_status",  status + '<br>' + files[0].filename.slice(34) + ": FAILED");
			progress++;
			files = [];
			getJobList();
			//remove failed entry from mysql
			jQuery.post(<?php echo '"'.$this->config->item('base_url').'index.php/process/failed"'; ?>, {filename: files[0].filename});
		});
		
	});
}

</script>
<p><?php //echo anchor('upload', 'Upload more files'); ?></p>
