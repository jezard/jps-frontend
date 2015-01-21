
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
					data-width="wide"
					data-cookiepolicy="single_host_origin">
				</button>
		    </div>
		</div>

	</div>
</section>
<script>
/*function onSignUpCallback(resp) {
	gapi.client.load('plus', 'v1', apiClientLoaded);
}


function apiClientLoaded() {
	gapi.client.plus.people.get({userId: 'me'}).execute(handleEmailResponse);
}

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
							my_lastname: familyName,
							my_portrait: user_img
		})
		.done(function(data){
			console.log(data);
			window.location = "http://joulepersecond.com/index.php/login";
		});
}*/


var helper = (function() {
  var BASE_API_PATH = 'plus/v1/';

  return {
    /**
     * Hides the sign in button and starts the post-authorization operations.
     *
     * @param {Object} authResult An Object which contains the access token and
     *   other authentication information.
     */
    onSignInCallback: function(authResult) {
      gapi.client.load('plus','v1').then(function() {
        if (authResult['access_token']) {
          $('#gConnect').hide();
          helper.profile();
        } else if (authResult['error']) {
          // There was an error, which means the user is not signed in.
          // As an example, you can handle by writing to the console:
          console.log('There was an error: ' + authResult['error']);
          $('#gConnect').show();
        }
        console.log('authResult', authResult);
      });
    },

    /**
     * Gets and renders the currently signed in user's profile data.
     */
    profile: function(){
      var primaryEmail;
      gapi.client.plus.people.get({
        'userId': 'me'
      }).then(function(res) {

        var profile = res.result;
        var user_img = profile.image.url;
        var display_name = profile.displayName;
        var givenName = profile.name.givenName;
        var familyName = profile.name.familyName;
        for (var i=0; i < profile.emails.length; i++) {
		  	if (profile.emails[i].type === 'account') primaryEmail = profile.emails[i].value;
		}
		jQuery.post("http://joulepersecond.com/index.php/socialsignup/", {
							username: display_name, 
							email: primaryEmail,
							my_firstname: givenName,
							my_lastname: familyName,
							my_portrait: user_img
		})
		.done(function(data){
			console.log(data);
			window.location = "http://joulepersecond.com/index.php/login";
		});

      }, function(err) {
        var error = err.result;
        console.log(error.message);
      });
    }
  };
})();

function onSignInCallback(authResult) {
  helper.onSignInCallback(authResult);
}

</script>