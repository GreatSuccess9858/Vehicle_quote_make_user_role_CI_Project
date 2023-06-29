<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once APPPATH . 'third_party/Facebook/autoload.php';
require_once APPPATH . 'third_party/Google/autoload.php';
require APPPATH . "third_party/twitter/autoload.php";
use Abraham\TwitterOAuth\TwitterOAuth;

class Login extends CI_Controller 
{

	public function __construct() 
	{
		parent::__construct();
		$this->load->model("login_model");
		$this->load->model("user_model");
		$this->load->model("home_model");
		$this->load->model("register_model");
	}

	public function index()
	{
		$this->template->set_page_title("Login");
		$this->template->set_error_view("error/login_error.php");
		$this->template->set_layout("layout/login_layout.php");
		if ($this->user_model->check_block_ip()) {
			$this->template->error(lang("error_26"));
		}
		if ($this->user->loggedin) {
			redirect(base_url());
		}
		$this->template->loadContent("login/index.php", array());
	}

	public function ajax_check_login() 
	{
		$formData = $this->input->post("formData");
		parse_str($formData, $data);

		$config = $this->config->item("cookieprefix");
		if ($this->user->loggedin) {
			$this->template->jsonError(lang("error_27"));
		}

		$email = $this->common->nohtml($data['email']);
		$pass = $this->common->nohtml($data['pass']);

		$field_errors = array();
		if(empty($data['email'])) {
			$field_errors['email'] = 'You left the username field empty!';
		}
		if(empty($data['pass'])) {
			$field_errors['pass'] = 'You left the password field empty!';
		}

		if(!empty($field_errors)) {
			echo json_encode(array("field_errors" => 1,"fieldErrors" => $field_errors));
			exit();
		}

		if($this->settings->info->login_protect) {
			// Check user for 5 login attempts
			$s = $this->login_model->get_login_attempts($_SERVER['REMOTE_ADDR'], 
							$email, (15*60));
			if($s->num_rows() > 0) {
				$s = $s->row();
				if($s->count >=5) {
					$this->template->jsonError(lang("error_68"));
				}
			}
		}

		$login = $this->login_model->getUserByEmail($email);
		if ($login->num_rows() == 0) {
			$login = $this->login_model->getUserByUsername($email);
			if($login->num_rows() == 0) {
				$this->login_protect($email);
				$this->template->jsonError(lang("error_29"));
			}
		}
		$r = $login->row();
		$userid = $r->ID;
		$email = $r->email;

		$phpass = new PasswordHash(12, false);
    	if (!$phpass->CheckPassword($pass, $r->password)) {
    		$this->login_protect($email);
    		$this->template->jsonError(lang("error_29"));
    	}

    	if($this->settings->info->activate_account) 
    	{
    		if(!$r->active) {
    			$this->template->jsonError(lang("error_72") . "<a href='".
    				site_url("register/send_activation_code/" . $r->ID . "/" .
    				 urlencode($r->email)).
    				"'>".lang("error_73") ."</a> " . lang("error_74"));
    		}
    	}

		if(empty($field_errors)) {
			echo json_encode(array("success" => 1));
		} else {
			echo json_encode(array("field_errors" => 1,"fieldErrors" => $field_errors));
		}
		exit();
	}

