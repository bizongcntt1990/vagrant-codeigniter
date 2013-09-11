<?php
class Verify extends CI_Controller {

	function __construct() {

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
	function login() {
		if ($this->my_auth->is_Login()) {
			redirect(base_url() . "home/login");
			exit ();
		}

		$this->form_validation->set_rules("username", "Username", "required");
		$this->form_validation->set_rules("password", "Password", "required");

		if ($this->form_validation->run() == FALSE) {
			$this->load->view("frontend/login", array (
				"error" => ""
			));
		} else {
			$u = $this->input->post("username");
			$p = $this->input->post("password");
			$session = $this->muser->checkLogin($u, $p);

			if ($session) {

				$data = array (
					"username" => $session['username'],
					"password" => $session['password'],
					"type" => $session['type'],
					"user_id" => $session['user_id'],
					"organization_id" => $session['organization_id'],
					
				);

				$this->my_auth->set_userdata($data);
				redirect(base_url() . "home/login");
			} else {
				$this->load->view("frontend/login", array (
					"error" => "Username or Password wrong"
				));
			}
		}
	}

	//---- Logout
	function logout() {
		$this->my_auth->sess_destroy();
		redirect(base_url() . "home/verify/login");
	}

}