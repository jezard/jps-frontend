
<section class="section-ln">
	<div class="col-1-2">
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
			</form>
		</div>
	</div>
	<!--https://developers.google.com/+/web/people/ -->
	<div class="col-1-2">
		<h3>Or sign up using your Google account</h3>
		<div class="content-container signup-form">
			<div id="gConnect" class="button">
				<button class="g-signin"
					data-scope="email"
					data-clientid="944557324013-bqebngtmsou4omlgb48us86g9brq9113.apps.googleusercontent.com"
					data-callback="onSignInCallback"
					data-theme="dark"
					data-cookiepolicy="single_host_origin">
				</button>
				<!-- Textarea for outputting data -->
				<div id="response" class="hide">
					<textarea id="responseContainer" style="width:100%; height:150px"></textarea>
				</div>
		    </div>
		</div>

	</div>
</section>

