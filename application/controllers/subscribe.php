
<?php

class Subscribe extends CI_Controller {
	function __construct()
	{
		parent::__construct();
		//load the user file model
		$this->load->model('user_model', 'user', TRUE);
		$this->load->helper('cookie');
		$this->load->helper(array('form', 'url'));
		if (!(get_user()!=""))
		{
			redirect('/login', 'refresh');
		}
		require_once('vendor/autoload.php');

	}

	function index()
	{
		// Set your secret key: remember to change this to your live secret key in production
		// See your keys here https://dashboard.stripe.com/account
		\Stripe\Stripe::setApiKey($this->config->item('stripe_secret_key'));

		// Get the credit card details submitted by the form
		$token = $_POST['stripeToken'];
		$email = $_POST['email'];


		//check whether a subscription already is in place...
		if($this->user->has_subscription($email)){
			echo 'It appears that you are already subscribed';
			return;
		}

		try{
			/*$customer = \Stripe\Customer::create(array(
			  "source" => $token,
			  "plan" => "001",
			  "email" => $email)
			);*/
			//instead of the above due to the tax issue we need to:
			//* create the Customer 									https://stripe.com/docs/api/php#create_customer
			$customer = \Stripe\Customer::create(array(
			  "description" => "Customer for JoulePerSecond.com",
			  "email" => $email,
			  "source" => $token
			));
			
			//* get the newly created cus_id
			//* get the card for the user 								https://stripe.com/docs/api/php#retrieve_card
			$card = $customer->sources->retrieve($customer->default_source);
			$country_code = $card->country;

			//TODO check against array of country codes
			$countries = array(
							  "AT" => "Austria",
							  "BE" => "Belgium",
							  "BG" => "Bulgaria",
							  "HR" => "Croatia",
							  "CU" => "Cuba",
							  "CY" => "Cyprus",
							  "CZ" => "Czech Republic",
							  "DK" => "Denmark",
							  "EE" => "Estonia",
							  "FI" => "Finland",
							  "FR" => "France",
							  "DE" => "Germany",
							  "GR" => "Greece",
							  "HU" => "Hungary",
							  "IE" => "Ireland",
							  "IT" => "Italy",
							  "LV" => "Latvia",
							  "LT" => "Lithuania",
							  "LU" => "Luxembourg",
							  "MT" => "Malta",
							  "NL" => "Netherlands",
							  "PL" => "Poland",
							  "PT" => "Portugal",
							  "RO" => "Romania",
							  "SK" => "Slovakia",
							  "SI" => "Slovenia",
							  "ES" => "Spain",
							  "SE" => "Sweden"
							);
			foreach ($countries as $key => $value) {
				if($country_code == $key)
				{
					echo "Unfortunately, due to VAT MOSS regulations we are unable to supply our services to ".$value;
					return;
				}
			}

			//* if not uk, us, aus, nz, canada etc. then reject else 	
			//* create a subscription 									https://stripe.com/docs/api/php#create_subscription
			$customer->subscriptions->create(array("plan" => "001"));

			//* probably better store the country code etc...

		}catch(Exception $e){
			echo 'Unfortunately, You have not been subscribed: ',  $e->getMessage(), "\n";
			return;
		}
		

		$this->user->set_stripe_id($email, $customer->id, $country_code);

		if($this->user->set_as_subscriber($email)){
			echo 'Thank you very much. You are now subscribed!';
		}else{
			echo 'There was an unknown problem :(';
		}
	}
}
?>