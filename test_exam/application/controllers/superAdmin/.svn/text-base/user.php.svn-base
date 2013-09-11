<?php

class User extends CI_Controller {

	var $_mail;

	function __construct() {
		parent::__construct();
		$this -> load -> helper(array("url", "form", "my_data"));
		$this -> load -> library(array("input", "form_validation", "session", "my_auth", "email"));

		if (!$this -> my_auth -> is_Superadmin()) {
			redirect(base_url() . "home/verify/login");
			exit();
		}

		$this -> load -> database();
		$this -> load -> model("muser");
		$this -> load -> model("morganization");
		$this -> load -> model("mbooklet");
		$this -> load -> model ("mexam");
		$this -> load -> library("my_layout");
		// Sử dụng thư viện layout
		$this -> my_layout -> setLayout("superAdmin/template");
		// load file layout chính (views/template.php)
	}

	//--- quan ly danh sach sub admin
	function index() {
		
		$max = $this -> muser -> num_rows_adminid();
		$min = 3;
		$data['num_rows'] = $max;
		//--- Paging
		if ($max != 0) {

			$this -> load -> library('pagination');
			$config['base_url'] = base_url() . "superAdmin/user/index";
			$config['total_rows'] = $max;
			$config['per_page'] = $min;
			$config['num_link'] = 3;
			$config['uri_segment'] = 4;
			$this -> pagination -> initialize($config);

			$data['link'] = $this -> pagination -> create_links();
			//$data['users'] = $this -> muser -> getalladmin();
			$data['users'] = $this -> muser -> getalloruser();
			$users = $data['users'];
			foreach ($users as $user) {
				$organization= $this->morganization->getOrganizationInfoFromUserid($user['user_id']);
				//echo $organiation['organization_id']."<br />";
				$today = date("Y-m-d");				
				$started_day = strtotime($organization['expired_date']);
				$expired_day = strtotime($today);
				if ( $expired_day > $started_day){
					$days_between = ceil(abs($expired_day - $started_day) / 86400);
				if ($days_between > 730){
					$this -> mexam -> deleteAllExamOfOrganization ($organization["organization_id"]);
					$this -> mbooklet -> deleteAllBookletOfOrganization($organization["organization_id"]);	
					$this -> muser -> deleteAllUserOfOrganization($organization['organization_id']);
					$this -> morganization -> deleteOrganization($organization['organization_id']); 				
				}
				}
				
				
			}			
			$this -> my_layout -> view("superAdmin/user/list_view", $data);

		} else {
			$data['report'] = "表示するデータがありません";
			$this -> my_layout -> view("backend/report", $data);
		}

	}

