<h3>Recent activities</h3>
<ul>
	<?php 
	foreach ($recentActivities as $activity) {
		$activityDate = date_create_from_format('Y-m-d H:i:s', $activity['activity_date']);
		echo '<li><a class="activity-link" href="http://'.$this->config->item('go_ip').'/'.$activity['activity_id'].'">'.date_format($activityDate, 'D, jS F Y').'</a></li>';
	}
	?>
</ul>
<iframe id="analysis-container" allowTransparency="true" scrolling="no"></iframe>
<script>
jQuery(document).ready(function(){
	jQuery('.activity-link').on('click', function(e){
		e.preventDefault();
		var url = jQuery(this).attr('href');
		jQuery('#analysis-container').attr('src', url);
		
	})
})

</script>