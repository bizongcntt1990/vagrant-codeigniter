<?php

class User extends CI_Controller{

    var $_mail;
    
    function  __construct() 
    {
        parent::__construct();
        $this->load->helper(array("url","form","my_data"));
        $this->load->library(array("input","form_validation","session","my_auth","email"));
        
        if(!$this->my_auth->is_Maketest()){
            redirect(base_url()."home/verify/login");
            exit();
        }
        $this->load->database();
        $this->load->model("muser");
        $this->load->model("mexam");
        $this->load->model("mbooklet");
		$this->load->model("doingTestModel");
        $this->load->library("my_layout"); // Sử dụng thư viện layout
        $this->my_layout->setLayout("maketest/template"); // load file layout chính (views/template.php)
    }       
     

    //--- danh sach thanh vien
    function index(){
    	  $data['report'] = "";
    	redirect(base_url()."maketest/user/readCsvFile");
    } 
    
    
    //--- Profile view
    function profile(){
    	 $user_id = $this->my_auth->user_id;
         $data['info'] = $this->muser->getInfo($user_id);
            
         $this->my_layout->view("maketest/user/profile_view",$data);
    }
    
    
    
    	function readCsvFileReturn($filename) {
    		
    		$marking = 0;     // tham so luu tru cham tay hay tu dong
    		
    		$current_bookletID;
    		$current_index = 0;    // luu tru cau hoi hien tai dang xet
    		$is_comment = FALSE;     // danh dau khi dang o comment
    		
    		$this->load->model("mbooklet");
    		$this->load->model("mexam");
    		
    		$admin = $this->muser->getUserFromUserName('admin');
    		$money_test = $admin['money'];		
    		
    	$data_upload['user_id'] = $this->my_auth->user_id;	
    	$today = date("Y-m-d");
    	$data_upload['upload_date'] = $today;	
		$handle = fopen($filename, 'r');
		$item = " ";
		$index_qs = 0;
		
		// load Title Test
		$data = fgetcsv($handle, 1000, ",");
	  if(strpos(trim($data[0]),'TestTitle') !== false){
	  	   if(preg_match('/^#/',trim($data[1])) || trim($data[1]) == ''){
               return "1"." テストのタイトルのエラー ".$this->get_string_array($data);
            }
			$question[trim($data[0])] = trim($data[1]);
		    $data_upload['subject'] = trim($data[1]);
	  }
	  else{
	  	return "1"." テストのタイトルのエラー ".$this->get_string_array($data);}
	  
	  		// load SubTitle Test
		$data = fgetcsv($handle, 1000, ",");
	  if(strpos(trim($data[0]),'TestSubTitle') !== false){
	  	if(preg_match('/^#/',trim($data[1])) || trim($data[1]) == ''){
               return "2"."　テストのサブタイトルのエラー ".$this->get_string_array($data);
            }
			$question[trim($data[0])] = trim($data[1]);
			$data_upload['description'] = trim($data[1]);
	  }
	  else return "2"." テストのサブタイトルのエラー ".$this->get_string_array($data);
	  
		  	  		// load  Start date time
		$data = fgetcsv($handle, 1000, ",");
	  if(strpos(trim($data[0]),'StartDateTime') !== false){
	  	
	  						  //kiem tra loi thieu cac truong 
					  if(!isset($data[1])) return "3"." 開始タイムのエラー ".$this->get_string_array($data);
					  if(!isset($data[2])) return "3"." 開始タイムのエラー ".$this->get_string_array($data);
					  if(!isset($data[3])) return "3"." 開始タイムのエラー ".$this->get_string_array($data);
					  if(!isset($data[4])) return "3"." 開始タイムのエラー ".$this->get_string_array($data);
					  if(!isset($data[5])) return "3"." 開始タイムのエラー ".$this->get_string_array($data);
					  if(!isset($data[6])) return "3"." 開始タイムのエラー ".$this->get_string_array($data);
	  	
					$question[trim($data[0])] = trim($data[1]) + "-" + trim($data[2]) + "-" + trim($data[3]) + " " + trim($data[4]) + ":" + trim($data[5]) + ":" + trim($data[6]);
					
					$mktimeStart = mktime(trim($data[4]),trim($data[5]),trim($data[6]),trim($data[2]), trim($data[3]), trim($data[1]));
					
					$date = date("Y-m-d H:i:s", $mktimeStart);
					
					$data_upload['starting_date'] = $date;
	  }
	  else return "3"." 開始タイムのエラー ".$this->get_string_array($data);
	  
	  	  	  		// load  TestTime
		$data = fgetcsv($handle, 1000, ",");
	  if(strpos(trim($data[0]),'TestTime') !== false){
	  		  		//kiem tra loi thieu cac truong 
					  if(!isset($data[1])) return 4;
					  if(!isset($data[2])) return 4;
					switch (trim($data[2])) {
						case 'h':
							$data_upload['test_time'] = trim($data[1])*60;
							break;
						case 'm':
							$data_upload['test_time'] = trim($data[1]);
							break;
						case 's':
							$data_upload['test_time'] = trim($data[1])/60;
							break;									
						default:
						    return "4"." 段位のエラー ".$this->get_string_array($data);
						break;
					}
					$date = date("Y-m-d H:i:s", $mktimeStart + $data_upload['test_time']*60);
					
					$data_upload['expired_date'] = $date;					
					
					$question[trim($data[0])] = $data_upload['test_time'];
					// add thong tin ban dau cua booklet
					$this->mbooklet->addBooklet($data_upload);
	  }
	  else if(strpos(trim($data[0]),'EndDateTime') !== false){
	  	// load  End Test Time
	  	
	  		  						  //kiem tra loi thieu cac truong 
					  if(!isset($data[1])) return "4"." 締切タイムのエラー ".$this->get_string_array($data);
					  if(!isset($data[2])) return "4"." 締切タイムのエラー ".$this->get_string_array($data);
					  if(!isset($data[3])) return "4"." 締切タイムのエラー ".$this->get_string_array($data);
					  if(!isset($data[4])) return "4"." 締切タイムのエラー ".$this->get_string_array($data);
					  if(!isset($data[5])) return "4"." 締切タイムのエラー ".$this->get_string_array($data);
					  if(!isset($data[6])) return "4"." 締切タイムのエラー ".$this->get_string_array($data);
	  	
					$question[trim($data[0])] = trim($data[1]) + "-" + trim($data[2]) + "-" + trim($data[3]) + " " + trim($data[4]) + ":" + trim($data[5]) + ":" + trim($data[6]);
					
					$mktimeEnd = mktime(trim($data[4]),trim($data[5]),trim($data[6]),trim($data[2]), trim($data[3]), trim($data[1]));
					
					$question['TestTime'] = ($mktimeEnd - $mktimeStart)/60;
					$data_upload['test_time'] = ($mktimeEnd - $mktimeStart)/60;
					$date = date("Y-m-d H:i:s", $mktimeEnd);
					
					$data_upload['expired_date'] = $date;
					// add thong tin ban dau cua booklet
					$this->mbooklet->addBooklet($data_upload);
	  }
	  else return "4"." error in ".$this->get_string_array($data);	  
	  
	  	  	  		// load  TestType
		$data = fgetcsv($handle, 1000, ",");
	  if(strpos(trim($data[0]),'TestType') !== false){
			$question[trim($data[0])] = trim($data[1]);
	  }
	  else return "5"." テストタイプのエラー ".$this->get_string_array($data);
	  
	  $line = 5;
	  
		while ($data = fgetcsv($handle, 1000, ",")) {
			$line++;
			
			if($is_comment){
				// loai bo comment
			  if(preg_match('/\*\/$/',trim($data[sizeof($data) - 1]))){
			  	$is_comment = FALSE;
			  }
			}else{
			// neu gap comment thi bo dong do di
			if(preg_match('/^\/\*/',trim($data[0]))){
				$is_comment = TRUE;
				// loai bo comment
			  if(preg_match('/\*\/$/',trim($data[sizeof($data) - 1]))){
			  	$is_comment = FALSE;
			  }
				continue;
			}
			
			switch (trim($data[0])) {
				case 'Testees' :
				      //kiem tra loi
				      if(!isset($data[1]) || trim($data[1]) != 'Name:') return $line." キーワードの名前のエラー ".$this->get_string_array($data);
					  if(!isset($data[2]) || trim($data[2]) == '') return $line." 名前がないエラー ".$this->get_string_array($data);
					  if(!isset($data[3]) || trim($data[3]) != 'ID:') return $line." error keyword ID: in ".$this->get_string_array($data);
					  if(!isset($data[4]) || trim($data[4]) == '') return $line." error not id in ".$this->get_string_array($data);
					  if(!isset($data[5]) || trim($data[5]) != 'PW:') return $line." error keyword PW: in ".$this->get_string_array($data);
					  if(!isset($data[6]) || trim($data[6]) == '') return $line." error not password in ".$this->get_string_array($data);
					  
                      $data_user['name'] = trim($data[2]);
                      $data_user['username'] = trim($data[4]);
                      $data_user['password'] = md5(trim($data[6]));
                      $data_user['organization_id'] = $this->my_auth->organization_id;
                      $user_info = $this->muser->getUsernameWithOrganization($data_user['username'],$data_user['organization_id']);
                      // neu chua co user nay thi them con khong thi update
                      if ($user_info == FALSE){
                      	$data_user['type'] = '00001';
                      	// update money user
                      	$data_user['money'] = $money_test;
                      	$this->muser->addUser($data_user);   
                      	$user_info = $this->muser->getUsernameWithOrganization($data_user['username'],$data_user['organization_id']);                   	
                      }else{
                      	// update money user
                      	$data_user['money'] = $money_test + $user_info['money'];
                      	$this->muser->updateUserFromUserNameWithOrganization($data_user,$data_user['username'],$data_user['organization_id']);
                      }
                      // them vao bang exam
                      $upload_exam['examinee_id'] = $user_info['user_id'];
                      $booklet_id = $this->mbooklet->getMaxBookletID();
                      
                      $upload_exam['booklet_id'] = $booklet_id->id;
                      $current_bookletID=$booklet_id->id;
                      $upload_exam['result'] = -1;
                      $upload_exam['password'] = $data_user['password'];
                      
                   if($this->mexam->get_examinee($upload_exam['booklet_id'],$upload_exam['examinee_id']) != 0)
                      return $line." error trung ten Testees trong CSV in ".$this->get_string_array($data);
                      // add vao bang exam
                      $this->mexam->addExam($upload_exam);    
                      
                      
					break;
				case 'Estimate' :
				// kiem tra loi chua co anser va SC
			   if(!isset( $question[$current_index]['answer']) && !isset( $question[$current_index]['SC']))
			   return $line." error Thieu SC và AN in ".$this->get_string_array($data);
			
					// loi thua dong cau hoi
				   if(isset($question[trim($data[0])])  || !isset($data[1]))	
				     return $line." error Thua Estimate in ".$this->get_string_array($data);			
					 $question[trim($data[0])] = trim($data[1]);
					break;				
				case 'Average' :
					// loi thua dong
				   if(isset($question[trim($data[0])]))	
				     return $line." error thua Average in ".$this->get_string_array($data);			
				     $question[trim($data[0])] = 'Average';		
					break;				
				case 'Ranking' :
					// loi thua dong
				   if(isset($question[trim($data[0])]))	
				     return $line." error Ranking in ".$this->get_string_array($data);;				
				     $question[trim($data[0])] = 'Ranking';	
					break;				
				case 'Trend' :
					// loi thua dong
				   if(isset($question[trim($data[0])]))	
				     return $line." error Trend in ".$this->get_string_array($data);				
				     $question[trim($data[0])] = 'Trend';
					break;				
				case 'Graphical' :	
				// loi thua dong
				   if(isset($question[trim($data[0])]))	
				     return $line." error Graphical in ".$this->get_string_array($data);				
					$question[trim($data[0])] = 'Graphical';	
					break;				
				case 'Histgram' :
				// loi thua dong
				   if(isset($question[trim($data[0])]))	
				     return $line." error Histgram in ".$this->get_string_array($data);
					$question[trim($data[0])] = 'Histgram';
					break;																									
				default :
				
			// bo qua comment
            if(preg_match('/^#/',trim($data[0]))){
               break;
            }	
				
				//kien tra xem da add nguoi lam test vao chua
				if(!isset($data_user['name']))
				 return $line." error Khong co Testsee in ".$this->get_string_array($data);
							
            // bo qua dong ttrong
            if(trim($data[0]) == '' && !isset($data[0])){
               break;
            }
            
			if (is_numeric(preg_replace('/[^0-9]/', '', $data[0]))) {

				if ($index_qs < preg_replace('/[^0-9]/', '', $data[0]) - 1) {
					$index_qs = preg_replace('/[^0-9]/', '', $data[0]) - 1;
				}
				
				// kiem tra loi ko co cac cau hoi phia truoc
				if($index_qs != 0 && !isset($question[$index_qs - 1])){
				 return $line." error Sai thư tự câu hỏi in ".$this->get_string_array($data);
			}
				
					  //kiem tra loi thieu cac truong 
					  if(!isset($data[1])) return $line." error Thieu trường thứ 2 in ".$this->get_string_array($data);
					  if(!isset($data[2])) return $line." error Thieu trường thứ 3 in ".$this->get_string_array($data);
				switch (trim($data[1])) {
					case 'QS' :
					// neu lap lai cau hoi
					    if(isset($question[$index_qs]['type']))
					    return $line." error Lặp lại câu hỏi in ".$this->get_string_array($data);
					    
					    $current_index = $index_qs;   // luu current_index
						$question[$index_qs]['type'] = trim($data[1]);
						$question[$index_qs]['question'] = trim($data[2]);
						$question[$index_qs]['multi_select'] = 0;
						$question[$index_qs]['question_time'] = 0;
						break;
					case 'QW' :
					// neu lap lai cau hoi
					    if(isset($question[$index_qs]['type']))
					    return $line." error Lặp lại câu hỏi in ".$this->get_string_array($data);
					    
					    $current_index = $index_qs;   // luu current_index
						$question[$index_qs]['type'] = trim($data[1]);
						$question[$index_qs]['question'] = trim($data[2]);
						$question[$index_qs]['multi_select'] = 0;
						$question[$index_qs]['question_time'] = 0;
						break;
					case 'FG' :
					// neu lap lai cau hoi
					    if(isset($question[$index_qs]['type']))
					    return $line." error Lặp lại câu hỏi in ".$this->get_string_array($data);
					    
					    $current_index = $index_qs;   // luu current_index
						$question[$index_qs]['type'] = trim($data[1]);
						$question[$index_qs]['question'] = trim($data[2]);
						$question[$index_qs]['multi_select'] = 0;
						$question[$index_qs]['question_time'] = 0;
						break;						
					case 'ANC' :
						for ($index = 2, $max_count = sizeof($data); $index < $max_count; $index++) {
							$question[$index_qs][trim($data[1])][$index -2] = $data[$index];
						}
						break;
					case 'INS' :
						$question[$index_qs]['INS'] = trim($data[2]);
						break;
					case 'TM' :
					// kiem tra sai kieu test
					if($question['TestType'] == 'Unfix')
					    return $line." error Khong dung kieu TestType:".$question['TestType']." in ".$this->get_string_array($data);
					    
					    
						$question[$index_qs]['question_timeout']['type'] = trim($data[1]);
						$question[$index_qs]['question_timeout']['value'] = trim($data[2]);
					  if(trim($data[3]) == 'h')
						$question[$index_qs]['question_time'] = trim($data[2])*3600;
					  else if(trim($data[3]) == 'm')
					    $question[$index_qs]['question_time'] = trim($data[2])*60;
					  else  if(trim($data[3]) == 's')
					    $question[$index_qs]['question_time'] = trim($data[2]);
					  else return $line." error sai đơn vị in ".$this->get_string_array($data);
						break;
					case 'LM' :
					// kiem tra sai kieu test
					if($question['TestType'] == 'Unfix')
					    return $line." error Khong dung kieu TestType:".$question['TestType']." in ".$this->get_string_array($data);
					//kiem tra loi
					    if(!isset($data[3])) return $line." error thiếu trường in ".$this->get_string_array($data);
					    if(!isset($data[4])) return $line." error thiếu trường in ".$this->get_string_array($data);
					    
					    
						$question[$index_qs]['question_timeout']['type'] = trim($data[1]);
						$question[$index_qs]['question_timeout']['type_lm'] = trim($data[2]);
						switch (trim($data[2])) {
							case 'TRI' :
								
					  if(trim($data[4]) == 'h')
						$question[$index_qs]['question_time'] = trim($data[3])*3600;
					  else if(trim($data[4]) == 'm')
					    $question[$index_qs]['question_time'] = trim($data[3])*60;
					  else if(trim($data[4]) == 's')
					    $question[$index_qs]['question_time'] = trim($data[3]);	
					  else return $line." error sai đơn vị in ".$this->get_string_array($data);
					    
					    $question[$index_qs]['question_timeout']['value'] = $question[$index_qs]['question_time'];							
								break;
							case 'REC' :
								
					  if(trim($data[4]) == 'h')
						$question[$index_qs]['question_time'] = trim($data[3])*3600;
					  else if(trim($data[4]) == 'm')
					    $question[$index_qs]['question_time'] = trim($data[3])*60;
					  else if(trim($data[4]) == 's')
					    $question[$index_qs]['question_time'] = trim($data[3]);	
					  else return $line." error sai đơn vị in ".$this->get_string_array($data);
					  
					    $question[$index_qs]['question_timeout']['value'] = $question[$index_qs]['question_time'];						
								break;
							case 'TRAP' :
							//kiem tra loi
					  if(!isset($data[5])) return $line." error thiếu trường in ".$this->get_string_array($data);
					  if(!isset($data[6])) return $line." error thiếu trường in ".$this->get_string_array($data);
					  							
					  if(trim($data[4]) == 'h')
						$question[$index_qs]['question_time'] = trim($data[3])*3600;
					  else if(trim($data[4]) == 'm')
					    $question[$index_qs]['question_time'] = trim($data[3])*60;
					  else if(trim($data[4]) == 's')
					    $question[$index_qs]['question_time'] = trim($data[3]);
					  else return $line." error sai đơn vị in ".$this->get_string_array($data);
					    
					    $question[$index_qs]['question_timeout']['value1'] = $question[$index_qs]['question_time'];
					    
					  if(trim($data[6]) == 'h')
						$question[$index_qs]['question_time'] = $question[$index_qs]['question_time'] + trim($data[5])*3600;
					  else if(trim($data[6]) == 'm')
					    $question[$index_qs]['question_time'] = $question[$index_qs]['question_time'] + trim($data[5])*60;
					  else if(trim($data[6]) == 's') 
					    $question[$index_qs]['question_time'] = $question[$index_qs]['question_time'] + trim($data[5]);	
					  else return $line." error sai đơn vị in ".$this->get_string_array($data);
					    
					    $question[$index_qs]['question_timeout']['value2'] = $question[$index_qs]['question_time'] - $question[$index_qs]['question_timeout']['value1'];				    								
								break;
						}
						break;

					default :
					// kiem tra loi so thu thu cac cau tra loi,cau hoi linh tinh
					if($current_index != $index_qs)
					   return $line." error sai thứ tự câu hỏi in ".$this->get_string_array($data);
					
						if (preg_match('/^S.[0-9]/', trim($data[1]))) {
							
						  	//kiem tra truong hop lan lon cau trac nghiem trong cau tu luan
						  	if($question[$index_qs]['type'] == 'QW')
						  	return $line." error in ".$this->get_string_array($data);
						  	
						  	//kiem tra neu bi trung cau selection
						  	if(isset($question[$index_qs]['selection'][preg_replace('/[^0-9]/', '', $data[1])]))
						  	return $line." error lap lại selection in ".$this->get_string_array($data);
							
							// loi sap xep sai thu tu selection
						  if(preg_replace('/[^0-9]/', '', $data[1]) != 1 && !isset($question[$index_qs]['selection'][preg_replace('/[^0-9]/', '', $data[1]) - 1]))
						  return $line." error lap lại selection in ".$this->get_string_array($data);
							
						  if(trim($data[2]) == 'FG'){
						  	$question[$index_qs]['selection'][preg_replace('/[^0-9]/', '', $data[1])] = trim($data[3]);
						  }
						  else{
							$question[$index_qs]['selection'][preg_replace('/[^0-9]/', '', $data[1])] = trim($data[2]);
						  }
						  
						  
						}else if (preg_match('/^WR.[0-9]/', trim($data[1]))) {	
							
							//kiem tra neu bi trung cau selection
						  	if(isset($question[$index_qs]['selection'][preg_replace('/[^0-9]/', '', $data[1])]))
						  	return $line." error lap lại selection in ".$this->get_string_array($data);
							
							//kiem tra truong hop lan lon cau trac nghiem trong cau tu luan
						  	if($question[$index_qs]['type'] == 'QS')
						  	return $line." error lap lại selection in ".$this->get_string_array($data);
							
							// loi sap xep sai thu tu dap an
						  if(preg_replace('/[^0-9]/', '', $data[1]) != 1 && !isset($question[$index_qs]['selection'][preg_replace('/[^0-9]/', '', $data[1]) - 1]))
						  return $line." error lap lại selection in ".$this->get_string_array($data);				
							$question[$index_qs]['selection'][preg_replace('/[^0-9]/', '', $data[1])] = trim($data[2]);
							
							
						} else{
							//kiem tra loi ko co selection lua chon
							if(!isset($question[$index_qs]['selection'])){
							   return $line." error thiếu selection in ".$this->get_string_array($data);
							}
							if (preg_match('/^AN.[0-9]/', trim($data[1]))) {
								
									// kiem tra sai kieu test
									if($question['TestType'] == 'Fix' && !isset($question[$index_qs]['question_timeout']))
					   					 return $line." error Khong dung kieu TestType:".$question['TestType']." in ".$this->get_string_array($data);
								
								
                                 $question[$index_qs]['answer'][preg_replace('/[^0-9]/', '', $data[1])]['type'] = trim($data[2]);
                                 $question[$index_qs]['answer'][preg_replace('/[^0-9]/', '', $data[1])]['indexanswer'] = trim($data[1]);
								switch (trim($data[2])) {
									case 'KS' :
									$question[$index_qs]['answer_QS'][preg_replace('/[^0-9]/', '', $data[1])][trim($data[2])] = $question[$index_qs]['selection'][preg_replace('/[^0-9]/', '', trim($data[3]))];
									case 'KWA' :
									case 'KWP' :
										$question[$index_qs]['answer'][preg_replace('/[^0-9]/', '', $data[1])][trim($data[2])] = trim($data[3]);
										break;

									case 'KSA' :
									$question[$index_qs]['multi_select'] = 1;
									case 'KWAA' :									
									case 'KWPA' :
									$index = 3;
									    $question[$index_qs]['answer'][preg_replace('/[^0-9]/', '', $data[1])][trim($data[2])] = $data[$index];
									     if(trim($data[2]) == 'KSA')
											$question[$index_qs]['answer_QS'][preg_replace('/[^0-9]/', '', $data[1])][trim($data[2])] = $question[$index_qs]['selection'][preg_replace('/[^0-9]/', '', $data[$index])];
										for ($index = 4, $max_count = sizeof($data); $index < $max_count; $index++) {
														// bo qua comment
            											if(preg_match('/^#/',$data[$index])){
              											 break;
           											     }	
											$question[$index_qs]['answer'][preg_replace('/[^0-9]/', '', $data[1])][trim($data[2])] = $question[$index_qs]['answer'][preg_replace('/[^0-9]/', '', $data[1])][trim($data[2])].",".$data[$index];
										  
										  if(trim($data[2]) == 'KSA')
											$question[$index_qs]['answer_QS'][preg_replace('/[^0-9]/', '', $data[1])][trim($data[2])] = $question[$index_qs]['answer_QS'][preg_replace('/[^0-9]/', '', $data[1])][trim($data[2])].",".$question[$index_qs]['selection'][preg_replace('/[^0-9]/', '', $data[$index])];
											
										}									
									break;
									case 'KWAO' :
									case 'KWPO' :
									case 'KSO' :
										for ($index = 3, $max_count = sizeof($data); $index < $max_count; $index++) {
														 // bo qua comment
            											if(preg_match('/^#/',$data[$index])){
              											 break;
           											     }	
											$question[$index_qs]['answer'][preg_replace('/[^0-9]/', '', $data[1])][trim($data[2])][$index -3] = $data[$index];
										
										if(trim($data[2]) == 'KSO')
										$question[$index_qs]['answer_QS'][preg_replace('/[^0-9]/', '', $data[1])][trim($data[2])][$index -3] = $question[$index_qs]['selection'][preg_replace('/[^0-9]/', '', $data[$index])];
										}
										break;
									default :
									  return $line." error error keyword in ".$this->get_string_array($data);
										break;
								}
							} else
								if (preg_match('/^SC.[0-9]/', trim($data[1]))) {	
									
								  if(trim($data[2]) == 'VINP'){
								  	 $question[$index_qs]['SC']['VINP'] = TRUE;
								  	 $marking = 1;
								  }
									else {
										$question[$index_qs]['SC'][trim($data[2])] = trim($data[3]);
									  if($question[$index_qs]['type'] == 'QW')
										$score = $question[$index_qs]['answer'][preg_replace('/[^0-9]/', '', trim($data[2]))][$question[$index_qs]['answer'][preg_replace('/[^0-9]/', '', trim($data[2]))]['type']];
									  else
									    $score = $question[$index_qs]['answer_QS'][preg_replace('/[^0-9]/', '', trim($data[2]))][$question[$index_qs]['answer'][preg_replace('/[^0-9]/', '', trim($data[2]))]['type']];
									  if(is_array($score)){
									  	
									  	if(!isset($question[$index_qs]['key']))
									  	 $question[$index_qs]['key'] = "";
									  	
									  	for ( $index = 0, $max_count = sizeof( $score ); $index < $max_count; $index++ ) {
											$question[$index_qs]['key'] = $question[$index_qs]['key'].$score[$index]." OR ";
										}											
										  $question[$index_qs]['key'] = $question[$index_qs]['key']."  score  ".trim($data[3])."<br>";	
									  }else{
									  	
									  	if(!isset($question[$index_qs]['key']))
									  	 $question[$index_qs]['key'] = "";
									  	$question[$index_qs]['key'] = $question[$index_qs]['key'].$score."  score  ".trim($data[3])."<br>";
									  }
										$question[$index_qs]['SC']['VINP'] = FALSE;
										}
								}
						}
						break;
				}

			}else return $line." error error keyword in ".$this->get_string_array($data);
			
				break;
			}
			
		}
			
		}
		
		$question['marking'] = $marking;
		fclose($handle);
		$data_upload['data'] = json_encode($question);
		$this->mbooklet->updateBooklet($data_upload,$upload_exam['booklet_id']);

		return -1;

	}
	
	
	  function checkCSV($filename) {
    		$current_bookletID;
    		$current_index = 0;    // luu tru cau hoi hien tai dang xet
    		$is_comment = FALSE;     // danh dau khi dang o comment
	
	    $this->load->model("mbooklet");
    		
    	$data_upload['user_id'] = $this->my_auth->user_id;	
    	$today = date("Y-m-d");
    	$data_upload['upload_date'] = $today;	
		$handle = fopen($filename, 'r');
		$item = " ";
		$index_qs = 0;
		
		// load Title Test
		$data = fgetcsv($handle, 1000, ",");
	  if(strpos(trim($data[0]),'TestTitle') !== false){
	  	   if(preg_match('/^#/',trim($data[1])) || trim($data[1]) == ''){
               return "1"." テストタイトルのエラー ".$this->get_string_array($data);
            }
			$question[trim($data[0])] = trim($data[1]);
		    $data_upload['subject'] = trim($data[1]);
	  }
	  else{
	  	return "1"."　テストタイトルのエラー ".$this->get_string_array($data);}
	  
	  		// load SubTitle Test
		$data = fgetcsv($handle, 1000, ",");
	  if(strpos(trim($data[0]),'TestSubTitle') !== false){
	  	if(preg_match('/^#/',trim($data[1])) || trim($data[1]) == ''){
               return "2"." テストサブタイトルのエラー ".$this->get_string_array($data);
            }
			$question[trim($data[0])] = trim($data[1]);
			$data_upload['description'] = trim($data[1]);
			
//	    $num_de = $this->mbooklet->get_examinee_from_des_ogri($data_upload['description'],$this->my_auth->organization_id);
	    $num_de = $this->mbooklet->get_examinee_from_des_user_id($data_upload['description'],$this->my_auth->user_id);
	    if($num_de >= 1)
	      return -2;
	  }
	  else return "2"." テストサブタイトルのエラー ".$this->get_string_array($data);
	  
		  	  		// load  Start date time
		$data = fgetcsv($handle, 1000, ",");
	  if(strpos(trim($data[0]),'StartDateTime') !== false){
	  	
	  						  //kiem tra loi thieu cac truong 
					  if(!isset($data[1])) return "3"." 開始タイムのエラー ".$this->get_string_array($data);
					  if(!isset($data[2])) return "3"." 開始タイムのエラー ".$this->get_string_array($data);
					  if(!isset($data[3])) return "3"." 開始タイムのエラー ".$this->get_string_array($data);
					  if(!isset($data[4])) return "3"." 開始タイムのエラー ".$this->get_string_array($data);
					  if(!isset($data[5])) return "3"." 開始タイムのエラー ".$this->get_string_array($data);
					  if(!isset($data[6])) return "3"." 開始タイムのエラー ".$this->get_string_array($data);
	  	
					$question[trim($data[0])] = trim($data[1]) + "-" + trim($data[2]) + "-" + trim($data[3]) + " " + trim($data[4]) + ":" + trim($data[5]) + ":" + trim($data[6]);
					
					$mktimeStart = mktime(trim($data[4]),trim($data[5]),trim($data[6]),trim($data[2]), trim($data[3]), trim($data[1]));
					
					$date = date("Y-m-d H:i:s", $mktimeStart);
					
					$data_upload['starting_date'] = $date;
	  }
	  else return "3"." 開始タイムのタイトル ".$this->get_string_array($data);
	  
	  	  	  		// load  TestTime
		$data = fgetcsv($handle, 1000, ",");
	  if(strpos(trim($data[0]),'TestTime') !== false){
	  		  		//kiem tra loi thieu cac truong 
					  if(!isset($data[1])) return 4;
					  if(!isset($data[2])) return 4;
					switch (trim($data[2])) {
						case 'h':
							$data_upload['test_time'] = trim($data[1])*60;
							break;
						case 'm':
							$data_upload['test_time'] = trim($data[1]);
							break;
						case 's':
							$data_upload['test_time'] = trim($data[1])/60;
							break;									
						default:
						    return "4"." 単位のエラー ".$this->get_string_array($data);
						break;
					}
					$date = date("Y-m-d H:i:s", $mktimeStart + $data_upload['test_time']*60);
					
					$data_upload['expired_date'] = $date;					
					
					$question[trim($data[0])] = $data_upload['test_time'];

	  }
	  else if(strpos(trim($data[0]),'EndDateTime') !== false){
	  	// load  End Test Time
	  	
	  		  						  //kiem tra loi thieu cac truong 
					  if(!isset($data[1])) return "4"." 締切タイムのエラー ".$this->get_string_array($data);
					  if(!isset($data[2])) return "4"." 締切タイムのエラー ".$this->get_string_array($data);
					  if(!isset($data[3])) return "4"." 締切タイムのエラー ".$this->get_string_array($data);
					  if(!isset($data[4])) return "4"." 締切タイムのエラー ".$this->get_string_array($data);
					  if(!isset($data[5])) return "4"." 締切タイムのエラー ".$this->get_string_array($data);
					  if(!isset($data[6])) return "4"." 締切タイムのエラー ".$this->get_string_array($data);
	  	
					$question[trim($data[0])] = trim($data[1]) + "-" + trim($data[2]) + "-" + trim($data[3]) + " " + trim($data[4]) + ":" + trim($data[5]) + ":" + trim($data[6]);
					
					$mktimeEnd = mktime(trim($data[4]),trim($data[5]),trim($data[6]),trim($data[2]), trim($data[3]), trim($data[1]));
					
					$question['TestTime'] = ($mktimeEnd - $mktimeStart)/60;
					$data_upload['test_time'] = ($mktimeEnd - $mktimeStart)/60;
					$date = date("Y-m-d H:i:s", $mktimeEnd);
					
					$data_upload['expired_date'] = $date;
					
	  }
	  else return "4"." エラー ".$this->get_string_array($data);	  
	  
	  	  	  		// load  TestType
		$data = fgetcsv($handle, 1000, ",");
	  if(strpos(trim($data[0]),'TestType') !== false){
			$question[trim($data[0])] = trim($data[1]);
	  }
	  else return "5"." テストのタイプのエラー ".$this->get_string_array($data);
	  
	  $line = 5;
	  
		while ($data = fgetcsv($handle, 1000, ",")) {
			$line++;
			
			if($is_comment){
				// loai bo comment
			  if(preg_match('/\*\/$/',trim($data[sizeof($data) - 1]))){
			  	$is_comment = FALSE;
			  }
			}else{
			// neu gap comment thi bo dong do di
			if(preg_match('/^\/\*/',trim($data[0]))){
				$is_comment = TRUE;
				// loai bo comment
			  if(preg_match('/\*\/$/',trim($data[sizeof($data) - 1]))){
			  	$is_comment = FALSE;
			  }
				continue;
			}
			
			switch (trim($data[0])) {
				case 'Testees' :
				      //kiem tra loi
				      if(!isset($data[1]) || trim($data[1]) != 'Name:') return $line." キーワードの名前のエラー ".$this->get_string_array($data);
					  if(!isset($data[2]) || trim($data[2]) == '') return $line." 名前がないエラー ".$this->get_string_array($data);
					  if(!isset($data[3]) || trim($data[3]) != 'ID:') return $line." キーワードのIDのエラー ".$this->get_string_array($data);
					  if(!isset($data[4]) || trim($data[4]) == '') return $line." IDがないエラー ".$this->get_string_array($data);
					  if(!isset($data[5]) || trim($data[5]) != 'PW:') return $line." キーワードパスワードのエラー ".$this->get_string_array($data);
					  if(!isset($data[6]) || trim($data[6]) == '') return $line." パスワードがないエラー ".$this->get_string_array($data);
					  
                      $data_user['name'] = trim($data[2]);
                      $data_user['username'] = trim($data[4]);
                      $data_user['password'] = md5(trim($data[6]));
                      $data_user['organization_id'] = $this->my_auth->organization_id;               

					break;
				case 'Estimate' :
				// kiem tra loi chua co anser va SC
			   if(!isset( $question[$current_index]['answer']) && !isset( $question[$current_index]['SC']))
			   return $line." SC や AN がないエラー ".$this->get_string_array($data);
			
					// loi thua dong cau hoi
				   if(isset($question[trim($data[0])])  || !isset($data[1]))	
				     return $line." Estimateが過剰のエラー ".$this->get_string_array($data);			
					 $question[trim($data[0])] = trim($data[1]);
					break;				
				case 'Average' :
					// loi thua dong
				   if(isset($question[trim($data[0])]))	
				     return $line." Averageが過剰のエラー ".$this->get_string_array($data);			
				     $question[trim($data[0])] = 'Average';		
					break;				
				case 'Ranking' :
					// loi thua dong
				   if(isset($question[trim($data[0])]))	
				     return $line." Rankingのエラー ".$this->get_string_array($data);;				
				     $question[trim($data[0])] = 'Ranking';	
					break;				
				case 'Trend' :
					// loi thua dong
				   if(isset($question[trim($data[0])]))	
				     return $line." Trendのエラー ".$this->get_string_array($data);				
				     $question[trim($data[0])] = 'Trend';
					break;				
				case 'Graphical' :	
				// loi thua dong
				   if(isset($question[trim($data[0])]))	
				     return $line." Graphicalのエラー ".$this->get_string_array($data);				
					$question[trim($data[0])] = 'Graphical';	
					break;				
				case 'Histgram' :
				// loi thua dong
				   if(isset($question[trim($data[0])]))	
				     return $line." Histgram のエラー ".$this->get_string_array($data);
					$question[trim($data[0])] = 'Histgram';
					break;																									
				default :
				
			// bo qua comment
            if(preg_match('/^#/',trim($data[0]))){
               break;
            }	
				
				//kien tra xem da add nguoi lam test vao chua
				if(!isset($data_user['name']))
				 return $line." 受験者がないエラー ".$this->get_string_array($data);
							
            // bo qua dong ttrong
            if(trim($data[0]) == '' && !isset($data[0])){
               break;
            }
            
			if (is_numeric(preg_replace('/[^0-9]/', '', $data[0]))) {

				if ($index_qs < preg_replace('/[^0-9]/', '', $data[0]) - 1) {
					$index_qs = preg_replace('/[^0-9]/', '', $data[0]) - 1;
				}
				
				// kiem tra loi ko co cac cau hoi phia truoc
				if($index_qs != 0 && !isset($question[$index_qs - 1])){
				 return $line." 質問の順番が間違いエラー ".$this->get_string_array($data);
			}
				
					  //kiem tra loi thieu cac truong 
					  if(!isset($data[1])) return $line." 第二目のフィールドがないエラー".$this->get_string_array($data);
					  if(!isset($data[2])) return $line."　第3目のフィールドがないエラー ".$this->get_string_array($data);
				switch (trim($data[1])) {
					case 'QS' :
					// neu lap lai cau hoi
					    if(isset($question[$index_qs]['type']))
					    return $line." 質問の繰り返しのエラー ".$this->get_string_array($data);
					    
					    $current_index = $index_qs;   // luu current_index
						$question[$index_qs]['type'] = trim($data[1]);
						$question[$index_qs]['question'] = trim($data[2]);
						$question[$index_qs]['multi_select'] = 0;
						$question[$index_qs]['question_time'] = 0;
						break;
					case 'QW' :
					// neu lap lai cau hoi
					    if(isset($question[$index_qs]['type']))
					    return $line." 質問の繰り返しのエラー ".$this->get_string_array($data);
					    
					    $current_index = $index_qs;   // luu current_index
						$question[$index_qs]['type'] = trim($data[1]);
						$question[$index_qs]['question'] = trim($data[2]);
						$question[$index_qs]['multi_select'] = 0;
						$question[$index_qs]['question_time'] = 0;
						break;
					case 'FG' :
					// neu lap lai cau hoi
					    if(isset($question[$index_qs]['type']))
					    return $line." 質問の繰り返しのエラー ".$this->get_string_array($data);
					    
					    $current_index = $index_qs;   // luu current_index
						$question[$index_qs]['type'] = trim($data[1]);
						$question[$index_qs]['question'] = trim($data[2]);
						$question[$index_qs]['multi_select'] = 0;
						$question[$index_qs]['question_time'] = 0;
						break;						
					case 'ANC' :
						for ($index = 2, $max_count = sizeof($data); $index < $max_count; $index++) {
							$question[$index_qs][trim($data[1])][$index -2] = $data[$index];
						}
						break;
					case 'INS' :
						$question[$index_qs]['INS'] = trim($data[2]);
						break;
					case 'TM' :
					// kiem tra sai kieu test
					if($question['TestType'] == 'Unfix')
					    return $line." テストタイプのフォーマットが間違いのエラー".$question['TestType']." in ".$this->get_string_array($data);
					    
					    
						$question[$index_qs]['question_timeout']['type'] = trim($data[1]);
						$question[$index_qs]['question_timeout']['value'] = trim($data[2]);
					  if(trim($data[3]) == 'h')
						$question[$index_qs]['question_time'] = trim($data[2])*3600;
					  else if(trim($data[3]) == 'm')
					    $question[$index_qs]['question_time'] = trim($data[2])*60;
					  else  if(trim($data[3]) == 's')
					    $question[$index_qs]['question_time'] = trim($data[2]);
					  else return $line." 単位が間違いエラー ".$this->get_string_array($data);
						break;
					case 'LM' :
					// kiem tra sai kieu test
					if($question['TestType'] == 'Unfix')
					    return $line." テストタイプのフォーマットが間違いエラー:".$question['TestType']." in ".$this->get_string_array($data);
					//kiem tra loi
					    if(!isset($data[3])) return $line." フィールドがないエラー  ".$this->get_string_array($data);
					    if(!isset($data[4])) return $line." フィールドがないエラー ".$this->get_string_array($data);
					    
					    
						$question[$index_qs]['question_timeout']['type'] = trim($data[1]);
						$question[$index_qs]['question_timeout']['type_lm'] = trim($data[2]);
						switch (trim($data[2])) {
							case 'TRI' :
								
					  if(trim($data[4]) == 'h')
						$question[$index_qs]['question_time'] = trim($data[3])*3600;
					  else if(trim($data[4]) == 'm')
					    $question[$index_qs]['question_time'] = trim($data[3])*60;
					  else if(trim($data[4]) == 's')
					    $question[$index_qs]['question_time'] = trim($data[3]);	
					  else return $line." 単位が間違いエラー ".$this->get_string_array($data);
					    
					    $question[$index_qs]['question_timeout']['value'] = $question[$index_qs]['question_time'];							
								break;
							case 'REC' :
								
					  if(trim($data[4]) == 'h')
						$question[$index_qs]['question_time'] = trim($data[3])*3600;
					  else if(trim($data[4]) == 'm')
					    $question[$index_qs]['question_time'] = trim($data[3])*60;
					  else if(trim($data[4]) == 's')
					    $question[$index_qs]['question_time'] = trim($data[3]);	
					  else return $line." 単位が間違いエラー ".$this->get_string_array($data);
					  
					    $question[$index_qs]['question_timeout']['value'] = $question[$index_qs]['question_time'];						
								break;
							case 'TRAP' :
							//kiem tra loi
					  if(!isset($data[5])) return $line." ィールドがないエラー  ".$this->get_string_array($data);
					  if(!isset($data[6])) return $line." ィールドがないエラー  ".$this->get_string_array($data);
					  							
					  if(trim($data[4]) == 'h')
						$question[$index_qs]['question_time'] = trim($data[3])*3600;
					  else if(trim($data[4]) == 'm')
					    $question[$index_qs]['question_time'] = trim($data[3])*60;
					  else if(trim($data[4]) == 's')
					    $question[$index_qs]['question_time'] = trim($data[3]);
					  else return $line." 単位が間違いエラー ".$this->get_string_array($data);
					    
					    $question[$index_qs]['question_timeout']['value1'] = $question[$index_qs]['question_time'];
					    
					  if(trim($data[6]) == 'h')
						$question[$index_qs]['question_time'] = $question[$index_qs]['question_time'] + trim($data[5])*3600;
					  else if(trim($data[6]) == 'm')
					    $question[$index_qs]['question_time'] = $question[$index_qs]['question_time'] + trim($data[5])*60;
					  else if(trim($data[6]) == 's') 
					    $question[$index_qs]['question_time'] = $question[$index_qs]['question_time'] + trim($data[5]);	
					  else return $line." 単位が間違いエラー ".$this->get_string_array($data);
					    
					    $question[$index_qs]['question_timeout']['value2'] = $question[$index_qs]['question_time'] - $question[$index_qs]['question_timeout']['value1'];				    								
								break;
						}
						break;

					default :
					// kiem tra loi so thu thu cac cau tra loi,cau hoi linh tinh
					if($current_index != $index_qs)
					   return $line." 質問の順番が間違いエラー ".$this->get_string_array($data);
					
						if (preg_match('/^S.[0-9]/', trim($data[1]))) {
							
						  	//kiem tra truong hop lan lon cau trac nghiem trong cau tu luan
						  	if($question[$index_qs]['type'] == 'QW')
						  	return $line." エラー ".$this->get_string_array($data);
						  	
						  	//kiem tra neu bi trung cau selection
						  	if(isset($question[$index_qs]['selection'][preg_replace('/[^0-9]/', '', $data[1])]))
						  	return $line." 選択が間違いエラー ".$this->get_string_array($data);
							
							// loi sap xep sai thu tu selection
						  if(preg_replace('/[^0-9]/', '', $data[1]) != 1 && !isset($question[$index_qs]['selection'][preg_replace('/[^0-9]/', '', $data[1]) - 1]))
						  return $line." 選択が間違いエラー ".$this->get_string_array($data);
							
						  if(trim($data[2]) == 'FG'){
						  	$question[$index_qs]['selection'][preg_replace('/[^0-9]/', '', $data[1])] = trim($data[3]);
						  }
						  else{
							$question[$index_qs]['selection'][preg_replace('/[^0-9]/', '', $data[1])] = trim($data[2]);
						  }
						  
						  
						}else if (preg_match('/^WR.[0-9]/', trim($data[1]))) {	
							
							//kiem tra neu bi trung cau selection
						  	if(isset($question[$index_qs]['selection'][preg_replace('/[^0-9]/', '', $data[1])]))
						  	return $line." 選択が間違いエラー ".$this->get_string_array($data);
							
							//kiem tra truong hop lan lon cau trac nghiem trong cau tu luan
						  	if($question[$index_qs]['type'] == 'QS')
						  	return $line." 選択が間違いエラー ".$this->get_string_array($data);
							
							// loi sap xep sai thu tu dap an
						  if(preg_replace('/[^0-9]/', '', $data[1]) != 1 && !isset($question[$index_qs]['selection'][preg_replace('/[^0-9]/', '', $data[1]) - 1]))
						  return $line." 選択が間違いエラー ".$this->get_string_array($data);				
							$question[$index_qs]['selection'][preg_replace('/[^0-9]/', '', $data[1])] = trim($data[2]);
							
							
						} else{
							//kiem tra loi ko co selection lua chon
							if(!isset($question[$index_qs]['selection'])){
							   return $line." 選択が間違いエラー ".$this->get_string_array($data);
							}
							if (preg_match('/^AN.[0-9]/', trim($data[1]))) {
								
									// kiem tra sai kieu test
									if($question['TestType'] == 'Fix' && !isset($question[$index_qs]['question_timeout']))
					   					 return $line." テストタイプが正しくないエラー:".$question['TestType']." in ".$this->get_string_array($data);
								
								
                                 $question[$index_qs]['answer'][preg_replace('/[^0-9]/', '', $data[1])]['type'] = trim($data[2]);
                                 $question[$index_qs]['answer'][preg_replace('/[^0-9]/', '', $data[1])]['indexanswer'] = trim($data[1]);
								switch (trim($data[2])) {
									case 'KS' :
									case 'KWA' :
									case 'KWP' :
										$question[$index_qs]['answer'][preg_replace('/[^0-9]/', '', $data[1])][trim($data[2])] = trim($data[3]);
										break;

									case 'KSA' :
									$question[$index_qs]['multi_select'] = 1;
									case 'KWAA' :									
									case 'KWPA' :
									$index = 3;
									    $question[$index_qs]['answer'][preg_replace('/[^0-9]/', '', $data[1])][trim($data[2])] = $data[$index];
										for ($index = 4, $max_count = sizeof($data); $index < $max_count; $index++) {
											$question[$index_qs]['answer'][preg_replace('/[^0-9]/', '', $data[1])][trim($data[2])] = $question[$index_qs]['answer'][preg_replace('/[^0-9]/', '', $data[1])][trim($data[2])] + "," + $data[$index];
										}									
									break;
									case 'KWAO' :
									case 'KWPO' :
									case 'KSO' :
										for ($index = 3, $max_count = sizeof($data); $index < $max_count; $index++) {
											$question[$index_qs]['answer'][preg_replace('/[^0-9]/', '', $data[1])][trim($data[2])][$index -3] = $data[$index];
										}
										break;
									default :
									  return $line." キーワードが間違いエラー ".$this->get_string_array($data);
										break;
								}
							} else
								if (preg_match('/^SC.[0-9]/', trim($data[1]))) {	
									
								  if(trim($data[2]) == 'VINP'){
								  	 $question[$index_qs]['SC']['VINP'] = TRUE;
								  }
									else {
										$question[$index_qs]['SC'][trim($data[2])] = trim($data[3]);
										$question[$index_qs]['SC']['VINP'] = FALSE;
										}
								}
						}
						break;
				}

			}else return $line." キーワードが間違いエラー".$this->get_string_array($data);
			
				break;
			}
			
		}
			
		}
		fclose($handle);

		return -1;

	}
    
    
            public function readCsvFile(){
            	
            	if(isset($_POST['ok']))
            {
               		  //kiem tra xem qua trinh upload co loi gi ko
	if ( !isset($_FILES["file_upload"]["error"]) ||
        $_FILES["file_upload"]["error"] != 0 ) {
    //thông báo lỗi dựa vào giá trị của $_FILES["file_upload"]["error"]
    	    $data['report'] = "選択のファイルがない";
            $this->my_layout->view("backend/report",$data);
            return;
    //và thoát
	} //end if

//kiem tra xem dung luong file co qua gio han quy dinh ko
if ( $_FILES["file_upload"]["size"] > $_POST['MAX_FILE_SIZE'] ) {
    //thông báo lỗi
    //và thoát
    $data['report'] = "ファイルのサイズが大きすぎ";
            $this->my_layout->view("backend/report",$data);
            return;
}
//kiem tra phan extension cua file co dung la xls ko
$temp = preg_split('/[\/\\\\]+/', $_FILES["file_upload"]["name"]);
$filename = $temp[count($temp)-1];
//ta cũng có thể kiểm tra phần mở rộng của file nếu cần thiết
if ( !preg_match('/\.(csv)$/i', $filename ) ){
    //thông báo lỗi file upload không phải là dạng XLS
    //và thoát
    $data['report'] = "ファイルのフォーマットは　.CSVじゃない";
            $this->my_layout->view("backend/report",$data);
            return;
} //end if 
$path_file = substr($_FILES["file_upload"]["tmp_name"],0,strlen($_FILES["file_upload"]["tmp_name"]) - strlen($_FILES["file_upload"]["name"]) + 3);
if ( move_uploaded_file($_FILES["file_upload"]["tmp_name"], $path_file."$filename") ) {
   //file đã được upload và copy sang thư mục lưu trữ thành công 
   
}else return;

   //file đã được upload và copy sang thư mục lưu trữ thành công   
     $result = $this->checkCSV($path_file."$filename");
    if($result == -1){
      $result = $this->readCsvFileReturn($path_file."$filename");
      redirect(base_url()."maketest/user/upload_success/");
    }
    else if($result == -2){
    	// vao day la truong hop file bi trung
    		$this->load->library('session');
        	$data = array('tmp_name'=>$path_file."$filename");
        	$this->session->set_userdata($data);
            
            redirect(base_url()."maketest/user/overwrite_file/".$_FILES["file_upload"]["name"]);
            
            
    }else {
       		$data['report'] = $result."行に間違い";
            $this->my_layout->view("backend/report",$data);  
    }       
            }else{
            	$data=array();
                $this->my_layout->view("maketest/user/load_file",$data);   
            }
            
            }