	//--- Quan ly to chuc
	function manage_organization() {
		if (isset($_POST['ok'])){
			$month = $_POST['month'];
			$year = $_POST['year'];
			//$date = date("Y-m-d", mktime(0, 0, 0, $month, $day, $year));
			$all_record = $this -> morganization -> getallrecord();
			$list = array();
			$row1 = array();
			$row1[] = "CTS-TAS-GWK53M78";
			$row1[] = $year;
			$row1[] = $month;
			$row1[] = date('Y',time());
			$row1[] = date('m',time());
			$row1[] = date('d',time());
			$row1[] = date('h',time());
			$row1[] = date('i',time());
			$row1[] = date('s',time());
			$row1[] = $this -> my_auth ->username;
			$row1[] = $this -> my_auth ->username;
			$list[] = $row1;
			foreach ( $all_record as $item ) {
       			$s_day 		= date('d',strtotime($item['started_date']));
				$s_month 	= date('m',strtotime($item['started_date']));
				$s_year 	= date('Y',strtotime($item['started_date']));
				
				$e_day 		= date('d',strtotime($item['expired_date']));
				$e_month 	= date('m',strtotime($item['expired_date']));
				$e_year 	= date('Y',strtotime($item['expired_date']));
				$info = $this->morganization->getInfo($item["organization_id"]);
    			$currentTime = strtotime(date('Y-m'));
       			$expiredTime = strtotime($item['expired_date']);
 				$c_year = date('Y',time());
				$c_month = date('m',time());
    			if (($year < $c_year)||($year == $c_year && $month <= $c_month)){
    				//Not expired
    				if (($year < $e_year && (($year==$s_year &&$month >=$s_month )||($year>$s_year)))|| ($year == $e_year && $month <=$e_month && $month >=$s_month)){
    					$row = array();
    					$row[] = $item['organization_id'];
    					$row[] = $item['organization_name'];
    					$row[] = $this -> muser -> getSumMoney($item['organization_id']);
    					$row[] = $item['address'];
    					$telephone = $this -> muser -> getoridadmintogether($item['organization_id']);
    					foreach ( $telephone as $mobile ) {
       						$row[] = $mobile['phone'];	
						}
    					
    					$list[] = $row;
    				}
    			}
			}
			$row3 = array();
			$row3[] = "END___END___END";
			$row3[] = $year;
			$row3[] = $month;
			$list[]= $row3;
			
			//write file csv
			$filename = "TAS-".$year."-".$month.".csv";
			$f = fopen($filename, "w+");
			foreach ($list as $v) {
				fputcsv($f,$v);
			}
			fclose($f); 
			$data['report'] = "CSVファイルを提出のは成功です！";
			$this -> my_layout -> view("backend/report", $data);
		}else{
			$max = $this -> morganization -> num_rows();
		$min = 3;
		$data['num_rows'] = $max;
		//--- Paging
		if ($max != 0) {

			$this -> load -> library('pagination');
			$config['base_url'] = base_url() . "superAdmin/user/manage_organization";
			$config['total_rows'] = $max;
			$config['per_page'] = $min;
			$config['num_link'] = 3;
			$config['uri_segment'] = 4;
			$this -> pagination -> initialize($config);

			$data['link'] = $this -> pagination -> create_links();
			$data['users'] = $this -> morganization -> getallrecord();
			$tmp = $this -> morganization -> getallrecord();
			//$data['users'] = $this -> muser -> getSumMoney();
			$k = 0;
			foreach ($tmp as $items) {
				$dulieu[$k] = $this -> muser -> getSumMoney($items['organization_id']);
				$k++;
			}
			$data['totalsum'] = $dulieu;
			$this -> my_layout -> view("superAdmin/user/organization_view", $data);

		} else {
			$data['report'] = "表示するデータがありません！";
			$this -> my_layout -> view("backend/report", $data);
		}
			
		}
		
	}

	//--- Cap nhat organization
	function or_edit() {
		$orid = $this -> uri -> segment(4);
		$data['info'] = $this -> morganization -> getInfo($orid);

		if ($orid != null && $data['info'] != NULL) {

			if (isset($_POST['ok'])) {
				$this -> form_validation -> set_rules("organization_id", "Organization id", "required|min_length[3]");
				$this -> form_validation -> set_rules("organization_name", "Organization name", "required|min_length[4]");
				$this -> form_validation -> set_rules("address", "Address", "required");
				//started_date
				$s_date = $_POST['started_day'];

				//expired_date
				$e_date = $_POST['expired_day'];

				$data['error'] = "";
				if ($this -> form_validation -> run() == FALSE) {

					$this -> my_layout -> view("superAdmin/user/edit_organization_view", $data);

				} else {
					$update = array("organization_id" => $this -> input -> post("organization_id"), "organization_name" => $this -> input -> post("organization_name"), "address" => $this -> input -> post("address"), "started_date" => $s_date, "expired_date" => $e_date);

					$this -> morganization -> updateOrganization($update, $orid);
					redirect(base_url() . "superAdmin/user/manage_organization");
				}
			} else {

				$info = $data['info'];
				$expired_date = strtotime($info['expired_date']);
				$now = time();
				if ($this -> muser -> checkExistAdminOrid($orid) == 0) {
					$data['report'] = "団体管理者を削除後。契約期間が変更できないこと。";
					$this -> my_layout -> view("backend/report", $data);
				} else {
					$this -> my_layout -> view("superAdmin/user/edit_organization_view", $data);
				}

			}

		} else {

			$data['report'] = "表示するデータがありません";
			$this -> my_layout -> view("backend/report", $data);
		}
	}

