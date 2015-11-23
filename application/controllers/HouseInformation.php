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
        $this->load->helper(array('form','url'));
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

    # delete post $id
    public function deletePost($id) {
      $data['id'] = $id;
      $data['houseInformation_item'] = $this->Houseinfo->getHouseInformation($id);
      $this->session->set_userdata('houseId', $data['id']);

      $this->load->view('templates/header', $data);
      $this->load->view('delete_post', $data);
      $this->load->view('templates/footer');
    }

    # submit delete post $id, set deleteStatus = 1.
    public function submitDeletePost() {
        $this->Houseinfo->deletePost($_SESSION['id']);
        $this->session->unset_userdata('houseId');

        $data['title'] = 'Delete Post';
        $data['msg'] = "Delete a post.";

        $this->load->view('templates/header',$data);
        $this->load->view('delete_post',$data);
        $this->load->view('templates/footer');
    }
}
