<?php
/**
 * Created by PhpStorm.
 * User: buddhi_hasanka
 * Date: 09-Feb-19
 * Time: 5:07 PM
 */

defined('BASEPATH') OR exit('No direct script access allowed');

class loan_model extends CI_Model
{
    var $table = 'loan';

    public function __construct()
    {
        $this->load->database();
    }

    public function loan_create($data)
    {
        echo $data;
        $this->db->insert($this->table, $data);
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function get_loans()
    {
        $result = $this->db->get($this->table);

        if ($result->num_rows() > 0) {
            return $result->result_array();
        } else {
            return false;
        }

    }


    public function get_loan_by_id( $where, $id)
    {
        $this->db->from($this->table);
        $this->db->where($where);
        $query = $this->db->get();

        return $query->row();
    }

    public function save($data)
    {
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }

    public function update($where, $data)
    {
        $this->db->update($this->table, $data, $where);
        return $this->db->affected_rows();
    }

    public function search($where)
    {
        $this->db->like($where);
        $query  =   $this->db->get($this->table);
        return $query->result_array();
    }
}
