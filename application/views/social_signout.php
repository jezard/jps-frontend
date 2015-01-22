<section class="section-ln">
	<h3>Log out / Revoke access</h3>
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
		    
		    <button class="btn-default" id="justsignout" >Just log out of JoulePerSecond (Recommended)</button><br>
		    <button class="btn-danger" id="disconnect" >Disconnect your Google account from JoulePerSecond ***</button>
		    <p>*** WARNING - this option deletes all data/activities associated with your account!!!</p>
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
			gapi.client.load('plus', 'v1').then(function() {
				if (authResult['access_token']) {
					$('#gConnect').hide();
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
			if (confirm('Remove all data related to your account? This action is not reversable!')) {
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
						//jQuery.get
						window.location = '/'; //TODO sign out user (inc cookies etc.) and delete all records of user
					},
					error: function(e) {
						console.log(e);
					}
				});
			}
		},

		signout: function() {
			gapi.auth.signOut();
			window.location = '/index.php/login';
		}
	};
})();
$(document).ready(function() {
	$('#disconnect').click(helper.disconnect);
	$('#justsignout').click(helper.signout);
});

function onSignInCallback(authResult) {
	helper.onSignInCallback(authResult);
}
</script>