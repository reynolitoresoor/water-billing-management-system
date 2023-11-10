<?php 
class SettingsModel extends CI_Model {

    function __construct() { 
         parent::__construct(); 
         $this->load->database();
         $this->load->library('session');
    } 

    public function getSettings()
    {        
        $results = $this->db->get_where('settings');

        return $results->result_array();
    }

    public function insertSettings() {
        $postValues = $_POST;

        foreach($postValues as $key => $value) {
            return $this->checkField($key);
        }
    }

    public function checkField($field) {
        $results = $this->db->get_where('settings', array('field' => $field));
        
        if($results->num_rows() > 0) {
            $data = array(
              'field' => $field,
              'value' => $this->input->post('system_name')
            );
            $this->db->set($data);
            $this->db->where('field', $field);
            $results = $this->db->update('settings');
            return $results;

        } else {
            $data = array(
              'field' => $field,
              'value' => $this->input->post('system_name')
            );
            $this->db->insert('settings', $data);

            return $this->db->insert_id();
        }
    }


}

?>