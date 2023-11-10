<?php 
class UsersModel extends CI_Model {

    function __construct() { 
         parent::__construct(); 
         $this->load->database();
         $this->load->library('session');
    } 

    public function insertUser()
    {        
        $user_salt = $this->userSalt();
        $data = array(
          'username' => $this->input->post('username'),
          'email' => $this->input->post('email'),
          'password' => md5($this->input->post('password')).$user_salt,
          'first_name' => $this->input->post('first_name'),
          'middle_name' => $this->input->post('middle_name'),
          'last_name' => $this->input->post('last_name'),
          'contact_no' => $this->input->post('contact_no'),
          'address' => $this->input->post('address'),
          'user_salt' => $user_salt,
          'user_type' => 4
        );
        $this->db->insert('users', $data);
        return $this->db->insert_id();
    }

    public function addUser()
    {        
        $user_salt = $this->userSalt();
        $data = array(
          'username' => $this->input->post('username'),
          'email' => $this->input->post('email'),
          'password' => md5($this->input->post('password')).$user_salt,
          'first_name' => $this->input->post('first_name'),
          'middle_name' => $this->input->post('middle_name'),
          'last_name' => $this->input->post('last_name'),
          'contact_no' => $this->input->post('contact_no'),
          'address' => $this->input->post('address'),
          'user_salt' => $user_salt,
          'user_type' => 2
        );
        $this->db->insert('users', $data);
        return $this->db->insert_id();
    }

    public function updateUser()
    {        
        $user_salt = $this->userSalt();
        if($this->input->post('password')) {
            $data = array(
              'username' => $this->input->post('username'),
              'email' => $this->input->post('email'),
              'password' => md5($this->input->post('password')).$user_salt,
              'first_name' => $this->input->post('first_name'),
              'middle_name' => $this->input->post('middle_name'),
              'last_name' => $this->input->post('last_name'),
              'contact_no' => $this->input->post('contact_no'),
              'address' => $this->input->post('address'),
              'user_salt' => $user_salt,
              'user_type' => 2
            );
        } else {
            $data = array(
              'username' => $this->input->post('username'),
              'email' => $this->input->post('email'),
              'first_name' => $this->input->post('first_name'),
              'middle_name' => $this->input->post('middle_name'),
              'last_name' => $this->input->post('last_name'),
              'contact_no' => $this->input->post('contact_no'),
              'address' => $this->input->post('address'),
              'user_type' => 2
            );
        }
        $this->db->set($data);
        $this->db->where('id',$this->input->post('user_id'));
        $results = $this->db->update('users');
        return $results;
    }

    public function addCustomer()
    {        
        $user_salt = $this->userSalt();
        $data = array(
          'username' => $this->input->post('username'),
          'email' => $this->input->post('email'),
          'password' => md5($this->input->post('password')).$user_salt,
          'first_name' => $this->input->post('first_name'),
          'middle_name' => $this->input->post('middle_name'),
          'last_name' => $this->input->post('last_name'),
          'contact_no' => $this->input->post('contact_no'),
          'address' => $this->input->post('address'),
          'user_salt' => $user_salt,
          'user_type' => 4
        );
        $this->db->insert('users', $data);
        return $this->db->insert_id();
    }

    public function updateCustomer()
    {        
        $user_salt = $this->userSalt();
        if($this->input->post('password')) {
            $data = array(
              'username' => $this->input->post('username'),
              'email' => $this->input->post('email'),
              'password' => md5($this->input->post('password')).$user_salt,
              'first_name' => $this->input->post('first_name'),
              'middle_name' => $this->input->post('middle_name'),
              'last_name' => $this->input->post('last_name'),
              'contact_no' => $this->input->post('contact_no'),
              'address' => $this->input->post('address'),
              'user_salt' => $user_salt,
              'user_type' => 4
            );
        } else {
            $data = array(
              'username' => $this->input->post('username'),
              'email' => $this->input->post('email'),
              'first_name' => $this->input->post('first_name'),
              'middle_name' => $this->input->post('middle_name'),
              'last_name' => $this->input->post('last_name'),
              'contact_no' => $this->input->post('contact_no'),
              'address' => $this->input->post('address'),
              'user_type' => 4
            );
        }
        $this->db->set($data);
        $this->db->where('id',$this->input->post('customer_id'));
        $results = $this->db->update('users');
        return $results;
    }

