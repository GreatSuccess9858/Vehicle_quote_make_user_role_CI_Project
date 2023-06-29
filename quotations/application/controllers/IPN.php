<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class IPN extends CI_Controller 
{

	public $project = null;

	public function __construct() 
	{
		parent::__construct();
		$this->load->model("ipn_model");
		$this->load->model("user_model");
		$this->config->set_item('csrf_protection', FALSE);

	}

	public function index() 
	{
		exit();
	}

	public function checkout2($id) 
	{

		$id = intval($id);
		
		$this->ipn_model->log_ipn("[CHECKOUT2] Attempting to purchase funds");
		
		$hashSecretWord = $this->settings->info->checkout2_secret; //2Checkout Secret Word
		$hashSid = $this->settings->info->checkout2_accountno; //2Checkout account number
		

		$this->ipn_model->log_ipn("[CHECKOUT2] Attempting to check hash credentials");

		$hashOrder = $_REQUEST['order_number']; //2Checkout Order Number

		$total_add = 0;
		if($id == 1) {
			$total_add = 5.00;
		} elseif($id == 2) {
			$total_add = 10.00;
		} elseif($id == 3) {
			$total_add = 30.00;
		}

		$total = ($_REQUEST['total']);

		if($total_add != $total) {
			$this->ipn_model->log_ipn("[CHECKOUT2] Amounts paid and amounts expected wrong!");
			exit();
		}

		$hashTotal = $total;

		$demo = 0;
		if($demo) {
			$StringToHash = strtoupper(md5($hashSecretWord . $hashSid . 1 . $hashTotal));
		} else {
			$StringToHash = strtoupper(md5($hashSecretWord . $hashSid . $hashOrder . $hashTotal));
		}

		$key = $_REQUEST['key'];

		if($this->user->loggedin) {
			$userid = $this->user->info->ID;
			$email = $this->user->info->email;
		} else {
			$userid = 0;
			if(isset($_REQUEST['email']) && !empty($_REQUEST['email'])) {
				$email = $this->common->nohtml($_REQUEST['email']);
			} else {
				$email = "None Provided";
			}
		}

		$log = $this->ipn_model->get_payment_log_hash($key);
		if($log->num_rows() > 0) {
			$this->ipn_model->log_ipn("[CHECKOUT2] Hash already processed [FAIL].");
			$this->template->error(lang("error_93"));
		}

		if($key == $StringToHash) {
			$this->ipn_model->log_ipn("[CHECKOUT2] Server hash and 2checkout hash match.");
			$this->user_model->add_points($userid, $total_add);

			$this->ipn_model->log_ipn("[CHECKOUT2] Credits successfully added to user.");

			$this->ipn_model->add_payment(array(
					"userid" => $userid, 
					"amount" => $total_add,
					"timestamp" => time(), 
					"email" => $email,
					"processor" => "2Checkout",
					"hash" => $key
					)
				);


			$this->session->set_flashdata("globalmsg", lang("success_40"));
			redirect(site_url("funds"));
		} else {
			$this->ipn_model->log_ipn("[CHECKOUT2] Server hash and 2checkout hash FAILED.");
			$this->session->set_flashdata("globalmsg", lang("success_44"));
			redirect(site_url("funds"));
		}
	}

	public function stripe($id) 
	{
		$this->ipn_model->log_ipn("[STRIPE] Tried to buy credits with STRIPE: " . $id);

		// Processing stripe payments
		// Stripe
		if(!empty($this->settings->info->stripe_secret_key) && !empty($this->settings->info->stripe_publish_key)) {
			// Stripe
			require_once(APPPATH . 'third_party/stripe/init.php');

			$stripe = array(
			  "secret_key"      => $this->settings->info->stripe_secret_key,
			  "publishable_key" => $this->settings->info->stripe_publish_key
			);

			\Stripe\Stripe::setApiKey($stripe['secret_key']);
		} else {
			$stripe = null;
		}
		
		if($stripe === null) {
			$this->template->error("No Stripe Keys found!");
		}


		if(!isset($_POST['stripeToken'])) {
			$this->template->error("No Stripe Token");
		}

		$token  = $_POST['stripeToken'];

		$this->ipn_model->log_ipn("[STRIPE] Connected successfully to API.");

		$stripeInfo =\Stripe\Token::retrieve($token);

		if($id == 1) {
			$amount = 500;
			$mc_gross = 5.00;
			$name = $this->settings->info->payment_symbol . "5.00 for " .$this->settings->info->site_name;
		} elseif($id == 2) {
			$amount = 1000;
			$mc_gross = 10.00;
			$name = $this->settings->info->payment_symbol . "10.00 for " .$this->settings->info->site_name;
		} elseif($id == 3) {
			$amount = 3000;
			$mc_gross = 30.00;
			$name = $this->settings->info->payment_symbol . "30.00 for " .$this->settings->info->site_name;
		} else {
			$this->template->error(lang("error_79"));
		}

		// Create a charge: this will charge the user's card
		try {
		  $charge = \Stripe\Charge::create(array(
		    "amount" => $amount, // Amount in cents
		    "currency" => $this->settings->info->paypal_currency,
		    "source" => $token,
		    "description" => $name
		    ));
		  $this->ipn_model->log_ipn("[STRIPE] Payment made successfully: $name.");
		} catch(\Stripe\Error\Card $e) {
		  // The card has been declined
			$this->ipn_model->log_ipn("[STRIPE] Credit Card was declined or error happened.");
			$this->template->error(lang("error_80"));
		}

		if($this->user->loggedin) {
			$userid = $this->user->info->ID;
		} else {
			$userid = 0;
		}

		$mc_gross = abs($mc_gross);
		$this->user_model->add_points($userid, $mc_gross);

		$this->ipn_model->log_ipn("[STRIPE] Credits successfully added to user.");

		$this->ipn_model->add_payment(array(
				"userid" => $userid, 
				"amount" => $mc_gross,
				"timestamp" => time(), 
				"email" => $stripeInfo->email,
				"processor" => "Stripe"
				)
			);

		$this->session->set_flashdata("globalmsg", lang("success_40"));
		redirect(site_url("funds"));
	}

	public function process2() 
	{
		require_once('paypal/config.php');
		$this->ipn_model->log_ipn("Attempted to pay Funds");
		// Read the post from PayPal system and add 'cmd'   
		$req = 'cmd=_notify-validate';  

		// Store each $_POST value in a NVP string: 1 string encoded 
		// and 1 string decoded   
		$ipn_email = '';  
		$ipn_data_array = array();
		foreach ($_POST as $key => $value)   
		{   
		 $value = urlencode(stripslashes($value));   
		 $req .= "&" . $key . "=" . $value;   
		 $ipn_email .= $key . " = " . urldecode($value) . '<br />';  
		 $ipn_data_array[$key] = urldecode($value);
		}

		// Store IPN data serialized for RAW data storage later
		$ipn_serialized = serialize($ipn_data_array);
		  
		// Validate IPN with PayPal
		require_once('paypal/validate.php');

		// Load IPN data into PHP variables
		require_once('paypal/parse-ipn-data.php');

		$ipn_log_data['ipn_data_serialized'] = $ipn_serialized;

		if(strtoupper($txn_type) == 'WEB_ACCEPT') {
			$this->ipn_model->log_ipn($ipn_log_data['ipn_data_serialized']);
			// Invoice Payment
			$userid = intval($this->common->nohtml($custom));
			$id = intval($item_number);
			$this->ipn_model->log_ipn("Tried to pay Funds ($mc_gross): " . 
				$id . " Userid:" . $userid);

			// Get amount
			$amount = abs($mc_gross);
			$this->user_model->add_points($userid, $amount);
			$this->ipn_model->log_ipn("Payment Added to user: $userid, $amount");
			$this->ipn_model->add_payment(array(
				"userid" => $userid, 
				"amount" => $amount, 
				"timestamp" => time(), 
				"email" => $this->common->nohtml($payer_email),
				"processor" => "PayPal"
				)
			);
		}
	}

}

?>