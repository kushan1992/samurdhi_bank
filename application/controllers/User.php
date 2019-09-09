<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();


        $this->load->helper('url_helper');
        $this->load->model('user_model');
        $this->load->helper('form');

    }


    public function users()
    {

        $data['get_users'] = $this->user_model->get_users();
        $data['rowCount'] = Array(10, 20, 50, 100);

//        $data['search_types'] = Array(array("key" => "Member No", "value" => "memnumber"), array("key" => "Name", "value" => "name"), array("key" => "NIC", "value" => "nic"), array("key" => "Occupation", "value" => "occupation"), array("key" => "Status", "value" => "status"));

        $this->load->view('templates/header');
        $this->load->view('user/users', $data);
        $this->load->view('templates/footer');

    }

    public function cus_create()
    {

        $data = array(
            'name' => $this->input->post('cus_name'),
            'nic' => $this->input->post('cus_nic'),
            'address' => $this->input->post('cus_address'),
            'occupation' => $this->input->post('cus_occupation'),
            'date' => date("Y-m-d H:i:s"),
            'status' => $this->input->post('cus_status'),
            'is_delete' => false,
        );

        $insert = $this->user_model->save($data);
        echo json_encode(array("status" => TRUE, $insert));

    }


    public function create_user()
    {
        $this->admin_model->create_user();
        redirect('/admin/create', 'refresh');
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
            'is_delete' => false,
        );

        $this->user_model->update(array('iduser' => $id), $data);
        echo json_encode(array("status" => TRUE));
    }


    public function cus_search()
    {


        $data = $this->user_model->search(array($_POST['searchType'] => $_POST['text']));
//        echo json_encode($data);
//
        if (!empty($data)) {
            foreach ($data as $row) {
                if (!empty($row['iduser'])) {
                    echo '<tr id="' . $row['iduser'] . '">';
                    echo '<td>' . $row['name'] . '</td>';
                    echo '<td>' . $row['idrole'] . '</td>';
                    echo '<td>' . $row['date'] . '</td>';
                    echo '<td>' . $row['status'] . '</td>';
                    echo '<td>';
                    echo '<button type="button" class="btn btn-icons btn-rounded btn-secondary" onclick="editModal(' . $row['iduser'] . ')">';
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
    function get_user($id)
    {
        $data = $this->user_model->get_user_by_id(array('iduser' => $id), $id);
        echo json_encode($data);
    }


}
