<section class="section-ln">
	<h3>Login in to JoulePerSecond</h3>
	<div class="content-container login-form">
	<?php echo validation_errors(); ?>

	<?php echo form_open('login'); ?>

	<h5>Email</h5>
	<input type="email" name="email" value="<?php echo set_value('email'); ?>" size="50" />

	<h5>Password</h5>
	<input type="password" name="password" value="<?php echo set_value('password'); ?>" size="50" />
	<a href="<?php echo $this->config->item('base_url'); ?>index.php/forgottenpassword">Forgotten Password?</a>

	<div><button class="btn" type="submit">Login</button></div>

	</form>
</section>