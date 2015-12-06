<?php
class Emailinfo extends CI_Model{
	public function __construct(){
		parent:: __construct();
		$this->load->database();
		$this->load->helper('date');
	}
	public function getEmaillist($id)
	{
<<<<<<< Updated upstream
=======
<<<<<<< HEAD
			$sql = "select e.*, r.receivedBy, r.readStatus from Email AS e, ReadStatus AS r where r.receive=e.id and e.sentBy = ? or r.receivedBy = ?";
=======
>>>>>>> Stashed changes
			$sql = "select e.id, e.sendTime, e.content,e.title, iu.username as sender, ir.username as receiver, r.readStatus 
					from 
					IndividualUser ir
					RIGHT JOIN
					IndividualUser iu 
					RIGHT JOIN 
					ReadStatus AS r INNER JOIN Email AS e  ON e.id=r.receive
					ON  iu.id=e.sentBy
					ON  ir.id=r.receivedBy
					WHERE e.sentBy = ? or r.receivedBy = ?;";
<<<<<<< Updated upstream
=======
>>>>>>> origin/master
>>>>>>> Stashed changes
			$query = $this->db->query($sql, array($id,$id));
			return $query->result_array();
	}
	public function getEmailDetail($id)
	{
		$sql = "select e.id, e.sendTime, e.content,e.title, iu.username as sender, ir.username as receiver, r.readStatus 
				from 
				IndividualUser ir
				RIGHT JOIN
				IndividualUser iu 
				RIGHT JOIN 
				ReadStatus AS r INNER JOIN Email AS e  ON e.id=r.receive
				ON  iu.id=e.sentBy
				ON  ir.id=r.receivedBy
				WHERE e.id= ?";
		$query = $this->db->query($sql, $id);
		return $query->result_array();
	}
	public function createEmail($id)
	{
		$data = array(
		'sentBy' => $id,
		'title' => $this->input->post('title'),
		'sendTime' => date('Y-m-d'),
		'content' => $this->input->post('content')
		);
<<<<<<< Updated upstream
		
		$this->db->insert('Email',$data);
		$emailId = $this->db->insert_id();
		
		$data = array (
		'receive' => $emailId,
		'receivedBy' => $this->input->post('sendTo'),
		'readStatus' => FALSE);
=======
<<<<<<< HEAD

		$this->db->insert('Email',$data1);
		$emailId = $this->db->insert_id();

		$data2 = array (
		'receive' => $emailId,
		'receivedBy' => $this->input->post('sendTo'),
		'readStatus' => FALSE);

		$this->db->insert('ReadStatus',$data2);

=======
		
		$this->db->insert('Email',$data);
		$emailId = $this->db->insert_id();
		
		$data = array (
		'receive' => $emailId,
		'receivedBy' => $this->input->post('sendTo'),
		'readStatus' => FALSE);
>>>>>>> Stashed changes
		
		$this->db->insert('ReadStatus',$data);
		
>>>>>>> origin/master
	}
	public function receiver($id)
	{
		$query = $this->db->get_where('IndividualUser', array('id' => $id));
		return $query->num_rows();
	}
	public function unreadEmail($id)
	{
<<<<<<< Updated upstream
=======
<<<<<<< HEAD
			$sql = "select e.* from Email AS e, ReadStatus AS r where r.receive=e.id and r.receivedBy = ?";
			$query = $this->db->query($sql, $id);
=======
>>>>>>> Stashed changes
			$sql = "select e.* from ReadStatus AS r JOIN Email AS e  ON e.id=r.receive WHERE r.receivedBy = ?";
			$query = $this->db->query($sql, $id);			
>>>>>>> origin/master
			return $query->result_array();
	}
	public function update_status($email,$user)
	{
		$data['readStatus']=1;
		$this->db->update('ReadStatus',$data,array('receive'=>$email,'receivedBy'=>$user));
	}

	public function corpVerifiedNotification($ids) {
		$emailid = $this->corpVerification($_SESSION['id']);
		foreach ($ids as $id) {
			if ($id == "") {continue;}
			$this->addReadStatus($emailid, $id);
		}

	}
	public function corpVerification($id) {
		$this->db->insert(
			"Email",
			array(
				'sentBy' => $id,
				'title' => 'Verification Success',
				'sendTime' => date("Y-m-d"),
				'content' => 'Your Corporate User application has been approved'
			)
		);
		$emailid = $this->db->insert_id();
		return $emailid;
	}

	public function setPinNotification($id) {
		$emailid = $this->pinNotification($_SESSION['id'],$id);
		$this->addReadStatus($emailid, $id);
	}
	public function pinNotification($userid,$postid) {
		$this->db->insert(
			"Email",
			array(
				'sentBy' => $userid,
				'title' => 'Post is set pin',
				'sendTime' => date("Y-m-d"),
				'content' => 'Your post'.$postid.'is been set pin.'
			)
		);
		$emailid = $this->db->insert_id();
		return $emailid;
	}

	public function addReadStatus($emailid, $receiverid) {

		$this->db->insert(
			"ReadStatus",
			array(
				'receive' => $emailid,
				'receivedBy' => $receiverid,
				'readStatus' => 0
			)
		);
		echo 1;
	}
}
