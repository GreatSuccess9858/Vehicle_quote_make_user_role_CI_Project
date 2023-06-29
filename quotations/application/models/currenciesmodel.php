<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class CurrenciesModel extends CI_Model {

    function __construct()
    {
        parent::__construct();
		$this->load->database();
    }
    
    function get_country_list()
    {
        $query = $this->db->get('CountryCode');
        return $query->result();
    }

}

/* End of file Currencies.php */
/* Location: ./application/controllers/Currencies.php */