	//--- Xoa organization
	function or_delete() {
		$orid = $this -> uri -> segment(4);

		if ($orid != null) {
			$this -> mexam -> deleteAllExamOfOrganization ($orid);
			$this -> mbooklet -> deleteAllBookletOfOrganization($orid);	
			$this -> muser -> deleteAllUserOfOrganization($orid);
			$this -> morganization -> deleteOrganization($orid);
			redirect(base_url() . "superAdmin/user/manage_organization");

		} else {

			$data['report'] = "表示するデータがありません";
			$this -> my_layout -> view("backend/report", $data);
		}
	}

	//--- Profile view
	function profile() {
		$user_id = $this -> my_auth -> user_id;
		$data['info'] = $this -> muser -> getInfo($user_id);

		$this -> my_layout -> view("superAdmin/user/profile_view", $data);
	}

	//--- Cap nhat admin
	function edit() {
		$user_id = $this -> uri -> segment(4);
		$dl = $this -> muser -> getInfo($user_id);
		$data['info'] = $dl;
		//$data['info'] = $this -> muser -> getalloruserid($user_id);
		$data['orga'] = $this -> morganization -> getInfo($dl['organization_id']);
		if (is_numeric($user_id) && $data['info'] != NULL) {
			//print_r($data);
			if (isset($_POST['ok'])) {
				$this -> form_validation -> set_rules("full_name", "Full name", "required|min_length[6]");
				$this -> form_validation -> set_rules("username", "Username", "required|max_length[25]|callback_checkUser");
				$this -> form_validation -> set_rules("password", "Password", "matches[repassword]");
				$this -> form_validation -> set_rules("email", "Email", "required|valid_email|callback_checkEmail");
				$this -> form_validation -> set_rules("address", "Address", "required");
				$this -> form_validation -> set_rules("phone", "Phone number", "required|numeric");

				$data['error'] = "";
				if ($this -> form_validation -> run() == FALSE) {

					$this -> my_layout -> view("superAdmin/user/edit_new", $data);

				} else {
					$day = $_POST['day'];
					$month = $_POST['month'];
					$year = $_POST['year'];

					//started_date
					$s_date = $_POST['started_day'];

					//expired_date
					$e_date = $_POST['expired_day'];

					$date = date("Y-m-d", mktime(0, 0, 0, $month, $day, $year));
					$update = array("name" => $this -> input -> post("full_name"), "username" => $this -> input -> post("username"), "email" => $this -> input -> post("email"), "address" => $this -> input -> post("address"), "phone" => $this -> input -> post("phone"), "type" => "01000", "birthday" => $date, );
					$update_or = array("started_date" => $s_date, "expired_date" => $e_date);

					if ($this -> input -> post("password") != "") {
						$update['password'] = md5($this -> input -> post("password"));
					}

					$this -> muser -> updateUser($update, $user_id);
					$this -> morganization -> updateOrganization($update_or, $this -> input -> post("organization_id"));
					redirect(base_url() . "superAdmin/user");
				}
			} else {
				//print_r($data);

				$this -> my_layout -> view("superAdmin/user/edit_view", $data);

			}

		} else {

			$data['report'] = "表示するデータがありません";
			$this -> my_layout -> view("backend/report", $data);
		}
	}

