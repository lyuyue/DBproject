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
        $this->load->model('Houseinfo');
        $this->load->library('session');
        $this->load->helper(array('form','url','date','timezone'));
    }

    public function index() {
        $data['houseInformation'] = $this->Houseinfo->getHouseInformation();
    }

    public function view($id) {
        $data['id'] = $id;
        $data['houseInformation_item'] = $this->Houseinfo->getHouseInformation($id);
        $data['title'] = "House Information";

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
    public function newPost() {
      $data['title'] = "House Information";

      $this->load->view('templates/header', $data);
      $this->load->view('new_post', $data);
      $this->load->view('templates/footer');
    }

    # submit a new post
    public function submitNewPost() {
        $data['title'] = 'New Post';
        $data['houseInformation_item']=$this->Houseinfo->newPost($_SESSION['id']);
        $data['msg'] = "New a post successfully.";

        $this->load->view('templates/header',$data);
        $this->load->view('submit_new_post',$data);
        $this->load->view('templates/footer');
    }

    # delete post $id
    public function deletePost($id) {
      $data['id'] = $id;
      $data['houseInformation_item'] = $this->Houseinfo->getHouseInformation($id);
      $data['title'] = "House Information";

      $this->load->view('templates/header', $data);
      $this->load->view('delete_post', $data);
      $this->load->view('templates/footer');
    }

    # submit delete post $id, set deleteStatus = 1.
    public function submitDeletePost($id) {
        $data['id'] = $id;
        $data['title'] = 'Delete Post';
        $data['houseInformation_item']=$this->Houseinfo->deletePost($id);
        $data['msg'] = "Delete post.";

        $this->load->view('templates/header',$data);
        $this->load->view('delete_post',$data);
        $this->load->view('templates/footer');
    }

    # get information of seller
    public function getSellerInformation($id) {
      $data['id'] = $id;
      $data['sellerInformation'] = $this->Houseinfo->getSellerInformation($id);
      $data['title'] = "Seller's Information";

      $this->load->view('templates/header', $data);
      $this->load->view('get_seller_information', $data);
      $this->load->view('templates/footer');
    }

    # get average rating of a post
    public function getPostAverageRating($id) {
      $data['id'] = $id;
      $data['postAverageRating'] = $this->Houseinfo->getPostAverageRating($id);
      $data['title'] = "Average Rating";

      $this->load->view('templates/header', $data);
      $this->load->view('get_post_average_rating', $data);
      $this->load->view('templates/footer');
    }

    # get statistics of all tags
    public function getTagStatistics($id) {
      $data['id'] = $id;
      $data['tagStatistics'] = $this->Houseinfo->getTagStatistics($id);
      $data['title'] = "Statistics of Tag";

      $this->load->view('templates/header', $data);
      $this->load->view('get_tag_statistics', $data);
      $this->load->view('templates/footer');
    }

    # get view times of post $id
    public function getViewTimes($id) {
      $data['id'] = $id;
      $data['viewTimes'] = $this->Houseinfo->getViewTimes($id);
      $data['title'] = "View Times of Post";

      $this->load->view('templates/header', $data);
      $this->load->view('get_view_times', $data);
      $this->load->view('templates/footer');
    }

    # rate post $id
    public function ratePost($id) {
      $data['id'] = $id;
      $data['ratePost'] = $this->Houseinfo->getHouseInformation($id);
      $data['title'] = "House Information";

      $this->load->view('templates/header', $data);
      $this->load->view('rate_post', $data);
      $this->load->view('templates/footer');
    }

    # submit rate post $id
    # need to check validation
    public function submitRatePost($id) {
      $data['id'] = $id;
      $data['ratePost'] = $this->Houseinfo->submitRatePost($_SESSION['id'],$id);
      $data['title'] = "House Information";
      $data['msg'] = 'Submit rating successfully.';

      $this->load->view('templates/header', $data);
      $this->load->view('submit_rate_post', $data);
      $this->load->view('templates/footer');
    }

    # set post $id as pin
    # need to check whether user is admin, need to check the row num of results
    public function setPin($id) {
      $data['id'] = $id;
      $data['pinPost'] = $this->Houseinfo->setPin($id);
      $data['title'] = "Pin Posts";

      $this->load->view('templates/header', $data);
      $this->load->view('set_pin', $data);
      $this->load->view('templates/footer');
    }

    # verify post $id
    # need to check whether user is admin
    public function verifyPost($id) {
      $data['id'] = $id;
      $data['verifiedPost'] = $this->Houseinfo->verifyPost($id);
      $data['title'] = "Post verification";

      $this->load->view('templates/header', $data);
      $this->load->view('verify_post', $data);
      $this->load->view('templates/footer');
    }

    # update post $id
    public function updatePost($id) {
      $data['id'] = $id;
      $data['title'] = "House Information";
      $data['post'] = $this->Houseinfo->getHouseInformation($id);

      $this->load->view('templates/header', $data);
      $this->load->view('update_post', $data);
      $this->load->view('templates/footer');
    }

    # submit a update of post $id
    public function submitUpdatePost($id) {
        $data['title'] = 'Update Post';
        $data['updatedPost']=$this->Houseinfo->updatePost($id);
        $data['msg'] = "Update a post successfully.";

        $this->load->view('templates/header',$data);
        $this->load->view('submit_update_post',$data);
        $this->load->view('templates/footer');
    }

}
