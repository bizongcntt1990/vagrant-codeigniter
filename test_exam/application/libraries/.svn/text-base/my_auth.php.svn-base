<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class My_Auth extends CI_Session
{
    var $CI;
    var $_model;
    
    function __construct(){
        parent::__construct();
        $CI =& get_instance();
        
        $this->_model = $CI;
        $this->_model->load->database();
        $this->_model->load->model("muser");
        $this->_model->load->model("morganization");
    }
    function check_expired_organization($or_id){
    	$info = $this->_model->morganization->getInfo($or_id);
    	$currentTime = strtotime(date('Y-m-d'));
       	$expiredTime = strtotime($info['expired_date']);
 
    	if ($currentTime <= $expiredTime){
    		return -1; //Not expired
    	}else {
    		return ($currentTime - $expiredTime)/(60*60*24);
    	}
    }
    function is_Admin(){
        $info = $this->_model->muser->getInfo($this->userdata("user_id"));
        if($this->is_Login() && $info['type']=="01000"){
            return TRUE;
        }
        else{
            return FALSE;
        }
    }
    
    function is_Examinee()
    {
       $info = $this->_model->muser->getInfo($this->userdata("user_id"));
        
        if($this->is_Login() && $info['type']=="00001"){
            return TRUE;
        }
        else{
            return FALSE;
        }
    }
    
    function is_Examiner()
    {
       $info = $this->_model->muser->getInfo($this->userdata("user_id"));
        
        if($this->is_Login() && $info['type']=="00010"){
            return TRUE;
        }
        else{
            return FALSE;
        }
    }
     function is_Maketest()
    {
       $info = $this->_model->muser->getInfo($this->userdata("user_id"));
        
        if($this->is_Login() && $info['type']=="00100"){
            return TRUE;
        }
        else{
            return FALSE;
        }
    }
    function is_Superadmin()
    {
       $info = $this->_model->muser->getInfo($this->userdata("user_id"));
        
        if($this->is_Login() && $info['type']=="10000"){
            return TRUE;
        }
        else{
            return FALSE;
        }
    }
  
    function is_Login(){
        
        if($this->userdata("username") && $this->userdata("username")!=""
                && $this->userdata("user_id") && $this->userdata("user_id")!=""){
                	$info = $this->_model->muser->getInfo($this->userdata("user_id"));
                	if ($this->userdata("organization_id")!=null){
                		if (($this->check_expired_organization($info['organization_id']) == -1 ))
                			return TRUE;//&&($this->userdata("type")!="00001")
                		else if (($this->check_expired_organization($info['organization_id'])> 0) && ($this->check_expired_organization($info['organization_id']) <730)&&($this->userdata("type")!="00001"))
                			return TRUE;
                		else {
                			$flagdata['flag']='0';
							$this->_model->muser->setFlag($this->userdata("user_id"),$flagdata);
                			return FALSE;
                		}	
                	}
                	return TRUE;
                }
            
        else
            return FALSE;
    }
    
    function __get($var)
    {
        return $this->userdata($var);

    }
    
}