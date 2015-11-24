<?php
class Tag extends CI_Controller
{
	public function __construct()
	{
		parent:: __construct();
		$this->load->model('Taginfo');
	}
	public function index()
	{
		$data['tag'] =$this->Taginfo->getTagInformation();
		$data['title'] = 'Tag archive';		
	}
	public function create()
	{
	$this->load->helper('form');
	$this->load->library('form_validation');
	
	$data['title'] = 'Create a new tag';

	
	$this->form_validation->set_rules('description','Tag Name','required');
	
	if ($this->form_validation->run()==FALSE)
	{
		$this->load->view('templates/header', $data);
		$this->load->view('create_tag');
		$this->load->view('templates/footer', $data);
		
	}
	else {
		$this->Taginfo->creatTag();
	}
	}
	}
}
