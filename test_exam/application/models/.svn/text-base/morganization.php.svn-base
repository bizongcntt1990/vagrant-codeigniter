<?php
class morganization extends CI_Model{

    private $_table = "organization";
    
    function __contruct(){
        parent::__construct();
        $this->load->database();
    }

    //--- Lay all record
    function getallrecord(){
        $this->db->select('*');
        $this->db->from($this->_table);
        $query = $this->db->get();
        $data = $query->result_array();
        return $data;
    }
    //--- Lay thong tin 1 record qua id
    function getInfo($id){
        $this->db->where("organization_id",$id);
        $query = $this->db->get($this->_table);
        
        if($query)
            return $query->row_array();
        else
            return FALSE;
    }
    
    //--- Xoa organization
    function deleteOrganization($id){
        if($id!=1){
            $this->db->where("organization_id",$id);
            $this->db->delete($this->_table);
        }
    }

    //--- Cap nhat organization
    function updateOrganization($data,$id){
        $this->db->where("organization_id",$id);
        if($this->db->update($this->_table,$data))
            return TRUE;
        else
            return FALSE;
    }

    // Tong so record
    function num_rows(){
        return $this->db->count_all($this->_table);
    }
	
	// add organization
	function addOrganization($data){
        if($this->db->insert($this->_table,$data))
            return TRUE;
        else
            return FALSE;
    }  
	// check exist organization
	function checkExistOrganization($organization_id){
    	$this->db->where("organization_id",$organization_id);
    	$query = $this->db->get($this->_table);
    	if ($query->num_rows() == 0){
    		return TRUE; // not exist
    	}else{
    		return FALSE; // exist
    	}
    }
	// get organization info from userid
	function getOrganizationInfoFromUserid($user_id){
		$this->db->select("*");
		$this->db->from("organization");
		$this->db->join("user","user.organization_id=organization.organization_id");
		$this->db->where("user.user_id",$user_id);
		$query = $this->db->get();
		if($query)
            return $query->row_array();
        else
            return FALSE;
		
	}
}
?>
