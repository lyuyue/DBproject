<?php
class Emailinfo extends CI_Model{
	public function __construct(){
		parent:: __construct();
		$this->load->database();
		$this->load->helper('date');
	}
	public function getEmaillist($id)
	{
			$sql = "select e.*, r.receivedBy, r.readStatus from Email AS e, ReadStatus AS r where r.receive=e.id and e.sentBy = ?";
			$query = $this->db->query($sql, $id);			
			return $query->result_array();
	}
	public function getEmailDetail($id)
	{
		$sql = "select e.*, r.receivedBy, r.readStatus from Email AS e, ReadStatus AS r where r.receive = e.id and e.id= ?";
		$query = $this->db->query($sql, $id);
		return $query->result_array();
	}
	public function createEmail($id)
	{
		$data1 = array(
		'sentBy' => $id,
		'title' => $this->input->post('title'),
		'sendTime' => date('Y-m-d'),
		'content' => $this->input->post('content')
		);
		
		$this->db->insert('Email',$data1);
		$emailId = $this->db->insert_id();
		
		$data2 = array (
		'receive' => $emailId,
		'receivedBy' => $this->input->post('sendTo'),
		'readStatus' => FALSE);
		
		$this->db->insert('ReadStatus',$data2);
		
	}
	public function receiver($id)
	{
		$query = $this->db->get_where('IndividualUser', array('id' => $id));
		return $query->num_rows();
	}
	public function unreadEmail($id)
	{
			$sql = "select e.* from Email AS e, ReadStatus AS r where r.receive=e.id and r.receivedBy = ?";
			$query = $this->db->query($sql, $id);			
			return $query->result_array();
	}
}
