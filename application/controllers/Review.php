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
			$this->load->model('IndividualUser');
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
			$data['name'] = $this->IndividualUser->getProfile($_SESSION['id']);
	
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
				$data['title'] = "Review already exists~!0_o~~";
				$this->load->view('templates/header', $data);
				$this->load->view('create_review', $data);
				$this->load->view('templates/footer', $data);
				}
				else{
				$this->ReviewInfo->createReview($data['user'], $data['house']);
				redirect('HouseInformation/view'."/".$id);
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
			$data['name'] = $this->IndividualUser->getProfile($_SESSION['id']);
			
	
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
				redirect('HouseInformation/view'."/".$id);
			}
		}
		public function delete($id,$user)
		{
			
			$data['title'] = "Delete Review";
			$data['user'] = $user;
			$data['house'] = $id;
			$query = $this->db->get_where('Review',array('postedBy'=>$user,'belongsTo'=>$id));
			$data['review'] = $query->result_array();
			
			$this->load->view('templates/header', $data);
			$this->load->view('delete_review', $data);
			$this->load->view('templates/footer');
			
		}
		public function submitDelete($id,$user)
		{
			$this->ReviewInfo->deleteReview($user,$id);
			redirect('HouseInformation/view'."/".$id);
		}

}