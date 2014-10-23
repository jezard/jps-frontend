<div class="account-page">
	<div class="col-1">
		<h1>My Account</h1>
		<h2>Settings</h2>
	</div>
	<div class="clear"></div>
	<?php echo form_open('myaccount'); ?>
		<section class="col-1-2">
			<h3>Data Cutoff</h3>
			<p>This setting determines how long the gap in the data should be before stopping analysis. The autofill settings determine what to record during this period. Default value is 15 Seconds</p>
		</section>
		<section class="col-1-2">
			<div id="range" class="neon-blue"><?php echo set_value('set_data_cutoff', @$set_data_cutoff); ?> Seconds</div>
			<input type="range" name="set_data_cutoff" min="3" max="150" value="<?php echo set_value('set_data_cutoff', @$set_data_cutoff); ?>"  onchange="showValue(this.value)" />
		</section>
		<div class="clear"></div>
		<hr>
		<section class="col-1-2">
			<h3>Data autofill</h3> 
			<p>These settings allow the user to decide how to handle data which isn't recorded at a rate of once per second. We recommend you do not use features such as Garmin's Auto Pause and particularly <em>Smart Recording</em> which can skew your data. It is a good idea to play around with these settings to suit your equipment and acitivity style.</p>
		</section>

		<section class="col-1-2">
			<h3>&nbsp;</h3>
			<ul>
				<li><span class="neon-blue">Autofill</span> (default): this fills in missing sample data up until the setting Data Cutoff point is reached. This is a good option where equipment doesn't record at the rate of once per second, or where frequent dropouts occur</li>
				<li><span class="neon-blue">SetZero</span>: works well with systems like TrainerRoad or where data dropouts are infrequent and data is recorded once per second. Try setting Data Cutoff low for best results.</li>
				<li><span class="neon-blue">Remove</span>: This removes all missing data from the activity, if data is missing - not recorded at once per second some acitivity charts will become shorter.</li>
			</ul>
			<?php
				$options = array(
	                  'autofill'  => 'Autofill',
	                  'setzero'    => 'SetZero',
	                  'remove'   => 'Remove',
	                );
				echo form_dropdown('set_autofill', $options, set_value('set_autofill', @$set_autofill))
	           	?>
		</section>
		<div class="clear"></div>
		<hr>
		<div class="col-1-1"><button class="btn" type="submit">Update Settings</button></div>
	</form>
</div>
<script>
	function showValue(newValue){
		document.getElementById("range").innerHTML=newValue + " Seconds";
	}
</script>
