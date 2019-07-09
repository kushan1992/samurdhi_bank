<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Customer extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();


        $this->load->helper('url_helper');
        $this->load->model('customer_model');
        $this->load->helper('form');
        $this->load->library('session');

    }


    public function customers()
    {

        $data['get_customers'] = $this->customer_model->get_customers();
        $data['rowCount'] = Array(10, 20, 50, 100);
        $this->load->view('templates/header');
        $this->load->view('customer/customers', $data);
        $this->load->view('templates/footer');

    }

    public function cus_create()
    {

        $data = array(
            'memnumber' => $this->input->post('cus_number'),
            'name' => $this->input->post('cus_name'),
            'nic' => $this->input->post('cus_nic'),
            'address' => $this->input->post('cus_address'),
            'occupation' => $this->input->post('cus_occupation'),
            'date' => date("Y-m-d H:i:s"),
            'status' => $this->input->post('cus_status'),
            'is_delete' => 1,
        );

        $insert = $this->customer_model->save($data);
        echo json_encode(array("status" => TRUE, $insert));

    }

    public function cus_update($id)
    {
        $data = array(
            'memnumber' => $this->input->post('cus_number'),
            'name' => $this->input->post('cus_name'),
            'nic' => $this->input->post('cus_nic'),
            'address' => $this->input->post('cus_address'),
            'occupation' => $this->input->post('cus_occupation'),
            'status' => $this->input->post('cus_status'),
            'is_delete' => 1,
        );

        $this->customer_model->update(array('idcustomer' => $id), $data);
        echo json_encode(array("status" => TRUE));
    }


    public function cus_search()
    {


        $data = $this->customer_model->search(array($_POST['searchType'] => $_POST['text']));
//        echo json_encode($data);
//
        if (!empty($data)) {
            foreach ($data as $row) {
                if (!empty($row['idcustomer'])) {
                    echo '<tr id="' . $row['idcustomer'] . '">';
                    echo '<td>' . $row['memnumber'] . '</td>';
                    echo '<td>' . $row['name'] . '</td>';
                    echo '<td>' . $row['nic'] . '</td>';
                    echo '<td>' . $row['occupation'] . '</td>';
                    echo '<td>' . $row['date'] . '</td>';
                    echo '<td>' . $row['status'] . '</td>';
                    echo '<td>';
                    echo '<button type="button" class="btn btn-icons btn-rounded btn-secondary" onclick="editModal(' . $row['idcustomer'] . ')">';
                    echo '<i class="mdi mdi-pencil"></i>';
                    echo '</button>';
//                    echo '<button type="button" class="btn btn-icons btn-rounded btn-danger">';
//                    echo '<i class="mdi mdi-delete"></i>';
//                    echo '</button>';
                    echo '</td>';
                    echo '</tr>';
                }
            }
        } else {
            echo '<tr class="emptyTable">';
            echo '<td colspan="7"> <h4 class="text-danger">No Results Found!</h4></td>';
            echo '</tr>';
        }

    }

    public
    function get_customer($id)
    {
        $data = $this->customer_model->get_customer_by_id(array('idcustomer' => $id), $id);
        echo json_encode($data);
    }


}