    public function addManager()
    {        
        $user_salt = $this->userSalt();
        $data = array(
          'username' => $this->input->post('username'),
          'email' => $this->input->post('email'),
          'password' => md5($this->input->post('password')).$user_salt,
          'first_name' => $this->input->post('first_name'),
          'middle_name' => $this->input->post('middle_name'),
          'last_name' => $this->input->post('last_name'),
          'contact_no' => $this->input->post('contact_no'),
          'address' => $this->input->post('address'),
          'user_salt' => $user_salt,
          'user_type' => 2
        );
        $this->db->insert('users', $data);
        return $this->db->insert_id();
    }

    public function updateManager()
    {        
        $user_salt = $this->userSalt();
        if($this->input->post('password')) {
            $data = array(
              'username' => $this->input->post('username'),
              'email' => $this->input->post('email'),
              'password' => md5($this->input->post('password')).$user_salt,
              'first_name' => $this->input->post('first_name'),
              'middle_name' => $this->input->post('middle_name'),
              'last_name' => $this->input->post('last_name'),
              'contact_no' => $this->input->post('contact_no'),
              'address' => $this->input->post('address'),
              'user_salt' => $user_salt,
              'user_type' => 2
            );
        } else {
            $data = array(
              'username' => $this->input->post('username'),
              'email' => $this->input->post('email'),
              'first_name' => $this->input->post('first_name'),
              'middle_name' => $this->input->post('middle_name'),
              'last_name' => $this->input->post('last_name'),
              'contact_no' => $this->input->post('contact_no'),
              'address' => $this->input->post('address'),
              'user_type' => 2
            );
        }
        $this->db->set($data);
        $this->db->where('id',$this->input->post('manager_id'));
        $results = $this->db->update('users');
        return $results;
    }

    public function addStaff()
    {        
        $user_salt = $this->userSalt();
        $data = array(
          'username' => $this->input->post('username'),
          'email' => $this->input->post('email'),
          'password' => md5($this->input->post('password')).$user_salt,
          'first_name' => $this->input->post('first_name'),
          'middle_name' => $this->input->post('middle_name'),
          'last_name' => $this->input->post('last_name'),
          'contact_no' => $this->input->post('contact_no'),
          'address' => $this->input->post('address'),
          'user_salt' => $user_salt,
          'user_type' => 3
        );
        $this->db->insert('users', $data);
        return $this->db->insert_id();
    }

    public function updateStaff()
    {        
        $user_salt = $this->userSalt();
        if($this->input->post('password')) {
            $data = array(
              'username' => $this->input->post('username'),
              'email' => $this->input->post('email'),
              'password' => md5($this->input->post('password')).$user_salt,
              'first_name' => $this->input->post('first_name'),
              'middle_name' => $this->input->post('middle_name'),
              'last_name' => $this->input->post('last_name'),
              'contact_no' => $this->input->post('contact_no'),
              'address' => $this->input->post('address'),
              'user_salt' => $user_salt,
              'user_type' => 3
            );
        } else {
            $data = array(
              'username' => $this->input->post('username'),
              'email' => $this->input->post('email'),
              'first_name' => $this->input->post('first_name'),
              'middle_name' => $this->input->post('middle_name'),
              'last_name' => $this->input->post('last_name'),
              'contact_no' => $this->input->post('contact_no'),
              'address' => $this->input->post('address'),
              'user_type' => 3
            );
        }
        $this->db->set($data);
        $this->db->where('id',$this->input->post('staff_id'));
        $results = $this->db->update('users');
        return $results;
    }

    public function userSalt() {
        $n = 20;
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randomString = '';
     
        for ($i = 0; $i < $n; $i++) {
            $index = rand(0, strlen($characters) - 1);
            $randomString .= $characters[$index];
        }
     
        return $randomString;
    }

    public function login() {
        $username = $this->input->post('username');
        $password = $this->input->post('password');
        $user_salt = $this->getUserSalt($username, $password);
        
        $data = array(
          'username' => $username,
          'password' => md5($password).$user_salt
        );
        $results = $this->db->get_where('users', $data);
        if($results) {
            foreach($results->result_array() as $data) {
                $this->session->set_userdata($data);
            }
        }
    }

    public function getUserSalt($username, $password) {
        $data = array(
          'username' => $username
        );
        $results = $this->db->get_where('users', $data);
        if($results) {
            foreach($results->result() as $data) {
                return $data->user_salt;
            }
        }
    }

    public function getAllUsers() {
        $results = $this->db->get_where('users',array('user_type' => 2));
        return $results->result();
    }

