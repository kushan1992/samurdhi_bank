<?php
/**
 * Created by PhpStorm.
 * User: buddhi_hasanka
 * Date: 09-Feb-19
 * Time: 5:05 PM
 */

defined('BASEPATH') OR exit('No direct script access allowed');

class Loan extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();


        $this->load->helper('url_helper');
        $this->load->model('loan_model');
        $this->load->helper('form');

    }


    public function loans()
    {
        $data['get_loans'] = $this->loan_model->get_loans();
        $data['rowCount'] = Array(10, 20, 50, 100);

        $this->load->view('templates/header');
        $this->load->view('loan/loans', $data);
        $this->load->view('templates/footer');

    }

    public function loan_create()
    {

        $data = array(
            'idcustomer' => $this->input->post('loan_cid'),
            'idloan_type' => $this->input->post('loan_type'),
            'amount' => $this->input->post('loan_amount'),
            'interest' => $this->input->post('loan_interest'),
            'duration' => $this->input->post('loan_duration'),
            'iduser' => '1',
            'status' => $this->input->post('loan_status'),
            'date' => date("Y-m-d H:i:s"),
            'is_delete' => 1,
        );

        $insert = $this->loan_model->save($data);
        echo json_encode(array("status" => TRUE, "id"));

    }

    public function loan_update($id)
    {
        $data = array(
            'idloan_type' => $this->input->post('loan_type'),
            'amount' => $this->input->post('loan_amount'),
            'interest' => $this->input->post('loan_interest'),
            'duration' => $this->input->post('loan_duration'),
            'status' => $this->input->post('loan_status'),
            'is_delete' => 1,
        );

        $this->loan_model->update(array('idloan' => $id), $data);
        echo json_encode(array("status" => TRUE));
    }


    public function loan_search()
    {


        $data = $this->loan_model->search(array($_POST['searchType'] => $_POST['text']));
//        echo json_encode($data);
//
        if (!empty($data)) {
            foreach ($data as $row) {
                if (!empty($row['idloan'])) {
                    echo '<tr id="' . $row['idloan'] . '">';
                    echo '<td>' . $row['memnumber'] . '</td>';
                    echo '<td>' . $row['name'] . '</td>';
                    echo '<td>' . $row['nic'] . '</td>';
                    echo '<td>' . $row['occupation'] . '</td>';
                    echo '<td>' . $row['date'] . '</td>';
                    echo '<td>' . $row['status'] . '</td>';
                    echo '<td>';
                    echo '<button type="button" class="btn btn-icons btn-rounded btn-secondary" onclick="editModal(' . $row['idloan'] . ')">';
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
    function get_loan($id)
    {
        $data = $this->loan_model->get_loan_by_id(array('idloan' => $id), $id);
        echo json_encode($data);
    }


}
