<?php

class Home extends CI_Controller{
    
    function __construct(){
        parent::__construct();
        
        $this->load->helper(array("url","date"));
        $this->load->library(array("form_validation","session","my_auth","my_layout"));
        $this->my_layout->setLayout("home/template");
     	
		if (!$this -> my_auth -> is_Login()) {
			redirect(base_url() . "login");
			exit();
		}
        $this->load->database();
        $this->load->model("muser");
        $this->load->model("mcomment");
    }
    
    //--- Homepage
    function index(){
    	$num = 10;
    	$user = $this -> muser -> getInfo($this -> my_auth ->user_id);
        $data["name"] = $user['name'];
        $data["alldata"] = $this -> mcomment -> getalldata();
        // If click twitter button
        if (isset($_POST['ok'])){
        	$count = $this -> mcomment -> num_rows();
        	$add = array(
                    "comment_id" => $count + 1,
                    "user_id" => $this->my_auth->user_id,
                    "twitter"     => $this->input->post("comment_area"),
                    "sent_time"   => date('Y-m-d H:i:s'),
                    
                                        );
            $this -> mcomment ->addComment($add);
        }
        if (isset($_POST['continue'])){
        	$num +=10;
        }
        $data['num'] = $num;
        $this->my_layout->view("home/comment",$data);     
    }
    
    //--- Profile view
    function profile(){
    	$user_id = $this -> my_auth -> user_id;
		$data['info'] = $this -> muser -> getInfo($user_id);

		//$this -> my_layout -> view("backend/user/profile_view", $data);
    }
}