	public function pro($redirect="") 
	{	
		$this->template->set_error_view("error/login_error.php");
		$this->template->set_layout("layout/login_layout.php");
		if ($this->user_model->check_block_ip()) {
			$this->template->error(lang("error_26"));
		}

		$config = $this->config->item("cookieprefix");
		if ($this->user->loggedin) {
			$this->template->error(lang("error_27"));
		}
		
		$email = $this->input->post("email", true);
		$pass = $this->common->nohtml($this->input->post("pass"));
		$remember = $this->input->post("remember", true);

		if($this->settings->info->login_protect) {
			// Check user for 5 login attempts
			$s = $this->login_model->get_login_attempts($_SERVER['REMOTE_ADDR'], 
							$email, (15*60));
			if($s->num_rows() > 0) {
				$s = $s->row();
				if($s->count >=5) {
					$this->template->error(lang("error_68"));
				}
			}
		}

		if (empty($email) || empty($pass)) {
			$this->template->error(lang("error_28"));
		}

		$login = $this->login_model->getUserByEmail($email);
		if ($login->num_rows() == 0) {
			$login = $this->login_model->getUserByUsername($email);
			if($login->num_rows() == 0) {
				$this->login_protect($email);
				$this->template->error(lang("error_29"));
			}
		}
		$r = $login->row();
		$userid = $r->ID;
		$email = $r->email;

		$phpass = new PasswordHash(12, false);
    	if (!$phpass->CheckPassword($pass, $r->password)) {
    		$this->login_protect($email);
    		$this->template->error(lang("error_29"));
    	}

    	if($this->settings->info->activate_account) 
    	{
    		if(!$r->active) {
    			$this->template->error(lang("error_72") . "<a href='".
    				site_url("register/send_activation_code/" . $r->ID . "/" .
    				 urlencode($r->email)).
    				"'>".lang("error_73") ."</a> " . lang("error_74"));
    		}
    	}

    	if($this->settings->info->secure_login) {
			// Generate a token
			$token = rand(1,100000) . $email;
			$token = md5(sha1($token));

			// Store it
			$this->login_model->updateUserToken($userid, $token);
		} else {
			if(empty($r->token)) {
				// Generate a token
				$token = rand(1,100000) . $email;
				$token = md5(sha1($token));

				// Store it
				$this->login_model->updateUserToken($userid, $token);
			} else {
				if($r->online_timestamp + (3600*24*30*2) < time() ) {
						// Generate a token
					$token = rand(1,100000) . $email;
					$token = md5(sha1($token));

					// Store it
					$this->login_model->updateUserToken($userid, $token);
				} else {
					$token = $r->token;
				}
			}
		}

		// Create Cookies
		if ($remember == 1) {
			$ttl = 3600*24*31;
		} else {
			$ttl = 3600*24*31;
		}

		setcookie($config . "un", $email, time()+$ttl, "/");
		setcookie($config . "tkn", $token, time()+$ttl, "/");

		$this->user_model->add_log(array(
			"userid" => $userid,
			"IP" => $_SERVER['REMOTE_ADDR'],
			"user_agent" => $_SERVER['HTTP_USER_AGENT'],
			"timestamp" => time(),
			"message" => lang("ctn_435")
			)
		);

		if(!empty($redirect)) {
			redirect(site_url(urldecode($redirect)));
		} else {
			redirect(base_url());
		}
	}

	private function login_protect($email) 
	{
		if($this->settings->info->login_protect) {
			// Add Count
			$s = $this->login_model
				->get_login_attempts($_SERVER['REMOTE_ADDR'], 
					$email, (15*60));
			if($s->num_rows() > 0) {
				$s = $s->row();
				$this->login_model->update_login_attempt($s->ID, array(
					"count" => $s->count+1
					)
				);
			} else {
				$this->login_model->add_login_attempt(array(
					"IP" => $_SERVER['REMOTE_ADDR'],
					"username" => $email,
					"count" => 1,
					"timestamp" => time()
					)
				);
			}
		}
	}

