<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php

class User extends CI_Controller{

    var $_mail;
    
    function  __construct() 
    {
        parent::__construct();
        $this->load->helper(array("url","form","my_data"));
        $this->load->library(array("input","form_validation","session","my_auth","email"));
        
        if(!$this->my_auth->is_Examiner()){
            redirect(base_url()."home/verify/login");
            exit();
        }
        
        $this->load->database();
        $this->load->model("muser");
        $this->load->model("mexam");
        $this->load->model("mbooklet");
        $this->load->model("doingTestModel");
        $this->load->library("my_layout"); // Sử dụng thư viện layout
        $this->my_layout->setLayout("examiner/template"); // load file layout chính (views/template.php)
    }       
     

    //--- Cham thi
    function index(){
    	$max = $this->mexam->num_rows_bookletexam();
        $min = 3;
        $data['num_rows'] = $max;
        //--- Paging
        if($max!=0){
            
            $this->load->library('pagination');
            $config['base_url'] = base_url()."examiner/user/index";
            $config['total_rows'] = $max;
            $config['per_page'] = $min;
            $config['num_link'] = 3; 
            $config['uri_segment'] = 4;
            $this->pagination->initialize($config);
            
            $data['link'] = $this->pagination->create_links();
            $tmp = $this->mexam->getbookletexam();
            $data['users'] = $tmp;
            $examinee_orga = $this->my_auth->organization_id;
            $k = 0; 
			foreach ( $tmp as $items) {
				$organization_items = $this -> muser -> getInfo($items["user_id"]);
				//Marking automatically
					//$rawJSONArray=$this->doingTestModel->getBookletDataByID($tmp['booklet_id']);
					$rawJSONArray= $this->doingTestModel->getBookletDataByDescription($items['description']);
					//The first element in array has index of 0 and this element has an array in the index of 'data' because of the 'data' return field
					$rawJSONData=json_decode($rawJSONArray[0]['data']);
					$check_mark[$k] = $rawJSONData->marking;
				if ($examinee_orga == $organization_items["organization_id"]){
					$dulieu[$k] = 1;
       				$k++;
				}else{
					$dulieu[$k] = 0;
       				$k++;
				}
       			 
			}
			$data['marking'] = $check_mark;
			$data['checkOrga'] = $dulieu;
            $this->my_layout->view("examiner/user/list_view",$data);
        
        }else{
            $data['report'] = "データがないので、表示できない";
            $this->my_layout->view("backend/report",$data);
        }
        
    } 
    //--- Profile view
    function profile(){
    	 $user_id = $this->my_auth->user_id;
         $data['info'] = $this->muser->getInfo($user_id);
            
         $this->my_layout->view("examiner/user/profile_view",$data);
    }
     //--- Cap nhat examiner
    function edit(){
        $user_id = $this->uri->segment(4);
        $data['info'] = $this->muser->getInfo($user_id);
       
        if(is_numeric($user_id) && $data['info']!=NULL)
        {
            
            if(isset($_POST['ok']))
            {
                $this->form_validation->set_rules("full_name","Full name","required|min_length[6]");
                $this->form_validation->set_rules("username","Username","required|max_length[25]|callback_checkUser");
                $this->form_validation->set_rules("password","Password","matches[repassword]");
                $this->form_validation->set_rules("email","Email","required|valid_email|callback_checkEmail");
                $this->form_validation->set_rules("address","Address","required");
                $this->form_validation->set_rules("phone","Phone number","required|numeric");
          		

                $data['error'] = "";
                if($this->form_validation->run()==FALSE){
   
                    $this->my_layout->view("examiner/user/edit_view",$data);
                
                }else{
                    $day=$_POST['day'];
                	$month=$_POST['month'];
                	$year=$_POST['year'];
             	
                	$date = date("Y-m-d", mktime(0,0,0,$month, $day, $year));
                    $update = array(
                                    "name" => $this->input->post("full_name"),
                                    "username"  => $this->input->post("username"),
                                    "email"     => $this->input->post("email"),
                                    "address"   => $this->input->post("address"),
                                    "phone"     => $this->input->post("phone"),
                                    "type"     => "00010",
                                    "birthday"    => $date,
                                   
                                 );
                      if($this->input->post("password")!="")
                      {
                         $update['password'] = md5($this->input->post("password"));
                      }
                      
                      $this->muser->updateUser($update,$user_id);
                      redirect(base_url()."examiner/user"); 
                }
            }
            else
            {
                $this->my_layout->view("examiner/user/edit_view",$data);   
            }
            
        }
        else
        {
            
            $data['report'] = "あなたのURLが正しくない";
            $this->my_layout->view("backend/report",$data);
        }
    }
    //--- List view marked booklet
    function send_result(){
    	//$max = $this->mexam->num_rows_markedbookletexam();
    	$max = $this->mexam->num_rows_bookletexam();
        $min = 3;
        $data['num_rows'] = $max;
        //--- Paging
        if($max!=0){
            
            $this->load->library('pagination');
            $config['base_url'] = base_url()."examiner/user/send_result";
            $config['total_rows'] = $max;
            $config['per_page'] = $min;
            $config['num_link'] = 3; 
            $config['uri_segment'] = 4;
            $this->pagination->initialize($config);
            
            $data['link'] = $this->pagination->create_links();
            //$data['users'] = $this->mexam->getmarkedbookletexam();
            $data['users'] = $this->mexam->getbookletexam();
            $this->my_layout->view("examiner/user/marked_booklet_view",$data);
        
        }else{
            $data['report'] = "データがないので、表示されていません";
            $this->my_layout->view("backend/report",$data);
        }
    }
    //--- Send email to all examinee
    function send_email(){
    	$booklet = $this->uri->segment(4);
    	if (is_numeric($booklet)){
                $allexaminee= $this->mexam->getallexaminee($booklet);
                foreach ( $allexaminee as $item ){
                	$userinfo = $this->muser->getInfo($item['examinee_id']);
                	$message  = $userinfo['name']."'s result is: <br/>";
                	$message .= $item['result']."<br/>";

                	$mail = array(
                                "to_receiver"   => $userinfo['email'],
                                "message"       => $message,
                            );

                	$this->load->library("my_email");
                	$this->my_email->config($mail);
                	$this->my_email->sendmail();
                }
         		$data['report'] = "回答者にメールを送るのは成功です";
            	$this->my_layout->view("backend/report",$data);      
    	}		
     }
     
     
         // cham diem bai dataTest voi phan tra loi la reply
    function marking($booklet_id){
    	
    	// lay $data cua booklet
    	$rawJSONArray=$this->doingTestModel->getBookletDataByID($booklet_id);
		//The first element in array has index of 0 and this element has an array in the index of 'data' because of the 'data' return field
		$rawJSONData=json_decode($rawJSONArray[0]['data']);
    	
    	$data_exam_booklet_id = $this->mexam->getallexaminee($booklet_id);
    	
    	//print_r($data_exam_booklet_id);
    	$index = 0;
    	$data = '';
    	foreach ( $data_exam_booklet_id as $key => $value ) {
           $result =  $this->marking_test($rawJSONData,json_decode($data_exam_booklet_id[$key]['reply']));
           $data_exam_booklet_id[$key]['result'] = $result['score'];
           $this->mexam->updateExam($data_exam_booklet_id[$key],$data_exam_booklet_id[$key]['examinee_id'],$booklet_id);
           
           $data['manual'][$index]['data'] = $result['manual_mark'];
           $data['manual'][$index]['score'] = $result['score'];
           $data['manual'][$index]['examinee_id'] = $data_exam_booklet_id[$key]['examinee_id'];
           $data['manual'][$index]['booklet_id'] = $booklet_id;
           $index++;          
		}
		
		$this->my_layout->view("examiner/user/manual_marking",$data);
    	
    }
    
    
     // cham diem bai dataTest voi phan tra loi la reply
    function marking_test($dataTest,$reply){
		$data = '';
    	$score = 0;
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

		}
	
