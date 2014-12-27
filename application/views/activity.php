<div class="overview-page">
	<section class="section-ln">
		<div class="col-1-2">
			<h3>Recent activities</h3>
			<div id="calendar"></div>
		</div>
		Activity update form
		<!-- <div class="col-1-2 top-update">
			<h2>Analyse your historical aggregated data</h2>
			<h3>For:</h3>
			<?php echo form_open('activity'); ?>
				<input type="hidden" name="date-info" value="true">
				<div class="date-range-btns">
				<label for="week">Last Week</label>
				<input id="week" type="radio" name="history" name="group1" value="week" checked>
				<label for="month">Last month</label>
				<input id="month" type="radio" name="history" value="month">
				<label for="year">Last year</label>
				<input id="year" type="radio" name="history" value="year">
				<label for="drange">Date Range...</label>
				<input id="drange" type="radio" name="history" value="range">
				<div class="clear"></div>
				<div id="range-input">
					<p>Please enter start and end dates for range analysis (dd/mm/yy):</p>
					<label for="drange-start">Start</label>
					<input id="drange-start" name="drange-start" type="text" />
					<div class="clear"></div>
					<label for="drange-end">End</label>
					<input id="drange-end" name="drange-end" type="text" />
				<div>
				<button class="btn" type="submit">Analyze</button>
			</form>
		</div>
		<p class="message neon-orange"><?php if(isset($message))echo $message; ?></p> -->

	</section>
	<iframe id="activity-container" allowTransparency="true" scrolling="no"></iframe>
</div>

<script>
$(document).on("click", ".active", function(e){
	
	if(jQuery('#list h1').length == 1){
		var activity_id = jQuery('.calendar_list li p').text();

		//go to activity when clicking the calendar day
		var url = <?php echo '"http://'.$this->config->item('go_ip').'/view/activity/"'; ?> + activity_id;

		jQuery('#activity-container').attr('src', url);
	}		
});


jQuery(document).ready(function(){

	//show all activities for day
	$(document).on("click", ".urgent", function(e){

		var activity_id = jQuery(this).find('p').text();
		var url = <?php echo '"http://'.$this->config->item('go_ip').'/view/activity/"'; ?> + activity_id;

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