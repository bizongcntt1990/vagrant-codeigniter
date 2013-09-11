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
    }

    function is_Login(){
        
        if($this->userdata("email") && $this->userdata("password")!=""
                && $this->userdata("user_id") && $this->userdata("user_id")!="")
            return TRUE;
        else
            return FALSE;
    }
    
    function __get($var)
    {
        return $this->userdata($var);

    }
    
}