<section class="section-ln">
	<h3>Sign up to JoulePerSecond!</h3>
	<div class="content-container signup-form">
		<?php echo validation_errors(); ?>

		<?php echo form_open('signup'); ?>
		*Required
		<label for="username">Username*</label>
		<input type="text" id="username" name="username" value="<?php echo set_value('username'); ?>" size="50" />

		<label for="email">Email Address*</label>
		<input type="email" id="email" name="email" value="<?php echo set_value('email'); ?>" size="50" />

		<label for="password">Password*</label>
		<input type="password" id="password" name="password" value="<?php echo set_value('password'); ?>" size="50" />

		<label for="passconf">Password Confirm*</label>
		<input type="password" id="passconf" name="passconf" value="<?php echo set_value('passconf'); ?>" size="50" />


		<div><button class="btn" type="submit">Sign up</button></div>
	</div>
	</form>
</section>