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
			return $query->result_array();
		}
		$query = $this->db->get_where('Tag', array('id'=>$id));
		return $query->row_array();
	}
	public function creatTag()
	{	
		$data['description'] = $this->input->post('description');
		$this->db->insert('Tag', $data);
	}
	public function check($name)
	{
		return $query=$this->db->get_where('Tag',array('description'=>$name));
	}
	public function getTagStat($id){
		$sql = "select t.* from Tag t, TagStatistics ts where ts.tagId=t.id and ts.usedBy = ?";
		$query = $this->db->query($sql,$id);
		return $query->result_array();
	}
	public function addTag($house,$tag)
	{
		$query = $this->db->get_where('TagStatistics',array('usedBy'=>$house,'tagId'=>$tag));
		if($query)
		{
		$counts = $query->row()->counts;
		$data = array(
		'counts'=>$counts + 1);
		$this->db->update('TagStatistics',$data,array('usedBy'=>$house,'tagId'=>$tag));
		}
		else
			{
				$data= array(
				'usedBy'=>$house,
				'tagId'=>$tag,
				'counts'=> 1
				);
				$this->db->insert('TagStatistcs',$data);
				
			}
	}
}
