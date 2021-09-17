<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class UserController extends CI_Controller {

	public function index()
	{
		if(is_authenticated()) {
			$this->load->view('home_view');
		}
		$this->load->view('login_view');
	}
	public function register()
	{	
		if(is_authenticated()) {
			$this->load->view('home_view');
		}
		$this->load->view('register');
	}
	// LOGIN CONTROLLER 
	public function login_view()
	{
		if(is_authenticated()) {
			$this->load->view('home_view');
		}
		$this->load->view('login_view');
	}
	public function do_register()
	{
		if (count($this->input->post())>0) {
			$data = $this->input->post();
			$insertData = array();
			$insertData['full_name'] = $data['full_name'];
			$insertData['email'] = $data['email'];
			$insertData['phone_no'] = $data['phone_no'];
			$this->form_validation->set_rules('full_name', 'full_name', 'required');
			$this->form_validation->set_rules('password', 'Password', 'required|min_length[4]|max_length[20]');
			$this->form_validation->set_rules('retype_password', 'Confrim Password', 'required|min_length[4]|max_length[20]');
			$this->form_validation->set_rules('email', 'Email', 'required|is_unique[ci_register.email]');
			if ($this->form_validation->run() == FALSE) {
				
				$this->session->set_flashdata("error",validation_errors());
				redirect(base_url()."register");
				
            } else {
				
				$password1=$data['password'];
				$password2=$data['retype_password'];
				
				if($password1 != $password2) {
					$this->session->set_flashdata("error",'Your Password Dose not Match');
					redirect(base_url()."register");
				} else {
					$insertData['password'] = password_hash($data['passsword'],PASSWORD_DEFAULT);
					// unset($data['retype_password']);
					$this->UserModel->RegisterUser($insertData);
					$this->session->set_flashdata("success",'Successfully Registered');
					redirect(base_url()."register");
					
				}
				
            }
			
		}
		
	}

	public function login_check()
	{
		$login_data = $this->input->post();
		$q = $this->UserModel->LoginCheckModel($login_data);
		// dd($q);
		if ($q) {
			$this->session->set_userdata($q[0]);
			redirect(base_url()."home_view");
			// dd($q);
		} else {
			echo "Wrong Credentials";
		}

	}

	public function home_view()
	{	
		if(!is_authenticated()) {
			redirect(base_url()."login_view");
		}else {
			$this->load->view('home_view');
		}
	}

	public function logout()
	{	
		
		$this->session->unset_userdata(array('__ci_last_regenerate','user_id','full_name','email','phone_no','password'));
	
		$this->load->view('login_view');
	} 		
}
