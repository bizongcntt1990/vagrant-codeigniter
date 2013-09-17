<?php
class mcomment extends CI_Model
{

    private $_table = 'comment';
    
    public function __contruct()
    {
        parent::__construct();
        $this->load->database();
    }

    //--- Get all data
    public function getalldata($off = "", $limit = "")
    {
        $this->db->select(STAR);
        $this->db->from($this->_table);
        $this->db->join('user', 'comment.user_id = user.user_id');
        $this->db->order_by('sent_time', 'desc');
        $this->db->limit($limit, $off);
        $query = $this->db->get();
        return $query->result_array();
    }
    
    //--- Get an information by comment_id
    public function getInfo($id)
    {
        $this->db->where('comment_id', $id);
        $query = $this->db->get($this->_table);
        if ($query) {
            return $query->row_array();
        } else {
            return false;
        }
    }

    //--- Add new comment
    public function addComment($data)
    {
        if ($this->db->insert($this->_table, $data)) {
            return true;
        } else {
            return false;
        }
    }

    //--- Sum of record
    public function num_rows()
    {
        return $this->db->count_all($this->_table);
    }
    
    //--- Get record by user_id
    public function getInfoByUserid($id)
    {
        $this->db->select(STAR);
        $this->db->where('user_id', $id);
        $query = $this->db->get($this->_table);
        if ($query) {
            return $query->result_array();
        } else {
            return false;
        }
    }
}
?>
