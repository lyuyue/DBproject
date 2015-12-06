<?php
/**
 * Created by PhpStorm.
 * User: YueLyu
 * Date: 11/21/15
 * Time: 3:18 PM
 */
    class Review extends CI_Controller {

        public function __construct() {
            parent::__construct();
            $this->load->helper(array('form','url'));
            $this->load->database();
            $this->load->library('session');
            $this->load->model('ReviewInfo');
        }

        public function showMyReviews() {
            $this->load->view("templates/header");
            $this->load->view("review");
            $this->load->view("templates/footer");
        }

        public function myReviews() {
            $id = $_SESSION['id'];
            echo $this->ReviewInfo->getMyReviews($id);
        }
		public function create($id){
		
			$this->load->helper('form');
			$this->load->library('form_validation');
	
			$data['title'] = 'Create a news reviews';
			$data['user']=$_SESSION['id'];
			$data['house']=$id;
	
			$this->form_validation->set_rules('description','Review Content','required');
	
			if ($this->form_validation->run()==FALSE)
			{	
				$this->load->view('templates/header', $data);
				$this->load->view('create_review', $data);
				$this->load->view('templates/footer', $data);
		
			}
			else {
				if($this->ReviewInfo->getMyReview($data['user'],$data['house'])->num_rows()>0)
				{
					echo "Review already exists~!0_o~~";
				}
				else{
				echo "Review created succesfully~!! :)";
				$this->ReviewInfo->createReview($data['user'], $data['house']);
			}
			}
		}
		public function edit($id)
		{
			$this->load->helper('form');
			$this->load->library('form_validation');
	
			$data['title'] = 'Create a news reviews';
			$data['user']=$_SESSION['id'];
			$data['house']=$id;
	
			$this->form_validation->set_rules('description','Review Content','required');
	
			if ($this->form_validation->run()==FALSE)
			{
				echo "Must add some content to the description~!! o_0~~";	
				$this->load->view('templates/header', $data);
				$this->load->view('edit_review', $data);
				$this->load->view('templates/footer', $data);
		
			}
			else {
				$this->ReviewInfo->editReview($data['user'], $data['house']);
			}
		}
		public function delete($id)
		{
			$data['title']="Delete Review";
			$data['user']=$_SESSION['id'];
			$data['house']=$id;
			$data['content']=$this->ReviewInfo->getMyReview($data['user'],$data['house']);
			
			if ($this->form_validation->run()==FALSE)
			{	
				$this->load->view('templates/header', $data);
				$this->load->view('delete_review', $data);
				$this->load->view('templates/footer');
			}
			else {
			$this->ReviewInfo->deleteReview($data['user'],$data['house']);
			}
		}
		
    }