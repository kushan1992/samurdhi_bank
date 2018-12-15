<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Customer extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

		$this->load->helper('url_helper');
		$this->load->model('customer_model');

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
	public function index()
	{
		$this->load->view('home');
	}
	public function dashboard(){
		$this->load->view('templates/header');
		$this->load->view('customer/dashboard');
		$this->load->view('templates/footer');

	}
	public function create(){

	$data['get_customer'] = $this->customer_model->get_customer();
	
		$this->load->view('templates/header');
		$this->load->view('customer/create',$data);
		$this->load->view('templates/footer');

	}
	public function create_cus(){
		$this->load->helper('form');
 		$this->load->library('form_validation');

 		$this->form_validation->set_rules('memNumber','Member Number','trim|required');
 		$this->form_validation->set_rules('name','Name','trim|required');
 		$this->form_validation->set_rules('nic','NIC','trim|required|min_length[10]|max_length[10]');
 		$this->form_validation->set_rules('address','Address','trim|required');
        $this->form_validation->set_rules('occupation','Occupation','trim|required');

		if ($this->form_validation->run()=== FALSE){
			$data['get_customer'] = $this->customer_model->get_customer();
			$this->load->view('templates/header');
			$this->load->view('customer/create',$data);
			$this->load->view('templates/footer');
		}
		else{
			$data = array(
       	  'member_no' => $this->input->post('memNumber'),
       	  'name' => $this->input->post('name'),
       	  'nic' => $this->input->post('nic'),
       	  'address' => $this->input->post('address'),
					'occupation' => $this->input->post('occupation'),					
					'date' => date("Y-m-d H:i:s"),
					'status' => 1 ,


       	);
     $cus_create = $this->customer_model->cus_create($data);
     if($cus_create == true){
			$data['result_msg'] = 'Submitted Data';
			$data['get_customer'] = $this->customer_model->get_customer();
			$this->load->view('templates/header');
 			$this->load->view('customer/create',$data);
 			$this->load->view('templates/footer');
		}else{
			$data['result_msg'] = 'Something Wrong';
			$data['get_customer'] = $this->customer_model->get_customer();
			$this->load->view('templates/header');
 			$this->load->view('customer/create',$data);
 			$this->load->view('templates/footer');

		}
		}




	}





}
