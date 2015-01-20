<section class="section-ln">
	<div class="col-1-2">
		
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
		</div>
	</div>

	<!--https://developers.google.com/+/web/people/ -->
	<div class="col-1-2">
		<h3>Or sign in using your Google account</h3>
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
<script>
function onSignInCallback(resp) {
	gapi.client.load('plus', 'v1', apiClientLoaded);
}

/**
* Sets up an API call after the Google API client loads.
*/
function apiClientLoaded() {
	gapi.client.plus.people.get({userId: 'me'}).execute(handleEmailResponse);
}

/**
* Response callback for when the API client receives a response.
*
* @param resp The API response object with the user email and profile information.
*/
function handleEmailResponse(resp) {
var primaryEmail;
var user_img = resp.image.url;
var display_name = resp.displayName;
	for (var i=0; i < resp.emails.length; i++) {
	  	if (resp.emails[i].type === 'account') primaryEmail = resp.emails[i].value;
	}
	document.getElementById('responseContainer').value = 'Primary email: ' + primaryEmail + '\n\nFull Response:\n' + JSON.stringify(resp);

	//this is the information we need
	console.log(primaryEmail, user_img, display_name);

	jQuery.post("http://joulepersecond.com/index.php/sociallogin/", {email: primaryEmail, username: display_name })
		.done(function(data){
			console.log(data);
			window.location = "http://joulepersecond.com/index.php/myaccount";
		});
	
}
</script>