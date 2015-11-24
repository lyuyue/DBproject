<?php
class TagStatisticinfo extends CI_Model
{
	public function __construct()
	{
	parent:: __construct();
	$this->load->database();
	}
	public function getTagStaInfo()
	{
		$query = $this->db->get('TagStatistic');
	}
}
