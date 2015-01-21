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
		    
		    <button class="btn" id="justsignout" >Just log out of this app</button>
		    <button class="btn" id="disconnect" >Disconnect your Google account from this app ***</button>
		    <p>*** WARNING - this option deletes all data/activities associated with your account!!!</p>
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
          window.location = '/';//TODO sign out user (inc cookies etc.) and delete all records of user
        },
        error: function(e) {
          console.log(e);
        }
      });
    },

    signout:function(){
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