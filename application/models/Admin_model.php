<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class admin_model extends CI_Model
{

    public function __construct()
    {
        $this->load->database();
    }

    public function checkLogin($un, $pass)
    {

        $this->db->where('name', $un);
        $this->db->where('password', $pass);
        $result = $this->db->get('user');

        foreach ($result -> result_array() as $row) {

        }

          if(!empty($row['iduser'])){

            return $result_from_db = array(
                     'userid' => $row['iduser'],
                     'roleid' => $row['idrole'],
                     'name' => $row['name']
                       );
          }else{
            return false;
          }

    }


    function get_admin_privilage()
    {
        $this->db->select('*');
        $result = $this->db->get('privilege');

        if ($result->num_rows() > 0) {
            return $result->result_array();
        } else {
            return false;
        }
    }

    function privilage_create($data)
    {
        $this->db->insert('privilege', $data);
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    function get_admin_roles()
    {
        $this->db->select('*');
        $result = $this->db->get('role');

        if ($result->num_rows() > 0) {
            return $result->result_array();
        } else {
            return false;
        }
    }

    function role_create($data)
    {
        $this->db->insert('role', $data);
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    function check_it($role_id)
    {
        $this->db->select('privilege_id');
        $this->db->where('role_id', $role_id);
        $result = $this->db->get('role_has_privilege');
        if ($result->num_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    function filter_role_det($role_id)
    {
        $this->db->select('privilege_id');
        $this->db->where('role_id', $role_id);
        $result = $this->db->get('role_has_privilege');

        if ($result->num_rows() > 0) {
            return $result->result_array();
        } else {
            return TRUE;
        }
    }

    function get_role_det($role_id)
    {
        $this->db->select('*');
        $this->db->where('idrole', $role_id);
        $result = $this->db->get('role');

        if ($result->num_rows() > 0) {
            return $result->result_array();
        } else {
            return false;
        }
    }

    function update_role()
    {
        $role = $this->input->post('role');
        $roleid = $this->input->post('roleid');
        $this->db->set('role', $role);
        $this->db->where('idrole', $roleid);
        $this->db->update('role');
    }

    function delete_role_privilage()
    {
        $roleid = $this->input->post('roleid');
        $this->db->where('role_id', $roleid);
        $this->db->delete('role_has_privilege');
    }

    function update_role_privilage()
    {
        $check_list = array();
        $roleid = $this->input->post('roleid');
        $check_list = $this->input->post('check_list');
        $arrlength = count($check_list);

        foreach ($_POST['check_list'] as $selected) {

            $data = array(
                'role_id' => $roleid,
                'privilege_id' => $selected
            );
            $this->db->insert('role_has_privilege', $data);

        }
    }

    function active_role()
    {
        $roleid = $this->input->post('roleid');
        $active = $this->input->post('active');
        if ($active == 'on') {
            $this->db->set('status', 'active');
            $this->db->where('idrole', $roleid);
            $this->db->update('role');
        } else {
            $this->db->set('status', 'deactive');
            $this->db->where('idrole', $roleid);
            $this->db->update('role');
        }
    }

    function get_privilage_det($privilage_id)
    {
        $this->db->select('*');
        $this->db->where('idprivilege', $privilage_id);
        $result = $this->db->get('privilege');

        if ($result->num_rows() > 0) {
            return $result->result_array();
        } else {
            return false;
        }
    }

    function update_privilege()
    {
        $privilege = $this->input->post('privilege');
        $privilegeid = $this->input->post('privilegeid');
        $active = $this->input->post('active');

        if ($active == 'on') {
            $this->db->set('privilege', $privilege);
            $this->db->set('status', 'active');
            $this->db->where('idprivilege', $privilegeid);
            $this->db->update('privilege');
        } else {
            $this->db->set('privilege', $privilege);
            $this->db->set('status', 'deactive');
            $this->db->where('idprivilege', $privilegeid);
            $this->db->update('privilege');
        }

    }

    function create_user()
    {
        $name = $this->input->post('name');
        $role = $this->input->post('role');
        $password = $this->input->post('password');


        $data = array(
            'idrole' => $role,
            'name' => $name,
            'password' => $password,
            'date' => date("Y-m-d H:i:s"),
            'status' => "active"
        );
        $this->db->insert('user', $data);

    }

    function get_admin_det()
    {
        $this->db->select('*');
        $result = $this->db->get('user');

        if ($result->num_rows() > 0) {
            return $result->result_array();
        } else {
            return false;
        }
    }

    function get_user_det($user_id)
    {
        $this->db->select('*');
        $this->db->where('iduser', $user_id);
        $result = $this->db->get('user');

        if ($result->num_rows() > 0) {
            return $result->result_array();
        } else {
            return false;
        }
    }

    function update_user()
    {

        $name = $this->input->post('name');
        $iduser = $this->input->post('userid');
        $password = $this->input->post('password');
        $role = $this->input->post('role');
        $active = $this->input->post('active');

        if ($active == 'on') {
            $this->db->set('name', $name);
            $this->db->set('password', $password);
            $this->db->set('idrole', $role);
            $this->db->set('status', 'active');
            $this->db->where('iduser', $iduser);
            $this->db->update('user');
        } else {
            $this->db->set('name', $name);
            $this->db->set('password', $password);
            $this->db->set('idrole', $role);
            $this->db->set('status', 'deactive');
            $this->db->where('iduser', $iduser);
            $this->db->update('user');
        }
    }


}