    public function updateUserProfileImage($profile) {
        if($profile) {
            $data = array(
                'first_name' => $this->input->post('first_name'),
                'middle_name' => $this->input->post('middle_name'),
                'last_name' => $this->input->post('last_name'),
                'email' => $this->input->post('email'),
                'address' => $this->input->post('address'),
                'contact_no' => $this->input->post('contact_no'),
                'profile' => $profile
            );
        }
        $this->session->profile = $profile;
        $this->db->set($data);
        $this->db->where('id', $this->session->userdata('id'));
        $results = $this->db->update('users');

        return $results;
    }

    public function updateUserProfile() {
        $data = array(
            'first_name' => $this->input->post('first_name'),
            'middle_name' => $this->input->post('middle_name'),
            'last_name' => $this->input->post('last_name'),
            'email' => $this->input->post('email'),
            'username' => $this->input->post('username'),
            'address' => $this->input->post('address'),
            'contact_no' => $this->input->post('contact_no')
        );
        $this->db->set($data);
        $this->db->where('id', $this->session->userdata('id'));
        $results = $this->db->update('users');

        return $results;
    }

    public function getAllCustomers() {
        $results = $this->db->get_where('users',array('user_type' => 4));
        return $results->result();
    }

    public function getAllManagers() {
        $results = $this->db->get_where('users',array('user_type' => 2));
        return $results->result();
    }

    public function getAllStaff() {
        $results = $this->db->get_where('users',array('user_type' => 3));
        return $results->result();
    }

    public function getAllBillings() {
        $this->db->select('*');
        $this->db->from('users');
        $this->db->join('bills','bills.user_id = users.id');
        $this->db->where('users.user_type', 4);
        $results = $this->db->get();
        return $results->result();
    }

    public function getCustomerBillings() {
        $this->db->select('*');
        $this->db->from('users');
        $this->db->join('bills','bills.user_id = users.id');
        $this->db->where('users.user_type', 4);
        $results = $this->db->get();
        return $results->result();
    }
    
    public function addBilling()
    {        
        $data = array(
          'user_id' => $this->input->post('customer'),
          'amount' => $this->input->post('amount'),
          'due_date' => $this->input->post('due_date'),
          'meter_from' => $this->input->post('meter_from'),
          'meter_to' => $this->input->post('meter_to')
        );
        $this->db->insert('bills', $data);
        return $this->db->insert_id();
    }
    

    public function updateBilling()
    {        
        $data = array(
          'user_id' => $this->input->post('customer'),
          'amount' => $this->input->post('amount'),
          'due_date' => $this->input->post('due_date'),
          'meter_from' => $this->input->post('meter_from'),
          'meter_to' => $this->input->post('meter_to'),
          'status' => $this->input->post('status')
        );
        $this->db->set($data);
        $this->db->where('id', $this->input->post('billing_id'));
        $results = $this->db->update('bills');
        return $results;
    }

    public function getUserBillings() {
        $user_id = $this->session->id;
        $results = $this->db->get_where('bills',array('user_id' => $user_id));

        return $results->result();
    }

    public function updateCustomerReceipt($receipt) {
        $data = array(
          'paid_amount' => $this->input->post('amount'),
          'receipt' => $receipt,
          'note' => $this->input->post('note')
        );
        $this->db->set($data);
        $this->db->where('id', $this->input->post('billing_id'));
        $results = $this->db->update('bills');

        return $results;
    }

    public function getUserById() {
        $user_id = $this->session->userdata('id');
        $results = $this->db->get_where('users', array('id' => $user_id));

        return $results->result();
    }

    public function deleteUser($id) {
        $this->db->where('id', $id);
        $results = $this->db->delete('users');

        return $results;
    }

    public function deleteCustomer($id) {
        $this->db->where('id', $id);
        $results = $this->db->delete('users');

        return $results;
    }

    public function deleteBill($id) {
        $this->db->where('id', $id);
        $results = $this->db->delete('bills');

        return $results;
    }

    public function getPaidBills() {
        $this->db->select('sum(bills.amount) as paid');
        $this->db->from('bills');
        $this->db->where('status',1);
        $results = $this->db->get();

        return $results->result();
    }

    public function getUnpaidBills() {
        $this->db->select('sum(bills.amount) as unpaid');
        $this->db->from('bills');
        $this->db->where('status',0);
        $results = $this->db->get();

        return $results->result();
    }

}

?>