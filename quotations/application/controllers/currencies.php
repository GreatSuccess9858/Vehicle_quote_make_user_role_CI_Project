<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Currencies extends CI_Controller {

	function __construct()
    {
        parent::__construct();		
		$this->load->model('CurrenciesModel');
    }
	
	/* Default function */
	public function index()
	{
		$data['fromCurrency'] = 'USD';
		$data['toCurrency'] = 'INR';
		$data['amount'] = '1';
		$this->load->library('currency_converter', $data);
		$data['country_details'] = $this->CurrenciesModel->get_country_list(); 
		$data['page_title'] = 'CodeIgniter Currency Converter Library';			
		$data['conversion_result'] =  $this->currency_converter->getResult();		
		$this->load->view('currency_converter',$data);
	}
	
	/* Function to convert*/
	public function convert(){				
		$data['fromCurrency'] = $this->input->post('fromCurrency');
		$data['toCurrency'] = $this->input->post('toCurrency');
		$data['amount'] = $this->input->post('amount');
		$this->load->library('currency_converter', $data);
		$data['country_details'] = $this->CurrenciesModel->get_country_list(); 
		$data['page_title'] = 'CodeIgniter Currency Converter Library';			
		$data['conversion_result'] =  $this->currency_converter->getResult();		
		$this->load->view('currency_converter',$data);
	}
}

/* End of file Currencies.php */
/* Location: ./application/controllers/Currencies.php */