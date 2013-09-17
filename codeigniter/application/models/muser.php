<?php
class muser extends CI_Model
{

    private $_table = 'user';
    
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
        $this->db->limit($off, $limit);
        $this->db->order_by('user_id', 'asc');
        $query = $this->db->get();
        $data = $query->result_array();
        return $data;
    }
    
    //--- Get an information by id
    public function getInfo($id)
    {
        $this->db->where('user_id', $id);
        $query = $this->db->get($this->_table);
        if ($query) {
            return $query->row_array();
        } else {
            return false;
        }
    }

    //---- Get information by email
    public function getInfoByEmail($email)
    {
        $this->db->where('email', $email);
        $query = $this->db->get($this->_table);
        if ($query){
            return $query->row_array();
        } else {
            return false;
        }
    }

    //--- Add new user
    public function addUser($data)
    {
        if ($this->db->insert($this->_table, $data)) {
            return true;
        } else {
            return false;
        }
    }

    // Sum of record
    public function num_rows()
    {
        return $this->db->count_all($this->_table);
    }
    
    //--- Check email exist
    public function checkEmail($email)
    {
        $this->db->where('email', $email);
        $query = $this->db->get($this->_table);
        if ($query->num_rows() == 0) {
            return false;
        } else {
            return $query->row_array();
        }   
    }
    
    //--- check login
    public function checkLogin($email, $password)
    {
        $u = $email;
        $p = md5($password);
        $this->db->where('email', $u);
        $this->db->where('password', $p);
        $query = $this->db->get($this->_table);
        if ($query->num_rows() == 0 ) {
            return false;
        } else {
            return $query->row_array();
        }        
    }
}
?>
