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
		//$this->form_validation->set_rules("organizations","Organization","required");
	//This part is programmed by Ngo Anh Tuan
		
		if ($this->form_validation->run() == FALSE) {
			$this->load->view("frontend/login", array (
				"error" => ""
			));
		} else {
			$u = $this->input->post("username");
			$p = $this->input->post("password");
			$o=$this->input->post("organizations");
			//Add a parameter to check the organization
			$session = $this->muser->checkLogin($u, $p, $o);
			$test = $this->muser->checkLoginWithoutMD5($u, $p);
			$checkExam = $this -> muser -> checkLoginExam($u,$p,$o);
			//echo 'session:'.$session;
			//echo 'check:'.$checkExam;
			if ($session) {
				/*
				 * This part is programmed by Ngo Anh Tuan
				 * Purpose: Prevent double login at the same time
				 */
				$flag=$session['flag'];
				
				if($flag!=1)
				{
				$data = array (
					"username" => $session['username'],
					"password" => $session['password'],
					"type" => $session['type'],
					"user_id" => $session['user_id'],
					"organization_id" => $session['organization_id'],

					
				);

				$this->my_auth->set_userdata($data);
				$flagdata['flag']='1';
				$this->muser->setFlag($session['user_id'],$flagdata);
				redirect(base_url() . "home/login");
				}
				else {
					$this->load->view("frontend/login", array (
							"error" => "別のユーザー名がログインしている!"
					));
				}
			} else if ($checkExam){
				$session = $this->muser->getexaminee($u);
				$flag=$session['flag'];
				
				if($flag!=1)
				{
				$data = array (
					"username" => $session['username'],
					"password" => $checkExam['password'],
					"type" => $session['type'],
					"user_id" => $session['user_id'],
					"organization_id" => $session['organization_id'],

					
				);

				$this->my_auth->set_userdata($data);
				$flagdata['flag']='1';
				$this->muser->setFlag($session['user_id'],$flagdata);
				redirect(base_url() . "home/login");
				}
				else {
					$this->load->view("frontend/login", array (
							"error" => "別のユーザー名がログインしている!"
					));
				}
			} else {
				$this->load->view("frontend/login", array (
					"error" => "ユーザー名やパスワードが間違い！"
				));
			}
		}
	}

	//---- Logout
	function logout() {
		$this->my_auth->sess_read();
		$flagdata['flag']='0';
		
		$this->muser->setFlag($this->my_auth->user_id,$flagdata);
		$this->my_auth->sess_destroy();

		redirect(base_url() . "home/login");
	}

}