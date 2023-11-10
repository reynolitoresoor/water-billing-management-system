<?php 
class RequestModel extends CI_Model {

    function __construct() { 
         parent::__construct(); 
         $this->load->database();
         $this->load->library('session');
    } 

    public function getBill($billing_id)
    {        
        $results = $this->db->get_where('bills', array('id' => $billing_id));

        return $results->result_array();
    }

    public function getCustomer($customer_id)
    {        
        $results = $this->db->get_where('users', array('id' => $customer_id));

        return $results->result_array();
    }

    public function getUser($user_id)
    {        
        $results = $this->db->get_where('users', array('id' => $user_id));

        return $results->result_array();
    }

}

?>