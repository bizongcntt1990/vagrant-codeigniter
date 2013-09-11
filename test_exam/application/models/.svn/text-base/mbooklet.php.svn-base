<?php
class mbooklet extends CI_Model{    
    
    function __contruct(){
        parent::__construct();
        $this->load->database();
    }
	   
	 function addBooklet($data){
        if($this->db->insert('booklet',$data))
            return TRUE;
        else
            return FALSE;
    }

    function updateBooklet($data,$id){
        $this->db->where("booklet_id",$id);
        if($this->db->update("booklet",$data))
            return TRUE;
        else
            return FALSE;
    }
	
    function deleteBooklet($id){
        if($id!=1){
            $this->db->where("booklet_id",$id);
            $this->db->delete('booklet');
        }
    }
	function getMaxBookletID(){
		$query =  $this->db->query('SELECT MAX(booklet_id) as id FROM  booklet');
		return $query->row(0);
	}
	
	        //--- Lay so booklet qua description
    function get_examinee($description){
    	$this->db->select('*');
        $this->db->from("booklet");
        $this->db->where("description",$description);
        $query = $this->db->get();
         return $query->num_rows();
    }
    
    	        //--- Lay so booklet qua description va $organization_id
    function get_examinee_from_des_ogri($description,$organization_id){
    	$this->db->select('*');
        $this->db->from("booklet");
        $this->db->join('user', 'user.user_id = booklet.user_id');
        $this->db->where("description",$description);
        $this->db->where("organization_id",$organization_id);
        $query = $this->db->get();
         return $query->num_rows();
    }
    
        	        //--- Lay so booklet qua description va user_id
    function get_examinee_from_des_user_id($description,$user_id){
    	$this->db->select('*');
        $this->db->from("booklet");
        $this->db->where("description",$description);
        $this->db->where("user_id",$user_id);
        $query = $this->db->get();
         return $query->num_rows();
    }
    
    	        //--- Lay ten maketest qua booklet_id
    function get_maketest_from_bookletid($booklet_id){
    	$this->db->select('username');
        $this->db->from("booklet");
        $this->db->join('user', 'user.user_id = booklet.user_id');
        $this->db->where("booklet_id",$booklet_id);
        $query = $this->db->get();
        return $query->result_array();
    }
	
	//--- Lay thong tin nhieu record qua id
    function getInfo($id){
        $this->db->select('*'); // <-- There is never any reason to write this line!
		$this->db->from("exam");
		$this->db->join('booklet', 'booklet.booklet_id = exam.booklet_id');
		$this->db->where("user_id",$id);
		$this->db->group_by('exam.booklet_id');
		$query = $this->db->get();			
        return $query->result_array();
    }
     //--- Lay thong tin 1 record qua booklet_id
    function getrecord($id){
        $this->db->where("booklet_id",$id);
        $query = $this->db->get("booklet");
        if($query)
            return $query->row_array();
        else
            return FALSE;
    }
    
    //--- Lay thong tin booklet_id
    function getBookletIdDelete($description,$organization_id){
        $this->db->select('*'); // <-- There is never any reason to write this line!
		$this->db->from("booklet");
		$this->db->join('user', 'booklet.user_id = user.user_id');
		$this->db->where("organization_id",$organization_id);
		$this->db->where("description",$description);
		$query = $this->db->get();			
        return $query->result_array();
    }
    
	// del all booklet of organization
	function deleteAllBookletOfOrganization($organization_id){

		$query = 'DELETE booklet FROM booklet ,
					user where booklet.user_id = user.user_id and  user.organization_id = ?';
		$this->db->query($query,$organization_id);
	}
	
		// del all booklet of organization
	function deleteAllBookletOfOrganizationAndBookletId($description,$organization_id){
		$query = "DELETE booklet FROM booklet ,
					user where booklet.user_id = user.user_id and  user.organization_id = ? and description = '".$description."'";
		$this->db->query($query,$organization_id);
	}
	//--- Lay thong tin nhieu record qua id
    function getInfoName(){
        $this->db->select('*'); // <-- There is never any reason to write this line!
		$this->db->from("tmp_name");
		$query = $this->db->get();			
        return $query->result_array();
    }
    //--- Lay du lieu
    function getalldata(){
        $this->db->select('*');
        $this->db->from("tmp_name");
        $this->db->order_by("id","asc");
        $query = $this->db->get();
        $data = $query->result_array();
        return $data;
    }
	// del all tmp_name
	function deleteAllName(){
		/*$this->db->from("booklet");
		$this->db->join("user","user.user_id=booklet.user_id");
		$this->db->where("user.organization_id",$organization_id);
		$this->deb->delete();*/
		$query = 'DELETE tmp_name FROM tmp_name';
		$this->db->query($query);
	}
	function addName($data){
        if($this->db->insert('tmp_name',$data))
            return TRUE;
        else
            return FALSE;
    }
    
    //Programmed by Ngo Anh Tuan** 25/4
    function getAllBookletUploadedByATestMaker($testmaker_id)
    {
    	$this->db->select('*'); // <-- There is never any reason to write this line!
    	$this->db->from("booklet");
    	$this->db->where("user_id",$testmaker_id);
    	$query = $this->db->get();
    	return $query->result_array();
    }
    
    function getNumberOfBookletUploadedByATestMaker($testmaker_id)
    {
    	$this->db->where("user_id",$testmaker_id);
    	$query=$this->db->get("booklet");
    	return $query->num_rows();
    }
    //--- Lay so record qua id
    function getNumberOfInfo($id){
        $this->db->select('*'); // <-- There is never any reason to write this line!
		$this->db->from("exam");
		$this->db->join('booklet', 'booklet.booklet_id = exam.booklet_id');
		$this->db->where("user_id",$id);
		$this->db->group_by('exam.booklet_id');
		$query = $this->db->get();			
        return $query->num_rows();
    }
}
?>
