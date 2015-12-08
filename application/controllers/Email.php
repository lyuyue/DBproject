<?php
class Email extends CI_Controller
{
	public function __construct()
	{
		parent:: __construct();
		$this->load->database();
		$this->load->model('Emailinfo');
		$this->load->library(array('session','form_validation'));
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
	public function view ($id,$user)
	{
		$this->Emailinfo->update_status($id,$_SESSION['id']);
		$data['emailDetail']=$this->Emailinfo->getEmailDetail($id,$user);
		$data['title']="Email Detail";
		
		$this->load->view('templates/header', $data);
		$this->load->view('email_information', $data);
		$this->load->view('templates/footer', $data);
	}
	public function create()
	{
	$this->load->library('form_validation');
	$this->load->helper('form');
	$data['title'] = 'Create a news email';
	
	
	$this->form_validation->set_rules('sendTo','Email Receiver','callback_receiver_check');
	$this->form_validation->set_rules('title','Email Title','required');
	$this->form_validation->set_rules('content','Email Content','required');
	
	if ($this->form_validation->run()==FALSE)
	{				
		$this->load->view('templates/header', $data);
		$this->load->view('create_email', $_SESSION['id']);
		$this->load->view('templates/footer', $data);
		
	}
	else {
		$name = $this->input->post('sendTo');
		$query = $this->db->get_where('IndividualUser', array('username' => $name));
		$result = $query->row();
		$id = $result->id;
		$this->Emailinfo->createEmail($_SESSION['id'],$id);
		redirect('Email/');
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
	public function receiver_check($name)
	{
		$receiver = $this->Emailinfo->receiver($name);
		if($receiver > 0)
		{
			return TRUE;
		}
		else{
				return FALSE;
			}
	}

	public function sendNotification() {
		$data['title'] = "Send Notification";
		$this->load->view('templates/header', $data);
		$this->load->view('send_notification');
		$this->load->view('templates/footer');
	}

	public function notificationSubmit() {
		$title = $_POST['title'];
		$content = $_POST['content'];


		$this->Emailinfo->addNotification($title, $content);

		redirect('/email');
	}
}