            /*
             * Simulate a test for test maker.
             * Programmed by Ngo Anh Tuan
             */
             	public function upload_success(){
             		$this->load->model("mbooklet");
             		$booklet_id = $this->mbooklet->getMaxBookletID()->id;
             		$data['report'] = "CSV アップロードが成功です! <br><br><a href='".base_url()."maketest/simulate/gettest/".$booklet_id."'>アップロードしたテスト問題をシミュレーションする</a>";
                        $this->my_layout->view("backend/report",$data);
             	}
             	/**
             	 * Overwrite file
             	 */
             	function overwrite_file($name){
             		$this->load->model("mbooklet");
             		
             		if (isset($_POST['overwrite'])){
            	// Xu ly trung o day nhe
            	
            	$name_split = substr($name,0,strlen($name) - 4);
                $this->mexam->deleteAllExamOfOrganizationDescription($name_split,$this->my_auth->organization_id);
            	$this->mbooklet->deleteAllBookletOfOrganizationAndBookletId($name_split,$this->my_auth->organization_id);
            	
     			$this->load->library('session');
        		$tmp = $this->session->userdata('tmp_name'); //access it
        		
                $result = $this->readCsvFileReturn($tmp);
		        redirect(base_url()."maketest/user/upload_success/");    
                   	
            }else if (isset($_POST['cancel'])){
            	//Chuyen dieu khien ve trang upload file user/readCsvFile
            	redirect(base_url()."maketest/user/readCsvFile");
            }else{
            	$data['filename'] = $name;
                $this->my_layout->view("maketest/user/double_csvfile_view",$data);
            }
             	}
        //--- Cap nhat maketest
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
   
