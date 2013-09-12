<?php
class Verify extends CI_Controller 
{

	function __construct() 
	{
		parent :: __construct();
		$this->load->helper(array (
			"url",
			"form"
		));
		$this->load->library(array (
			"form_validation",
			"session",
			"my_auth"
		));

		$this->load->database();
		$this->load->model("muser");
	}

	//--- Login
	function login() 
	{
		if ( $this->my_auth->is_Login() ){
			redirect(base_url() . "login");
			exit ();
		}
        
		$this->form_validation->set_rules("email", "Email", "required");
		$this->form_validation->set_rules("password", "Password", "required");

		if ( $this->form_validation->run() == FALSE ){
			$this->load->view("login", array (
				"error" => ""
			));
		} else {
			$u = $this->input->post("email");
			$p = $this->input->post("password");
			$session = $this->muser->checkLogin($u, $p);
			
			//if email and password is correct then session exist
			if ($session) {
				$data = array (
					"email" => $session['email'],
					"password" => $session['password'],
					"user_id" => $session['user_id'],
				);
				$this->my_auth->set_userdata($data);
				redirect(base_url() . "home");
			} else {
				$this->load->view("login", array (
					"error" => "メールアドレスやパスワードが間違い！"
				));
			}
		}
	}

	//--- Logout
	function logout() 
	{
		// Destroy the session
		$this->my_auth->sess_read();
		$this->my_auth->sess_destroy();

		redirect(base_url() . "login");
	}

}