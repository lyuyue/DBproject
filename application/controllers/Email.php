<?php
class Email extends CI_Controller
{
	public function __construct()
	{
		parent:: __construct();
		$this->load->database();
		$this->load->model('Emailinfo');
		$this->load->library('session');
		$this->load->helper(array('form','url','date'));
	}
	public function index()
	{
		$data['emailInformation']=$this->Emailinfo->getEmailList($_SESSION['id']);
		$data['title']="Email List";
		
		$this->load->view('templates/header', $data);
		$this->load->view('email_index', $data);
		$this->load->view('templates/footer', $data);
	}
	public function view ($id)
	{
		$data['emailDetail']=$this->Emailinfo->getEmailDetail($id);
		$data['title']="Email Detail";
		
		$this->load->view('templates/header', $data);
		$this->load->view('email_information', $data);
		$this->load->view('templates/footer', $data);
	}
	public function create()
	{
		
	$this->load->helper('form');
	$this->load->library('form_validation');
	
	$data['title'] = 'Create a news email';

	
	$this->form_validation->set_rules('sendBy','Email Sender','required|valid_email');
	$this->form_validation->set_rules('sendTo','Email Receiver','required|valid_email');
	$this->form_validation->set_rules('title','Email Title','required');
	$this->form_validation->set_rules('content','Email Content','required');
	
	if ($this->form_validation->run()==FALSE)
	{
		$this->load->view('templates/header', $data);
		$this->load->view('create_email');
		$this->load->view('templates/footer', $data);
		
	}
	else {
		$this->Emailinfor->creatEmail();
		$this->Emailinfor->createReadStatus();
	}
	}
	public function unread()
	{
		$data['emailInformation'] = $this->Emailinfo->unreadEmail($_SESSION['id']);
		$data['title']="Unread Email List";
		
		$this->load->view('templates/header', $data);
		$this->load->view('email_index', $data);
		$this->load->view('templates/footer', $data);
	}
	
}