                    $this->my_layout->view("maketest/user/edit_view",$data);
                
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
                                    "type"     => "00100",
                                    "birthday"    => $date,
                                   
                                 );
                      if($this->input->post("password")!="")
                      {
                         $update['password'] = md5($this->input->post("password"));
                      }
                      
                      $this->muser->updateUser($update,$user_id);
                      redirect(base_url()."maketest/user"); 
                }
            }
            else
            {
                $this->my_layout->view("maketest/user/edit_view",$data);   
            }
            
        }
        else
        {
            
            $data['report'] = "このURLが無効です！";
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
		
		$this->my_layout->view("maketest/user/manual_marking",$data);
    	
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
            $config['base_url'] = base_url()."maketest/user/print_result";
            $config['total_rows'] = $max;
            $config['per_page'] = $min;
            $config['num_link'] = 3; 
            $config['uri_segment'] = 4;
            $this->pagination->initialize($config);
            
            $data['link'] = $this->pagination->create_links();
            $data['users'] = $this->mexam->getuserexam($booklet_id);
            $description = $this->mbooklet->getrecord($booklet_id);
            $data['booklet_name'] = $description['description'];
            $data['booklet_id'] = $booklet_id;
            $this->my_layout->view("maketest/user/result_view_no_graphic",$data);
        }else{
            $data['report'] = "表示するデータがありません";
            $this->my_layout->view("backend/report",$data);
        }
    }
    //--- Cham thi
    function marking_testexam(){
    	$max = $this->mexam->num_rows_bookletexam();
        $min = 3;
        $data['num_rows'] = $max;
        //--- Paging
        if($max!=0){
            
            $this->load->library('pagination');
            $config['base_url'] = base_url()."maketest/user/marking_testexam";
            $config['total_rows'] = $max;
            $config['per_page'] = $min;
            $config['num_link'] = 3; 
            $config['uri_segment'] = 4;
            $this->pagination->initialize($config);
            
            $data['link'] = $this->pagination->create_links();
            $record = $this->mbooklet->getInfo($this->my_auth->user_id);
            $data['users'] = $record;
            $k = 0;
            foreach ( $record as $item ) {
       			//Marking automatically
				$rawJSONArray=$this->doingTestModel->getBookletDataByID($item['booklet_id']);
				//The first element in array has index of 0 and this element has an array in the index of 'data' because of the 'data' return field
				$rawJSONData=json_decode($rawJSONArray[0]['data']);
       			$dulieu[$k] = $rawJSONData->marking;
				$k++;	
			}
			$numberofrecord = $this -> mbooklet ->getNumberOfInfo($this->my_auth->user_id);
			if ($numberofrecord == 0){
				$data['report'] = "データがないので、表示できない";
            	$this->my_layout->view("backend/report",$data);
			}else{
				$data['marking'] = $dulieu;
            	$this->my_layout->view("maketest/user/list_view",$data);	
			}
			
        
        }else{
            $data['report'] = "データがないので、表示できない";
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
            $config['base_url'] = base_url()."maketest/user/marked_result";
            $config['total_rows'] = $max;
            $config['per_page'] = $min;
            $config['num_link'] = 3; 
            $config['uri_segment'] = 4;
            $this->pagination->initialize($config);
            
            $data['link'] = $this->pagination->create_links();
            $data['users'] = $this->mexam->getuserexam($booklet_id);
            $description = $this->mbooklet->getrecord($booklet_id);
            $data['booklet_name'] = $description['description'];
            $data['booklet_id'] = $booklet_id;
            $this->my_layout->view("maketest/user/result_view",$data);
        }else{
            $data['report'] = "表示するデータがありません";
            $this->my_layout->view("backend/report",$data);
        }
    }
     //--- List view marked booklet
    function send_result(){
    	$user_id = $this->my_auth->user_id;
    	$max = $this->mexam->num_rows_markedbookletexamid($user_id);
        $min = 3;
        $data['num_rows'] = $max;
        //--- Paging
        if($max!=0){
            
            $this->load->library('pagination');
            $config['base_url'] = base_url()."maketest/user/send_result";
            $config['total_rows'] = $max;
            $config['per_page'] = $min;
            $config['num_link'] = 3; 
            $config['uri_segment'] = 4;
            $this->pagination->initialize($config);
            
            $data['link'] = $this->pagination->create_links();
            $data['users'] = $this->mexam->getmarkedbookletexamid($user_id);
            $this->my_layout->view("maketest/user/marked_booklet_view",$data);
        
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
                	$message  = $userinfo['name']."の結果: <br/>";
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
     
    function get_string_array($array){
    	 $result = "";
    	for ( $index = 0, $max_count = sizeof( $array ); $index < $max_count; $index++ ) {
	        $result = $result.$array[$index].",";
      		}
    	return $result;
    }
    
    
    function view_uploaded_csv()
    {
    	$testmaker_id=$this->my_auth->user_id;
    	$data['allbooklets']=$this->mbooklet->getAllBookletUploadedByATestMaker($testmaker_id);
    	
    	$numberOfAllBooklets=$this->mbooklet->getNumberOfBookletUploadedByATestMaker($testmaker_id);
    	$data['numberOfAllBooklets']=$numberOfAllBooklets;
    	
    	$numberOfRowPerPage=3;
    	if($numberOfAllBooklets!=0)
    	{
    		$this->load->library('pagination');
    		//$config['base_url'] = base_url()."maketest/testlist/index";
    		$config['total_rows'] = $numberOfAllBooklets;
    		$config['per_page'] = $numberOfRowPerPage;
    		$config['num_link'] = 3;
    		$config['uri_segment'] = 4;
    		$this->pagination->initialize($config);
    	
    		$data['link'] = $this->pagination->create_links();
    	
    	
    		$this->my_layout->view("maketest/user/listAllUploadedCSV",$data);
    			
    	}
    	else
    	{
    		$data['report'] = "アップロードしたCSVファイルがないから表示できない!";
    		$this->my_layout->view("backend/report",$data);
    	}
    }
    
    function getCSVForViewing($booklet_id)
    {
    	$testmaker_id=$this->my_auth->user_id;
    	$rawJSONArray=$this->doingTestModel->getBookletDataByID($booklet_id);
    	//The first element in array has index of 0 and this element has an array in the index of 'data' because of the 'data' return field
    	$rawJSONData=json_decode($rawJSONArray[0]['data']);
    	$count=0;
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
    	
    	$this->my_layout->view("maketest/user/viewParticularCSV",$data);
    	
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
		//$result = array('0');
    	for ( $index = 0;; $index++ ) {
    	  if(!isset($data[$index]))
    	   break;
    	  if($data[$index]['reply'] != ""){
    	    
    		$reply_row = json_decode($data[$index]['reply']);
    		  for ( $index_1 = 0;; $index_1++ ) {
    		     if(!isset($reply_row[$index_1])){
    		       break;
				 }
				 if(!isset($reply_row[$index_1][1]) || str_replace(',','',$reply_row[$index_1][1]) == "")
				   $result[$index_1][$index] = 'z';
				 else  
    		       $result[$index_1][$index] = $reply_row[$index_1][1];
				}
		}else{
    		  for ( $index_1 = 0;; $index_1++ ) {
    		     if(!isset($reply_row[$index_1])){
    		       break;
				 }
    		       $result[$index_1][$index] = 'z';
				}						
		}
    	}
		//print_r ($result);
    	return $result;
    }
    
	function graphic1($booklet_id){
         //$booklet_id = 36; // a lay booklet_id rui dung cai ngay ben duoi de lay ket qua, cai duoi nua la em la vi du de hien thi a co the bo di
		 $result = $this->return_for_graphic_1($booklet_id);
		 if ($result != NULL){
		 	$x = $result["0.1"].",".$result["0.2"].",".$result["0.3"].",".$result["0.4"].",".$result["0.5"].",".
		 $result["0.6"].",".$result["0.7"].",".$result["0.8"].",".$result["0.9"].",".$result["1"];
		
         $data["x"] = $x;
		 $data['max_score'] = $result['max_score'];
         $this->my_layout->view("maketest/user/graphic1",$data);
		 }else{
		 	$data['report'] = "回答者がまだテストをしない!";
    		$this->my_layout->view("backend/report",$data);
		 }
		 
    }
	
    function graphic2($booklet_id){
		$result = $this->return_for_graphic_2($booklet_id);
//		print_r ($result);
		if ($result != NULL){
			$xLenght = sizeof($result);
		$x = "";
		for ($i=0; $i <$xLenght ; $i++) { 
			$x .= "'問題".($i+1)."',";
		}		
		//print_r($result);
		/*$string = "S(1),S(2)";
		if (preg_match("/(2)/", $string)) echo " ton tai !";
		else echo "khong ton tai !";*/
		$yLenght= sizeof($result[0]);
		
		$x1 = "";$x2 = "";$x3 = "";$x4 = "";$x5 = "";$x6 = "";$x7 = "";$x8 = "";$x10 = "";
		for ($i=0; $i < $xLenght ; $i++) {
			$c1 =0; $c2 = 0; $c3 = 0; $c4 = 0;$c5 = 0; $c6 = 0;$c7 = 0; $c8 = 0;$c10 = 0;
			for ($j=0; $j < $yLenght ; $j++) {
		      if(!isset($result[$i][$j])) continue;
				if (preg_match("/(1)/", $result[$i][$j])) $c1++;
				if (preg_match("/(2)/", $result[$i][$j])) $c2++;
				if (preg_match("/(3)/", $result[$i][$j])) $c3++;
				if (preg_match("/(4)/", $result[$i][$j])) $c4++;
				if (preg_match("/(5)/", $result[$i][$j])) $c5++;
				if (preg_match("/(6)/", $result[$i][$j])) $c6++;
				if (preg_match("/(7)/", $result[$i][$j])) $c7++;
				if (preg_match("/(8)/", $result[$i][$j])) $c8++;  
				if ($result[$i][$j] == "z" || $result[$i][$j] == "") $c10++; 
				/*switch ($result[$i][$j]) {
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
				}*/			
			} 			
			$x1 .= $c1.",";
			$x2 .= $c2.",";
			$x3 .= $c3.",";
			$x4 .= $c4.",";
			$x5 .= $c5.",";
			$x6 .= $c6.",";
			$x7 .= $c7.",";
			$x8 .= $c8.",";
			$x10 .= $c10.",";
		}		
		$data['x'] = $x;
		$data['x1'] = $x1;
		$data['x2'] = $x2;
		$data['x3'] = $x3;
		$data['x4'] = $x4;
		$data['x5'] = $x5;
		$data['x6'] = $x6;
		$data['x7'] = $x7;
		$data['x8'] = $x8;
		$data['x10'] = $x10;
		 $this->my_layout->view("maketest/user/graphic2",$data);	
			
		}else{
			$data['report'] = "結果がまだありません!";
    		$this->my_layout->view("backend/report",$data);
		}		
		
    }
}
?>
