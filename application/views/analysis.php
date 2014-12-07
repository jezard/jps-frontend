<div class="overview-page">
	<section class="section-ln">
		<div class="col-1-2">
			<h2>Recent activities</h2>
			<ul class="recent-list">
				<?php
				echo '<li><a class="activity-link" href="http://joulepersecond.com:8080/view/range/">Range</a></li>';
				foreach ($recentActivities as $activity) {
					$activityDate = date_create_from_format('Y-m-d H:i:s', $activity['activity_date']);
					echo '<li><a class="activity-link" href="http://'.$this->config->item('go_ip').'/view/activity/'.$activity['activity_id'].'">'.date_format($activityDate, 'D, jS F Y').'</a></li>';
				}
				?>
			</ul>
			<h2>View older</h2>
			<p>Date calender widget</p>
		</div>
		<div class="col-1-2 top-update">
			<h2>Analyse your historical aggregated data</h2>
			<h3>For:</h3>
			<?php echo form_open('analysis'); ?>
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
		<p class="message neon-orange"><?php if(isset($message))echo $message; ?></p>

	</section>
	<iframe id="analysis-container" allowTransparency="true" scrolling="no"></iframe>
</div>

<script>
jQuery(document).ready(function(){
	jQuery('.activity-link').on('click', function(e){
		e.preventDefault();
		var url = jQuery(this).attr('href');
		jQuery('#analysis-container').attr('src', url);
	})
});


</script>