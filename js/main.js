$(function () {
	jQuery('.main-nav-item').each(function(){
		var anchor = jQuery(this).find('a').attr('href');
		jQuery(this).css('cursor','pointer').on('click',function(){
			window.location = anchor;
		});
	})
});
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

	jQuery.post("http://joulepersecond.com/index.php/socialsignup/", {username: display_name, email: primaryEmail })
		.done(function(data){
			console.log(data);
			window.location = "http://joulepersecond.com/index.php/login";
		});
}