	public function google_login() 
	{
		$this->template->set_error_view("error/login_error.php");
		$this->template->set_layout("layout/login_layout.php");
		if ($this->settings->info->disable_social_login) {
			$this->template->error(lang("error_30"));
		}
		if ($this->user->loggedin) {
			$this->template->error(lang("error_27"));
		}

		// Get Keys
		if(empty($this->settings->info->google_client_id) || 
			empty($this->settings->info->google_client_secret)) {
			$this->template->error(lang("error_31"));
		}

		$client = new Google_Client();
		$client->setApplicationName('framework');
		$client->setClientId($this->settings->info->google_client_id);
		$client->setClientSecret($this->settings->info->google_client_secret);
		$client->setRedirectUri(site_url("login/google_login"));
		$client->setScopes(array(
			'https://www.googleapis.com/auth/plus.login',
			'https://www.googleapis.com/auth/plus.me', 
			'https://www.googleapis.com/auth/userinfo.email', 
			'https://www.googleapis.com/auth/userinfo.profile'
			)
		);

		
		$oauth2 = new Google_Auth_OAuth2($client);
		$plus = new Google_Service_Plus($client);

		if (isset($_GET['code'])) {
			$client->authenticate($_GET['code']);
			$_SESSION['google_token'] = $client->getAccessToken();
			$redirect = redirect(site_url("login/google_login"));
			header('Location: ' . filter_var($redirect, FILTER_SANITIZE_URL));
			return;
		}

		if (isset($_SESSION['google_token'])) {
			$client->setAccessToken($_SESSION['google_token']);
		}
		$provider = "google";

		if ($client->getAccessToken()) {
			$peop = $plus->people->get('me');
			$name = $peop['displayName'];
			$oauth_id = $peop['id'];
			$token = $client->getAccessToken();
		    $_SESSION['google_token'] = $token;


		    if (!$oauth_id) $this->template->error(lang("error_32"));

		    $user = $this->login_model->get_oauth_user($provider, $oauth_id);
		    if ($user->num_rows() == 0) {
		    	// Create
		    	$userid = $this->register_model->add_user(array(
		    		"oauth_provider" => $provider,
		    		"oauth_id" => $oauth_id,
		    		"oauth_token" => $token,
		    		"first_name" => $name,
		    		"IP" => $_SERVER['REMOTE_ADDR'],
		    		"joined" => time(),
		    		"joined_date" => date("n-Y"),
		    		"user_role" => $this->settings->info->default_user_role
		    		)
		    	);

		    	// Check for any default user groups
				$default_groups = $this->user_model->get_default_groups();
				foreach($default_groups->result() as $r) {
					$this->user_model->add_user_to_group($userid, $r->ID);
				}
		    } else {
		    	$this->login_model
		    	->update_google_user($provider, $oauth_id, $token);
		    }
		    
		    // Set Cookies
			$ttl = 3600*24*31;

			$config = $this->config->item("cookieprefix");

			setcookie($config . "provider", $provider, time()+$ttl, "/");
			setcookie($config . "oauthid", $oauth_id, time()+$ttl, "/");
			setcookie($config . "oauthtoken", $token,
			 time()+$ttl, "/");

			$this->session->set_flashdata("globalmsg", lang("success_15"));
			redirect(site_url());
		} else {
		    $authUrl = $client->createAuthUrl();
		    redirect($authUrl);
		}
	}

	public function facebook_login() 
	{
		$this->template->set_error_view("error/login_error.php");
		$this->template->set_layout("layout/login_layout.php");
		if ($this->settings->info->disable_social_login) {
			$this->template->error(lang("error_30"));
		}
		if ($this->user->loggedin) {
			$this->template->error(lang("error_27"));
		}

		// Get Keys
		if(empty($this->settings->info->facebook_app_id) || 
			empty($this->settings->info->facebook_app_secret)) {
			$this->template->error(lang("error_33"));
		}

		$fb = new Facebook\Facebook([
		  'app_id' => $this->settings->info->facebook_app_id,
		  'app_secret' => $this->settings->info->facebook_app_secret,
		  'default_graph_version' => 'v2.4',
		  ]);

		$helper = $fb->getRedirectLoginHelper();
		$permissions = ['email', 'user_likes']; // optional
		$loginUrl = $helper->getLoginUrl(site_url("login/facebook_login_pro"));

		redirect($loginUrl);
	}

