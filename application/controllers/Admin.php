<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

		$this->load->helper('url_helper');
    $this->load->model('admin_model');
		$this->load->helper('form');
		$this->load->library('form_validation');

		// $this->load->library('session');

	}
	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index() {
		$this->load->view('templates/header');
		$this->load->view('dashboard');
		$this->load->view('templates/footer');
	}

	public function signin() {
		$this->load->view('admin/signin');
	}

	public function process()  {
        $user = $this->input->post('username');
		$pass = $this->input->post('password');

		if((isset($user) && trim($user) !== '') && (isset($pass) && trim($pass) !== '')){
			$this->load->model('Admin_model');
			$result = $this->Admin_model->checkLogin($user, $pass);

			if(! $result){
				$data['error'] = 'Invalid Username or Password';
				$this->load->view('admin/signin', $data);
			} else{
				redirect('admin');
			}

		}
	}
	public function privilage(){
		$data['get_privilage'] = $this->admin_model->get_admin_privilage();
		$this->load->view('templates/header');
		$this->load->view('admin/privilage',$data);
		$this->load->view('templates/footer');
	}
	public function create_privilage(){
			$this->load->helper('form');
	 		$this->load->library('form_validation');

	 		$this->form_validation->set_rules('privilage','Privilage','trim|required');
	 		//$this->form_validation->set_rules('status','Status','trim|required');

			if ($this->form_validation->run()=== FALSE){
				$this->load->view('templates/header');
				$this->load->view('admin/privilage');
				$this->load->view('templates/footer');
				redirect('/admin/privilage', 'refresh');
			}
			else{
				$data = array(
	       	  'privilege' => $this->input->post('privilage'),
	       	  'status' => "active",

	       	);
	     $privilage_create = $this->admin_model->privilage_create($data);
	     if($privilage_create == true){
				$data['result_msg'] = 'Submitted Data';
				// $data['get_privilage'] = $this->admin_model->get_admin_privilage();
				// $this->load->view('templates/header');
	 			// $this->load->view('admin/privilage',$data);
	 			// $this->load->view('templates/footer');
				redirect('/admin/privilage', 'refresh');
			}else{
				$data['result_msg'] = 'Something Wrong';
				// $data['get_privilage'] = $this->admin_model->get_admin_privilage();
				// $this->load->view('templates/header');
	 			// $this->load->view('admin/privilage',$data);
	 			// $this->load->view('templates/footer');
				redirect('/admin/privilage', 'refresh');

			}
		}

	}
	public function Role(){
		$data['get_roles'] = $this->admin_model->get_admin_roles();
		$data['get_privilage'] = $this->admin_model->get_admin_privilage();
		$this->load->view('templates/header');
		$this->load->view('admin/role',$data);
		$this->load->view('templates/footer');
	}
	public function create_role(){
		$this->load->helper('form');
		$this->load->library('form_validation');

		$this->form_validation->set_rules('role','role','trim|required');
		//$this->form_validation->set_rules('status','Status','trim|required');

		if ($this->form_validation->run()=== FALSE){
			$this->load->view('templates/header');
			$this->load->view('admin/role');
			$this->load->view('templates/footer');
			redirect('/admin/role', 'refresh');
		}
		else{
			$data = array(
					'role' => $this->input->post('role'),
					'status' => "active",

				);
		 $privilage_create = $this->admin_model->role_create($data);
		 if($privilage_create == true){
			$data['result_msg'] = 'Submitted Data';
			// $data['get_roles'] = $this->admin_model->get_admin_roles();
			// $this->load->view('templates/header');
			// $this->load->view('admin/role',$data);
			// $this->load->view('templates/footer');
			redirect('/admin/role', 'refresh');
		}else{

			// $data['get_roles'] = $this->admin_model->get_admin_roles();
			// $this->load->view('templates/header');
			// $this->load->view('admin/role',$data);
			// $this->load->view('templates/footer');
			redirect('/admin/role', 'refresh');

		}
	}

	}
	public function get_permission_det(){
		$role_id = $this->input->post('id');
    if(!empty($role_id))
    {
			$check_it = $this->admin_model->check_it($role_id);
			$get_role_det = $this->admin_model->get_role_det($role_id);

			$filter_role_det = $this->admin_model->filter_role_det($role_id);
			$get_privilage = $this->admin_model->get_admin_privilage();
      $privilage_id = array();


			if($check_it){
       //checking its available or not
					 if(!empty($filter_role_det)){
						 foreach ($filter_role_det AS $row) {
							 $privilage_id[] = $row['privilege_id'];
							}
						 }else{
							 echo "No Data";
						 }

	      echo form_open('admin/update_role_privilage');
				echo '	<div class="modal-body">';
 	      echo '   <div class="row">';
 	      echo '     <div class="col-md-6">';
 	      echo '         <div class="form-group row">';
 	      echo '           <label class="col-sm-3 col-form-label">Role</label>';
 	      echo '           <div class="col-sm-9">';
				foreach ($get_role_det AS $row) {
			  echo '<input type="input" name="role" value="'.$row['role'].'" required/>';
				echo '<input type="hidden" name="roleid"  value="'.$row['idrole'].'" />';
			  }
				echo '           </div>';
 	      echo '         </div>';
 	      echo '       <h4 class="modal-title">Set Permission</h4>';
				foreach ($get_privilage AS $row) {
					echo '<input type="checkbox" name="check_list[]" value="'.$row['idprivilege'].'"';
					if(in_array($row['idprivilege'], $privilage_id)){
             echo ' checked';
					}
				echo '> '.$row['privilege'].'<br>';
				}
				echo '<br/>';
				echo '<h4 class="modal-title">Active/Deactive</h4>';
				echo '<label class="switch">';
				foreach ($get_role_det AS $row) {
				echo '<input type="checkbox" name="active" ';
        if($row['status']=="active"){
					echo 'checked>';
				}else{
					echo '>';
				 }
				}
				echo '<span class="slider round"></span>';
				echo '</label>';
				echo '</div>';
			  echo '</div>';
				echo '<div class="modal-footer">';
				echo '	<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>';
				echo '	<button type="submit" class="btn btn-success" >Submit</button>';

				echo '</div>';
				echo '</form>';
	  	}else{
			//	$get_privilage = $this->admin_model->get_admin_privilage();
        echo form_open('admin/update_role_privilage');
				echo '	<div class="modal-body">';
 	      echo '   <div class="row">';
 	      echo '     <div class="col-md-6">';
 	      echo '         <div class="form-group row">';
 	      echo '           <label class="col-sm-3 col-form-label">Role</label>';
 	      echo '           <div class="col-sm-9">';
				foreach ($get_role_det AS $row) {
			  echo '<input type="input" name="role" value="'.$row['role'].'" />';
				echo '<input type="hidden" name="roleid"  value="'.$row['idrole'].'" />';
			  }
				echo '           </div>';
 	      echo '         </div>';
 	      echo '       <h4 class="modal-title">Set Permission</h4>';
				foreach ($get_privilage AS $row) {
					echo '<input type="checkbox" name="check_list[]" value="'.$row['idprivilege'].'"> '.$row['privilege'].'<br>';
				}
				echo '<br/>';
				echo '<h4 class="modal-title">Active/Deactive</h4>';
				echo '<label class="switch">';
				foreach ($get_role_det AS $row) {
				echo '<input type="checkbox" name="active" ';

        if($row['status']=="active"){
					echo 'checked>';
				 }else{
 					echo '>';
 				 }
				}
				echo '<span class="slider round"></span>';
				echo '</label>';
				echo '</div>';
			  echo '</div>';
				echo '<div class="modal-footer">';
				echo '	<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>';
				echo '	<button type="submit" class="btn btn-success" >Submit</button>';

				echo '</div>';
				echo '</form>';
			}

    }
    else
    {
        echo "No Data";
    }
	}
	public function update_role_privilage(){

    $this->admin_model->update_role();
		$this->admin_model->delete_role_privilage();
	  $this->admin_model->update_role_privilage();
		$this->admin_model->active_role();

   redirect('/admin/role', 'refresh');

	}
	public function update_privilage(){

		$privilage_id = $this->input->post('id');
		if(!empty($privilage_id))
		{
			$get_privilage_det = $this->admin_model->get_privilage_det($privilage_id);

			echo form_open('admin/update_privilage_det');
			echo '	<div class="modal-body">';
			echo '   <div class="row">';
			echo '     <div class="col-md-6">';
			echo '         <div class="form-group row">';
			echo '           <label class="col-sm-3 col-form-label">Privilage</label>';
			echo '           <div class="col-sm-9">';
			foreach ($get_privilage_det AS $row) {
			echo '<input type="input" name="privilege" value="'.$row['privilege'].'" required/>';
			echo '<input type="hidden" name="privilegeid"  value="'.$row['idprivilege'].'" />';
			}
			echo '           </div>';
			echo '         </div>';

			echo '<br/>';
			echo '<h4 class="modal-title">Active/Deactive</h4>';
			echo '<label class="switch">';
			foreach ($get_privilage_det AS $row) {
			echo '<input type="checkbox" name="active" ';
			if($row['status']=="active"){
				echo 'checked>';
			}else{
				echo '>';
			 }
			}
			echo '<span class="slider round"></span>';
			echo '</label>';
			echo '</div>';
			echo '</div>';
			echo '<div class="modal-footer">';
			echo '	<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>';
			echo '	<button type="submit" class="btn btn-success" >Submit</button>';

			echo '</div>';
			echo '</form>';
		}
	}
	public function update_privilage_det(){
		$this->admin_model->update_privilege();
		redirect('/admin/privilage', 'refresh');
	}
	public function create(){
	  $data['get_roles'] = $this->admin_model->get_admin_roles();
		$data['admin_det'] = $this->admin_model->get_admin_det();
		$this->load->view('templates/header');
		$this->load->view('admin/create',$data);
		$this->load->view('templates/footer');
	}
	public function create_user(){
		 $this->admin_model->create_user();
		 redirect('/admin/create', 'refresh');
	}
	public function update_user(){
		$user_id = $this->input->post('id');
		if(!empty($user_id))
		{
			$get_user_det = $this->admin_model->get_user_det($user_id);
			$get_roles = $this->admin_model->get_admin_roles();

			echo form_open('admin/update_user_det');
			echo '	<div class="modal-body">';
			echo '   <div class="row">';
			echo '     <div class="col-md-6">';
			foreach ($get_user_det AS $row) {
			echo '         <div class="form-group row">';
			echo '           <label class="col-sm-4 col-form-label">Name</label>';
			echo '           <div class="col-sm-8">';
			echo '<input type="input" name="name" value="'.$row['name'].'" required/>';
			echo '<input type="hidden" name="userid"  value="'.$row['iduser'].'" />';
			echo '           </div>';
			echo '         </div>';
			echo '         <div class="form-group row">';
			echo '           <label class="col-sm-4 col-form-label">Password</label>';
			echo '           <div class="col-sm-8">';
			echo '<input type="input" name="password" value="'.$row['password'].'" required/>';
			echo '           </div>';
			echo '         </div>';
			echo '         <div class="form-group row">';
			echo '           <label class="col-sm-4 col-form-label">Role</label>';
			echo '           <div class="col-sm-8">';
			echo ' <select class="form-control form-control-md" id="exampleFormControlSelect1" name="role">';
			foreach ($get_roles AS $row2) {
          if($row2['status']== "active" && $row2['idrole']==$row['idrole']){
						echo'<option value="'.$row2['idrole'].'" selected>'.$row2['role'].'</option>';
					}elseif($row2['status']== "active"){
						echo'<option value="'.$row2['idrole'].'">'.$row2['role'].'</option>';
					}
			}
			echo'</select>';
			echo '           </div>';
			echo '         </div>';
      }
			echo '<br/>';
			echo '<h4 class="modal-title">Active/Deactive</h4>';
			echo '<label class="switch">';
			foreach ($get_user_det AS $row) {
			echo '<input type="checkbox" name="active" ';
			if($row['status']=="active"){
				echo 'checked>';
			}else{
				echo '>';
			 }
			}
			echo '<span class="slider round"></span>';
			echo '</label>';
			echo '</div>';
			echo '</div>';
			echo '<div class="modal-footer">';
			echo '	<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>';
			echo '	<button type="submit" class="btn btn-success" >Submit</button>';

			echo '</div>';
			echo '</form>';
		}
	}
	public function update_user_det(){
		$this->admin_model->update_user();
		redirect('/admin/create', 'refresh');
	}




}
