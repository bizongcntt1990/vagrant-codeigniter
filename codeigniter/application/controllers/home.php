<?php

class Home extends CI_Controller{
    
    public function __construct()
    {
        parent::__construct();
        
        $this->load->helper(array("url","date","form"));
        $this->load->library(array("form_validation","session","my_auth","my_layout"));
        $this->my_layout->setLayout("home/template");
     	
		if (! $this -> my_auth -> is_Login() ) {
			redirect(base_url() . "login");
			exit();
		}
        $this->load->database();
        $this->load->model("muser");
        $this->load->model("mcomment");
    }
    
    //--- Homepage
    function index()
    {   
        // Initial array
        $data = array();
        // Store offset variable to get limit in database
    	$array_off = array(
            'off' => 0,
         );
        $this->load->vars($array_off);

        // Get name via user_id
    	$user = $this->muser->getInfo($this->my_auth->user_id);
        $data["name"] = $user['name'];
        $data["all_record"] = $this->mcomment->num_rows();
        $data['data'] = $this->mcomment->getalldata(0,10);
        $this->my_layout->view("home/comment",$data);     
    }
    
    function save()
    {
        $data_send =  $_REQUEST["data_send"];
        
        $this->load->helpers(array("form"));
        $add = array(
                    "user_id" => $this->my_auth->user_id,
                    "twitter"     => $data_send,
                    "sent_time"   => date('Y-m-d H:i:s'),
                    
        );
        // Save data_send into database
        $this->mcomment->addComment($add);

        $data = array();
        $data['data'] = $this->mcomment->getalldata(0,10);
        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($data));
    }
    
    function get()
    {    
        $this->load->helpers(array("form"));
        $data = array();
        // Get current offset to get data from database
        $current_off = $this->load->get_var("off") + 10;
        $data["data"] = $this->mcomment->getalldata($current_off,10);
        // Store new offset value 
        $array_off = array(
            'off' => $current_off,
         );
        $this->load->vars($array_off);
        // Send data which loaded from database to view in json format
		$this->output
    		->set_content_type('application/json')
    		->set_output(json_encode($data));
    }
}