<div class="overview-page">
	<section class="col-1-2">
	<h2>Recent activities</h2>
		<ul class>
			<?php 
			foreach ($recentActivities as $activity) {
				$activityDate = date_create_from_format('Y-m-d H:i:s', $activity['activity_date']);
				echo '<li><a class="activity-link" href="http://'.$this->config->item('go_ip').'/view/activity/'.$activity['activity_id'].'">'.date_format($activityDate, 'D, jS F Y').'</a></li>';
			}
			?>
		</ul>
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
jQuery('iframe').load(function() {
    this.style.height =
    this.contentWindow.document.body.offsetHeight + 'px';
});

</script>