		$result['score'] = $score;
		$result['manual_mark'] = $data;
		
		return $result;
		
    }
     
    function updateNewScore($booklet_id)
    {
    	$jsonString=$_POST['jsonString'];
    	$data = json_decode($jsonString);
    	
    	foreach ($data as $item) {
    		//print_r($item[1]);
    		//echo "<br>";
    		$data_exam['result'] = $item[1];
    		$data_exam['examiner_id'] = $this->my_auth->user_id;
    		$this->mexam->updateExam($data_exam,$item[0],$booklet_id);
    	}
    	    	
//    	    $data['report'] = "The test has just been marked successfully!";
//            $this->my_layout->view("backend/report",$data);
    	
    	$max = $this->mexam->num_rows_blid($booklet_id);
        $min = 3;
        $data['num_rows'] = $max;
        //--- Paging
        if($max!=0){
            
            $this->load->library('pagination');
            $config['base_url'] = base_url()."examiner/user/print_result";
            $config['total_rows'] = $max;
            $config['per_page'] = $min;
            $config['num_link'] = 3; 
            $config['uri_segment'] = 4;
            $this->pagination->initialize($config);
            
            $data['link'] = $this->pagination->create_links();
            $data['users'] = $this->mexam->getuserexam($booklet_id);
            $description = $this->mbooklet->getrecord($booklet_id);
            $data['booklet_id'] = $booklet_id;
            $data['booklet_name'] = $description['description'];
            $this->my_layout->view("examiner/user/result_view_no_graphic",$data);
        }else{
            $data['report'] = "表示するデータがありません";
            $this->my_layout->view("backend/report",$data);
        }
    }
    function marked_result($booklet_id)
    {
    	$max = $this->mexam->num_rows_blid($booklet_id);
        $min = 3;
        $data['num_rows'] = $max;
        //--- Paging
        if($max!=0){
            
            $this->load->library('pagination');
            $config['base_url'] = base_url()."examiner/user/marked_result";
            $config['total_rows'] = $max;
            $config['per_page'] = $min;
            $config['num_link'] = 3; 
            $config['uri_segment'] = 4;
            $this->pagination->initialize($config);
            
            $data['link'] = $this->pagination->create_links();
            $data['users'] = $this->mexam->getuserexam($booklet_id);
            $description = $this->mbooklet->getrecord($booklet_id);
            $data['booklet_id'] = $booklet_id;
            $data['booklet_name'] = $description['description'];
            $this->my_layout->view("examiner/user/result_view",$data);
        }else{
            $data['report'] = "表示するデータがありません";
            $this->my_layout->view("backend/report",$data);
        }
    }
    // lay ve de hien thi bieu do loai 1
    // tra ve 1 mang voi $result['0.1'] la so nguoi dat diem trong khoang 0 -> 10% so diem toi da
    //$result['0.2'] la so nguoi dat diem trong khoang 10% -> 20% so diem toi da
    function return_for_graphic_1($booklet_id){
    	$data = $this->mexam->getallexaminee($booklet_id);
    	$score_max = -1;
    	for ( $index = 0, $max_count = sizeof( $data ); $index < $max_count; $index++ ) {
    	  if($score_max < $data[$index]['result'])
	       $score_max = $data[$index]['result'];
		}
		
		$score_max = 100;
				
		$result['0.1'] = 0;
		$result['0.2'] = 0;
		$result['0.3'] = 0;
		$result['0.4'] = 0;
		$result['0.5'] = 0;
		$result['0.6'] = 0;
		$result['0.7'] = 0;
		$result['0.8'] = 0;
		$result['0.9'] = 0;
		$result['1'] = 0;
		
		for ( $index = 0, $max_count = sizeof( $data ); $index < $max_count; $index++ ) {
           if($data[$index]['result'] / $score_max <= 0.1){
           $result['0.1'] = $result['0.1'] + 1;
           }else if($data[$index]['result'] / $score_max <= 0.2){
           $result['0.2'] = $result['0.2'] + 1;
           }else if($data[$index]['result'] / $score_max <= 0.3){
           $result['0.3'] = $result['0.3'] + 1;
           }else if($data[$index]['result'] / $score_max <= 0.4){
           $result['0.4'] = $result['0.4'] + 1;
           }else if($data[$index]['result'] / $score_max <= 0.5){
           $result['0.5'] = $result['0.5'] + 1;
           }else if($data[$index]['result'] / $score_max <= 0.6){
           $result['0.6'] = $result['0.6'] + 1;
           }else if($data[$index]['result'] / $score_max <= 0.7){
           $result['0.7'] = $result['0.7'] + 1;
           }else if($data[$index]['result'] / $score_max <= 0.8){
           $result['0.8'] = $result['0.8'] + 1;
           }else if($data[$index]['result'] / $score_max <= 0.9){
           $result['0.9'] = $result['0.9'] + 1;
           }else if($data[$index]['result'] / $score_max <= 1){
           $result['1'] = $result['1'] + 1;
           }
		}
		$result['max_score'] = $score_max;
    	return $result;
    }
    
    // tra ve 1 mang dap an cua cac cau hoi
    // VD: $result[0] cac dap an nguoi lam test tra loi cho cau hoi thu nhat
    // VD: $result[1] cac dap an nguoi lam test tra loi cho cau hoi thu hai
    function return_for_graphic_2($booklet_id){
    	$data = $this->mexam->getallexaminee($booklet_id);
    	for ( $index = 0;; $index++ ) {
    	  if(!isset($data[$index]))
    	   break;
    	  if($data[$index]['reply'] != ""){
    	    
    		$reply_row = json_decode($data[$index]['reply']);
    		  for ( $index_1 = 0;; $index_1++ ) {
    		     if(!isset($reply_row[$index_1]))
    		       break;
    		       
    		       $result[$index_1][$index] = $reply_row[$index_1][1];
				}
		}
    	}
    	return $result;
    }
    
	function graphic1($booklet_id){
         //$booklet_id = 36; // a lay booklet_id rui dung cai ngay ben duoi de lay ket qua, cai duoi nua la em la vi du de hien thi a co the bo di
		 $result = $this->return_for_graphic_1($booklet_id);
		 $x = $result["0.1"].",".$result["0.2"].",".$result["0.3"].",".$result["0.4"].",".$result["0.5"].",".
		 $result["0.6"].",".$result["0.7"].",".$result["0.8"].",".$result["0.9"].",".$result["1"];
		
         $data["x"] = $x;
		 $data['max_score'] = $result['max_score'];
         $this->my_layout->view("examiner/user/graphic1",$data);
    }
	
    function graphic2($booklet_id){
		$result = $this->return_for_graphic_2($booklet_id);
		$xLenght = count($result);
		//$xLenght = 5;
		$x = "";
		for ($i=0; $i <$xLenght ; $i++) { 
			$x .= "'問題".($i+1)."',";
		}		
		
		$yLenght= sizeof($result[0]);
		
		$x1 = "";$x2 = "";$x3 = "";$x4 = "";
		for ($i=0; $i < $xLenght ; $i++) {
			$c1 =0; $c2 = 0; $c3 = 0; $c4 = 0;
			for ($j=0; $j < $yLenght ; $j++) { 
				switch ($result[$i][$j]) {
					case 'S(1)':
						$c1 ++;
						break;
					case 'S(2)':
						$c2 ++;
						break;
					case 'S(3)':
						$c3 ++;
						break;
					case 'S(4)':
						$c4 ++;
						break;
					default:				
						break;
				}				
			} 			
			$x1 .= $c1.",";
			$x2 .= $c2.",";
			$x3 .= $c3.",";
			$x4 .= $c4.",";
		}		
		$data['x'] = $x;
		$data['x1'] = $x1;
		$data['x2'] = $x2;
		$data['x3'] = $x3;
		$data['x4'] = $x4;
		 $this->my_layout->view("examiner/user/graphic2",$data);
    }
}
?>
