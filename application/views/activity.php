<div class="overview-page">
	<section class="section-ln">
		<div class="col-1-2">
			<h3>Recent activities</h3>
			<div id="calendar"></div>
		</div>
		<div class="col-1-2 ride-basic">
			<h3>Basic ride info <date id="activity-date"></date></h3>
			<div class="basic-form">
			<?php echo form_open('activity'); ?>
				<input type="hidden" id="activity_id" name="activity_id" value="">
				<label for="activity_title">Name:</label>
				<input id="activity_title" name="activity_title" type="text">
				<label for="activity_description">Notes:</label>
				<textarea id="activity_notes" rows="5" name="activity_notes"></textarea>
				<button class="btn-default" type="submit">Update</button>
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
		jQuery('#activity_id').val(activity_id);

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
	var activity_id = <?php echo '"'.$displayActivity.'"'; ?>;
	var url = <?php echo '"http://'.$this->config->item('go_ip').'/view/activity/"'; ?> + activity_id;
	jQuery('#activity_id').val(activity_id);
	//get title/name of activity 
	jQuery.post( '<?php echo $this->config->item('base_url') .'index.php/activity/get'; ?>', { activity_id: activity_id }, function(data){
		data_array = data.split('^');
		jQuery('#activity_title').val(data_array[0]);
		jQuery('#activity_notes').val(data_array[1]);
		jQuery('#activity-date').text(data_array[2]);
	});

	jQuery('#activity-container').attr('src', url);

	//show all activities for day
	$(document).on("click", ".urgent", function(e){

		var activity_id = jQuery(this).find('p').text();

		localStorage.setItem("selectedDate", jQuery.fn.dp_calendar.getDate());

		var url = <?php echo '"http://'.$this->config->item('go_ip').'/view/activity/"'; ?> + activity_id;
		jQuery('#activity_id').val(activity_id);

		//get title/name of activity 
		jQuery.post( '<?php echo $this->config->item('base_url') .'index.php/activity/get'; ?>', { activity_id: activity_id }, function(data){
			data_array = data.split('^');
			jQuery('#activity_title').val(data_array[0]);
			jQuery('#activity_notes').val(data_array[1]);
			jQuery('#activity-date').text(data_array[2]);
		});

		jQuery('#activity-container').attr('src', url);
    });

	var events_array = new Array(
		<?php
			$html = '';

			foreach ($recentActivities as $activity) {

				$activityDate = date_create_from_format('Y-m-d H:i:s', $activity['activity_date']);
				$html .= '{
					startDate: new Date('.date_format($activityDate, 'Y, m-1, d, H, i O').'),
					endDate: new Date('.date_format($activityDate, 'Y, m-1, d, H, i O').'),
					title: "'.date_format($activityDate, 'H:i').' :: '.$activity['activity_name'].' view: &raquo;",
					description: "'.$activity['activity_id'].'"
					},';
			}
			$html = rtrim($html, ',');
			echo $html;
		?>
	);

	var d = new Date(localStorage.getItem("selectedDate"));

	jQuery("#calendar").dp_calendar({
		events_array: events_array,
		date_selected: d,
	});



});



</script>