	public function facebook_login_pro() 
	{
		$this->template->set_error_view("error/login_error.php");
		$this->template->set_layout("layout/login_layout.php");
		if ($this->settings->info->disable_social_login) {
			$this->template->error(lang("error_30"));
		}
		if ($this->user->loggedin) {
			$this->template->error(lang("error_27"));
		}

		// Get Keys
		if(empty($this->settings->info->facebook_app_id) || 
			empty($this->settings->info->facebook_app_secret)) {
			$this->template->error(lang("error_33"));
		}

		$fb = new Facebook\Facebook([
		  'app_id' => $this->settings->info->facebook_app_id,
		  'app_secret' => $this->settings->info->facebook_app_secret,
		  'default_graph_version' => 'v2.4',
		  ]);

		$helper = $fb->getRedirectLoginHelper();
		try {
		  $accessToken = $helper->getAccessToken(site_url("login/facebook_login_pro"));
		} catch(Facebook\Exceptions\FacebookResponseException $e) {
		  // When Graph returns an error
		  echo 'Graph returned an error: ' . $e->getMessage();
		  exit;
		} catch(Facebook\Exceptions\FacebookSDKException $e) {
		  // When validation fails or other local issues
		  echo 'Facebook SDK returned an error: ' . $e->getMessage();
		  exit;
		}

		if(isset($accessToken)) {
			// OAuth 2.0 client handler
			$oAuth2Client = $fb->getOAuth2Client();

			// Exchanges a short-lived access token for a long-lived one
			$longLivedAccessToken = $oAuth2Client->getLongLivedAccessToken($accessToken);
			$fb->setDefaultAccessToken($longLivedAccessToken);
			try {
			  $response = $fb->get('/me');
			  $userNode = $response->getGraphUser();
			} catch(Facebook\Exceptions\FacebookResponseException $e) {
			  // When Graph returns an error
			  echo 'Graph returned an error: ' . $e->getMessage();
			  exit;
			} catch(Facebook\Exceptions\FacebookSDKException $e) {
			  // When validation fails or other local issues
			  echo 'Facebook SDK returned an error: ' . $e->getMessage();
			  exit;
			}


  			$provider = "facebook";
			$oauth_id = $this->common->nohtml($userNode->getId());
			$user = $this->login_model->get_oauth_user($provider, $oauth_id);
			$name = $this->common->nohtml($userNode->getName());
			$token = $longLivedAccessToken;
			if ($user->num_rows() == 0) {
				$userid = $this->register_model->add_user(array(
		    		"oauth_provider" => $provider,
		    		"oauth_id" => $oauth_id,
		    		"oauth_token" => $token,
		    		"first_name" => $name,
		    		"IP" => $_SERVER['REMOTE_ADDR'],
		    		"joined" => time(),
		    		"joined_date" => date("n-Y"),
		    		"user_role" => $this->settings->info->default_user_role
		    		)
		    	);

		    	// Check for any default user groups
				$default_groups = $this->user_model->get_default_groups();
				foreach($default_groups->result() as $r) {
					$this->user_model->add_user_to_group($userid, $r->ID);
				}


			} else {
				// login
				$this->login_model
				->update_facebook_user($provider, $oauth_id, $token);
			}

			// Set Cookies
			$ttl = 3600*24*31;

			$config = $this->config->item("cookieprefix");

			setcookie($config . "provider", $provider, time()+$ttl, "/");
			setcookie($config . "oauthid", $oauth_id, time()+$ttl, "/");
			setcookie($config . "oauthtoken", $token,
			 time()+$ttl, "/");

			$this->session->set_flashdata("globalmsg", lang("success_16"));
			redirect(site_url());
		} else {
			$this->template->error(lang("error_34"));
		}
	}

	public function twitter_login() 
	{
		$this->template->set_error_view("error/login_error.php");
		$this->template->set_layout("layout/login_layout.php");
		if ($this->settings->info->disable_social_login) {
			$this->template->error(lang("error_30"));
		}
		if ($this->user->loggedin) {
			$this->template->error(lang("error_27"));
		}

		// Get Keys
		if(empty($this->settings->info->twitter_consumer_key) || 
			empty($this->settings->info->twitter_consumer_secret)) {
			$this->template->error(lang("error_35"));
		}

		$twitteroauth = new TwitterOAuth(
			$this->settings->info->twitter_consumer_key,
			$this->settings->info->twitter_consumer_secret);

		// We redirect the user to this url once we have our tokens
		$request_token = $twitteroauth->oauth("oauth/request_token", 
			array("oauth_callback" => site_url("login/twitter_login_pro")));

		// On Success
		if ($twitteroauth->getLastHttpCode() ==200){

			$_SESSION['oauth_token'] = $request_token['oauth_token'];
			$_SESSION['oauth_token_secret'] = $request_token['oauth_token_secret'];
			if($request_token['oauth_callback_confirmed']) {
		 		$url = $twitteroauth->url("oauth/authenticate", 
		 			array("oauth_token" => $request_token['oauth_token']));
		 		redirect($url);
		 	} else {
		 		$this->template->error(lang("error_36"));
		 	}
		} else {
			// Twitter API may be down
		    $this->template->error(lang("error_37") . $twitteroauth->getLastHttpCode());
		}
	}

