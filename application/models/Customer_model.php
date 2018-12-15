<?php
class customer_model extends CI_Model{

	public function __construct()
	{
       $this->load->database();
	}

  public function cus_create($data)
	{
    $this->db->insert('customer', $data);
    if ($this->db->affected_rows() > 0) {
    return true;
    } else {
    return false;
    }
  }
	public function get_customer(){
      $this->db->select('*');
      $result = $this->db->get('customer');
      
      if($result->num_rows() > 0){
        return $result->result_array();
       var_dump ($result->result_array());
      }else{
        return false;
      }
   }
}
