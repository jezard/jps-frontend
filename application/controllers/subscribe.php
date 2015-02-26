
<?php

class Subscribe extends CI_Controller {
	function __construct()
	{
		parent::__construct();
		//load the user file model
		$this->load->model('user_model', 'user', TRUE);
		$this->load->helper('cookie');
		$this->load->helper(array('form', 'url'));
		if (!($this->input->cookie('valid_user')))
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
			echo 'You are already subscribed';
			return;
		}

		try{
			$customer = \Stripe\Customer::create(array(
			  "source" => $token,
			  "plan" => "001",
			  "email" => $email)
			);
		}catch(Exception $e){
			echo 'You have not been subscribed: ',  $e->getMessage(), "\n";
		}
		

		$this->user->set_stripe_id($email, $customer->id);

		if($this->user->set_as_subscriber($email)){
			echo 'You are now subscribed!';
		}
	}
}
?>