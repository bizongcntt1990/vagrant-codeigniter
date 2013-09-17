<?php

if (! defined('BASEPATH')) 
    exit('No direct script access allowed');

class MY_Email extends CI_Email 
{

     //var $CI;
    private $CI = null;
    private $_mail = null;
     
    public function __construct()
    {
        parent::__construct();
        $this->CI =& get_instance(); 
    }
     
    private function config($data)
    {
        $this->_mail = array(
                            'from_sender'       => 'Realworld Company',
                            'name_sender'       => 'Realworld,Inc',
                            'subject_sender'    => 'Register sucessful !',
                        );
        $this->_mail['to_receiver'] = $data['to_receiver'];               
        $this->_mail['message'] = $data['message'];
    }
     
    public function sendmail()
    { 
            $config['protocol']    = 'smtp';
            $config['smtp_host']    = 'ssl://smtp.gmail.com';
            $config['smtp_port']    = '465';
            $config['smtp_timeout'] = '7';
            $config['smtp_user']    = 'project.jpit.t10@gmail.com'; // gmail address
            $config['smtp_pass']    = 'hust2013'; // pass gmail
            $config['charset']    = 'utf-8';
            $config['newline']    = '\r\n';
            $config['mailtype'] = 'html'; // or html
            $config['validation'] = true; // bool whether to validate email or not      
            $this->initialize($config);
        
            $this->from($this->_mail['from_sender'], $this->_mail['name_sender']);
            $this->to($this->_mail['to_receiver']); 
        
            $this->subject($this->_mail['subject_sender']);
            $this->message($this->_mail['message']);
            $this->send();
    }
}
