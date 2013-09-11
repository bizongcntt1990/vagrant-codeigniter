<?php

/*
 * Author: Ngo Anh Tuan
* This controller is for getting booklet from database and display it for test maker to try
	* Date created: 09/04/2013
*/
class simulate extends CI_Controller{
	function __construct(){
		parent::__construct();
		$this->load->helper(array("url","form","my_data"));
		$this->load->library(array("input","form_validation","session","my_auth","email"));
		
		if(!$this->my_auth->is_Maketest()){
            redirect(base_url()."home/verify/login");
            exit();
        }
		$this->load->database();
		$this->load->model("doingTestModel");
		$this->load->library("my_layout"); // Sử dụng thư viện layout
		$this->my_layout->setLayout("maketest/template"); // load file layout chính (views/template.php)
	}

	function gettest($booklet_id)
	{
		$rawJSONArray=$this->doingTestModel->getBookletDataByID($booklet_id);
		//The first element in array has index of 0 and this element has an array in the index of 'data' because of the 'data' return field
		$rawJSONData=json_decode($rawJSONArray[0]['data']);
		$data["testSubTitle"]=$rawJSONData->TestSubTitle;
		$data["subject"]=$this->doingTestModel->getBookletSubjectByID($booklet_id);
		$data["testTime"]=$rawJSONData->TestTime;
		$data["starting_date"]=$this->doingTestModel->getBookletStartingDateByID($booklet_id);
		$data["expired_date"]=$this->doingTestModel->getBookletExpiredDateByID($booklet_id);
		$data["testType"]=$rawJSONData->TestType;
		/*$count=0;
		 while($rawJSONData->{$count}!=null)
		 {
		$data[$count]=$rawJSONData->{$count};
		$count=$count+1;
		}*/
		$count=0;
		//echo $rawJSONData->{'1'}->selection->{'3'};
		foreach ($rawJSONData as $item)
		{
			/*
			 * There are some tricks there: With the foreach function, it's easy to go through all the $rawJSONData,
			* each $item is an item of the $rawJSONData. But there are some miscellaneous $item that hold some miscellaneous
			* information such as Time,Title... If we get $item->question or something like that, errors will occur.
			* If we check what $item holding- miscellaneous information or question, we can avoid these errors. Checking is very simple,
			* all the question $items are instances of stdClass
			*/
			if($item instanceof stdClass)
			{
				$data['type'][$count]=$item->type;
				$data['question'][$count]=$item->question;
				$data['answer'][$count]=$item->selection;
				$data['multi_select'][$count]=$item->multi_select;
				//				echo $data['multi_select'][$count];
				$data['each_time'][$count]=$item->question_time;
				$count++;
			}

		}
		$data['numberOfQuestion']=$count;
		$data['booklet_id']=$booklet_id;
		$this->load->library('pagination');
		$config['base_url'] = base_url()."examinee/gettest";
		//$config['total_rows'] = $numberOfAllTests;
		//$config['per_page'] = $numberOfRowPerPage;
		$config['num_link'] = 3;
		$config['uri_segment'] = 4;
		$this->pagination->initialize($config);

		$data['link'] = $this->pagination->create_links();


		$this->my_layout->view("maketest/user/doParticularBookletView",$data);

	}

	function sendResult($booklet_id)
	{
		$examinee_id=$this->my_auth->user_id;
		$jsonString=$_POST['jsonString'];
		$this->doingTestModel->sendJSONResult($jsonString,$examinee_id,$booklet_id);
		redirect(base_url()."examinee/testlist");
	}


}
?>
