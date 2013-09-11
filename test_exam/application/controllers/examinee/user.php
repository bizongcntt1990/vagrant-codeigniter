<?php
/*
 * @author: Ngo Anh Tuan
 * @11/03/13
 * /examinee/user.php
 */
class User extends CI_Controller{

    var $_mail;
    
    function  __construct() 
    {
    	/*
    	 * Construct function: If the logged in person is an examinee, redirect to examinee/verify/login
    	 */
        parent::__construct();
        $this->load->helper(array("url","form","my_data"));
        $this->load->library(array("input","form_validation","session","my_auth","email"));
        
        if(!$this->my_auth->is_Examinee()){
            redirect(base_url()."home/verify/login");
            exit();
        }
        
        $this->load->database();
        $this->load->model("muser");
        $this->load->library("my_layout"); // Sử dụng thư viện layout
        $this->my_layout->setLayout("examinee/template"); // load file layout chính (views/template.php)
    }       
     


    function index(){
        
	//This is the index page when examinee comes to the test system.
	//It's the good place to display the list of the test
    	$this->muser->getalldata();
    	$o_id=$this->my_auth->organization_id;
    	$max = $this->muser->num_rows_orid($o_id);
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

    		redirect(base_url()."examinee/testlist");
    	
    	}else{
    	
    		$data['report'] = "表示するデータがありません！";
    		$this->my_layout->view("backend/report",$data);
    	}
    } 
    
    function profile()
    {
    	$user_id=$this->my_auth->user_id;
    	$data['info'] = $this->muser->getInfo($user_id);
        $this->my_layout->view("examinee/user/profile_view",$data);
    }
     function edit(){
        $user_id = $this->uri->segment(4);
        $data['info'] = $this->muser->getInfo($user_id);
       
        if(is_numeric($user_id) && $data['info']!=NULL)
        {
            
            if(isset($_POST['ok']))
            {
                $this->form_validation->set_rules("full_name","Full name","required");
                $this->form_validation->set_rules("username","Username","required|max_length[25]");
                //$this->form_validation->set_rules("password","Password","matches[repassword]");
                $this->form_validation->set_rules("email","Email","required|valid_email|callback_checkEmail");
                $this->form_validation->set_rules("address","Address","required");
                //$this->form_validation->set_rules("phone","Phone number","required|callback_validPhone");
          		$this->form_validation->set_rules("phone","Phone number","required|numeric");

                $data['error'] = "";
                if($this->form_validation->run()==FALSE){
   
                    $this->my_layout->view("examinee/user/edit_view",$data);
                
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
                                    "type"     => "00001",
                                    "birthday"    => $date,
                                   
                                 );
                  
                  
                      		$this->muser->updateUser($update,$user_id);
                      		redirect(base_url()."examinee/user/profile");
                }
            }
            else
            {
                $this->my_layout->view("examinee/user/edit_view",$data);   
            }
            
        }
        else
        {
            
            $data['report'] = "このURLが無効です！";
            $this->my_layout->view("backend/report",$data);
        }
    }

    
}
?>
