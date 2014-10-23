<div class="account-page">
<h2>This is the My Account page</h2>
<p>Page content</p>
<h2>Settings</h2>
	<?php echo form_open('myaccount'); ?>
		<h3>Data Cutoff</h3>
		<p>This setting determines how long the gap in the data should be before stopping analysis. The autofill settings determine what to record during this period.</p>
		<input type="text" name="set_data_cutoff" value="<?php echo set_value('set_data_cutoff', @$set_data_cutoff); ?>" size="3" />
		<h3>Data autofill</h3>
		<p>These settings allow the user to decide how to handle data which isn't recorded at a rate of once per second. We recommend you do not use features such as Garmin's Auto Pause and particularly <em>Smart Recording</em> which can skew the data. it is a good idea to play around with these settings to suit your equipment and acitivity style.</p>
		<ul>
			<li>Autofill [default]: this fills in missing sample data up until the setting Data Cutoff point is reached. This is a good option where equipment doesn't record at the rate of once per second, or where frequent dropouts occur</li>
			<li>SetZero: works well with systems like TrainerRoad or where data dropouts are infrequent and data is recorded once per second. Try setting Data Cutoff low for best results.</li>
			<li>Remove: This removes all missing data from the activity, if data is missing - not recorded at once per second some acitivity charts will become shorter.</li>
		</ul>
		<?php
			$options = array(
                  'autofill'  => 'Autofill',
                  'setzero'    => 'SetZero',
                  'remove'   => 'Remove',
                );
			echo form_dropdown('set_autofill', $options, set_value('set_autofill', @$set_autofill))
           	?>
		<div><input type="submit" value="Submit" /></div>
	</form>
</div>
