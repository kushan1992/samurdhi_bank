<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

		$this->load->helper('url_helper');
    $this->load->model('admin_model');

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
	public function create(){
		$this->load->view('templates/header');
		$this->load->view('admin/create');
		$this->load->view('templates/footer');
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
	 		$this->form_validation->set_rules('status','Status','trim|required');

			if ($this->form_validation->run()=== FALSE){
				$this->load->view('templates/header');
				$this->load->view('admin/privilage');
				$this->load->view('templates/footer');
			}
			else{
				$data = array(
	       	  'privilege' => $this->input->post('privilage'),
	       	  'status' => $this->input->post('status'),

	       	);
	     $privilage_create = $this->admin_model->privilage_create($data);
	     if($privilage_create == true){
				$data['result_msg'] = 'Submitted Data';
				$this->load->view('templates/header');
	 			$this->load->view('admin/privilage',$data);
	 			$this->load->view('templates/footer');
			}else{
				$data['result_msg'] = 'Something Wrong';
				$this->load->view('templates/header');
	 			$this->load->view('admin/privilage',$data);
	 			$this->load->view('templates/footer');

			}
		}

	}
	public function Role(){
		//$data['get_privilage'] = $this->admin_model->get_admin_privilage();
		$this->load->view('templates/header');
		$this->load->view('admin/role');
		$this->load->view('templates/footer');
	}


}
