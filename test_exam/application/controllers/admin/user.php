<?php

class User extends CI_Controller{

    var $_mail;
    
    function  __construct() 
    {
        parent::__construct();
        $this->load->helper(array("url","form","my_data"));
        $this->load->library(array("input","form_validation","session","my_auth","email"));
        
        if(!$this->my_auth->is_Admin()){
            redirect(base_url()."home/verify/login");
            exit();
        }
        
        $this->load->database();
        $this->load->model("muser");
        $this->load->model("mexam");
        $this->load->library("my_layout"); // Sử dụng thư viện layout
        $this->my_layout->setLayout("backend/template"); // load file layout chính (views/template.php)
    }       
     

    //--- Danh sach thanh vien
    function index(){
        
        $this->muser->getalldata();
        $o_id=$this->my_auth->organization_id;
        $max = $this->muser->num_rows_oridadmin($o_id);
        $min = 3;
        $data['num_rows'] = $max;
        //--- Paging
        if($max!=0){
            
            $this->load->library('pagination');
            $config['base_url'] = base_url()."admin/user/index";
            $config['total_rows'] = $max;
            $config['per_page'] = $min;
            $config['num_link'] = 3; 
            $config['uri_segment'] = 4;
            $this->pagination->initialize($config);
            
            $data['link'] = $this->pagination->create_links();
            $user_id=$this->my_auth->user_id;
            $type_id=$this->my_auth->type_id;
            //$data['users'] = $this->muser->getalldata($min,$this->uri->segment($config['uri_segment']));
            $data['users'] = $this->muser->getoridadmin($o_id);
            $data['id'] = $user_id;
            $this->my_layout->view("backend/user/list_view",$data);
        
        }else{
            $data['report'] = "表示するデータがありません";
            $this->my_layout->view("backend/report",$data);
        }
        
        
    } 
    //---- Add new user
    function add()
    {
        $this->form_validation->set_rules("full_name","Full name","required|min_length[6]");
        $this->form_validation->set_rules("username","Username","required|max_length[25]|callback_checkUser");
        $this->form_validation->set_rules("password","Password","required|matches[repassword]");
        $this->form_validation->set_rules("email","Email","required|valid_email|callback_checkEmail");
        $this->form_validation->set_rules("address","Address","required");
        //$this->form_validation->set_rules("phone","Phone number","required|callback_validPhone");
        $this->form_validation->set_rules("phone","Phone number","required|numeric");
        $data['error'] = "";
        if($this->form_validation->run()==FALSE){
            
            $this->my_layout->view("backend/user/add_view",array("error"=>""));
        }
        else
        {
                $salt = create_random_string(5);
                $day=$_POST['day'];
                $month=$_POST['month'];
                $year=$_POST['year'];
             	
                $date = date("Y-m-d", mktime(0,0,0,$month, $day, $year));
                $add = array(
                        "organization_id" => $this->my_auth->organization_id,
                        "username"  => $this->input->post("username"),
                         "name" => $this->input->post("full_name"),
                        "password"  => md5($this->input->post("password")),
                        "type"     => $_POST['type'],
                        "phone"   => $this->input->post("phone"),
                        "email"     => $this->input->post("email"),
                        "address"   => $this->input->post("address"),
                        "birthday"     => $date,
                                        );
                //This code is already editted by Ngo Anh Tuan, to check conflicted username with organization included
                //if (!$this->muser->checkExistUsername($add['username'])){ | original code
                if (!$this->muser->checkExistUsernameWithOrganization($add['username'],$add['organization_id'])){
                	if ($this->muser->addUser($add)){
                		$data['report']="データの追加することが成功です!";
                		$this->my_layout->view("backend/report",$data); 
                	} else $this->my_layout->view("backend/user/add_view",$data);
                		
                }else{
                	$data['report']="ユーザー名が存在しています。別のユーザー名を入力ください！";
                	$this->my_layout->view("backend/report",$data);
                }
         }

    }
    //--- Cap nhat user
    function edit(){
        $user_id = $this->uri->segment(4);
        $data['info'] = $this->muser->getInfo($user_id);
       
        if(is_numeric($user_id) && $data['info']!=NULL)
        {
            
            if(isset($_POST['ok']))
            {
                $this->form_validation->set_rules("full_name","Full name","required|min_length[6]");
                $this->form_validation->set_rules("username","Username","required|max_length[25]");
                $this->form_validation->set_rules("password","Password","matches[repassword]");
                //$this->form_validation->set_rules("email","Email","required|valid_email|callback_checkEmail");
                //$this->form_validation->set_rules("address","Address","required");
                //$this->form_validation->set_rules("phone","Phone number","required|callback_validPhone");
          		$this->form_validation->set_rules("phone","Phone number","required|numeric");

                $data['error'] = "";
                if($this->form_validation->run()==FALSE){
   
                    $this->my_layout->view("backend/user/edit_view",$data);
                
                }else{
                    $day=$_POST['day'];
                	$month=$_POST['month'];
                	$year=$_POST['year'];
             	
                	$date = date("Y-m-d", mktime(0,0,0,$month, $day, $year));
                    $update = array(
                                    "name" => $this->input->post("full_name"),
                                    "username"  => $this->input->post("username"),
                                    "email"     => $this->input->post("email"),
                                    "address"   => $this->input->post("address"),
                                    "phone"     => $this->input->post("phone"),
                                    "type"     => $_POST['type'],
                                    "birthday"    => $date,
                                   
                                 );
                      if($this->input->post("password")!="")
                      {
                         $update['password'] = md5($this->input->post("password"));
                      }
                      
					  $this->muser->updateUser($update,$user_id);
                      redirect(base_url()."admin/user");
                       
                }
            }
            else
            {
                $this->my_layout->view("backend/user/edit_view",$data);   
            }
            
        }
        else
        {
            
            $data['report'] = "あなたのURLが無効です！";
            $this->my_layout->view("backend/report",$data);
        }
    }
	// edit profile
	function editProfile() {
		$user_id = $this -> uri -> segment(4);
		$data['info'] = $this -> muser -> getInfo($user_id);

		if (is_numeric($user_id) && $data['info'] != NULL) {

			if (isset($_POST['ok'])) {
				$this -> form_validation -> set_rules("full_name", "Full name", "required|min_length[6]");
				$this -> form_validation -> set_rules("username", "Username", "required|max_length[25]|callback_checkUser");
				$this -> form_validation -> set_rules("password", "Password", "matches[repassword]");
				//$this -> form_validation -> set_rules("email", "Email", "required|valid_email|callback_checkEmail");
				$this -> form_validation -> set_rules("address", "Address", "required");
				$this->form_validation->set_rules("phone","Phone number","required|numeric");

				$data['error'] = "";
				if ($this -> form_validation -> run() == FALSE) {

					$this -> my_layout -> view("backend/user/editProfile_view", $data);

				} else {
					$day = $_POST['day'];
					$month = $_POST['month'];
					$year = $_POST['year'];

					$date = date("Y-m-d", mktime(0, 0, 0, $month, $day, $year));
					$update = array("name" => $this -> input -> post("full_name"),
									 "username" => $this -> input -> post("username"), 
									 "email" => $this -> input -> post("email"), 
									 "address" => $this -> input -> post("address"), 
									 "phone" => $this -> input -> post("phone"), 
									 "birthday" => $date, );
					if ($this -> input -> post("password") != "") {
						$update['password'] = md5($this -> input -> post("password"));
					}

					$this -> muser -> updateUser($update, $user_id);
					redirect(base_url() . "admin/user");
				}
			} else {
				$this -> my_layout -> view("backend/user/editProfile_view", $data);
			}

		} else {

			$data['report'] = "あなたのURLが無効です！";
			$this -> my_layout -> view("backend/report", $data);
		}
	}
	
