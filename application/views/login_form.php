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
					data-width="wide"
					data-cookiepolicy="single_host_origin">
				</button>
				<button class="btn" id="disconnect" >Disconnect your Google account from this app</button>
				<!-- Textarea for outputting data -->
				<div id="response" class="hide">
					<textarea id="responseContainer" style="width:100%; height:150px"></textarea>
				</div>
		    </div>
		</div>

	</div>
</section>
<script>
/*function onSignInCallback(resp) {
	gapi.client.load('plus', 'v1', apiClientLoaded);
}


function apiClientLoaded() {
	gapi.client.plus.people.get({userId: 'me'}).execute(handleEmailResponse);
}


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
     * Calls the OAuth2 endpoint to disconnect the app for the user.
     */
    disconnect: function() {
      // Revoke the access token.
      $.ajax({
        type: 'GET',
        url: 'https://accounts.google.com/o/oauth2/revoke?token=' +
            gapi.auth.getToken().access_token,
        async: false,
        contentType: 'application/json',
        dataType: 'jsonp',
        success: function(result) {
          console.log('revoke response: ' + result);
          $('#gConnect').show();
        },
        error: function(e) {
          console.log(e);
        }
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
        jQuery.post("http://joulepersecond.com/index.php/sociallogin/", {email: primaryEmail, username: display_name })
		.done(function(data){
			window.location = "http://joulepersecond.com/index.php/myaccount";
		});

      }, function(err) {
        var error = err.result;
        console.log(error.message);
      });
    }
  };
})();
$(document).ready(function() {
  $('#disconnect').click(helper.disconnect);
});
function onSignInCallback(authResult) {
  helper.onSignInCallback(authResult);
}
</script>