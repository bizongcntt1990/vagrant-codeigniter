<?php
/*
 * Author: Ngo Anh Tuan
 * This controller is for viewing the list of all the test available
 * Date created: 12-03-2013
 */
class testlist extends CI_Controller{
	function __construct(){
		parent::__construct();
		$this->load->helper(array("url","form","my_data"));
		$this->load->library(array("input","form_validation","session","my_auth","email"));
		
		if(!$this->my_auth->is_Examinee()){
            redirect(base_url()."home/verify/login");
            exit();
        }
		$this->load->database();
		$this->load->model("doingTestModel");
		$this->load->model("mbooklet");
		$this->load->library("my_layout"); // Sử dụng thư viện layout
		$this->my_layout->setLayout("examinee/template"); // load file layout chính (views/template.php)
	}
	
	function index()
	{
		$examinee_id=$this->my_auth->user_id;
		$password = $this ->my_auth ->password;
		//$numberOfAllTests=$this->doingTestModel->getNumberRowOfTestList($examinee_id);
		//$list_test = $this->doingTestModel->getAllAvailableTest($examinee_id);
		$numberOfAllTests=$this->doingTestModel->getNumberRowOfTestListBooklet($examinee_id,$password);
		$list_test = $this->doingTestModel->getAllAvailableTestBooklet($examinee_id,$password);
		print_r ($list_test);
		echo 'username:'.$examinee_id;
		echo 'password'.$password;
		$data['bookletList'] = $list_test;
		$data['numberOfAllTests']=$numberOfAllTests;
		// get name of maketest
		$numberOfMaketest = 0;
		foreach ( $list_test as $item ) {
       		$nameOfMaketest [$numberOfMaketest] = $this -> mbooklet -> get_maketest_from_bookletid($item['booklet_id']);
       		$numberOfMaketest++;
		}
		$data['nameMaketest'] = $nameOfMaketest;
		$numberOfRowPerPage=3;
		if($numberOfAllTests!=0)
		{
			$this->load->library('pagination');
			$config['base_url'] = base_url()."examinee/testlist/index";
			$config['total_rows'] = $numberOfAllTests;
			$config['per_page'] = $numberOfRowPerPage;
			$config['num_link'] = 3;
			$config['uri_segment'] = 4;
			$this->pagination->initialize($config);
			 
			$data['link'] = $this->pagination->create_links();


			$this->my_layout->view("examinee/user/listTestAvailableView",$data);
			
		}
		else
		{
			$data['report'] = "今テストがない!";
			$this->my_layout->view("examinee/report",$data);
		}
	}
}