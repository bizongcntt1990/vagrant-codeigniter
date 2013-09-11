<?php
/*
 * Author: Ngo Anh Tuan
 * This controller is for getting booklet from database and display it for examinee to do
 * Date created: 13-03-2013
 */
class dotest extends CI_Controller{
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
		$this->load->library("my_layout"); // Sử dụng thư viện layout
		//$this->load->controller("examiner/user");
		$this->my_layout->setLayout("examinee/template"); // load file layout chính (views/template.php)
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
		
		
		$this->my_layout->view("examinee/user/doParticularBookletView",$data);
		
	}
	
	function sendResult($booklet_id)
	{
		$examinee_id=$this->my_auth->user_id;
		$jsonString=$_POST['jsonString'];
		$this->doingTestModel->sendJSONResult($jsonString,$examinee_id,$booklet_id);
		
		//Marking automatically
		$rawJSONArray=$this->doingTestModel->getBookletDataByID($booklet_id);
		//The first element in array has index of 0 and this element has an array in the index of 'data' because of the 'data' return field
		$rawJSONData=json_decode($rawJSONArray[0]['data']);
		if($rawJSONData->marking == 0)
		{
		$result=$this->marking_test($rawJSONData,json_decode($jsonString));
		$this->doingTestModel->updateScoreAfterMarking($result['score'],$examinee_id,$booklet_id);
        $this->doingTestModel->updateScoreItemAfterMarking(json_encode($result['score_item']),$examinee_id,$booklet_id);
		}
		redirect(base_url()."examinee/testlist");
	}
	
	function marking_test($dataTest,$reply){
		$data = '';
		$score = 0;
		$score_pre = 0;
		for ( $index = 0, $max_count = sizeof($reply); $index < $max_count; $index++ ) {
	
			$item_time = $reply[$index][0];
			$item_reply = $reply[$index][1];
			$item_type = $reply[$index][2];
	
	
			if(isset($dataTest->{$index}->answer)){
	
				$dataTestItemAnswer = $dataTest->{$index}->answer;
	
				// tinh ti le diem dat duoc
				$scale = 1;
	
				if($dataTest->{$index}->question_time != 0){
					switch ( $dataTest->{$index}->question_timeout->type ) {
						case 'TM':
							$scale = 1;
							break;
						case 'LM':
							switch ( $dataTest->{$index}->question_timeout->type_lm ) {
								case 'TRI':
									$scale = ($dataTest->{$index}->question_timeout->value - $item_time) / $dataTest->{$index}->question_timeout->value;
									break;
								case 'REC':
									$scale = 1;
									break;
								case 'TRAP':
//								echo "test_time:".$item_time."<br>";
						   if($item_time <= $dataTest->{$index}->question_timeout->value1)
						   	$scale = 1;
						   else{
						   	$scale = ($dataTest->{$index}->question_timeout->value2 - $item_time + $dataTest->{$index}->question_timeout->value1) / $dataTest->{$index}->question_timeout->value2;
						    if($scale < 0) $scale = 0;
						   }
						   break;
								default:
									break;
							}
							break;
						default:
							break;
					}
				}
	
				if($item_type == 'multiqw'){
					// cham diem cho tu luan voi nhieu TextBox
					$indexReply = 1;
					$itemReplyAllTextBox = explode(",",$item_reply);
	
					foreach ( $itemReplyAllTextBox as $itemRepleyItem) {
					    if(isset($dataTest->{$index}->ANC)){
							   foreach ( $dataTestItemAnswer as $value ) {

						switch ( $value->type ) {
							case 'KWP':
							case 'KWPA':
 							    	if($itemRepleyItem == $value->{$value->type}){
									$score = $score + $dataTest->{$index}->SC->{$value->indexanswer} * $scale;									
								}   
								break;   
							case 'KWPO':
 									foreach ( $value->{$value->type} as $itemANAnd) {
									if($itemRepleyItem == $itemANAnd){
										$score = $score + $dataTest->{$index}->SC->{$value->indexanswer} * $scale;
									}
								}    
								break;
							default:
								break;
						}



							   }
					    }else{
						switch ( $dataTestItemAnswer->{$indexReply}->type ) {
							case 'KWP':
							case 'KWPA':
								if($itemRepleyItem == $dataTestItemAnswer->{$indexReply}->{$dataTestItemAnswer->{$indexReply}->type}){
									$score = $score + $dataTest->{$index}->SC->{$dataTestItemAnswer->{$indexReply}->indexanswer} * $scale;
								}
								break;
							case 'KWPO':
								foreach ( $dataTestItemAnswer->{$indexReply}->{$dataTestItemAnswer->{$indexReply}->type} as $itemANAnd) {
									if($itemRepleyItem == $itemANAnd){
										$score = $score + $dataTest->{$index}->SC->{$dataTestItemAnswer->{$indexReply}->indexanswer} * $scale;
									}
								}
								break;
							default:
								break;
						}					    	
					    } 						
						$indexReply++;
					}
				}else{
	
					// cham diem cho phan trac nhiem va tu luan co 1 o TextBox
					foreach ( $dataTestItemAnswer as $itemAN) {
						switch ($itemAN->type) {
							case 'KS' :
							case 'KWA' :
							case 'KSA' :
							case 'KWAA' :
								if($item_reply == $itemAN->{$itemAN->type}){
									$score = $score + $dataTest->{$index}->SC->{$itemAN->indexanswer} * $scale;
								}
								break;
	
							case 'KWAO' :
							case 'KSO' :
								foreach ( $itemAN->{$itemAN->type} as $itemANAnd) {
									if($item_reply == $itemANAnd){
										$score = $score + $dataTest->{$index}->SC->{$itemAN->indexanswer} * $scale;
									}
								}
								break;
							default:
								break;
						}
					}
				}
			}
			if($dataTest->{$index}->SC->VINP == TRUE){
				// cho giao vien tu cham vao day
				//echo "cham tay <br>";
				$data[$index]['question'] = $dataTest->{$index};
				$data[$index]['answer'] = $reply[$index];
			}
			
			$score = round($score,1);
			
			// luu diem cua moi cau
			$result['score_item'][$index] = $score - $score_pre;
			$score_pre = $score;
		}
	
		$result['score'] = $score;
		$result['manual_mark'] = $data;
	
		return $result;
	
	}
	
	function getresultview($booklet_id)
	{
		$examinee_id=$this->my_auth->user_id;
		$jsonString=$this->doingTestModel->getJSONResult($examinee_id,$booklet_id);
		$jsonScoreItem=$this->doingTestModel->getJSONScoreItem($examinee_id,$booklet_id);
		$rawJSONArray=$this->doingTestModel->getBookletDataByID($booklet_id);
		//The first element in array has index of 0 and this element has an array in the index of 'data' because of the 'data' return field
		$rawJSONData=json_decode($rawJSONArray[0]['data']);
		$bookletData=$this->doingTestModel->getBookletDataByID($booklet_id);
		$data['replyJSONArray']=json_decode($jsonString[0]['reply']);
		$data['score_item'] = json_decode($jsonScoreItem[0]['score_item']);
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
				if(property_exists($item,"key"))
				$data['key'][$count]=$item->key;
				else 
					$data['key'][$count]=null;
				$count++;
			}
		}
		$data_score=$this->doingTestModel->getScore($examinee_id,$booklet_id);
		$score = $data_score[0]['result'];
		$data['score']=$score;
		if($score==-1)
		{
			$data['report'] = "あなたのテストはまだ採点られない!";
			$this->my_layout->view("backend/report",$data);
		}
		else {
		$this->my_layout->view("examinee/user/doParticularResultView",$data);
		}
	
	
}


}