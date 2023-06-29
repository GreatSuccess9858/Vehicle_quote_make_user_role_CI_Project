<?php
$host_split = explode('.',$_SERVER['HTTP_HOST']);
$test_ipn = isset($_POST['test_ipn']) ? true : false;
$host_split = explode('.',$_SERVER['HTTP_HOST']);
$sandbox = $host_split[0] == 'sandbox' ? true : false;


$ppHost = 'https://www.paypal.com/';
$ssl = $_SERVER['SERVER_PORT'] == '443' ? true : false;

/*
PHP Version : 
What version of PHP are you running?
*/
$php_version = explode('.',phpversion());
$php_version = $php_version[0];

/*
SMTP Settings : 
If you leave $smtp_auth to false the script will defaulut to using the local mail() function.
Otherwise, fill in your email server's SMTP settings here so the script can send emails on your behalf.
$smtp_auth = true/false for whether or not your SMTP server requires authentication to send emails.
$email_from_address and $email_from_name are what will be used to send the emails with.
*/

$smtp_auth = false;
$smtp_username = '';
$smtp_password = '';
$smtp_host = '';
$email_from_address = '';
$email_from_name = '';

/*
Site Admin : 
These values will be used to send administration emails to.  Errors, IPN confirmations, etc.
*/

$admin_email_address = '';
$admin_name = '';

/*
Database Settings : 
Fill in your MySQL credentials here.  
$db_table_prefix will be used for the names of the tables
*/

$db_host = $sandbox ? 'test_server_host' : 'live_server_host';	
$db_username = $sandbox ? 'test_server_username' : 'live_server_username';
$db_password = $sandbox ? 'test_server_password' : 'live_server_password';
$db_database = $sandbox ? 'test_server_dbname' : 'live_server_dbname';
$db_table_prefix = '';  

/*
FSOCK or CURL
Sometimes hosts don't like fsock for some reason.  You can set a flag here if you need to use Curl instead.
*/

$curl_validation = true;
						
/*
SSL Settings :
Set true/fase if your sandbox server or your production server run on SSL
This will cause the IPN to run over SSL as well.  While this isn't critical because
IPN doesn't include highly sensitive data, it's still recommended when available.
*/

$sandbox_ssl = true;
$production_ssl = false;

/*
Digital Product Settings :
If you have a digital file that you'd like to include as an email attachment to buyers include that here.
*/
$digital_product_path = '';
?>