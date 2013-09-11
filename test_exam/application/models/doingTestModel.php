<?php

/*
 * Author: Ngo Anh Tuan
 * This class is used for doing Test Modelling, provide data for examinee doing test
 * Date created: 13/03/2013
 */
class doingTestModel extends CI_Model{
	
	function __contruct(){
		parent::__construct();
		$this->load->database();
	}
	
	function getAllAvailableTest($examinee_id)
	{
		$this->db->select("*");
		$this->db->from("booklet");
		$this->db->join("exam","booklet.booklet_id=exam.booklet_id");
		$this->db->where("examinee_id",$examinee_id);
		//$this->db->where("booklet.booklet_id","exam.booklet_id");
		$query=$this->db->get();
		$data=$query->result_array();
		return $data;
	}
	function getAllAvailableTestBooklet($examinee_id,$password)
	{
		$this->db->select("*");
		$this->db->from("booklet");
		$this->db->join("exam","booklet.booklet_id=exam.booklet_id");
		$this->db->where("examinee_id",$examinee_id);
		$this->db->where("exam.password",$password);
		//$this->db->where("booklet.booklet_id","exam.booklet_id");
		$query=$this->db->get();
		$data=$query->result_array();
		return $data;
	}
	function getNumberRowOfTestList($examinee_id)
	{
		//$this->db->where("user_id",$examinee_id);
		$this->db->where("examinee_id",$examinee_id);
		$query=$this->db->get("exam");
		return $query->num_rows();
	}
	function getNumberRowOfTestListBooklet($examinee_id,$password)
	{
		//$p = md5($password);
		//$this->db->where("user_id",$examinee_id);
		$this->db->where("examinee_id",$examinee_id);
		$this->db->where("exam.password",$password);
		$query=$this->db->get("exam");
		return $query->num_rows();
	}
	function getResultOfExaminee($examinee_id,$booklet_id)
	{
		$this->db->where("examinee_id",$examinee_id);
		$this->db->where("booklet_id",$booklet_id);
		$query=$this->db->get("booklet");
		$data=$query->result_array();
		return $data;
	}
	
	function isDoneByExaminee($booklet_id,$examinee_id)
	{
		$this->db->select("reply");
		$this->db->where("examinee_id",$examinee_id);
		$this->db->where("booklet_id",$booklet_id);
		$this->db->where("reply != ''");
		$query=$this->db->get("exam");
		return $query->num_rows();
	}
	
	function getBookletDataByID($booklet_id)
	{
		$this->db->select("data");
		$this->db->where("booklet_id",$booklet_id);
		$query=$this->db->get("booklet");
		$data=$query->result_array();
		return $data;
	}
	function getBookletDataByDescription($des)
	{
		$this->db->select("data");
		$this->db->where("description",$des);
		$query=$this->db->get("booklet");
		$data=$query->result_array();
		return $data;
	}
	function getBookletSubjectByID($booklet_id)
	{
		$this->db->select("subject");
		$this->db->where("booklet_id",$booklet_id);
		$query=$this->db->get("booklet");
		$data=$query->result_array();
		return $data[0]['subject'];
	}
	
	function getBookletStartingDateByID($booklet_id)
	{
		$this->db->select("starting_date");
		$this->db->where("booklet_id",$booklet_id);
		$query=$this->db->get("booklet");
		$data=$query->result_array();
		return $data[0]['starting_date'];
		
	}
	
	function getBookletExpiredDateByID($booklet_id)
	{
		$this->db->select("expired_date");
		$this->db->where("booklet_id",$booklet_id);
		$query=$this->db->get("booklet");
		$data=$query->result_array();
		return $data[0]['expired_date'];
	
	}
	function sendJSONResult($jsonString,$examinee_id,$booklet_id)
	{
		$this->db->where("examinee_id",$examinee_id);
		$this->db->where("booklet_id",$booklet_id);
		$data['reply']=$jsonString;
		$this->db->update("exam",$data);
	}
	
	function getJSONResult($examinee_id,$booklet_id)
	{
		$this->db->select("reply");
		$this->db->from("exam");
		$this->db->where("booklet_id",$booklet_id);
		$this->db->where("examinee_id",$examinee_id);
		$query=$this->db->get();
		$data=$query->result_array();
		return $data;
	}
	
		function getJSONScoreItem($examinee_id,$booklet_id)
	{
		$this->db->select("score_item");
		$this->db->from("exam");
		$this->db->where("booklet_id",$booklet_id);
		$this->db->where("examinee_id",$examinee_id);
		$query=$this->db->get();
		$data=$query->result_array();
		return $data;
	}
	
	function getScore($examinee_id,$booklet_id)
	{
		$this->db->select("result");
		$this->db->from("exam");
		$this->db->where("booklet_id",$booklet_id);
		$this->db->where("examinee_id",$examinee_id);
		$query=$this->db->get();
		$data=$query->result_array();
		return $data;
	}
	
	function updateScoreAfterMarking($result,$examinee_id,$booklet_id)
	{
		$this->db->where("examinee_id",$examinee_id);
		$this->db->where("booklet_id",$booklet_id);
		$data['result']=$result;
		$this->db->update("exam",$data);
	}
	
		function updateScoreItemAfterMarking($score,$examinee_id,$booklet_id)
	{
		$this->db->where("examinee_id",$examinee_id);
		$this->db->where("booklet_id",$booklet_id);
		$data['score_item'] = $score;
		$this->db->update("exam",$data);
	}
	
}