	public function twitter_login_pro() 
	{
		$this->template->set_error_view("error/login_error.php");
		$this->template->set_layout("layout/login_layout.php");
		if ($this->settings->info->disable_social_login) {
			$this->template->error(lang("error_30"));
		}
		if ($this->user->loggedin) {
			$this->template->error(lang("error_27"));
		}
		
		// Get Keys
		if(empty($this->settings->info->twitter_consumer_key) || 
			empty($this->settings->info->twitter_consumer_secret)) {
			$this->template->error(lang("error_35"));
		}

		$provider = "twitter";

		// Check that they have gotten their auth tokens from twitter
		if (!empty($_GET['oauth_verifier']) && !empty($_SESSION['oauth_token'])
		 && !empty($_SESSION['oauth_token_secret']))
		{
			if($_GET['oauth_token'] != $_SESSION['oauth_token']) {
				$this->template->error(lang("error_38"));
			}

		    $twitteroauth = new TwitterOAuth(
		    	$this->settings->info->twitter_consumer_key,
				$this->settings->info->twitter_consumer_secret,
				$_SESSION['oauth_token'],
				$_SESSION['oauth_token_secret']
			);

		    $access_token = $twitteroauth->oauth("oauth/access_token", 
		    	array("oauth_verifier" => $_GET['oauth_verifier']));
		    if($twitteroauth->getLastHttpCode() != 200) {
		    	$errors = "";
		    	foreach($access_token->errors as $error) {
					$errors .= $error->message . "<br /><br />";
				}
				$this->template->error(lang("error_39") . "<br /><br />" 
					. $errors);
		    }

			// Getting Twitter user data
			// Use Access Token to get data
			$connection = new TwitterOAuth(
				$this->settings->info->twitter_consumer_key, 
				$this->settings->info->twitter_consumer_secret,
				$access_token['oauth_token'], 
				$access_token['oauth_token_secret']);
			$user_info = $connection->get('account/verify_credentials');

			$errors = "";
			if ($connection->getLastHttpCode() != 200) {
				foreach($user_info->errors as $error) {
					$errors .= $error->message . "<br /><br />";
				}
				$this->template->error(lang("error_40") . "<br /><br />"
				 . $errors);
			}

			// Check to see if we already have this user
			$user = $this->login_model
			->get_oauth_user($provider, $this->common->nohtml($user_info->id));

			$oauth_id = $this->common->nohtml($user_info->id);
			$name = $this->common->nohtml($user_info->screen_name);
			$access_token['oauth_token'] = 
				$this->common->nohtml($access_token['oauth_token']);
			$access_token['oauth_token_secret'] = 
				$this->common->nohtml($access_token['oauth_token_secret']);

			if ($user->num_rows() == 0) {
				$userid = $this->register_model->add_user(array(
		    		"oauth_provider" => $provider,
		    		"oauth_id" => $oauth_id,
		    		"oauth_token" => $access_token['oauth_token'],
		    		"oauth_secret" => $access_token['oauth_token_secret'],
		    		"first_name" => $name,
		    		"IP" => $_SERVER['REMOTE_ADDR'],
		    		"joined" => time(),
		    		"joined_date" => date("n-Y"),
		    		"user_role" => $this->settings->info->default_user_role
		    		)
		    	);
				

				// Check for any default user groups
				$default_groups = $this->user_model->get_default_groups();
				foreach($default_groups->result() as $r) {
					$this->user_model->add_user_to_group($userid, $r->ID);
				}

			} else {
				// Update User
				$this->login_model->update_oauth_user(
					$access_token['oauth_token'],
					$access_token['oauth_token_secret'],
					$oauth_id,$provider);
			}

			// Set Cookies
			$ttl = 3600*24*31;

			$config = $this->config->item("cookieprefix");

			setcookie($config . "provider", $provider, time()+$ttl, "/");
			setcookie($config . "oauthid", $oauth_id, time()+$ttl, "/");
			setcookie($config . "oauthtoken", $access_token['oauth_token'],
			 time()+$ttl, "/");
			setcookie($config . "oauthsecret", $access_token['oauth_token_secret'],
			 time()+$ttl, "/");
			$this->session->set_flashdata("globalmsg", lang("success_17"));
			redirect(site_url());
		} else {
			$this->template->error(lang("error_41"));
		    redirect(site_url("login/twitter_login"));
		}
	}

	public function logout($hash='') 
	{
		$this->template->set_error_view("error/login_error.php");
		$config = $this->config->item("cookieprefix");
		$this->load->helper("cookie");
		if ($hash != $this->security->get_csrf_hash() ) {
			//$this->template->error(lang("error_6"));
		}
		delete_cookie($config. "un");
		delete_cookie($config. "tkn");
		delete_cookie($config. "provider");
		delete_cookie($config. "oauthid");
		delete_cookie($config. "oauthtoken");
		delete_cookie($config. "oauthsecret");
		$this->session->sess_destroy();

		$this->user_model->add_log(array(
				"userid" => $this->user->info->ID,
				"IP" => $_SERVER['REMOTE_ADDR'],
				"user_agent" => $_SERVER['HTTP_USER_AGENT'],
				"timestamp" => time(),
				"message" => lang("ctn_436")
				)
			);
		redirect(base_url());
	}

