<?php

class Login extends CI_Controller
{
    private $rules = array(
        array(
            'field' => 'name',
            'label' => 'Name',
            'rules' => 'required|max_length[40]'
        ),
        array(
            'field' => 'email',
            'label' => 'Email',
            'rules' => 'required|valid_email|callback_checkEmail'
        ),
        array(
            'field' => 'password',
            'label' => 'Password',
            'rules' => 'required|min_length[6]|matches[repassword]'
        ),
    );

    function __construct()
    {
        parent::__construct();        
        $this->load->helper(array('url', 'date'));
        $this->load->library(array('form_validation', 'session', 
                            'my_auth', 'my_layout', 'email'));
        $this->my_layout->setLayout('template');
        $this->form_validation->set_rules($this->rules);
        $this->load->database();
        $this->load->model('muser');
    }
    
    //--- Homepage
    public function index()
    {
              
        if (! $this->my_auth->is_Login()) {
            redirect(base_url().'verify/login');
            exit();
        } else {
            redirect(base_url().'home');
        }
    }

    //---- Register new user
    public function register_new()
    {
        if ($this->my_auth->is_Login()) {
            redirect(base_url().'login');
            exit();
        }
        $data['error'] = "";
        if ($this->form_validation->run() == false) {
            $this->load->view('register', $data);     
        } else {
            if (! $this->muser->checkEmail($this->input->post('email'))) {
                $add = array(
                    'name' => $this->input->post('name'),
                    'email' => $this->input->post('email'),
                    'password' => md5($this->input->post('password')),
                    
                );
                if ($this->muser->addUser($add)) {
                    $add_user = $this->muser->getInfoByEmail($this->input->post('email'));
                    // Store data into session
                    $data = array(
                        'email' => $this->input->post('email'),
                        'user_id' => $add_user['user_id'],
                    );
                    $this->my_auth->set_userdata($data);
                    // Send mail to user when register is sucessful
                    $message  = 'Your account :<br/>';
                    $message .= 'email :'. $this->input->post('email').'<br/>';
                    $message .= 'password:'. $this->input->post('password');
                    $mail = array(
                            'to_receiver' => $this->input->post('email'),
                            'message'     => $message,
                    );
                    //$this->email->config($mail);
                    //$this->email->sendmail();
                
                    redirect(base_url().'home');
                } else {
                    $data['report'] = 'データの登録に失敗しました！';
                }
            } else {
                    $data['report'] = 'メールアドレスが存在しています。別のメールアドレスを入力してください！';
            }
            $this->load->view('register',$data);
        }
        
    }

    //--- Send a message when the register is completed
    private function register_complete()
    {
            //--- Check login
            if ($this->my_auth->is_Login()) {
                redirect(base_url().'login');
                exit();
            }
            if ($this->session->userdata($this->_register) === true) {
                $data['report'] = "ユーザー登録は成功です ! <br/>
                            あなたがメールでチェックしてください! <br/>";
                $this->my_layout->view('report',$data);
            } else {
                redirect(base_url().'verify/login');
            }
    }
    //---- Check exist email when user register­
    public function checkEmail($email)
    {
        if (! $this->muser->checkEmail($email)) {
            return true;
        } else {
            $this->form_validation->set_message("checkEmail","このメールアドレスはもう登録しました。もう一度お願いします。");
            return false;
        }
    }
}