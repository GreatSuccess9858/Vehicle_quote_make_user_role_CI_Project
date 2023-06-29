<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class currency_converter {
	
	public $amount;
	public $from;
	public $to;
	public $googleUrl = "http://www.google.com/ig/calculator?hl=en&q=";
	
    public function currency_converter($params)
    {
        $this->amount 		= $params['amount'];
		$this->from 		= $params['fromCurrency'];
		$this->to 			= $params['toCurrency'];
		$this->googleUrl 	= $this->googleUrl."1".$this->from."=?".$this->to;
    }
	
	public function getResult(){
		$result = file_get_contents($this->googleUrl);
		/* Convert the above result into Array */
		$result = explode('"', $result);
		
		/* Right side text*/
		$convertedAmount = explode(' ', $result[3]);
		$conversion = $convertedAmount[0];
		$conversion = $conversion * $this->amount;
		$conversion = round($conversion, 2);

		//Get text for converted currency
		$rightText = ucwords(str_replace($convertedAmount[0],"",$result[3]));

		//Make right hand side string
		$rightText = $conversion.$rightText;
		
		/* Left side text*/
		$googleLeft = explode(' ', $result[1]);
		$fromAmount = $googleLeft[0];

		//Get text for converted from currency
		$fromText = ucwords(str_replace($fromAmount,"",$result[1]));

		//Make left hand side string
		$leftText = $this->amount." ".$fromText;

		return $leftText." = ".$rightText;
	}
}
/* End of file currency_converter.php */