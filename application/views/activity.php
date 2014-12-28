<div class="overview-page">
	<section class="section-ln">
		<div class="col-1-2">
			<h3>Recent activities</h3>
			<div id="calendar"></div>
		</div>
		<div class="col-1-2 ride-basic">
			<h3>Basic ride info</h3>
			<?php echo form_open('activity'); ?>
				<input type="hidden" id="activity_id" name="activity_id" value="">
				<label for="activity_title">Start</label>
				<input id="activity_title" name="activity_title" type="text" />
				<button type="submit">Update</button>
			</form>
		</div>
	</section>
	<iframe id="activity-container" allowTransparency="true" scrolling="no"></iframe>
</div>

<script>
$(document).on("click", ".active", function(e){
	
	if(jQuery('#list h1').length == 1){
		var activity_id = jQuery('.calendar_list li p').text();

		//go to activity when clicking the calendar day
		var url = <?php echo '"http://'.$this->config->item('go_ip').'/view/activity/"'; ?> + activity_id;
		jQuery('#activity_id').val(activity_id);

		//get title/name of activity 
		jQuery.post( '<?php echo $this->config->item('base_url') .'index.php/activity/get'; ?>', { activity_id: activity_id }, function(data){
			jQuery('#activity_title').val(data);
		});

		jQuery('#activity-container').attr('src', url);
	}		
});


jQuery(document).ready(function(){

	//show all activities for day
	$(document).on("click", ".urgent", function(e){

		var activity_id = jQuery(this).find('p').text();
		var url = <?php echo '"http://'.$this->config->item('go_ip').'/view/activity/"'; ?> + activity_id;
		jQuery('#activity_id').val(activity_id);

		//get title/name of activity 
		jQuery.post( '<?php echo $this->config->item('base_url') .'index.php/activity/get'; ?>', { activity_id: activity_id }, function(data){
			jQuery('#activity_title').val(data);
		});

		jQuery('#ctivity-container').attr('src', url);
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

	

	jQuery("#calendar").dp_calendar({
		events_array: events_array,
	});



});



</script>