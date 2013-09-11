<?php
class mexam extends CI_Model{

    private $_table = "exam";
    
    function __contruct(){
        parent::__construct();
        $this->load->database();
    }
    //--- Lay tat ca booklet_id
    function getallbookletid(){
    	$this->db->select('*');
        $this->db->from($this->_table);
        $this->db->group_by('booklet_id');
        $query = $this->db->get();
        $data = $query->result_array();
        return $data;
    }
    //--- Lay tat ca examinee qua booklet_id
    function getallexaminee($id){
    	$this->db->select('*');
        $this->db->from($this->_table);
        $this->db->where("booklet_id",$id);
        $query = $this->db->get();
        $data = $query->result_array();
        return $data;
    }
    
        //--- Lay tat ca examinee qua booklet_id,user_id
    function get_examinee($booklet_id,$user_id){
    	$this->db->select('*');
        $this->db->from($this->_table);
        $this->db->where("booklet_id",$booklet_id);
        $this->db->where("examinee_id",$user_id);
        $query = $this->db->get();
         return $query->num_rows();
    }
    
    //--- Lay thong tin 1 record qua booklet_id
    function getInfo($id){
        $this->db->where("booklet_id",$id);
        $query = $this->db->get($this->_table);
        if($query)
            return $query->row_array();
        else
            return FALSE;
    }
    //--- Lay thong tin tu 2 bang user va exam
    function getuserexam($id){
    	/*$this->db->select('t1.field, t2.field2')
          		 ->from('table1 AS t1, table2 AS t2')
          ->where('t1.id = t2.table1_id')
          ->where('t1.user_id', $user_id);*/
          $this->db->select('*'); // <-- There is never any reason to write this line!
			$this->db->from($this->_table);
			$this->db->join('user', 'user.user_id = exam.examinee_id');
			$this->db->where('booklet_id',$id);
			$query = $this->db->get();
			$data = $query->result_array();
        	return $data;
    }
    //--- Lay tat ca booklet_id tu 2 bang booklet va exam
    function getbookletexam(){
    	
          $this->db->select('*'); // <-- There is never any reason to write this line!
			$this->db->from($this->_table);
			$this->db->join('booklet', 'booklet.booklet_id = exam.booklet_id');
			$this->db->group_by('exam.booklet_id');
			$query = $this->db->get();			
        	return $query->result_array();
    }
    //--- Lay marked booklet_id tu 2 bang booklet va exam
    function getmarkedbookletexam(){
    	
          	$this->db->select('*'); // <-- There is never any reason to write this line!
			$this->db->from($this->_table);
			$this->db->join('booklet','booklet.booklet_id = exam.booklet_id');
			$this->db->where('exam.result !=',-1);
			$this->db->group_by('exam.booklet_id');
			$query = $this->db->get();			
        	return $query->result_array();
    }
    //--- Lay marked booklet_id tu 2 bang booklet va exam theo id
    function getmarkedbookletexamid($id){
    	
          	$this->db->select('*'); // <-- There is never any reason to write this line!
			$this->db->from($this->_table);
			$this->db->join('booklet','booklet.booklet_id = exam.booklet_id');
			$this->db->where('exam.result !=',-1);
			$this->db->where('user_id',$id);
			$this->db->group_by('exam.booklet_id');
			$query = $this->db->get();			
        	return $query->result_array();
    }
   
    // Tong so booklet_id
    function num_rows_bookletid(){
		$this->db->select('*');
        $this->db->from($this->_table);
        $this->db->group_by('booklet_id');
        $query = $this->db->get();
        return $query->num_rows();
    }
    // Tong so record theo booklet_id
    function num_rows_blid($id){
        $this->db->where("booklet_id",$id);
        $query = $this->db->get($this->_table);
        return $query->num_rows();
    }
    //--- Tong so record 2 bang user va exam
    function num_rows_userexam($id){
    	
          $this->db->select('*'); // <-- There is never any reason to write this line!
			$this->db->from($this->_table);
			$this->db->join('user', 'user.user_id = exam.examinee_id');
			$this->db->where('booklet_id',$id);
			$query = $this->db->get();
			$data = $query->result_array();
        	return $query->num_rows();
    }
    //--- Tong so record 2 bang booklet va exam
    function num_rows_bookletexam(){
    	
          $this->db->select('*'); // <-- There is never any reason to write this line!
			$this->db->from($this->_table);
			$this->db->join('booklet', 'booklet.booklet_id = exam.booklet_id');
			$this->db->group_by('exam.booklet_id');
			$query = $this->db->get();			
        	return $query->num_rows();
    }
    //--- Tong so marked booklet_id tu 2 bang
    function num_rows_markedbookletexam(){
    		$this->db->select('*'); // <-- There is never any reason to write this line!
			$this->db->from($this->_table);
			$this->db->join('booklet', 'booklet.booklet_id = exam.booklet_id');
			$this->db->group_by('exam.booklet_id');
			$this->db->where('exam.result !=',-1);
			$query = $this->db->get();			
        	return $query->num_rows();
    }
    //--- Tong so marked booklet_id tu 2 bang theo user__id
    function num_rows_markedbookletexamid($id){
    		$this->db->select('*'); // <-- There is never any reason to write this line!
			$this->db->from($this->_table);
			$this->db->join('booklet', 'booklet.booklet_id = exam.booklet_id');
			$this->db->group_by('exam.booklet_id');
			$this->db->where('exam.result !=',-1);
			$this->db->where('user_id',$id);
			$query = $this->db->get();			
        	return $query->num_rows();
    }
    // Tong so record theo examinee_id
    function num_rows_examid($id){
        $this->db->where("examinee_id",$id);
        $query = $this->db->get($this->_table);
        return $query->num_rows();
    }
	
	 function addExam($data){
        if($this->db->insert('exam',$data))
            return TRUE;
        else
            return FALSE;
    }
	
    function updateExam($data,$examinee_id,$booklet_id){
        $this->db->where("booklet_id",$booklet_id);
		$this->db->where("examinee_id",$examinee_id);
        if($this->db->update("exam",$data))
            return TRUE;
        else
            return FALSE;
    }
	
    function deleteExam($examinee_id,$booklet_id){        
            $this->db->where("booklet_id",$booklet_id);
			$this->db->where("examinee_id",$examinee_id);
            $this->db->delete('exam');
    }
    //--- Xoa examinee_id
    function deleteExaminee($id){
        $this->db->where("examinee_id",$id);
        $this->db->delete($this->_table);
    }
	// delete all exam of the organization
	function deleteAllExamOfOrganization($organiation_id){
		/*$this->db->from($this->_table);
		$this->db->join("user","user.user_id = exam.examinee");
		$this->db->where("user.organization_id",$organiation_id);
		$this->db->delete($this->_table);*/
		$query = 'DELETE exam FROM user ,
					exam where user.user_id = exam.examinee_id and  user.organization_id = ?';
		$this->db->query($query,$organiation_id);
	}
	// del all booklet_id
	function deleteAllBookletId($id){
		$query = 'DELETE exam FROM exam where booklet_id = ?';
		$this->db->query($query,$id);
	}
	
		// delete all exam of the organization
	function deleteAllExamOfOrganizationDescription($description,$organiation_id){
		$query = "DELETE exam FROM user ,
					exam,booklet where booklet.user_id = user.user_id and booklet.booklet_id = exam.booklet_id and  user.organization_id = ? and description = '".$description."'";
		$this->db->query($query,$organiation_id);
	}
}
?>
