<?php
class muser extends CI_Model{

    private $_table = "user";
    
    function __contruct(){
        parent::__construct();
        $this->load->database();
    }

    //--- Lay du lieu
    function getalldata($off="",$limit=""){
        $this->db->select('*');
        $this->db->from($this->_table);
        $this->db->limit($off,$limit);
        $this->db->order_by("user_id","asc");
        $query = $this->db->get();
        $data = $query->result_array();
        return $data;
    }
    //--- Lay record admin id
    function getalladmin(){
        $this->db->select('*');
        $this->db->from($this->_table);
        $this->db->where("type","01000");
        $query = $this->db->get();
        $data = $query->result_array();
        return $data;
    }
	// get all data ngoai tru superadmin
	
	 function getalldataexceptSA($off="",$limit=""){
        $this->db->select('*');
        $this->db->from($this->_table);
        $this->db->limit($off,$limit);
		$this->db->where('type !=','10000');
        $this->db->order_by("user_id","asc");
        $query = $this->db->get();
        $data = $query->result_array();
        return $data;
    }

    //--- Lay du lieu cung organization_id
    function getorid($organization_id){
    	$this->db->select('*');
        $this->db->from($this->_table);
        $this->db->where("organization_id",$organization_id);
        $query = $this->db->get();
        $data = $query->result_array();
        return $data;
    }
        //--- Lay du lieu tu user_id 
    function getalloruserid($id){
    	$this->db->select('*');
        $this->db->from($this->_table);
        $this->db->join("organization","user.organization_id=organization.organization_id");
        $this->db->where("user.user_id",$id);
        $query = $this->db->get();
        $data = $query->result_array();
        return $data;
    }
    //--- Lay du lieu 
    function getalloruser(){
    	$this->db->select('*');
        $this->db->from($this->_table);
        $this->db->join("organization","user.organization_id=organization.organization_id");
        $this->db->where("type","01000");
        $query = $this->db->get();
        $data = $query->result_array();
        return $data;
    }
     //--- Lay du lieu cung organization_id va cung admin
    function getoridadmintogether($organization_id){
    	$this->db->select('*');
        $this->db->from($this->_table);
        $this->db->where("organization_id",$organization_id);
        $this->db->where("type","01000");
        $query = $this->db->get();
        $data = $query->result_array();
        return $data;
    }
    //--- Lay du lieu cung organization_id va khac admin
    function getoridadmin($organization_id){
    	$this->db->select('*');
        $this->db->from($this->_table);
        $this->db->where("organization_id",$organization_id);
        $this->db->where("type !=","01000");
        $query = $this->db->get();
        $data = $query->result_array();
        return $data;
    }
    //--- Lay thong tin 1 record qua id
    function getInfo($id){
        $this->db->where("user_id",$id);
        $query = $this->db->get($this->_table);
        
        if($query)
            return $query->row_array();
        else
            return FALSE;
    }
	// get username
	function getUserFromUserName($username){
        $this->db->where("username",$username);
        $query = $this->db->get($this->_table);
        
        if($query)
            return $query->row_array();
        else
            return FALSE;
    }

    //---- Lay thong tin qua email
    function getInfoByEmail($email){
        $this->db->where("email",$email);
        $query = $this->db->get($this->_table);

        if($query)
            return $query->row_array();
        else
            return FALSE;
    }

    //--- Them User moi
    function addUser($data){
        if($this->db->insert($this->_table,$data))
            return TRUE;
        else
            return FALSE;
    }

    //--- Xoa user
    function deleteUser($id){
        if($id!=1){
            $this->db->where("user_id",$id);
            $this->db->delete($this->_table);
        }
    }

    //--- Cap nhat user
    function updateUser($data,$id){
        $this->db->where("user_id",$id);
        if($this->db->update($this->_table,$data))
            return TRUE;
        else
            return FALSE;
    }
    
        //--- Cap nhat user
    function updateUserFromUserName($data,$username){
        $this->db->where("username",$username);
        if($this->db->update($this->_table,$data))
            return TRUE;
        else
            return FALSE;
    }

