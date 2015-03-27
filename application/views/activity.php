<div class="overview-page">
	<section class="section-ln">
		<div class="col-1-2">
			<h3>Recent activities</h3>
			<div id="calendar"></div>
		</div>
		<div class="col-1-2 ride-basic">
			<h3>Basic ride info <date id="activity-date"></date></h3>
			<div class="basic-form">
			<?php echo form_open('activity', array('id' => 'frm_activity')); ?>
				<input type="hidden" id="activity_id" name="activity_id" value="">
				<label for="activity_title">Name:</label>
				<input id="activity_title" name="activity_title" type="text">
				<label for="activity_description">Notes:</label>
				<textarea id="activity_notes" rows="5" name="activity_notes"></textarea>
				<button class="btn-default" type="submit">Update</button>

				<!-- only for strava connected users -->
				<?php if($strava_user): ?>
				<input type="hidden" id="strava_upload" name="strava_upload" value="">
				<span class="strava-options">

					<!-- don't show buttons if uploading or uploaded to strava instead show link on strava -->
					<?php if(!$poll_strava): ?>
					<strong><em> OR </em></strong> 
					<button id="strava-it" class="btn-default">Update and save to <span style="color:#FB4B02; font-weight:bold; letter-spacing: -1px">STRAVA</span></button>
					<?php endif; ?>
					<div id="upload-status" style="display:none">
						<span id="status-text" class="note">Uploading activity to <span style="color:#FB4B02; font-weight:bold; letter-spacing: -1px">STRAVA</span></span>
					</div>
					

				</span>
				<?php endif; ?>

			</form>
			<?php echo form_open('activity/delete'); ?>
				<input type="hidden" id="activity_id2" name="activity_id" value="">
				<button class="btn-danger" type="submit">Delete Activity</button>
			</form>
			</div>
		</div>
	</section>
	<iframe id="activity-container" allowTransparency="true" scrolling="no"></iframe>
</div>

<script>
$(document).on("click", ".active", function(e){
	
	if(jQuery('#list h1').length == 1){
		var activity_id = jQuery('.calendar_list li p').text();
		localStorage.setItem("selectedDate", jQuery.fn.dp_calendar.getDate());
		//go to activity when clicking the calendar day
		var url = <?php echo '"http://'.$this->config->item('go_ip').'/view/activity/"'; ?> + activity_id;
		jQuery('#activity_id, #activity_id2').val(activity_id);

		//get title/name of activity 
		jQuery.post( '<?php echo $this->config->item('base_url') .'index.php/activity/get'; ?>', { activity_id: activity_id }, function(data){
			data_array = data.split('^');
			jQuery('#activity_title').val(data_array[0]);
			jQuery('#activity_notes').val(data_array[1]);
			jQuery('#activity-date').text(data_array[2]);
		});

		jQuery('#activity-container').attr('src', url);
	}		
});



jQuery(document).ready(function(){
	//direct user to most recent activity or just updated
	var filename;
	var activity_id = <?php echo '"'.$displayActivity.'"'; ?>;
	var url = <?php echo '"http://'.$this->config->item('go_ip').'/view/activity/"'; ?> + activity_id;
	jQuery('#activity_id, #activity_id2').val(activity_id);
	//get title/name of activity 
	jQuery.post( '<?php echo $this->config->item('base_url') .'index.php/activity/get'; ?>', { activity_id: activity_id }, function(data){
		data_array = data.split('^');
		jQuery('#activity_title').val(data_array[0]);
		jQuery('#activity_notes').val(data_array[1]);
		jQuery('#activity-date').text(data_array[2]);
		filename = data_array[3];

	});

	jQuery('#activity-container').attr('src', url);

	//send the form data to strava uploader before saving
	jQuery('#strava-it').on("click", function(e){
		e.preventDefault();
		var name = $('#activity_title').val();
		var desc = $('#activity_notes').val();

		$('#strava_upload').val('1');

		jQuery.post( '<?php echo $this->config->item('base_url') .'/strava/upload'; ?>', { name: name, description:desc, file: filename, activity_id: activity_id }, function(data){
			if(data == "error"){
				alert("There was an issue uploading to Strava, If the problem continues try reconnecting to Strava (Menu -> My Account)");
			}else{
				console.log(data);
				$('#upload-status').slideDown(500, function(){
					$( "#frm_activity" ).delay(500).submit();
				});
			}
			

		});
	});
	//still on the strava tip... 
	<?php if($poll_strava): ?>

	var interval;
	interval = setInterval(poll_strava, 5000);

	function poll_strava(){
		jQuery.post( '<?php echo $this->config->item('base_url') .'/strava/upload_status'; ?>', { activity_id: activity_id }, function(data){
			data_array = data.split('^');
			console.log(data);
			$('#upload-status').show();
			$('#status-text').html(data_array[0]);
			if(data_array[1] == 'failed' || data_array[1] == 'success'){
				clearInterval(interval);	
			}
		});
	}
	<?php endif; ?>


	//show all activities for day
	$(document).on("click", ".urgent", function(e){

		var activity_id = jQuery(this).find('p').text();

		localStorage.setItem("selectedDate", jQuery.fn.dp_calendar.getDate());

		var url = <?php echo '"http://'.$this->config->item('go_ip').'/view/activity/"'; ?> + activity_id;
		jQuery('#activity_id, #activity_id2').val(activity_id);

		//get title/name of activity 
		jQuery.post( '<?php echo $this->config->item('base_url') .'index.php/activity/get'; ?>', { activity_id: activity_id }, function(data){
			data_array = data.split('^');
			jQuery('#activity_title').val(data_array[0]);
			jQuery('#activity_notes').val(data_array[1]);
			jQuery('#activity-date').text(data_array[2]);
			filename = data_array[3];
		});
		jQuery('#activity-container').attr('src', url);
    });

	var events_array = new Array(
		<?php
			$html = '';

			foreach ($recentActivities as $activity) {

				$activityDate = date_create_from_format('Y-m-d H:i:s', $activity['activity_date']);
				$html .= '{
					startDate: new Date('.date_format($activityDate, 'Y, (n-1), j, G').'),
					endDate: new Date('.date_format($activityDate, 'Y, (n-1), j, G').'),
					//alternative method...
					/*startDate: new Date('.date_format($activityDate, 'Y').', '. (int)(date_format($activityDate, 'm')-1) .', '.date_format($activityDate, 'd, H, i, s').'),
					endDate: new Date('.date_format($activityDate, 'Y').', '. (int)(date_format($activityDate, 'm')-1) .', '.date_format($activityDate, 'd, H, i, s').'),*/
					title: "'.date_format($activityDate, 'H:i').' :: '.$activity['activity_name'].' view: &raquo;",
					description: "'.$activity['activity_id'].'"
					},';
			}
			$html = rtrim($html, ',');
			echo $html;
		?>
	);

	var d = new Date(localStorage.getItem("selectedDate"));
	var today = new Date();

	if(d.getFullYear() == '1970'){
		d = today;
	}

	jQuery("#calendar").dp_calendar({
		events_array: events_array,
		date_selected: d,
	});



});



</script>