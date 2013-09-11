<?php
class muser extends CI_Model{

    private $_table = "user";
    
    function __contruct(){
        parent::__construct();
        $this->load->database();
    }

    //--- get all data
    function getalldata($off="",$limit=""){
        $this->db->select('*');
        $this->db->from($this->_table);
        $this->db->limit($off,$limit);
        $this->db->order_by("user_id","asc");
        $query = $this->db->get();
        $data = $query->result_array();
        return $data;
    }
    
    //--- get an information by id
    function getInfo($id){
        $this->db->where("user_id",$id);
        $query = $this->db->get($this->_table);
        
        if($query)
            return $query->row_array();
        else
            return FALSE;
    }

    //---- get information by email
    function getInfoByEmail($email){
        $this->db->where("email",$email);
        $query = $this->db->get($this->_table);

        if($query)
            return $query->row_array();
        else
            return FALSE;
    }

    //--- Add new user
    function addUser($data){
        if($this->db->insert($this->_table,$data))
            return TRUE;
        else
            return FALSE;
    }

    //--- Remove user
    function deleteUser($id){
        if($id!=1){
            $this->db->where("user_id",$id);
            $this->db->delete($this->_table);
        }
    }

    //--- Update user
    function updateUser($data,$id){
        $this->db->where("user_id",$id);
        if($this->db->update($this->_table,$data))
            return TRUE;
        else
            return FALSE;
    }

    // Sum of record
    function num_rows(){
        return $this->db->count_all($this->_table);
    }
    
    
    //--- check email exist
    function checkEmail($email){
        $this->db->where("email",$email);
        $query = $this->db->get($this->_table);
        if($query->num_rows()==0){
            return FALSE;
        }
        else{
            return $query->row_array();
        }
        
    }
    
    //----------------------------- CHECK LOGIN
    function checkLogin($email,$password){
        $u = $email;
        $p = md5($password);
        $this->db->where("email",$u);
        $this->db->where("password",$p);
        $query = $this->db->get($this->_table);
        if($query->num_rows()==0){
            return FALSE;
        }
        else{
            return $query->row_array();
        }
        
    }
}
?>