    // Tong so record
    function num_rows(){
        return $this->db->count_all($this->_table);
    }
    // Tong so record theo organition_id
    function num_rows_orid($organization_id){
        $this->db->where("organization_id",$organization_id);
        $query = $this->db->get($this->_table);
        return $query->num_rows();
    }
    // Tong so record theo organition_id , khac admin
    function num_rows_oridadmin($organization_id){
        $this->db->where("organization_id",$organization_id);
        $this->db->where("type !=","01000");
        $query = $this->db->get($this->_table);
        return $query->num_rows();
    }
    // Tong so record theo admin
    function num_rows_adminid(){
        $this->db->where("type","01000");
        $query = $this->db->get($this->_table);
        return $query->num_rows();
    }
    // Check exist admin　with organization_id
    function checkExistAdminOrid($organization_id){
        $this->db->where("organization_id",$organization_id);
        $this->db->where("type","01000");
        $query = $this->db->get($this->_table);
        return $query->num_rows();
    }
    //---- Kiem tra username hop le
    function getUser($username,$id){
        if(isset($id)){ //use for update
           $this->db->where("username",$username);
           $this->db->where("user_id !=",$id);
           $query = $this->db->get($this->_table);
        }
        else{ //user for add
            $this->db->where("username",$username);
            $query = $this->db->get($this->_table);
        }
        
        if($query->num_rows()!=0){
            return FALSE;
        }
        else{
            return TRUE;
        }
    }
    // check user admin
    function getUserAdmin($username,$id){
        if(isset($id)){ //use for update
           $this->db->where("username",$username);
           $this->db->where("user_id !=",$id);
		   $this->db->where("type",01000);
           $query = $this->db->get($this->_table);
        }
        else{ //user for add
            $this->db->where("username",$username);
            $this->db->where("type",01000);
            $query = $this->db->get($this->_table);
        }
        
        if($query->num_rows()!=0){
            return FALSE;
        }
        else{
            return TRUE;
        }
    }
        function getUserWithOrganization($username,$id,$organizationid){
        if(isset($id)){ //use for update
           $this->db->where("username",$username);
           $this->db->where("user_id !=",$id);
           $this->db->where("organization_id !=",$organizationid);
           $query = $this->db->get($this->_table);
        }
        else{ //user for add
            $this->db->where("username",$username);
            $query = $this->db->get($this->_table);
        }
        
        if($query->num_rows()!=0){
            return FALSE;
        }
        else{
            return TRUE;
        }
    }
    //--- Kiem tra Email
    function checkEmail($email,$id=""){
        
        if(isset($id) && $id!="")
        { //use for update
           $this->db->where("email",$email);
           $this->db->where("user_id !=",$id);
           $query = $this->db->get($this->_table);
        }
        else
        { //user for add
            $this->db->where("email",$email);
            $query = $this->db->get($this->_table);
        }
        
        if($query->num_rows()!=0){
            return FALSE;
        }
        else{
            return TRUE;
        }
        
    }
    