    //--- Profile view
    function profile(){
    	$user_id = $this -> my_auth -> user_id;
		$data['info'] = $this -> muser -> getInfo($user_id);

		$this -> my_layout -> view("backend/user/profile_view", $data);
    }
    //--- Cap nhat user
    function edit_profile(){
        $user_id = $this->uri->segment(4);
        $data['info'] = $this->muser->getInfo($user_id);
       
        if(is_numeric($user_id) && $data['info']!=NULL)
        {
            
            if(isset($_POST['ok']))
            {
                $this->form_validation->set_rules("full_name","Full name","required|min_length[6]");
                $this->form_validation->set_rules("username","Username","required|max_length[25]");
                $this->form_validation->set_rules("password","Password","matches[repassword]");
                $this->form_validation->set_rules("email","Email","required|valid_email|callback_checkEmail");
                $this->form_validation->set_rules("address","Address","required");
                //$this->form_validation->set_rules("phone","Phone number","required|callback_validPhone");
          		$this->form_validation->set_rules("phone","Phone number","required|numeric");

                $data['error'] = "";
                if($this->form_validation->run()==FALSE){
   
                    $this->my_layout->view("backend/user/profile_edit",$data);
                
                }else{
                    $day=$_POST['day'];
                	$month=$_POST['month'];
                	$year=$_POST['year'];
             	
                	$date = date("Y-m-d", mktime(0,0,0,$month, $day, $year));
                    $update = array(
                                    "name" => $this->input->post("full_name"),
                                    "username"  => $this->input->post("username"),
                                    "email"     => $this->input->post("email"),
                                    "address"   => $this->input->post("address"),
                                    "phone"     => $this->input->post("phone"),
                                    "type"     => "01000",
                                    "birthday"    => $date,
                                   
                                 );
                      if($this->input->post("password")!="")
                      {
                         $update['password'] = md5($this->input->post("password"));
                      }
                  
                      		$this->muser->updateUser($update,$user_id);
                      		redirect(base_url()."admin/user/profile");
                       
                }
            }
            else
            {
                $this->my_layout->view("backend/user/profile_edit",$data);   
            }
            
        }
        else
        {
            
            $data['report'] = "あなたのURLが無効です！";
            $this->my_layout->view("backend/report",$data);
        }
    }
    //--- Xoa user
    function delete(){
        $userid = $this->uri->segment(4);
        
        if(is_numeric($userid)){
            
            $this->muser->deleteUser($userid);
            $this->mexam->deleteExaminee($userid);
            redirect(base_url()."admin/user");
        
        }else{
            
            $data['report'] = "あなたのURLが無効です！";
            $this->my_layout->view("backend/report",$data);
        }
    }
    function send_info(){
    	$check = $this->mexam->getallbookletid();
    	if ($check){
    			if (isset($_POST['ok'])){
    			$data['error'] = "";
            	$bookletid=$_POST['booklet'];
 				redirect(base_url()."admin/user/send_test/".$bookletid);
    		}else{
    			$max = $this->mexam->num_rows_bookletid();
        		$data['num_rows'] = $max;
        		//--- Paging
       		 	if($max!=0){
            		$data['exams'] = $this->mexam->getallbookletid();
            		$this->my_layout->view("backend/user/select_test",$data);
       			 }
    		}
    	}else {
    		$data['report'] = "ひょうじするBOOKLETがありません！";
            $this->my_layout->view("backend/report",$data);
    	}
    	
    }
    function send_test(){
    	$booklet_id = $this->uri->segment(4);
    	if (is_numeric($booklet_id)){
              	$max = $this->mexam->num_rows_userexam($booklet_id);
        		$data['num_rows'] = $max;
        		$min=3;
        		//--- Paging
        		if($max!=0){
            
            		$this->load->library('pagination');
            		$config['base_url'] = base_url()."admin/user/send_test";
            		$config['total_rows'] = $max;
            		$config['per_page'] = $min;
            		$config['num_link'] = 3; 
            		$config['uri_segment'] = 4;
            		$this->pagination->initialize($config);
            
            		$data['link'] = $this->pagination->create_links();
            		$data['users'] = $this->mexam->getuserexam($booklet_id);
            		$this->my_layout->view("backend/user/examinee_view",$data);
        		}else{
           			 $data['report'] = "表示するデータがありません！";
            		 $this->my_layout->view("backend/report",$data);
        		}
        }
        else
        {
            $data['report'] = "あなたのURLが無効です！";
            $this->my_layout->view("backend/report",$data);
        }     
    }
    //--- Send email to user
    function send_email(){
    	$userid = $this->uri->segment(4);
    	if (is_numeric($userid)){
                $userinfo= $this->muser->getInfo($userid);
                $link_test = base_url()."home/login";
                $message  = "このリンクによってあなたのアカウントをテストする <br/>";
                $message .= "リンク : <a href=".$link_test.">".$link_test."</a><br/>";
                $message .= "ユーザー名 : ".$userinfo['username']."<br/>";
                $message .= "パスワード : ".$userinfo['password'];

                $mail = array(
                                "to_receiver"   => $userinfo['email'],
                                "message"       => $message,
                            );

                $this->load->library("my_email");
                $this->my_email->config($mail);
                $this->my_email->sendmail();

                //$this->session->set_userdata(array($this->_register => TRUE));
                $data['report'] = "採点者にメールを送信したことが成功";
            	$this->my_layout->view("backend/report",$data);
    			
    	}		
     }
    //--- Kiểm tra user hợp lệ
   function checkUser($username)
    {
    	/*This code is edited by Ngo Anh Tuan
    	 * 
    	 *Before editing: Check user will return false if there is a user with the same user name but different organization
    	 *This error is the result of the lacking check of organization ID
    	 *Edit: Check organization ID in the getUser utility function
    	*/
        $id = $this->uri->segment(4);
        $organization_id=$this->my_auth->organization_id;
        if($this->muser->getUserForCheckingExistingUser($username,$id,$organization_id)==TRUE){
            return TRUE;
        }
        else{
            $this->form_validation->set_message("checkUser","あなたのユーザー名が存在している、他のユーザー名を作ってお願いします！");
            return FALSE;
       }
    }
    
    //---- Kiem tra Email
    function checkEmail($email)
    {
        $id = $this->uri->segment(4);
        if($this->muser->checkEmail($email,$id)==TRUE){
            return TRUE;
        }
        else{
            $this->form_validation->set_message("checkEmail","メールが存在している、もう一度お願いします！");
            return FALSE;
        }
    }

    function validPhone($phone){
    
        $rule1="^[0-9]{11}$";
     
        if(eregi($rule1,$phone)){
                return TRUE;
        }
        else{
                $error = "電話番号が正しくない ! ぜひすべては数字です！";
                $this->form_validation->set_message("validPhone",$error);
                return FALSE;
        }
    }
    
}
?>
