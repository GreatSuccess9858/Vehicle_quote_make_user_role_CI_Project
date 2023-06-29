<?PHP
class PHPMailer_Library {
	public function __construct() {
		log_message('Debug', 'PHPMailer class is loaded.');
	}

	public function load() {
		require_once APPPATH . 'third_party/PHPMailer/src/PHPMailer.php';
		require_once APPPATH . 'third_party/PHPMailer/src/Exception.php';
		require_once APPPATH . 'third_party/PHPMailer/src/SMTP.php';

		$objMail = new PHPMailer\PHPMailer\PHPMailer();
		return $objMail;
	}
}