    //Ngo Anh Tuan editted
    function checkLogin($username,$password,$organization){
        $u = $username;
        $p = md5($password);
        if ($organization=='admin')
       {
               $this->db->select("*");
               $this->db->from($this->_table);
               $this->db->where("username",$u);
               $this->db->where("password",$p);
               $query = $this->db->get();
       }
       else{
       		$this->db->select("*");
       		$this->db->from($this->_table);
       		$this->db->where("username",$u);
       		$this->db->where("password",$p);
       		$this->db->join("organization","user.organization_id=organization.organization_id");
       		$this->db->where("organization.organization_id",$organization);
       
       	//echo "$u => $p";
       	//echo "$query->num_rows()";
       	$query = $this->db->get();
     }
      
        if($query->num_rows()==0){
            return FALSE;
        }
        else{
            return $query->row_array();
        }
        
    }
    // record theo examinee
    function getexaminee($username){
    	$this->db->select("*");
       	$this->db->from($this->_table);
    	$this->db->where("username",$username);
        $this->db->where("type","00001");
        $query = $this->db->get();
        
        if($query->num_rows()==0){
            return FALSE;
        }
        else{
            return $query->row_array();
        }
    }
    //DVL editted
    function checkLoginExam($username,$password,$organization){
        $u = $username;
        $p = md5($password);
       		$this->db->select("*");
       		$this->db->from($this->_table);
       		$this->db->join("organization","user.organization_id=organization.organization_id");
       		$this->db->join("exam","user.user_id=exam.examinee_id");
       		$this->db->where("username",$u);
       		$this->db->where("exam.password",$p);
       		$this->db->where("organization.organization_id",$organization);
       
       	//echo "$u => $p";
       	//echo "$query->num_rows()";
       	$query = $this->db->get();   
        if($query->num_rows()==0){
            return FALSE;
        }
        else{
            return $query->row_array();
        }
        
    }
    //--- Kiem tra dang nhap without encrypt md5
    //----CHECK LOGIN
    function checkLoginWithoutMD5($username,$password){
        $u = $username;
        $p = $password;
        $this->db->where("username",$u);
        $this->db->where("password",$p);
        //echo "$u => $p";
        //echo "$query->num_rows()";
        $query = $this->db->get($this->_table);
        if($query->num_rows()==0){
            return FALSE;
        }
        else{
            return $query->row_array();
        }
        
    }
    //--- Check Username trung
    function checkExistUsername($username){
    	$this->db->where("username",$username);
    	$query = $this->db->get($this->_table);
    	if ($query->num_rows() == 0){
    		return FALSE; // not exist
    	}else{
    		return TRUE; // exist
    	}
    }
    //Checking username with the organization included
    function checkExistUsernameWithOrganization($username, $organization_id){
    	$this->db->where("username",$username);
    	$this->db->where("organization_id",$organization_id);
    	$query = $this->db->get($this->_table);
    	if ($query->num_rows() == 0){
    		return FALSE; // not exist
    	}else{
    		return TRUE; // exist
    	}
    }
    //This part is programmed by Ngo Anh Tuan
    function getAllOrganization(){
    	$this->db->select('*');
    	$this->db->from("organization");
    	$query = $this->db->get();
    	$data = $query->result_array();
    	return $data;
    }
    function setFlag($userid,$data)
    {
    	$this->db->where("user_id",$userid);
    	$this->db->update("user",$data);
    }
    /*
     * This function is programmed by Ngo Anh Tuan
     */
    function getUserForCheckingExistingUser($username,$id,$organizationID){
    	if(isset($id)){ //use for update
    		$this->db->where("username",$username);
    		$this->db->where("organization_id",$organizationID);
    		$this->db->where("user_id !=",$id);
    		$query = $this->db->get($this->_table);
    	}
    	else{ //user for add
    		$this->db->where("username",$username);
    		$query = $this->db->get($this->_table);
    	}
    
    	if($query->num_rows()!=0){
    		return FALSE;
    	}
    	else{
    		return TRUE;
    	}
    }
    
        // get sum of money
    function getSumMoney($or_id){
    	$this->db->select_sum('money','total');
    	$this->db->from($this->_table);
    	$this->db->where("organization_id",$or_id);
    	$query = $this->db->get();
    	return $query->row()->total;
    }
    
    
        //username with the organization included
    function getUsernameWithOrganization($username, $organization_id){
    	$this->db->where("username",$username);
    	$this->db->where("organization_id",$organization_id);
    	$query = $this->db->get($this->_table);
        if($query)
            return $query->row_array();
        else
            return FALSE;
    }
    
            //--- Cap nhat user
    function updateUserFromUserNameWithOrganization($data,$username,$organization_id){
        $this->db->where("username",$username);
        $this->db->where("organization_id",$organization_id);
        if($this->db->update($this->_table,$data))
            return TRUE;
        else
            return FALSE;
    }
    // del all user of organization 
    function deleteAllUserOfOrganization($organization_id){
    	$this->db->where("organization_id",$organization_id);
		$this->db->delete($this->_table);		
    }
}
?>