	//--- Cap nhat super admin
	function edit_super() {
		$user_id = $this -> uri -> segment(4);
		$data['info'] = $this -> muser -> getInfo($user_id);

		if (is_numeric($user_id) && $data['info'] != NULL) {

			if (isset($_POST['ok'])) {
				$this -> form_validation -> set_rules("full_name", "Full name", "required|min_length[6]");
				$this -> form_validation -> set_rules("username", "Username", "required|max_length[25]|callback_checkUser");
				$this -> form_validation -> set_rules("password", "Password", "matches[repassword]");
				$this -> form_validation -> set_rules("email", "Email", "required|valid_email|callback_checkEmail");
				$this -> form_validation -> set_rules("address", "Address", "required");
				$this -> form_validation -> set_rules("phone", "Phone number", "required|numeric");

				$data['error'] = "";
				if ($this -> form_validation -> run() == FALSE) {

					$this -> my_layout -> view("superAdmin/user/editProfile_view", $data);

				} else {
					$day = $_POST['day'];
					$month = $_POST['month'];
					$year = $_POST['year'];

					$date = date("Y-m-d", mktime(0, 0, 0, $month, $day, $year));
					$update = array("name" => $this -> input -> post("full_name"), "username" => $this -> input -> post("username"), "email" => $this -> input -> post("email"), "address" => $this -> input -> post("address"), "phone" => $this -> input -> post("phone"), "type" => "10000", "birthday" => $date, );
					if ($this -> input -> post("password") != "") {
						$update['password'] = md5($this -> input -> post("password"));
					}

					$this -> muser -> updateUser($update, $user_id);
					redirect(base_url() . "superAdmin/user");
				}
			} else {
				$this -> my_layout -> view("superAdmin/user/editProfile_view", $data);
			}

		} else {

			$data['report'] = "表示するデータがありません";
			$this -> my_layout -> view("backend/report", $data);
		}
	}

	//--- Xoa admin
	function delete() {
		$userid = $this -> uri -> segment(4);
		$data_del = $this -> muser -> getInfo($userid);
		$orga_id = $data_del['organization_id'];
		if (is_numeric($userid)) {
			$this -> mexam -> deleteAllExamOfOrganization ($orga_id);
			$this -> mbooklet -> deleteAllBookletOfOrganization($orga_id);	
			$this -> muser -> deleteAllUserOfOrganization($orga_id);
			$this -> morganization -> deleteOrganization($orga_id);
			//$this -> muser -> deleteUser($userid);
			redirect(base_url() . "superAdmin/user");

		} else {

			$data['report'] = "表示するデータがありません";
			$this -> my_layout -> view("superAdmin/report", $data);
		}
	}

	//---- Add new user
	function addAdmin() {
		$this -> form_validation -> set_rules("full_name", "Full name", "required|min_length[6]");
//		$this -> form_validation -> set_rules("username", "Username", "required|max_length[25]");
		$this -> form_validation -> set_rules("username", "Username","organization","organization", "required|max_length[25]|callback_checkUser");
		
		$this -> form_validation -> set_rules("password", "Password", "required|matches[repassword]");
		$this -> form_validation -> set_rules("email", "Email", "required|valid_email|callback_checkEmail");
		$this -> form_validation -> set_rules("address", "Address", "required");
		$this -> form_validation -> set_rules("phone", "Phone number", "required|numeric");
		$this -> form_validation -> set_rules("organization", "organization", "required|min_length[3]|callback_checkOr");

		$data['error'] = "";
		$data['orga'] = $this -> morganization -> getallrecord();
		if ($this -> form_validation -> run() == FALSE) {

			$this -> my_layout -> view("superAdmin/user/addAdmin_view", array("error" => ""));
		} else {
			$salt = create_random_string(5);
			$day = $_POST['day'];
			$month = $_POST['month'];
			$year = $_POST['year'];

			//started_date
			$s_date = $_POST['started_day'];

			//expired_date
			$e_date = $_POST['expired_day'];

			//$e_date = date("Y-m-d", mktime(0, 0, 0, $e_month, $e_day, $e_year));

			$date = date("Y-m-d", mktime(0, 0, 0, $month, $day, $year));
			$add = array("organization_id" => $this -> input -> post("organization"), "username" => $this -> input -> post("username"), "name" => $this -> input -> post("full_name"), "password" => md5($this -> input -> post("password")), "type" => "01000", "phone" => $this -> input -> post("phone"), "email" => $this -> input -> post("email"), "address" => $this -> input -> post("address"), "birthday" => $date, "money" => 0, "flag" => 0, );
			$update = array("organization_id" => $this -> input -> post("organization"), "organization_name" => $this -> input -> post("organization"), "address" => $this -> input -> post("address"), "started_date" => $s_date, "expired_date" => $e_date);

			if ($this -> muser -> addUser($add)) {
				$this -> morganization -> addOrganization($update);
				$data['report'] = "データを追加することが成功です!";
				$this -> my_layout -> view("superAdmin/report", $data);

			} else {

				$this -> my_layout -> view("superAdmin/user/addAdmin_view", $data);
			}

		}

	}

