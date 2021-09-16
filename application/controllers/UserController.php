<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class UserController extends CI_Controller {

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
		$this->load->view('welcome_message');
	}
	public function register()
	{	
		$this->load->view('register');
	}
	public function do_register()
	{
		
		if (count($this->input->post())>0) {
			$data = $this->input->post();
			$this->form_validation->set_rules('full_name', 'full_name', 'required');
			$this->form_validation->set_rules('password', 'Password', 'required|min_length[8]|max_length[20]');
			$this->form_validation->set_rules('retype_password', 'Confrim Password', 'required|min_length[8]|max_length[20]');
			$this->form_validation->set_rules('email', 'Email', 'required');
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
					unset($data['retype_password']);
					$this->UserModel->RegisterUser($data);
					echo "Success";
				}
				
            }

		}
	}
}
