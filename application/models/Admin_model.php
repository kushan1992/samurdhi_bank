<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class admin_model extends CI_Model{

	public function __construct() {
       $this->load->database();
	}

  public function checkLogin($un, $pass) {

    $this->db->where('username', $un);
    $this->db->where('password', $pass);
    $result = $this->db->get('user');

    if($result->num_rows() == 1) {
        $row = $result->row();
        $data = array(
                'userid' => $row->iduser,
                'roleid' => $row->role_idrole,
                'name' => $row->name,
                'username' => $row->username
                );
        // $this->session->set_userdata($data);
        return true;
    }
    return false;

  }


  
	function get_customer() {
      $this->db->select('*');
      $result = $this->db->get('customer');

      if($result->num_rows() > 0){
        return $result->result_array();
      }else{
        return false;
      }
   }
}