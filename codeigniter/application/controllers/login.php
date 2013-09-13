<?php

class Login extends CI_Controller
{
    
    function __construct()
    {
        parent::__construct();
        
        $this->load->helper(array("url","date"));
        $this->load->library(array("form_validation","session","my_auth","my_layout"));
        $this->my_layout->setLayout("template");
     
        $this->load->database();
        $this->load->model("muser");
    }
    
    //--- Homepage
    function index()
    {
              
        if(! $this->my_auth->is_Login() )
        {
            redirect(base_url()."verify/login");
            exit();
        }
        else
        {
            redirect(base_url()."home");
        }
    }

    //---- Register new user
    function register_new()
    {
        if( $this->my_auth->is_Login() ){
            redirect( base_url()."login" );
            exit();
        }

        $this->form_validation->set_rules("name","Name","required");
        $this->form_validation->set_rules("password","Password","required|min_length[6]|matches[repassword]");
        $this->form_validation->set_rules("email","Email","required|valid_email|callback_checkEmail");
        $data['error'] = "";
        
        
        if( $this->form_validation->run() == FALSE ){
            $data['old_name'] = $this->input->post("name");
            $data['old_email'] = $this->input->post("email");
            $this->load->view("register",$data);
            
        } else {
            if (! $this->muser->checkEmail($this->input->post("email")) ){

                $add = array(
                    "name" => $this->input->post("name"),
                    "email" => $this->input->post("email"),
                    "password" => md5($this->input->post("password")),
                    
                );
                if ( $this->muser->addUser($add) ){
                    $data['report'] = "データの追加することが成功でした!";
                    $this->my_layout->view("report",$data);
                    redirect(base_url()."login/register_complete");
                } else {
                    $data['report'] = "データの追加することが失敗でした！";
                }
            } else {
                    $data['report'] = "メールアドレスが存在しています。別のメールアドレスを入力してください！";
            }
            $data['old_name'] = $this->input->post("name");
            $data['old_email'] = $this->input->post("email");
            $this->load->view("register",$data);
        }
        
    }

    //--- Send a message when the register is completed
    function register_complete()
    {

            //--- Check login
            /*if( $this->my_auth->is_Login() ){
                redirect(base_url()."login");
                exit();
            }*/
            
            if( $this->session->userdata($this->_register)==TRUE ){
                $data['report'] = "ユーザー登録は成功です ! <br/>
                            あなたがメールでチェックしてください! <br/>";
                $this->my_layout->view("report",$data);
            } else {
                redirect(base_url()."verify/login");
            }
    }
    //---- Check exist email when user register­
    function checkEmail($email)
    {
        if(! $this->muser->checkEmail($email) ){
            return TRUE;
        } else {
            $this->form_validation->set_message("checkEmail","このメールアドレスはもう登録しました。もう一度お願いします。");
            return FALSE;
        }
    }
}