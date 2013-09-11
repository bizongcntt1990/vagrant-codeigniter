<?php

class Login extends CI_Controller{
    
    var $_register = "register"; // ten cua session register khi dang ki thanh vien
    var $_fgpassword = "fgpassword";
    
    function __construct(){
        parent::__construct();
        
        $this->load->helper(array("url","date","my_data"));
        $this->load->library(array("form_validation","my_layout","session","my_auth","email"));
        $this->my_layout->setLayout("frontend/template");
     
        $this->load->database();
        $this->load->model("muser"); 
    }
    
    //--- Trang chu
    function index(){
              
        if(!$this->my_auth->is_Login())
        {
            redirect(base_url()."home/verify/login");
            exit();
        }
        else
        {
            if ($this->my_auth->is_Admin()){
     			redirect(base_url()."admin/user");
     		}else if ($this->my_auth->is_Examinee()){
     			redirect(base_url()."examinee/user");
     		}else if ($this->my_auth->is_Examiner()){
     			redirect(base_url()."examiner/user");
     		}else if ($this->my_auth->is_Superadmin()){
     			redirect(base_url()."superAdmin/user");
     		}else if ($this->my_auth->is_Maketest()){
     			redirect(base_url()."maketest/user");
     		}
        }
    }
   
    
    
    //--- Ä�Äƒng kĂ­ thĂ nh cĂ´ng
    function register_complete(){

            //--- Neu Login thi khong khong bao
            if($this->my_auth->is_Login()){
                redirect(base_url()."home/login");
                exit();
            }
            
            if($this->session->userdata($this->_register)==TRUE){
                $data['report'] = "You has been register completed ! <br/>
                                   Please check your email address to active your account and use system ! <br/>";
                                   
                $this->my_layout->view("frontend/user/register_complete",$data);
            }
            else
            {
                redirect(base_url()."home/verify/login"); 
            }
    }

    //---- Quen mat khau
    function fg_password(){
        
        //--- Neu Login thi khong duoc vao trang nay
        if($this->my_auth->is_Login()){
            redirect(base_url()."home/login");
            exit();
        }

        $this->form_validation->set_rules("email","Email","required|valid_email|callback_checkEmailForgot");
        $data['error'] = "";
        
        if($this->form_validation->run()==FALSE){

            $this->load->view("frontend/fg_password",$data);
            
        }else{
             $email = $this->input->post("email");
             $info = $this->muser->getInfoByEmail($email);

             $message = "";
             //--- Neu da co tai khoan
             if($info['username']!=null){

                // reset password cho user
                $password = create_random_string(5);
                $reset = array(
                                "password" => md5($password),
                            );
                $this->muser->updateUser($reset,$info['user_id']);
                
                //--- Gui mail cho user
                $message  = "Please login with :<br/>";
                $message .= "username :".$info['username']."<br/>";
                $message .= "password:".$password;
                
                $mail = array(
                            "to_receiver"   => $email,
                            "message"       => $message,
                        );

                $this->load->library("my_email");
                $this->my_email->config($mail);
                $this->my_email->sendmail();

                $this->session->set_userdata(array($this->_fgpassword => TRUE));
                redirect(base_url()."home/login/fg_complete");
                
             }else{
                 $data['error'] = "You hasn't been actived your account, please check your email again !";
             }
             
             $this->load->view("frontend/fg_password",$data);
        }
        
    }

    //----- Thong da gui mail sau khi bĂ¡o lĂ  Ä‘Ă£ quen mat khau
    function fg_complete(){
        if($this->session->userdata($this->_fgpassword)==TRUE){
            $data['report'] = "Your email has been sending !";
            $this->my_layout->view("frontend/report",$data);
            $this->session->unset_userdata($this->_fgpassword);
        }else{
            redirect(base_url()."home/verify/login");
        }
    }
    
    
    
    
    //--- Kiá»ƒm tra user há»£p lá»‡
    function checkUser($username)
    {
        $id = $this->uri->segment(4);
        if($this->muser->getUser($username,$id)==TRUE){
            return TRUE;
        }
        else{
            $this->form_validation->set_message("checkUser","Your username has been register, please try again");
            return FALSE;
       }
    }
    
    //---- Kiem tra Email khi Ä‘Äƒng kĂ­
    function checkEmail($email)
    {
        $id = $this->uri->segment(4);
        if($this->muser->checkEmail($email,$id)==TRUE){
            return TRUE;
        }
        else{
            $this->form_validation->set_message("checkEmail","Email has been exit, please try again");
            return FALSE;
        }
    }

    //--- Kiem tra email khi quen mat khau
    function checkEmailForgot($email)
    {
        if($this->muser->checkEmail($email)==FALSE){ // co ton tai email
            return TRUE;
        }
        else{
            $this->form_validation->set_message("checkEmailForgot","Email is not avaliable , please try again !");
            return FALSE;
        }
    }
    
    function validPhone($phone){
        /*
         *  Sá»‘ há»£p lá»‡ :
            -   084.08.37610471 : true
            -  (084).(08).37610471 : true
            -  (084.08).7610471 : false
         *
         *
         */
        $rule1="^[0-9]{3}\.[0-9]{2}\.[0-9]{8}$";
        $rule2="^\([0-9]{3}\)\.\([0-9]{2}\)\.[0-9]{8}$";
        if(eregi($rule1,$phone) || eregi($rule2,$phone) ){
                return TRUE;
        }
        else{
                $error = "The phone numser is not avaliable ! It's must be 084.08.37610475 or (084).(08).37610475 or (084.08).7610475";
                $this->form_validation->set_message("validPhone",$error);
                return FALSE;
        }
    }
    
    
}