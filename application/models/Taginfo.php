<?php
class Taginfo extends CI_Model{
	public function __construct(){
		parent::__construct();
		$this->load->database();
	}
	public function getTagInformation($id=0){
		if($id == 0)
		{
			$query = $this->db->get('Tag');
			return $query->resutl_array();
		}
		$query = $this->db->get_where('Tag', array('id'=>$id));
		return $query->row_array();
	}
	public function creatTag()
	{
		$data['description'] = $this->input->post['description'];
		$this->db->insert('Tag', $data);
	}
}
