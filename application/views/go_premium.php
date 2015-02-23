<section class="section-ln">
	<h3>Upload files</h3>
	<div class="content-container upload-form">
		<p><span class="note">You seem to have used all of your activity upload credits. You are allocated <?php echo $activity_cap; ?> per rolling 28 day period</span></p>
		<h4><?php echo $message; ?></h4>
		<?php echo $this->config->item('subscribe_button'); ?>
	</div>
</section>
