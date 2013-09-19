<?php
class Verify extends CI_Controller 
{
	private $rules = array(
        array(
            'field' => 'email',
            'label' => 'Email',
            'rules' => 'trim|required|xss_clean|valid_email'
        ),
        array(
        	'field' => 'password',
        	'label' => 'Password',
        	'rules' => 'trim|required|xss_clean'
        ),
    );

	public function __construct() 
	{
		parent::__construct();
		$this->load->helper(array(
			'url',
			'form'
		));
		$this->load->library(array(
			'form_validation',
			'session',
			'my_auth',
			'memcached_library'
		));
		$this->form_validation->set_rules($this->rules);
		$this->load->database();
		$this->load->model('muser');
	}

	//--- Login
	public function login() 
	{
		if ($this->my_auth->is_Login()) {
			redirect(base_url(). 'login');
			exit ();
		}
		if ($this->form_validation->run() === false) {
			$add = array(
                'error' => '',
            );
			$this->load->view('login',$add);
		} else {
			$u = $this->input->post('email');
			$p = $this->input->post('password');
			$session = $this->muser->checkLogin($u, $p);
			
			//if email and password is correct then session exist
			if ($session) {
				$data = array(
					'email' => $session['email'],
					'user_id' => $session['user_id'],
				);
				$this->my_auth->set_userdata($data);
				redirect(base_url(). 'home');
			} else {
				$add = array(
                    'error' => 'メールアドレスやパスワードが間違い！',
                );
				$this->load->view('login', $add);
			}
		}
	}

	//--- Logout
	public function logout() 
	{
		// Destroy the session
		$this->my_auth->sess_read();
		$this->my_auth->sess_destroy();
		//$this->memcached_library->flush();
		redirect(base_url(). 'login');
	}

}