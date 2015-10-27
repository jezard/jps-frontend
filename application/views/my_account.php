<?php 

	$standard_ride = '

	<div class="standard-ride-container">
		<label>Ride Label:</label>
		<input type="text" name="ride_label[]" value="" maxlength="50" size="50" placeholder="e.g. TrainerRoad Z2 &amp; 4 Sweet Spot (1:04)" >
		<select name="in_or_out[]">
			<option value="in">Indoor / Trainer</option>
			<option value="out">Outdoor / Road</option>
		</select>
		<select name="race_or_train[]">
			<option value="race">Race</option>
			<option value="train">Training ride</option>
		<select>
		<div class="delete-standard-ride">Remove filter [x]</div>
	</div>

'; ?>
<div id="add-me" style="display:none">
	<?php echo $standard_ride; ?>
</div>



<div class="account-page">
	<?php echo form_open('myaccount'); ?>
		
		<section class="account-settings">
			<div class="section-ln">
				<?php if($user_set == 0): ?>
					<div class="warning"><strong>Note:</strong> Users must update their settings before uploading files</div>
				<?php endif; ?>
				<div class="col-1-2">
					<h1>Account settings</h1>
				</div>
				
				<div class="clear"></div>
				<div class="col-1-2 about-me">
					<h3>About me</h3>
					<div class="basic-form">
						<label for="my_firstname">First name*:</label>
						<input type="text" id="my_firstname" name="my_firstname" value="<?php echo set_value('my_firstname', @$my_firstname); ?>" maxlength="50" size="20" placeholder="First name" ><br>
						<label for="my_lastname">Last name*:</label>
						<input type="text" id="my_lastname" name="my_lastname" value="<?php echo set_value('my_lastname', @$my_lastname); ?>" maxlength="50" size="20" placeholder="Last name" ><br>
						<label for="my_age">Age (years)*:</label>
						<input type="number" id="my_age" name="my_age" value="<?php echo set_value('my_age', @$my_age); ?>" maxlength="3" size="3" placeholder="Age" max="120" min="5" ><br>
						<label for="my_weight">Weight (Kg)*:</label>
						<input type="number" id="my_weight" name="my_weight" value="<?php echo set_value('my_weight', @$my_weight); ?>" maxlength="3" size="3" placeholder="Kg" max="150" min="30" ><br>
						<label for="my_gender">Gender:</label>
						<?php
							$options = array(
				                  'male'  => 'Male',
				                  'female'    => 'Female',
				                );
							echo form_dropdown('my_gender', $options, set_value('my_gender', @$my_gender), 'id="my-gender"')
				        ?><br>
				        <label for="my_location">Location:</label>
				        <?php
							$countries = array(
							  "NONE" => "Please Select...",
							  "AU" => "Australia",
							  "AF" => "Afghanistan",
							  "AL" => "Albania",
							  "DZ" => "Algeria",
							  "AS" => "American Samoa",
							  "AD" => "Andorra",
							  "AO" => "Angola",
							  "AI" => "Anguilla",
							  "AQ" => "Antarctica",
							  "AG" => "Antigua & Barbuda",
							  "AR" => "Argentina",
							  "AM" => "Armenia",
							  "AW" => "Aruba",
							  "AT" => "Austria",
							  "AZ" => "Azerbaijan",
							  "BS" => "Bahamas",
							  "BH" => "Bahrain",
							  "BD" => "Bangladesh",
							  "BB" => "Barbados",
							  "BY" => "Belarus",
							  "BE" => "Belgium",
							  "BZ" => "Belize",
							  "BJ" => "Benin",
							  "BM" => "Bermuda",
							  "BT" => "Bhutan",
							  "BO" => "Bolivia",
							  "BA" => "Bosnia/Hercegovina",
							  "BW" => "Botswana",
							  "BV" => "Bouvet Island",
							  "BR" => "Brazil",
							  "IO" => "British Indian Ocean Territory",
							  "BN" => "Brunei Darussalam",
							  "BG" => "Bulgaria",
							  "BF" => "Burkina Faso",
							  "BI" => "Burundi",
							  "KH" => "Cambodia",
							  "CM" => "Cameroon",
							  "CA" => "Canada",
							  "CV" => "Cape Verde",
							  "KY" => "Cayman Is",
							  "CF" => "Central African Republic",
							  "TD" => "Chad",
							  "CL" => "Chile",
							  "CN" => "China, People's Republic of",
							  "CX" => "Christmas Island",
							  "CC" => "Cocos Islands",
							  "CO" => "Colombia",
							  "KM" => "Comoros",
							  "CG" => "Congo",
							  "CD" => "Congo, Democratic Republic",
							  "CK" => "Cook Islands",
							  "CR" => "Costa Rica",
							  "CI" => "Cote d'Ivoire",
							  "HR" => "Croatia",
							  "CU" => "Cuba",
							  "CY" => "Cyprus",
							  "CZ" => "Czech Republic",
							  "DK" => "Denmark",
							  "DJ" => "Djibouti",
							  "DM" => "Dominica",
							  "DO" => "Dominican Republic",
							  "TP" => "East Timor",
							  "EC" => "Ecuador",
							  "EG" => "Egypt",
							  "SV" => "El Salvador",
							  "GQ" => "Equatorial Guinea",
							  "ER" => "Eritrea",
							  "EE" => "Estonia",
							  "ET" => "Ethiopia",
							  "FK" => "Falkland Islands",
							  "FO" => "Faroe Islands",
							  "FJ" => "Fiji",
							  "FI" => "Finland",
							  "FR" => "France",
							  "FX" => "France, Metropolitan",
							  "GF" => "French Guiana",
							  "PF" => "French Polynesia",
							  "TF" => "French South Territories",
							  "GA" => "Gabon",
							  "GM" => "Gambia",
							  "GE" => "Georgia",
							  "DE" => "Germany",
							  "GH" => "Ghana",
							  "GI" => "Gibraltar",
							  "GR" => "Greece",
							  "GL" => "Greenland",
							  "GD" => "Grenada",
							  "GP" => "Guadeloupe",
							  "GU" => "Guam",
							  "GT" => "Guatemala",
							  "GN" => "Guinea",
							  "GW" => "Guinea-Bissau",
							  "GY" => "Guyana",
							  "HT" => "Haiti",
							  "HM" => "Heard Island And Mcdonald Island",
							  "HN" => "Honduras",
							  "HK" => "Hong Kong",
							  "HU" => "Hungary",
							  "IS" => "Iceland",
							  "IN" => "India",
							  "ID" => "Indonesia",
							  "IR" => "Iran",
							  "IQ" => "Iraq",
							  "IE" => "Ireland",
							  "IL" => "Israel",
							  "IT" => "Italy",
							  "JM" => "Jamaica",
							  "JP" => "Japan",
							  "JT" => "Johnston Island",
							  "JO" => "Jordan",
							  "KZ" => "Kazakhstan",
							  "KE" => "Kenya",
							  "KI" => "Kiribati",
							  "KP" => "Korea, Democratic Peoples Republic",
							  "KR" => "Korea, Republic of",
							  "KW" => "Kuwait",
							  "KG" => "Kyrgyzstan",
							  "LA" => "Lao People's Democratic Republic",
							  "LV" => "Latvia",
							  "LB" => "Lebanon",
							  "LS" => "Lesotho",
							  "LR" => "Liberia",
							  "LY" => "Libyan Arab Jamahiriya",
							  "LI" => "Liechtenstein",
							  "LT" => "Lithuania",
							  "LU" => "Luxembourg",
							  "MO" => "Macau",
							  "MK" => "Macedonia",
							  "MG" => "Madagascar",
							  "MW" => "Malawi",
							  "MY" => "Malaysia",
							  "MV" => "Maldives",
							  "ML" => "Mali",
							  "MT" => "Malta",
							  "MH" => "Marshall Islands",
							  "MQ" => "Martinique",
							  "MR" => "Mauritania",
							  "MU" => "Mauritius",
							  "YT" => "Mayotte",
							  "MX" => "Mexico",
							  "FM" => "Micronesia",
							  "MD" => "Moldavia",
							  "MC" => "Monaco",
							  "MN" => "Mongolia",
							  "MS" => "Montserrat",
							  "MA" => "Morocco",
							  "MZ" => "Mozambique",
							  "NA" => "Namibia",
							  "NR" => "Nauru Island",
							  "NP" => "Nepal",
							  "NL" => "Netherlands",
							  "AN" => "Netherlands Antilles",
							  "NC" => "New Caledonia",
							  "NZ" => "New Zealand",
							  "NI" => "Nicaragua",
							  "NE" => "Niger",
							  "NG" => "Nigeria",
							  "NU" => "Niue",
							  "NF" => "Norfolk Island",
							  "MP" => "Mariana Islands, Northern",
							  "NO" => "Norway",
							  "OM" => "Oman",
							  "PK" => "Pakistan",
							  "PW" => "Palau Islands",
							  "PS" => "Palestine",
							  "PA" => "Panama",
							  "PG" => "Papua New Guinea",
							  "PY" => "Paraguay",
							  "PE" => "Peru",
							  "PH" => "Philippines",
							  "PN" => "Pitcairn",
							  "PL" => "Poland",
							  "PT" => "Portugal",
							  "PR" => "Puerto Rico",
							  "QA" => "Qatar",
							  "RE" => "Reunion Island",
							  "RO" => "Romania",
							  "RU" => "Russian Federation",
							  "RW" => "Rwanda",
							  "WS" => "Samoa",
							  "SH" => "St Helena",
							  "KN" => "St Kitts & Nevis",
							  "LC" => "St Lucia",
							  "PM" => "St Pierre & Miquelon",
							  "VC" => "St Vincent",
							  "SM" => "San Marino",
							  "ST" => "Sao Tome & Principe",
							  "SA" => "Saudi Arabia",
							  "SN" => "Senegal",
							  "SC" => "Seychelles",
							  "SL" => "Sierra Leone",
							  "SG" => "Singapore",
							  "SK" => "Slovakia",
							  "SI" => "Slovenia",
							  "SB" => "Solomon Islands",
							  "SO" => "Somalia",
							  "ZA" => "South Africa",
							  "GS" => "South Georgia and South Sandwich",
							  "ES" => "Spain",
							  "LK" => "Sri Lanka",
							  "XX" => "Stateless Persons",
							  "SD" => "Sudan",
							  "SR" => "Suriname",
							  "SJ" => "Svalbard and Jan Mayen",
							  "SZ" => "Swaziland",
							  "SE" => "Sweden",
							  "CH" => "Switzerland",
							  "SY" => "Syrian Arab Republic",
							  "TW" => "Taiwan, Republic of China",
							  "TJ" => "Tajikistan",
							  "TZ" => "Tanzania",
							  "TH" => "Thailand",
							  "TL" => "Timor Leste",
							  "TG" => "Togo",
							  "TK" => "Tokelau",
							  "TO" => "Tonga",
							  "TT" => "Trinidad & Tobago",
							  "TN" => "Tunisia",
							  "TR" => "Turkey",
							  "TM" => "Turkmenistan",
							  "TC" => "Turks And Caicos Islands",
							  "TV" => "Tuvalu",
							  "UG" => "Uganda",
							  "UA" => "Ukraine",
							  "AE" => "United Arab Emirates",
							  "GB" => "United Kingdom",
							  "UM" => "US Minor Outlying Islands",
							  "US" => "USA",
							  "HV" => "Upper Volta",
							  "UY" => "Uruguay",
							  "UZ" => "Uzbekistan",
							  "VU" => "Vanuatu",
							  "VA" => "Vatican City State",
							  "VE" => "Venezuela",
							  "VN" => "Vietnam",
							  "VG" => "Virgin Islands (British)",
							  "VI" => "Virgin Islands (US)",
							  "WF" => "Wallis And Futuna Islands",
							  "EH" => "Western Sahara",
							  "YE" => "Yemen Arab Rep.",
							  "YD" => "Yemen Democratic",
							  "YU" => "Yugoslavia",
							  "ZR" => "Zaire",
							  "ZM" => "Zambia",
							  "ZW" => "Zimbabwe"
								);
							echo form_dropdown('my_location', $countries, set_value('my_location', @$my_location), 'id="my-location"');
				        ?><br>
				        <label for="is_public">Set profile to public:</label>
				        <?php echo form_checkbox('is_public', '1', (@$is_public == '1'), 'id="is-public"'); ?>
				        <a href="https://www.strava.com/oauth/authorize?
							client_id=4992
							&response_type=code
							&redirect_uri=http://joulepersecond.com/strava/authorise
							&scope=write
							&state=connect
						  &approval_prompt=force"><img src="images/ConnectWithStrava.png" alt="Connect with strava" /></a>

				    </div>

				</div>
				<div class="col-1-2 my-vital-stats">
					<h3>My vital statistics</h3>
					<div class="basic-form">
						<label for="my_mhr">Maximum Heart Rate*:</label>
						<input type="number" id="my_mhr" name="my_mhr" value="<?php echo set_value('my_mhr', @$my_mhr); ?>" maxlength="3" size="3" placeholder="BPM" max="220" min="90" ><br>
						<label for="my_rhr">Resting Heart Rate*:</label>
						<input type="number" id="my_rhr" name="my_rhr" value="<?php echo set_value('my_rhr', @$my_rhr); ?>" maxlength="3" size="3" placeholder="BPM" max="120" min="30" ><br>
						<label for="my_thr">Threshold Heart Rate <a href="http://www.joefrielsblog.com/2011/04/determining-your-lthr.html" title="Help" target="_blank"><b>[?]</b></a>*:</label>
						<input type="number" id="my_thr" name="my_thr" value="<?php echo set_value('my_thr', @$my_thr); ?>" maxlength="3" size="3" placeholder="BPM" max="220" min="60" ><br>
						<label for="my_ftp">Functional Threshold Power <a href="http://www.joefrielsblog.com/2010/08/estimating-your-ftp.html" title="Help" target="_blank"><b>[?]</b></a>*:</label>
						<input type="number" id="my_ftp" name="my_ftp" value="<?php echo set_value('my_ftp', @$my_ftp); ?>" maxlength="3" size="3" placeholder="Watts" max="600" min="100" ><br>
						<label for="my_vo2">VO<sub>2</sub> Max<span class="neon-orange">*</span> (ml/kg/min):</label>
						<input type="number" id="my_vo2" name="my_vo2" value="<?php echo set_value('my_vo2', @$my_vo2); ?>" maxlength="3" size="3" placeholder="Val" max="70" min="0" >
						<p><br><span class="neon-orange">*</span> If value unknown, set value to <code>0</code></p>
						<?php ($user_set == 0)? $continue = ' <span style="color:red">TO CONTINUE</span> ' : $continue = ''; ?>
						<button class="btn-default" type="submit"><b>UPDATE ALL SETTINGS <?php echo $continue ?>&raquo;<b></button>
					</div>
				</div>
				<div class="clear"></div>
				<?php if(@$validated == 'no'): ?>
					<div class="warning"><strong>Not updated </strong> Users must complete all fields correctly: <?php echo validation_errors(); ?></div>
				<?php endif; ?>
			</div>

			<div class="section-ln set-rides">
				<h2>My standard rides</h2>
				<div class="col-1-2">
					<p>Standard rides make it much easier to filter and compare performance over time when repeating workouts (by filtering out other rides). Works well with TrainerRoad and similar training setups:</p>
					<p>Of course - you can also use the advanced filter for comparsion of other similar rides or races</p>
				</div>
				<div class="col-1-2">
					<div id="standard-rides">
						<?php echo $standard_ride; ?>
					</div>
					<div id="add-standard-ride">Create new filter &raquo;</div>
				</div>
			</div>
			<div style="clear:both"></div>
			<div class="section-ln">

				<h2>Advanced settings</h2>
				
				<div class="col-1-2">
					<h3>Data Cutoff</h3>
					<div class="content-container">
						<p>This setting determines how long the gap in the data should be before stopping analysis. The autofill settings determine what to record during this period. <strong>Default value is 15 Seconds</strong></p>
						<div id="range-dco" class="note"><?php echo set_value('set_data_cutoff', @$set_data_cutoff); ?> Seconds</div>
						<input type="range" name="set_data_cutoff" min="3" max="150" value="<?php echo set_value('set_data_cutoff', @$set_data_cutoff); ?>"  onchange="showDCO(this.value)" />
					</div>
					<h3>Notable CP Roll Off</h3>
					<div class="content-container">
						<p>Governs the display of Notable Critical Power performance drop off. All NCPs higher than the last will be shown, but there is a roll off period before showing lesser NCPs. Set high to show fewer, but more notable performances. <strong>Default is 0.995</strong></p>
						<div id="range-ncp" class="note"><input type="number" id="ncp-val" name"ncp-val" step="0.001" min="0.5" max="1" value="<?php echo set_value('ncp-val', intval(@$set_ncp_rolloff)/1000); ?>"></div>
						<input type="range" id="set_ncp_rolloff" name="set_ncp_rolloff" min="500" max="1000" value="<?php echo set_value('set_ncp_rolloff', @$set_ncp_rolloff); ?>"  onchange="showNCP(this.value/1000)" />
					</div>
				</div>
				<div class="col-1-2">
					<h3>Data autofill</h3> 
					<div class="content-container">
						<p>These settings allow the user to decide how to handle data which isn't recorded at a rate of once per second. We recommend you do not use features such as Garmin's Auto Pause and particularly <em>Smart Recording</em> which can skew your data. It is a good idea to play around with these settings to suit your equipment and acitivity style.</p>
						<ul>
							<li><strong>Autofill</strong> (default): this fills in missing sample data up until the setting Data Cutoff point is reached. This is a good option where equipment doesn't record at the rate of once per second, or where frequent dropouts occur</li>
							<li><strong>SetZero</strong>: works well with systems like TrainerRoad or where data dropouts are infrequent and data is recorded once per second. Try setting Data Cutoff low for best results.</li>
							<li><strong>Remove</strong>: This removes all missing data from the activity, if data is missing - not recorded at once per second some acitivity charts will become shorter.</li>
						</ul>
						<?php
						$options = array(
			                  'autofill'  => 'Autofill',
			                  'setzero'    => 'SetZero',
			                  'remove'   => 'Remove',
			                );
						echo form_dropdown('set_autofill', $options, set_value('set_autofill', @$set_autofill))
			           	?>
			        </div>
				</div>
				<div class="clear"></div>
				<?php ($user_set == 0)? $continue = ' <span style="color:red">TO CONTINUE</span> ' : $continue = ''; ?>
				<button class="btn-default" type="submit"><b>UPDATE ALL SETTINGS <?php echo $continue ?>&raquo;<b></button>
			</div>
			

		</section>
		
		
	</form>
	<?php if($paid_account == 0): ?>
		<section class="section-ln">
			<style>.section-ln td, .section-ln th{width:auto; padding:0 10px 10px; line-height: 15px}</style>

			<h2>Subscribe and Go Premium</h2>
			
			<div class="col-1-2">
				<h3>Subscription benefits</h3>
				<div class="content-container">
					<h4>Table of benefits</h4>
					<table>
						<tr>
							<th>&nbsp;</th>
							<th>Free user</th>
							<th>Premium user</th>

						</tr>
						<tr>
							<td><strong>Uploads</strong></td>
							<td>20 per rolling 28 day period</td>
							<td>Unlimited</td>
						</tr>
						<tr>
							<td><strong>Deep&nbsp;analysis</strong></td>
							<td>View up to last 90 days</td>
							<td>Any period</td>
						</tr>
						<tr>
							<td><strong>Uploaded&nbsp;files</strong></td>
							<td>Ride data stored in our superfast database</td>
							<td>Stored as .tcx, and in our superfast database</td>
						</tr>
						<tr>
							<td><strong>New&nbsp;features</strong></td>
							<td>Selected</td>
							<td>Premium users get all new features</td>
						</tr>
						<tr>
							<td><strong>Use&nbsp;forum</strong></td>
							<td>Yes</td>
							<td>Yes</td>
						</tr>
						<tr>
							<td><strong>Ads</strong></td>
							<td>Some</td>
							<td>None</td>
						</tr>


					</table>
				</div>
			</div>
			<div class="col-1-2">
				<h3>Subscribe now for just <span class="neon-orange"><em>&pound;4.99</em>/Mo</span></h3> 
				<div class="content-container">
					<p><span class="note">Pay securely using with your credit card, <strong><em>Paypal</em></strong> option coming soon.</span></p>
					<script src="https://checkout.stripe.com/checkout.js"></script>
					<input id="customButton" type="image" src="/images/go-premium.png" border="0" alt="Purchase">
					<script>
						  var handler = StripeCheckout.configure({
						    key: "<?php echo $this->config->item('stripe_publishable_key'); ?>",
						    //image: '/img/documentation/checkout/marketplace.png',
						    token: function(token) {
						    	jQuery.post("<?php echo $this->config->item('base_url'); ?>index.php/subscribe", {
						    			stripeToken: token.id,
						    			email: "<?php echo $email; ?>"
						    		},
						    		function (data){
						    			alert(data);
						    			location.reload();

						    	} );
						      // Use the token to create the charge with a server-side script.
						      // You can access the token ID with `token.id`
						    }
						  });

						  $('#customButton').on('click', function(e) {
						    // Open Checkout with further options
						    handler.open({
						    	email: '<?php echo @$email; ?>',
						      	name: 'JoulePerSecond.com',
						      	description: 'Premium subscription £4.99 Monthly',
						      	currency: "gbp"
						    });
						    e.preventDefault();
						  });

						  // Close Checkout on page navigation
						  $(window).on('popstate', function() {
						    handler.close();
						  });
					</script>
					</form>
					<!--<?php include 'includes/subscribe_btn.php'; ?> (paypal)-->
		        </div>
			</div>
			<div class="clear"></div>

		</section>
	<?php else: ?>
		<section class="section-ln">
			<h2>Your subscription</h2>
		
			<div class="col-1-2">
				<h3>Subscription information</h3>
				<div class="content-container">
					<p>For any queries relating to your subscription please contact us <a href="mailto:admin@joulepersecond.com?subject=Subscription%20Query">here</a></p>
				</div>
			</div>
			<div class="col-1-2">
				<h3>Update or cancel</h3>
				<div class="content-container">
					<p>To update or cancel your subscription please contact us <a href="mailto:admin@joulepersecond.com?subject=Subscription%20Query">here</a></p>
				</div>
			</div>

		</section>
	<?php endif; ?>



</div>
<script>
	function showDCO(newValue){
		document.getElementById("range-dco").innerHTML=newValue + " Seconds";
	}
	function showNCP(newValue){
		document.getElementById("ncp-val").value=newValue;
	}
	jQuery(document).ready(function(){
		jQuery("#ncp-val").on("change", function(){
			jQuery("#set_ncp_rolloff").val(jQuery(this).val()*1000)
		});
		//add a form element
		jQuery('#add-standard-ride').on("click", function(){
			var html = <?php echo json_encode($standard_ride); ?>;
			jQuery('#standard-rides').append(html);
		});
		//delete a form element
		jQuery(document).on("click", ".delete-standard-ride", function(){
			jQuery(this).closest('.standard-ride-container').remove();
		});
	});
</script>