	public function resetpw($token,$userid) 
	{
		$this->template->set_error_view("error/login_error.php");
		$this->template->set_layout("layout/login_layout.php");
		$userid = intval($userid);
		// Check
		$user = $this->login_model->getResetUser($token, $userid);
		if ($user->num_rows() == 0) {
			$this->template->error(lang("error_42"));
		}

		$r=$user->row();
		if ($r->timestamp +3600*24*7 < time()) {
			$this->template->error(lang("error_43"));
		}

		$this->template->loadContent("login/resetpw.php", 
			array(
				"token" => $token,
				 "userid" => $userid
			)
		);

	}

	public function resetpw_pro($token, $userid) 
	{
		$this->template->set_error_view("error/login_error.php");
		$this->template->set_layout("layout/login_layout.php");
		$userid = intval($userid);
		// Check
		$user = $this->login_model->getResetUser($token, $userid);
		if ($user->num_rows() == 0) {
			$this->template->error(lang("error_42"));
		}
		$r=$user->row();
		if ($r->timestamp +3600*24*7 < time()) {
			$this->template->error(lang("error_43"));
		}

		$npassword = $this->common->nohtml(
			$this->input->post("npassword", true)
		);
		$npassword2 = $this->common->nohtml(
			$this->input->post("npassword2", true)
		);

		if ($npassword != $npassword2) {
			$this->template->error(lang("error_44"));
		}

		if (empty($npassword)) {
			$this->template->error(lang("error_45"));
		}

		$password = $this->common->encrypt($npassword);

		$this->login_model->updatePassword($userid, $password);
		$this->login_model->deleteReset($token);
		$this->session->set_flashdata("globalmsg", lang("success_18"));
		redirect(site_url("login"));
	}

	public function forgotpw() 
	{
		$this->template->set_error_view("error/login_error.php");
		$this->template->set_layout("layout/login_layout.php");
		$this->template->loadContent("login/forgotpw.php", array());
	}

	public function forgotpw_pro() 
	{	
		$this->template->set_layout("layout/login_layout.php");
		$this->template->set_error_view("error/login_error.php");
		$email = $this->input->post("email", true);

		$log = $this->login_model->getResetLog($_SERVER['REMOTE_ADDR']);
		if ($log->num_rows() > 0) {
			$log = $log->row();
			if ($log->timestamp+ 60*15 > time()) {
				$this->template->error(
					lang("error_46")
				);
			}
		}

		$this->login_model->addToResetLog($_SERVER['REMOTE_ADDR']);

		// Check for email
		$user = $this->login_model->getUserEmail($email);
		if ($user->num_rows() == 0) {
			$this->template->error(
				lang("error_47")
			);
		}
		$user = $user->row();

		$token = rand(1,10000000000) . time()
		. "HUFI9e9dvcwjecw8392klle@O(*388*&&£^^$$$";

		$token = sha1(md5($token));

		$this->login_model->resetPW($user->ID, $token);

		if(!isset($_COOKIE['language'])) {
			// Get first language in list as default
			$lang = $this->config->item("language");
		} else {
			$lang = $this->common->nohtml($_COOKIE["language"]);
		}

		// Send Email
		$email_template = $this->home_model
			->get_email_template_hook("forgot_password", $lang);
		if($email_template->num_rows() == 0) {
			$this->template->error(lang("error_48"));
		}
		$email_template = $email_template->row();

		$email_template->message = $this->common->replace_keywords(array(
			"[NAME]" => $user->username,
			"[SITE_URL]" => site_url(),
			"[EMAIL_LINK]" => 
				site_url("login/resetpw/" . $token . "/" . $user->ID),
			"[SITE_NAME]" =>  $this->settings->info->site_name
			),
		$email_template->message);

		$this->common->send_email($email_template->title,
			 $email_template->message, $email);

		$this->session->set_flashdata("globalmsg", lang("success_19"));
		redirect(site_url("login/forgotpw"));
	}

	public function banned() 
	{
		$this->template->set_error_view("error/login_error.php");
		$this->template->set_layout("layout/login_layout.php");
		$this->template->loadContent("login/banned.php", array());
	}


}

?>