<?php
class mcomment extends CI_Model
{

    private $_table = "comment";
    
    function __contruct()
    {
        parent::__construct();
        $this->load->database();
    }

    //--- get all data
    function getalldata($off="", $limit="")
    {
        $this->db->select('*');
        $this->db->from($this->_table);
        $this->db->join("user", "comment.user_id = user.user_id");
        $this->db->order_by("sent_time", "desc");
        $this->db->limit($limit, $off);
        $query = $this->db->get();
        return $query->result_array();
    }
    
    //--- Get an information by comment_id
    function getInfo($id)
    {
        $this->db->where("comment_id",$id);
        $query = $this->db->get($this->_table);
        
        if( $query ){
            return $query->row_array();
        } else{
            return FALSE;
        }
    }

    //--- Add new comment
    function addComment( $data )
    {
        if( $this->db->insert($this->_table,$data) ){
            return TRUE;
        } else{
            return FALSE;
        }
    }

    //--- Sum of record
    function num_rows()
    {
        return $this->db->count_all($this->_table);
    }
    
    //--- Get record by user_id
    function getInfoByUserid($id)
    {
        $this->db->select("*");
        $this->db->where("user_id",$id);
        $query = $this->db->get($this->_table);
        if( $query ){
            return $query->result_array();
        } else {
            return FALSE;
        }
    }
}
?>
