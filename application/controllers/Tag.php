<?php
class Tag extends CI_Controller
{
	public function __construct()
	{
		parent:: __construct();
		$this->load->model('Taginfo');
		$this->load->library('session','form_validation');
        $this->load->helper(array('form','url','date'));
		$this->load->helper('form');
		$this->load->library('form_validation');
	
	}
	public function index()
	{
		$data['tag'] =$this->Taginfo->getTagInformation();
		$data['title'] = 'Tag archive';		
	}
	public function create()
	{
	
	$data['title'] = 'Create a new tag';

	
	$this->form_validation->set_rules('description','Tag Name','required');
	
	if ($this->form_validation->run()==FALSE)
	{
		$this->load->view('templates/header', $data);
		$this->load->view('create_tag');
		$this->load->view('templates/footer', $data);
		
	}
	else {
		$check = $this->Taginfo->check($this->input->post('description'));
		if($check)
		{
		    echo "Tag already exsits.Create another tag"; 
			$this->load->view('templates/header', $data);
			$this->load->view('create_tag');
			$this->load->view('templates/footer', $data);
		}
		else{
		echo "Tag create succesfully~!0_o~~";
		$this->Taginfo->creatTag();
		}
	}
	}
	public function addTag($house)
	{
		$data['user']=$_SESSION['id'];
		$data['house']=$house;
		$data['title']="Add Tag";
		$data['tag']=$this->Taginfo->getTagInformation();
		$selection = $this->input->post('selection');
		
		if($selection)
		{
			echo "Succesfully added tag to the house :)";
			$this->Taginfo->addTag($house,$selection);
			redirect('HouseInformation/view/1');
		}
		else
		{
		echo "Please select a tag to add :( ~~~";		
		$this->load->view('templates/header',$data);
		$this->load->view('add_tag',$data);
		$this->load->view('templates/footer',$data);
		}
		
	}
	}
