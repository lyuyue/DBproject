<?php
/**
 * Created by PhpStorm.
 * User: YueLyu
 * Date: 11/14/15
 * Time: 9:45 PM
 */

class HouseInformation extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->model(array('Houseinfo','RatingInfo'));
        $this->load->library(array('session','form_validation'));
        $this->load->helper(array('form','url','date'));
    }

    public function index() {
        $data['houseInformation'] = $this->Houseinfo->getHouseInformation();
    }

    public function view($id,$msg='',$update_view_times=1) {
        if($update_view_times === 1){
          $this->Houseinfo->addViewTimes($id);
        }
        $data['id'] = $id;
        $data['houseInformation_item'] = $this->Houseinfo->getHouseInformation($id);
        $data['title'] = "House Information";
        $data['msg'] = $msg;

        $data['tagStatistics'] = $this->Houseinfo->getTagStatistics($id);
        $data['sellerInformation'] = $this->Houseinfo->getSellerInformation($id);
        $data['corpInformation'] = $this->Houseinfo->getCorpInformation($id);

        $this->load->view('templates/header', $data);
        $this->load->view('house_information', $data);
        $this->load->view('templates/footer');
    }

    public function viewMyPosts() {
        $data['title'] = 'My Posts';
        $this->load->view('templates/header',$data);
        $this->load->view('my_posts',$data);
        $this->load->view('templates/footer');
    }

    public function myPosts() {
        $id = $_SESSION['id'];
        echo $this->Houseinfo->getMyPosts($id);
    }

    # post a new House
    public function newPost($msg='') {
      $data['title'] = "House Information";
      $data['msg'] = $msg;

      $this->load->view('templates/header', $data);
      $this->load->view('new_post', $data);
      $this->load->view('templates/footer');
    }

    # submit a new post
    public function submitNewPost() {
        $this->form_validation->set_rules('buildYear', 'BuildYear', 'required|exact_length[10]');
        $this->form_validation->set_rules('location', 'Location', 'required');
        $this->form_validation->set_rules('brNumber', 'BrNumber', 'required|integer');
        $this->form_validation->set_rules('price', 'Price', 'required|greater_than[0]');
        $this->form_validation->set_rules('description', 'Description', 'required');
        $this->form_validation->set_rules('typeName', 'TypeName', 'required|in_list[1,2]');

        if ($this->form_validation->run() == FALSE)
          { $this->newPost('Error in input data. Input again.');
          }
          else
          { $id=$this->Houseinfo->newPost($_SESSION['id']);
            $msg = "New a post successfully.";
            $this->uploadImage($id,$msg);
          }
    }

    # upload image for post $id
    public function uploadImage($id,$msg=''){
      $config['upload_path']      = './images/';
      $config['allowed_types']    = 'jpg|png';
      $this->load->library('upload', $config);

      if ( ! $this->upload->do_upload('userfile'))
      { $data['error'] = array('error' => $this->upload->display_errors());
        $data['id'] = $id;
        $this->load->view('upload_image', $data);
      }
      else
      { $data = array('upload_data' => $this->upload->data());
        $this->Houseinfo->updateImage($id,$data['upload_data']['file_name']);
        $update_view_times = 0;
        $this->view($id,$msg,$update_view_times);
      }
    }

    # delete post $id
    public function deletePost($id) {
      $data['id'] = $id;

      $this->load->view('templates/header', $data);
      $this->load->view('delete_post', $data);
      $this->load->view('templates/footer');
    }

    # submit delete post $id, set deleteStatus = 1.
    public function submitDeletePost($id) {
        $data['houseInformation_item']=$this->Houseinfo->deletePost($id);
        $msg = "Post has been deleted.";

        $this->view($id,$msg,0);
    }

    # set post $id as pin
    # need to check whether user is admin, need to check the row num of results
    public function setPin($id) {
      $data['id'] = $id;
      $data['pinPost'] = $this->Houseinfo->setPin($id);
      $data['title'] = "Pin Posts";

      $this->load->view('templates/header', $data);
      $this->load->view('main', $data);
      $this->load->view('templates/footer');
    }

    public function unverifiedPost() {
    echo $this->Houseinfo->unverifiedPost();
    }

    public function verifyAllPost() {
    $this->load->view('templates/header');
    $this->load->view('post_verification');
    $this->load->view('templates/footer');
    }

    # verify post $id
    # need to check whether user is admin
    public function verifyPost() {
        $list = explode(',', $_POST['data']);
        $this->Houseinfo->verifyPost($list);
    }

    # update post $id
    public function editPost($id,$msg='') {
      $data['id'] = $id;
      $data['title'] = "House Information";
      $data['post'] = $this->Houseinfo->getHouseInformation($id);
      $data['msg'] = $msg;

      $this->load->view('templates/header', $data);
      $this->load->view('edit_post', $data);
      $this->load->view('templates/footer');
    }

    # submit a update of post $id
    public function submitEditPost($id) {
        $this->form_validation->set_rules('buildYear', 'BuildYear', 'required|exact_length[10]');
        $this->form_validation->set_rules('location', 'Location', 'required');
        $this->form_validation->set_rules('brNumber', 'BrNumber', 'required|integer');
        $this->form_validation->set_rules('price', 'Price', 'required|greater_than[0]');
        $this->form_validation->set_rules('description', 'Description', 'required');
        $this->form_validation->set_rules('typeName', 'TypeName', 'required|in_list[1,2]');

        if ($this->form_validation->run() == FALSE)
          { $this->editPost($id,'Error in input data. Input again.');
          }
          else
          { $this->Houseinfo->editPost($id);
            $msg = "Update post successfully.";
            $this->uploadImage($id,$msg);
          }
    }

    public function houseRating($id, $msg='') {
      $data['id'] = $id;
      $data['ratePost'] = $this->Houseinfo->getHouseInformation($id);

      if(isset($msg))
      { $data['msg'] = $msg;
      }

      $this->load->view('templates/header', $data);
      $this->load->view('rate_house', $data);
      $this->load->view('templates/footer');
    }

    # submit rate post $id
    # need to check validation
    public function submitHouseRating($id) {
      $this->form_validation->set_rules('rating', 'Rating', 'required|in_list[1,2,3,4,5]');
      if ($this->form_validation->run() == FALSE){
          $this->houseRating($id,'Error in input data. Input again.');
      }
      else{
        if ($this->RatingInfo->existHouseRating($_SESSION['id'],$id)) {
            $this->houseRating($id,"Rating for this post exists.");
        }
        else {
        $data['id'] = $id;
        $this->RatingInfo->submitRateHouse($_SESSION['id'],$id);
        $msg = 'Submit rating successfully.';

        $this->view($id,$msg,0);
        }
      }
    }

}
