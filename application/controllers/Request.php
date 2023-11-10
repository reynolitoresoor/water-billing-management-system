<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Request extends CI_Controller {
    
    public function __construct()
    {
        parent::__construct();
        $this->load->helper(array('form','url'));
        $this->load->library('session','form_validation');
        $this->load->model('RequestModel');
    }

	public function getBill($billing_id)
	{
		$billing = $this->RequestModel->getBill($billing_id);

		echo json_encode($billing);
	}

	public function getCustomer($customer_id)
	{
		$customer = $this->RequestModel->getCustomer($customer_id);

		echo json_encode($customer);
	}

	public function getUser($user_id)
	{
		$user = $this->RequestModel->getCustomer($user_id);

		echo json_encode($user);
	}

}
