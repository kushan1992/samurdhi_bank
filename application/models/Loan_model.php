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
    var $table1 = 'loan';
    var $table2 = 'loan_type';

    public function __construct()
    {
        $this->load->database();
    }

    public function loan_create($data)
    {
        echo $data;
        $this->db->insert($this->table1, $data);
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }


    public function get_loans()
    {
        $this->db->select('loan.idloan, loan.idcustomer, loan.idloan_type, loan.interest, loan.duration, loan.amount, loan.status, loan.date, loan.iduser, loan.is_delete,loan_type.loan_name');
        $this->db->from('loan');
        $this->db->join('loan_type', 'loan_type.idloan_type = loan.idloan_type');
        $result = $this->db->get();

        // $result = $this->db->get($this->table1);
        if ($result->num_rows() > 0) {
            return $result->result_array();
        } else {
            return false;
        }

    }


    public function get_loan_by_id( $where, $id)
    {
        $this->db->from($this->table1);
        $this->db->where($where);
        $query = $this->db->get();

        return $query->row();
    }

    public function save($data)
    {
        $this->db->insert($this->table1, $data);
        return $this->db->insert_id();
    }

    public function update($where, $data)
    {
        $this->db->update($this->table1, $data, $where);
        return $this->db->affected_rows();
    }

    public function search($where)
    {
        $this->db->like($where);
        $query  =   $this->db->get($this->table1);
        return $query->result_array();
    }


    public function get_loan_types()
    {
        $result = $this->db->get($this->table2);

        if ($result->num_rows() > 0) {
            return $result->result_array();
        } else {
            return false;
        }

    }


    public function save_loan_type($data)
    {
        $this->db->insert($this->table2, $data);
        return $this->db->insert_id();
    }

    public function get_loan_type_by_id( $where, $id)
    {
        $this->db->from($this->table2);
        $this->db->where($where);
        $query = $this->db->get();

        return $query->row();
    }

    public function update_loan_type($where, $data)
    {
        $this->db->update($this->table2, $data, $where);
        return $this->db->affected_rows();
    }

    public function search_loan_type($where)
    {
        $this->db->like($where);
        $query  =   $this->db->get($this->table2);
        return $query->result_array();
    }
    public function get_customer_loans($id)
    {
      $this->db->select('loan.idloan, loan.idcustomer, loan.idloan_type, loan.interest, loan.duration, loan.amount, loan.status, loan.date, loan.iduser, loan.is_delete,loan_type.loan_name');
      $this->db->from('loan');
      $this->db->where($id);
      $this->db->join('loan_type', 'loan_type.idloan_type = loan.idloan_type');
      $result = $this->db->get();

      if ($result->num_rows() > 0) {
          return $result->result_array();
      } else {
          return false;
      }
    }

}
