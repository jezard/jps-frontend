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
        <?php if(isset($message)): ?>
          <span class="warning"><?php echo @$message; ?></span>
        <?php endif; ?>
				<a href="<?php echo $this->config->item('base_url'); ?>index.php/forgottenpassword">Forgotten Password?</a>

				<div><button class="btn-default" type="submit">Login</button></div>

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
		    </div>
		</div>

	</div>
</section>
<script>
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
        jQuery.post("<?php echo $this->config->item('base_url'); ?>/sociallogin/", {email: primaryEmail, username: display_name })
		.done(function(data){
			window.location = "<?php echo $this->config->item('base_url'); ?>/index.php/myaccount";
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