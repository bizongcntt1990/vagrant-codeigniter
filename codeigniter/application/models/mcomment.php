<?php
class mcomment extends CI_Model{

    private $_table = "comment";
    
    function __contruct(){
        parent::__construct();
        $this->load->database();
    }

    //--- get all data
    function getalldata($off="",$limit=""){
        $this->db->select('*');
        $this->db->from($this->_table);
        $this->db->limit($off,$limit);
        $this->db->order_by("sent_time","desc");
        $query = $this->db->get();
        $data = $query->result_array();
        return $data;
    }
    
    //--- get an information by comment_id
    function getInfo($id){
        $this->db->where("comment_id",$id);
        $query = $this->db->get($this->_table);
        
        if($query)
            return $query->row_array();
        else
            return FALSE;
    }

    //--- Add new comment
    function addComment($data){
        if($this->db->insert($this->_table,$data))
            return TRUE;
        else
            return FALSE;
    }

    //--- Remove comment
    function deleteComment($id){
        if($id!=1){
            $this->db->where("comment_id",$id);
            $this->db->delete($this->_table);
        }
    }

    //--- Update comment
    function updateComment($data,$id){
        $this->db->where("comment_id",$id);
        if($this->db->update($this->_table,$data))
            return TRUE;
        else
            return FALSE;
    }

    //--- Sum of record
    function num_rows(){
        return $this->db->count_all($this->_table);
    }
    
    //--- Get record by user_id
    function getInfoByUserid($id){
        $this->db->select("*");
        $this->db->where("user_id",$id);
        $query = $this->db->get($this->_table);

        if($query)
            return $query->result_array();
        else
            return FALSE;
    }
    
}
?>
