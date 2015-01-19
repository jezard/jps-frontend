
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
					data-callback="onSignUpCallback"
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
function onSignUpCallback(resp) {
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
var familyName = resp.name.familyName;
var givenName = resp.name.givenName;

	for (var i=0; i < resp.emails.length; i++) {
	  	if (resp.emails[i].type === 'account') primaryEmail = resp.emails[i].value;
	}
	document.getElementById('responseContainer').value = 'Primary email: ' + primaryEmail + '\n\nFull Response:\n' + JSON.stringify(resp);

	//this is the information we need
	console.log(primaryEmail, user_img, display_name, familyName, givenName);

	jQuery.post("http://joulepersecond.com/index.php/socialsignup/", {
							username: display_name, 
							email: primaryEmail,
							my_firstname: givenName,
							my_lastname: familyName
		})
		.done(function(data){
			console.log(data);
			window.location = "http://joulepersecond.com/index.php/login";
		});
}
</script>