	function addOrganization() {
		$this -> form_validation -> set_rules("organization_id", "Organization id", "required|min_length[3]|callback_checkOr");
		$this -> form_validation -> set_rules("organization_name", "Organization name", "required|min_length[4]");
		$this -> form_validation -> set_rules("address", "Address", "required");

		$data['error'] = "";
		if ($this -> form_validation -> run() == FALSE) {

			$this -> my_layout -> view("superAdmin/user/addOrganization_view", array("error" => ""));
		} else {
			//started_date
			$s_date = $_POST['started_day'];

			//expired_date
			$e_date = $_POST['expired_day'];

			$add = array("organization_id" => $this -> input -> post("organization_id"), "organization_name" => $this -> input -> post("organization_name"), "address" => $this -> input -> post("address"), "started_date" => $s_date, "expired_date" => $e_date);

			if ($this -> morganization -> addOrganization($add)) {
				$data['report'] = "データを追加することが成功です!";
				$this -> my_layout -> view("superAdmin/report", $data);

			} else
				$this -> my_layout -> view("superAdmin/user/addOrganization_view", $data);
		}

	}

	function changeMoney() {
		$id = $this -> session -> userdata('user_id');
		if (isset($_POST['ok'])) {
			$data['money'] = $this -> input -> post('money_id');
			if ($this -> muser -> updateUser($data, $id)) {
				$data['report'] = "お金を変更することが成功です!";
				$this -> my_layout -> view("superAdmin/report", $data);
			} else {
				$data['report'] = "お金を変更することが失敗です!";
				$this -> my_layout -> view("superAdmin/report", $data);
			}
		} else {
			$result = $this -> muser -> getInfo($id);
			$data['money'] = $result['money'];
			//echo $data['money'];
			$this -> my_layout -> view("superAdmin/user/changeMoney_view", $data);
		}

	}

	function validPhone($phone) {

		$rule1 = "^[0-9]{11}$";

		if (eregi($rule1, $phone)) {
			return TRUE;
		} else {
			$error = "電話番号が正しくない! ぜひすべては数字です";
			$this -> form_validation -> set_message("validPhone", $error);
			return FALSE;
		}
	}

	function checkUser($username,$organiation) {
		$id = $this -> uri -> segment(4);
		print_r($id);
		if ($this -> muser -> getUserWithOrganization($username, $id,$organiation) == TRUE) {
			return TRUE;
		} else {
			$this -> form_validation -> set_message("checkUser", "ユーザー名が存在している、他のユーザ名を入力してお願い".$id);
			return FALSE;
		}
	}

	function checkOr($organiztion_id) {

		if ($this -> morganization -> checkExistOrganization($organiztion_id) == TRUE) {
			return TRUE;
		} else {
			$this -> form_validation -> set_message("checkOr", "この団体が存在している。他の団体を入力してお願い");
			return FALSE;
		}
	}

	//--- Reset money
	function money_reset() {
		$orid = $this -> uri -> segment(4);

		if ($orid != null) {
			$dulieu = $this -> muser -> getorid($orid);
			foreach ($dulieu as $items) {
				$update = array("name" => $items["name"], "organization_id" => $items["organization_id"], "username" => $items["username"], "email" => $items["email"], "address" => $items["address"], "phone" => $items["phone"], "type" => $items["type"], "birthday" => $items["birthday"], "money" => "0", "flag" => "0", );
				$this -> muser -> updateUser($update, $items["user_id"]);
			}
			redirect(base_url() . "superAdmin/user/manage_organization");

		} else {

			$data['report'] = "このURLが無効です";
			$this -> my_layout -> view("backend/report", $data);
		}
	}

}
?>
