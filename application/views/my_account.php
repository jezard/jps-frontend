<div class="account-page">
	<?php echo form_open('myaccount'); ?>
		
		<section class="account-settings">
			<div class="section-ln">
				<div class="col-1-2">
					<h1>Account settings</h1>
				</div>
				<div class="col-1-2">
					<button class="btn-default" type="submit">Update All Settings</button>
				</div>
				
				<div class="clear"></div>
				<div class="col-1-2 about-me">
					<h3>About me</h3>
					<div class="basic-form">
						<label for="my_firstname">First name:</label>
						<input type="text" id="my_firstname" name="my_firstname" value="<?php echo set_value('my_firstname', @$my_firstname); ?>" maxlength="50" size="20" placeholder="First name" ><br>
						<label for="my_lastname">Last name:</label>
						<input type="text" id="my_lastname" name="my_lastname" value="<?php echo set_value('my_lastname', @$my_lastname); ?>" maxlength="50" size="20" placeholder="Last name" ><br>
						<label for="my_age">Age (years):</label>
						<input type="number" id="my_age" name="my_age" value="<?php echo set_value('my_age', @$my_age); ?>" maxlength="3" size="3" placeholder="Age" max="120" min="5" ><br>
						<label for="my_weight">Weight (Kg):</label>
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
				    </div>

				</div>
				<div class="col-1-2 my-vital-stats">
					<h3>My vital statistics</h3>
					<div class="basic-form">
						<label for="my_mhr">Maximum Heart Rate:</label>
						<input type="number" id="my_mhr" name="my_mhr" value="<?php echo set_value('my_mhr', @$my_mhr); ?>" maxlength="3" size="3" placeholder="BPM" max="220" min="90" ><br>
						<label for="my_rhr">Resting Heart Rate:</label>
						<input type="number" id="my_rhr" name="my_rhr" value="<?php echo set_value('my_rhr', @$my_rhr); ?>" maxlength="3" size="3" placeholder="BPM" max="120" min="30" ><br>
						<label for="my_thr">Threshold Heart Rate:</label>
						<input type="number" id="my_thr" name="my_thr" value="<?php echo set_value('my_thr', @$my_thr); ?>" maxlength="3" size="3" placeholder="BPM" max="220" min="60" ><br>
						<label for="my_ftp">Functional Threshold Power<span class="neon-orange">*</span>:</label>
						<input type="number" id="my_ftp" name="my_ftp" value="<?php echo set_value('my_ftp', @$my_ftp); ?>" maxlength="3" size="3" placeholder="Watts" max="600" min="0" ><br>
						<label for="my_vo2">VO<sub>2</sub> Max<span class="neon-orange">*</span> (ml/kg/min):</label>
						<input type="number" id="my_vo2" name="my_vo2" value="<?php echo set_value('my_vo2', @$my_vo2); ?>" maxlength="3" size="3" placeholder="Val" max="70" min="0" >
						<p><br><span class="neon-orange">*</span> If values for <em><abbr title="Functional Threshold Power">FTP</abbr></em> or <em>VO<sub>2</sub> Max</em> are unknown, set value to <code>0</code></p>
					</div>
				</div>
			</div>
			<div class="section-ln">

				<h2>Advanced settings</h2>
				
				<div class="col-1-2">
					<h3>Data Cutoff</h3>
					<div class="content-container">
						<p>This setting determines how long the gap in the data should be before stopping analysis. The autofill settings determine what to record during this period. Default value is 15 Seconds</p>
						<div id="range" class="neon-green"><?php echo set_value('set_data_cutoff', @$set_data_cutoff); ?> Seconds</div>
						<input type="range" name="set_data_cutoff" min="3" max="150" value="<?php echo set_value('set_data_cutoff', @$set_data_cutoff); ?>"  onchange="showValue(this.value)" />
					</div>
				</div>
				<div class="col-1-2">
					<h3>Data autofill</h3> 
					<div class="content-container">
						<p>These settings allow the user to decide how to handle data which isn't recorded at a rate of once per second. We recommend you do not use features such as Garmin's Auto Pause and particularly <em>Smart Recording</em> which can skew your data. It is a good idea to play around with these settings to suit your equipment and acitivity style.</p>
						<ul>
							<li><span class="neon-green">Autofill</span> (default): this fills in missing sample data up until the setting Data Cutoff point is reached. This is a good option where equipment doesn't record at the rate of once per second, or where frequent dropouts occur</li>
							<li><span class="neon-green">SetZero</span>: works well with systems like TrainerRoad or where data dropouts are infrequent and data is recorded once per second. Try setting Data Cutoff low for best results.</li>
							<li><span class="neon-green">Remove</span>: This removes all missing data from the activity, if data is missing - not recorded at once per second some acitivity charts will become shorter.</li>
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
				<div class="col-1-1 bottom-update"><button class="btn-default" type="submit">Update All Settings</button></div>
			</div>
			

		</section>
		
		
	</form>
</div>
<script>
	function showValue(newValue){
		document.getElementById("range").innerHTML=newValue + " Seconds";
	}
</script>
