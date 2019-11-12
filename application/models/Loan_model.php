<?php

/**
 * Created by PhpStorm.
 * User: buddhi_hasanka
 * Date: 09-Feb-19
 * Time: 5:07 PM
 */

defined('BASEPATH') or exit('No direct script access allowed');

class loan_model extends CI_Model
{
    var $table1 = 'loan';
    var $table2 = 'loan_type';
    var $table3 = 'payment_schedule';
    var $table4 = 'payment_log';

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
        $this->db->select('loan.idloan, loan.idcustomer, loan.idloan_type, loan.interest, loan.duration, loan.amount, loan.installment,loan.status, loan.date, loan.iduser, loan.is_delete,loan_type.loan_name');
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

    public function round_up($value, $places)
    {
        $mult = pow(10, abs($places));
        return $places < 0 ?
            ceil($value / $mult) * $mult : ceil($value * $mult) / $mult;
    }

    public function save($data, $data_payment_schedule)
    {
        $this->db->insert($this->table1, $data);
        $id = $this->db->insert_id();

        foreach ($data_payment_schedule as $ps) {
            $ps['idloan'] = $id;
            $this->db->insert($this->table3, $ps);
        }

        //        $this->db->insert_batch($this->table3, $data_payment_schedule);
        return $id;
    }

    public function update($where, $data)
    {
        $this->db->update($this->table1, $data, $where);
        return $this->db->affected_rows();
    }

    public function search($where)
    {
        $this->db->like($where);
        $query = $this->db->get($this->table1);
        return $query->result_array();
    }

    public function get_loan_by_id($where)
    {
        $this->db->from($this->table1);
        $this->db->where($where);
        $query = $this->db->get();

        return $query->row();
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

    public function get_loan_type_by_id($where)
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
        $query = $this->db->get($this->table2);
        return $query->result_array();
    }

    public function get_customer_loans($where)
    {
        $this->db->select(
            'loan.idloan, loan.idcustomer, loan.idloan_type, loan.interest, loan.duration, loan.amount, loan.installment, 
            loan.status, loan.date, loan.iduser, loan.is_delete, loan_type.idloan_type, loan_type.loan_name'
        );
        $this->db->from('loan');
        $this->db->where($where);
        $this->db->join('loan_type', 'loan_type.idloan_type = loan.idloan_type');
        $result = $this->db->get();

        if ($result->num_rows() > 0) {
            return $result->result_array();
        } else {
            return false;
        }
    }

    public function get_loan_schedule($where)
    {
        $this->db->where($where);
        $query = $this->db->get($this->table3);
        return $query->result_array();
    }

    public function get_last_loan_payment_log($where)
    {
        $this->db->where($where);
        $this->db->order_by('date', "desc");
        $this->db->limit(1);
        $query = $this->db->get($this->table4);
        return $query->result_array();
    }

    public function get_loan_payment_log($where)
    {
        $this->db->where($where);
        $this->db->order_by('date', "desc");
        // $this->db->limit(1);
        $query = $this->db->get($this->table4);
        return $query->result_array();
    }


    public function save_payment_log($data)
    {
        $this->db->insert($this->table4, $data);
        return $this->db->insert_id();
    }

    public function update_loan_schedule($where, $data)
    {
        $this->db->update($this->table3, $data, $where);
        return $this->db->affected_rows();
    }
    
    public function updateLoanStatus($where, $data)
    {
        $this->db->update($this->table1, $data, $where);
        return $this->db->affected_rows();
    }
}
