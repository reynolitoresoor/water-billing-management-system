<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pages extends CI_Controller {
    
    public function __construct()
    {
        parent::__construct();
        $this->load->helper(array('form','url'));
        $this->load->library('session','form_validation');
        $this->load->model('UsersModel');
        $this->load->model('SettingsModel');
    }

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/userguide3/general/urls.html
	 */
	public function index()
	{
		if($this->session->userdata('username')) {
			redirect('/dashboard');
		} else {
			$this->load->library('form_validation');

			$config = array(
			        array(
			                'field' => 'username',
			                'label' => 'Username',
			                'rules' => 'required'
			        ),
			        array(
			                'field' => 'password',
			                'label' => 'Password',
			                'rules' => 'required',
			                'errors' => array(
			                        'required' => 'You must provide a %s.',
			                ),
			        )
			);
			$this->form_validation->set_rules($config);

			if ($this->form_validation->run() == FALSE)
	        {
	        	$settings = $this->SettingsModel->getSettings();
	            $this->load->view('index',compact('settings'));
	        }
	        else
	        {
	        	$this->UsersModel->login();
	        	if($this->session->user_type == 1 || $this->session->user_type == 2 || $this->session->user_type == 3) {
	        		redirect('/dashboard');
	        	} else {
	        		redirect('/');
	        	}
	        }
			
		}
	}

	public function createAccount()
	{
		$this->load->library('form_validation');

		$config = array(
		        array(
		                'field' => 'username',
		                'label' => 'Username',
		                'rules' => 'required'
		        ),
		        array(
		                'field' => 'password',
		                'label' => 'Password',
		                'rules' => 'required',
		                'errors' => array(
		                        'required' => 'You must provide a %s.',
		                ),
		        ),
		        array(
		                'field' => 'confirm_password',
		                'label' => 'Confirm Password',
		                'rules' => 'required|matches[password]'
		        ),
		        array(
		                'field' => 'email',
		                'label' => 'Email',
		                'rules' => 'valid_email'
		        )
		);
		$this->form_validation->set_rules($config);

		if ($this->form_validation->run() == FALSE)
        {
        	$settings = $this->SettingsModel->getSettings();
            $this->load->view('create-account',compact('settings'));
        }
        else
        {
        	if($this->UsersModel->insertUser()) {
        		$this->session->set_tempdata('success', 'You can now login with your account.', 1);
        		redirect('/');
        	} 
        }
		
	}

	public function dashboard()
	{
		$paid = $this->UsersModel->getPaidBills();
		$unpaid = $this->UsersModel->getUnpaidBills();
		$settings = $this->SettingsModel->getSettings();
		$managers = $this->UsersModel->getAllManagers();
		$staff = $this->UsersModel->getAllStaff();
		$customers = $this->UsersModel->getAllCustomers();

		if($this->session->user_type == 1) {
			$this->load->view('admin/dashboard',compact('paid','unpaid','settings','managers','staff','customers'));
		} else if($this->session->user_type == 2 || $this->session->user_type == 5) {
            $this->load->view('user-dashboard',compact('paid','unpaid','settings','managers','staff','customers'));
		} else if($this->session->user_type == 3) {
            $this->load->view('staff-dashboard',compact('paid','unpaid','settings'));
		} else {
			redirect('/my-billings');
		}
		
	}

	public function users()
	{
		$this->load->library('form_validation');
        if(!$this->input->post('user_id')){
		    $config = array(
		        array(
		                'field' => 'username',
		                'label' => 'Username',
		                'rules' => 'required'
		        ),
		        array(
		                'field' => 'password',
		                'label' => 'Password',
		                'rules' => 'required',
		                'errors' => array(
		                        'required' => 'You must provide a %s.',
		                ),
		        ),
		        array(
		                'field' => 'confirm_password',
		                'label' => 'Confirm Password',
		                'rules' => 'required|matches[password]'
		        ),
		        array(
		                'field' => 'email',
		                'label' => 'Email',
		                'rules' => 'valid_email'
		        )
		    );
	    } else {
		    $config = array(
	    		array(
		                'field' => 'username',
		                'label' => 'Username',
		                'rules' => 'required'
		        ),
	    	);
	    }
		$this->form_validation->set_rules($config);

		if ($this->form_validation->run() == FALSE)
        {
            $users = $this->UsersModel->getAllUsers();
            $settings = $this->SettingsModel->getSettings();
            $this->load->view('users',compact('users','settings'));
        }
        else
        {
        	if($this->input->post('user_id')) {
        		if($this->UsersModel->updateUser()) {
	        		$this->session->set_tempdata('success', 'User successfully updated.', 0);
	        		redirect('/users');
	        	}
        	} else {
        		if($this->UsersModel->addUser()) {
	        		$this->session->set_tempdata('success', 'User successfully added.', 0);
	        		redirect('/users');
	        	}
        	}
        }

	}

	public function customers()
	{
		$this->load->library('form_validation');
        
        if(!$this->input->post('customer_id')){
			$config = array(
		        array(
		                'field' => 'username',
		                'label' => 'Username',
		                'rules' => 'required'
		        ),
		        array(
		                'field' => 'password',
		                'label' => 'Password',
		                'rules' => 'required',
		                'errors' => array(
		                        'required' => 'You must provide a %s.',
		                ),
		        ),
		        array(
		                'field' => 'confirm_password',
		                'label' => 'Confirm Password',
		                'rules' => 'required|matches[password]'
		        ),
		        array(
		                'field' => 'email',
		                'label' => 'Email',
		                'rules' => 'valid_email'
		        )
		    );
	    } else {
	    	$config = array(
	    		array(
		                'field' => 'username',
		                'label' => 'Username',
		                'rules' => 'required'
		        ),
	    	);
	    }
		$this->form_validation->set_rules($config);

		if ($this->form_validation->run() == FALSE)
        {
            $customers = $this->UsersModel->getAllCustomers();
            $settings = $this->SettingsModel->getSettings();
            $this->load->view('customers',compact('customers','settings'));
        }
        else
        {
        	if($this->input->post('customer_id')) {
        		if($this->UsersModel->updateCustomer()) {
	        		$this->session->set_tempdata('success', 'Customer successfully updated.', 0);
	        		redirect('/customers');
	        	}
        	} else {
        		if($this->UsersModel->addCustomer()) {
	        		$this->session->set_tempdata('success', 'Customer successfully added.', 0);
	        		redirect('/customers');
	        	}
        	}
        }

	}

	public function managers()
	{
		$this->load->library('form_validation');
        
        if(!$this->input->post('manager_id')){
			$config = array(
		        array(
		                'field' => 'username',
		                'label' => 'Username',
		                'rules' => 'required'
		        ),
		        array(
		                'field' => 'password',
		                'label' => 'Password',
		                'rules' => 'required',
		                'errors' => array(
		                        'required' => 'You must provide a %s.',
		                ),
		        ),
		        array(
		                'field' => 'confirm_password',
		                'label' => 'Confirm Password',
		                'rules' => 'required|matches[password]'
		        ),
		        array(
		                'field' => 'email',
		                'label' => 'Email',
		                'rules' => 'valid_email'
		        )
		    );
	    } else {
	    	$config = array(
	    		array(
		                'field' => 'username',
		                'label' => 'Username',
		                'rules' => 'required'
		        ),
	    	);
	    }
		$this->form_validation->set_rules($config);

		if ($this->form_validation->run() == FALSE)
        {
            $managers = $this->UsersModel->getAllManagers();
            $settings = $this->SettingsModel->getSettings();
            $this->load->view('managers',compact('managers','settings'));
        }
        else
        {
        	if($this->input->post('manager_id')) {
        		if($this->UsersModel->updateManager()) {
	        		$this->session->set_tempdata('success', 'Manager successfully updated.', 0);
	        		redirect('/managers');
	        	}
        	} else {
        		if($this->UsersModel->addManager()) {
	        		$this->session->set_tempdata('success', 'Manager successfully added.', 0);
	        		redirect('/managers');
	        	}
        	}
        }

	}


	public function staff()
	{
		$this->load->library('form_validation');
        
        if(!$this->input->post('staff_id')){
			$config = array(
		        array(
		                'field' => 'username',
		                'label' => 'Username',
		                'rules' => 'required'
		        ),
		        array(
		                'field' => 'password',
		                'label' => 'Password',
		                'rules' => 'required',
		                'errors' => array(
		                        'required' => 'You must provide a %s.',
		                ),
		        ),
		        array(
		                'field' => 'confirm_password',
		                'label' => 'Confirm Password',
		                'rules' => 'required|matches[password]'
		        ),
		        array(
		                'field' => 'email',
		                'label' => 'Email',
		                'rules' => 'valid_email'
		        )
		    );
	    } else {
	    	$config = array(
	    		array(
		                'field' => 'username',
		                'label' => 'Username',
		                'rules' => 'required'
		        ),
	    	);
	    }
		$this->form_validation->set_rules($config);

		if ($this->form_validation->run() == FALSE)
        {
            $staff = $this->UsersModel->getAllStaff();
            $settings = $this->SettingsModel->getSettings();
            $this->load->view('staff',compact('staff','settings'));
        }
        else
        {
        	if($this->input->post('staff_id')) {
        		if($this->UsersModel->updateStaff()) {
	        		$this->session->set_tempdata('success', 'Staff successfully updated.', 0);
	        		redirect('/staff');
	        	}
        	} else {
        		if($this->UsersModel->addStaff()) {
	        		$this->session->set_tempdata('success', 'Staff successfully added.', 0);
	        		redirect('/staff');
	        	}
        	}
        }

	}

	public function bills()
	{
		$this->load->library('form_validation');

		$config = array(
		        array(
		                'field' => 'customer',
		                'label' => 'customer',
		                'rules' => 'required'
		        ),
		        array(
		                'field' => 'amount',
		                'label' => 'Amount',
		                'rules' => 'required'
		        ),
		        array(
		                'field' => 'due_date',
		                'label' => 'Due Date',
		                'rules' => 'required'
		        ),
		        array(
		                'field' => 'meter_from',
		                'label' => 'Meter From',
		                'rules' => 'required'
		        ),
		        array(
		                'field' => 'meter_to',
		                'label' => 'Meter To',
		                'rules' => 'required'
		        )
		);
		$this->form_validation->set_rules($config);

		if ($this->form_validation->run() == FALSE)
        {
            $billings = $this->UsersModel->getAllBillings();
            $customers = $this->UsersModel->getAllCustomers();
            $settings = $this->SettingsModel->getSettings();
            $this->load->view('billings',compact('billings','customers','settings'));
        }
        else
        {
        	if($this->input->post('billing_id')) {
        		if($this->UsersModel->updateBilling()) {
	        		$this->session->set_tempdata('success', 'Billing successfully updated.', 0);
	        		redirect('/bills');
	        	}
        	} else {
        		if($this->UsersModel->addBilling()) {
        			$this->session->set_tempdata('success', 'Billing successfully added.', 0);
	        		redirect('/bills');
	        	}
        	}
        }

	}

	public function myBillings()
	{
		$config['upload_path']    = './uploads/receipts';
        $config['allowed_types']  = 'gif|jpg|png|jpeg';
        $config['overwrite']      = true;
        $upload_error = "";

        $this->load->library('upload', $config);

        if ( ! $this->upload->do_upload('receipt'))
        {
            $upload_error = array('error' => $this->upload->display_errors());     
        }
        else
        {
            $data = array('upload_data' => $this->upload->data());
            $receipt = $data['upload_data']['file_name'];
            $update = $this->UsersModel->updateCustomerReceipt($receipt);
            if($update) {
            	$this->session->set_tempdata('success', 'Thank you for paying your bill.', 0);
            	redirect('/receipt/'.$this->input->post('billing_id'));
            }
        }

        $my_billings = $this->UsersModel->getUserBillings();
        $settings = $this->SettingsModel->getSettings();
        $this->load->view('my-billings',compact('my_billings','settings'));
	}

	public function customerBillings()
	{
		$this->load->library('form_validation');

		$config = array(
		        array(
		                'field' => 'customer',
		                'label' => 'customer',
		                'rules' => 'required'
		        ),
		        array(
		                'field' => 'amount',
		                'label' => 'Amount',
		                'rules' => 'required'
		        ),
		        array(
		                'field' => 'due_date',
		                'label' => 'Due Date',
		                'rules' => 'required'
		        ),
		        array(
		                'field' => 'meter_from',
		                'label' => 'Meter From',
		                'rules' => 'required'
		        ),
		        array(
		                'field' => 'meter_to',
		                'label' => 'Meter To',
		                'rules' => 'required'
		        )
		);
		$this->form_validation->set_rules($config);

		if ($this->form_validation->run() == FALSE)
        {
            $customer_billings = $this->UsersModel->getCustomerBillings();
	        $customers = $this->UsersModel->getAllCustomers();
	        $settings = $this->SettingsModel->getSettings();
	        $this->load->view('bills',compact('customer_billings','customers','settings'));
        }
        else
        {
        	if($this->input->post('billing_id')) {
        		if($this->UsersModel->updateBilling()) {
	        		$this->session->set_tempdata('success', 'Billing successfully updated.', 0);
	        		redirect('/bills');
	        	}
        	} else {
        		if($this->UsersModel->addBilling()) {
        			$this->session->set_tempdata('success', 'Billing successfully added.', 0);
	        		redirect('/bills');
	        	}
        	}
        }

	}

	public function receipt($id) {
		$settings = $this->SettingsModel->getSettings();
		$bill = $this->UsersModel->getBilling($id);

		$this->load->view('receipt',compact('bill','settings'));
	}

	public function profile()
	{
		$config['upload_path']    = './uploads/images';
        $config['allowed_types']  = 'gif|jpg|png|jpeg';
        $config['overwrite']      = true;
        $upload_error = "";

        $this->load->library('upload', $config);

        if ( ! $this->upload->do_upload('profile'))
        {
            $upload_error = array('error' => $this->upload->display_errors());     
        }
        else
        {
            $data = array('upload_data' => $this->upload->data());
            $profile = $data['upload_data']['file_name'];
            $update_profile = $this->UsersModel->updateUserProfileImage($profile);
            if($update_profile) {
            	$this->session->set_tempdata('success', 'Update profile successfully.', 0);
            }
        }
        
        if($_POST) {
        	$update_profile = $this->UsersModel->updateUserProfile();
	        if($update_profile) {
	        	$this->session->set_tempdata('success', 'Update profile successfully.', 0);
	        }
        }

        $profile = $this->UsersModel->getUserById();
        $settings = $this->SettingsModel->getSettings();
        $this->load->view('profile',compact('profile','upload_error','settings'));
     
	}

	public function settings()
	{
		if($_POST) {
			$settings = $this->SettingsModel->insertSettings();
			if($settings) {
				$this->session->set_tempdata('success', 'Settings successfully save.', 0);
			}
		}
        $settings = $this->SettingsModel->getSettings();
		$this->load->view('admin/settings',compact('settings'));
	}

	public function deleteUser($id) {
		$delete = $this->UsersModel->deleteUser($id);
		if($delete) {
			$this->session->set_tempdata('success', 'User successfully deleted.', 0);
			redirect('/users');
		}
	}

	public function deleteCustomer($id) {
		$delete = $this->UsersModel->deleteCustomer($id);
		if($delete) {
			$this->session->set_tempdata('success', 'Customer successfully deleted.', 0);
			redirect('/customers');
		}
	}

	public function deleteBill($id) {
		$delete = $this->UsersModel->deleteBill($id);
		if($delete) {
			$this->session->set_tempdata('success', 'Billing successfully deleted.', 0);
			redirect('/bills');
		}
	}

	public function logout() {
		$this->session->sess_destroy();
		redirect('/');
	}
}
