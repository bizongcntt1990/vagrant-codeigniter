<?php

class Home extends CI_Controller
{
    public $my_const;

    public function __construct()
    {
        parent::__construct();
        
        $this->load->helper(array('url', 'date', 'form', 'array'));
        $this->load->library(array('form_validation', 'session', 
                            'my_auth', 'my_layout', 'memcached_library'));
        $this->my_layout->setLayout('home/template');
        // Load file config : my_const.php
        $this->load->config('my_const');
        $this->my_const = $this->config->item('array_const');

        if (! $this->my_auth->is_Login()) {
            redirect(base_url(). 'login');
            exit();
        }
        $this->load->database();
        $this->load->model('muser');
        $this->load->model('mcomment');
    }

    //--- Homepage
    public function index()
    {   
        $userid = $this->my_auth->user_id;
        $key_id = 'user'.$userid;
        // Lets try to get the key 
        $results = $this->memcached_library->get($key_id);
        if (! $results) {
             $query = $this->mcomment->getalldata($userid, $this->my_const['zero'], $this->my_const['max_rows']);
            // Lets store the results
            $this->memcached_library->set($key_id, $query, null);
            $num_rows = $this->mcomment->num_rows_id($userid);
            $this->memcached_library->set('num', $num_rows, null);
            // Initial array
            $data = array();
            // Get name via user_id
            $user = $this->muser->getInfo($userid);
            $data['name'] = $user['name'];
            $data['all_record'] = $num_rows;
            $data['data'] = $query;    
        } else {
            // second times is loaded
            $query = $this->memcached_library->get($key_id);
            // Get name via user_id
            $user = $this->muser->getInfo($userid);
            $data['name'] = $user['name'];
            $data['all_record'] = $this->memcached_library->get('num');
            $data['data'] = $query;
        }
        $this->my_layout->view('home/comment', $data);
    }
    
    public function save()
    {
        $this->load->helpers(array('form'));
        $data_send =  $this->input->post('data_send');
        $status = "ok";
        if (strlen($data_send) == 1 || strlen($data_send) > $this->my_const['max_chars']) {
            $status = "error";
        } else {
            $add = array(
                    'user_id' => $this->my_auth->user_id,
                    'twitter'     => $data_send,
                    'sent_time'   => date('Y-m-d H:i:s'),
                    
            );
            // Save data_send into database
            $this->mcomment->addComment($add);
        } 
        $key_id = 'user'.$this->my_auth->user_id;
        $this->memcached_library->delete($key_id);
        $userid = $this->my_auth->user_id;
        $data = array();
        $data['data'] = $this->mcomment->getalldata($userid, $this->my_const['zero'], $this->my_const['max_rows']);
        $data['status'] = $status;
        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($data));
    }
    
    public function get()
    {    
        $this->load->helpers(array('form'));
        $data_send =  $_POST['num_click'];
        $asc = $_POST['asc'];
        $current_off = ($data_send-1)*$this->my_const['max_rows'] + $asc;
        $data = array();
        // Get current offset to get data from database
        $userid = $this->my_auth->user_id;
        $data['data'] = $this->mcomment->getalldata($userid, $current_off, $this->my_const['max_rows']);

        // Send data which loaded from database to view in json format
        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($data));
    }
}