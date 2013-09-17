<?php
if (! defined('BASEPATH')) 
    exit('No direct script access allowed');

class My_Auth extends CI_Session
{
    private $_model = null;
    
    public function __construct()
    {
        parent::__construct();
        $this->_model =& get_instance();
        $this->_model->load->database();
        $this->_model->load->model('muser');
    }
    
    public function is_Login()
    {
        
        if ($this->userdata('email') && $this->userdata('user_id') &&
                             $this->userdata('user_id') != '') {
            return true;
        } else {
            return false;
        }
    }
    
    public function __get($var)
    {
        return $this->userdata($var);
    }
    
}