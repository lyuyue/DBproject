<?php
/**
 * Created by PhpStorm.
 * User: YueLyu
 * Date: 11/14/15
 * Time: 9:13 PM
 */
class Houseinfo extends CI_Model {

    public  function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function getHouseInformation($id = 0) 
    {
        if ($id === 0) 
        {
            $query = $this->db->get('HouseInformation');
            return $query->result->result_array();
        }

        $query = $this->db->get_where('HouseInformation', array('id' => $id));
        return $query->row_array();
    }

    public function getMyPosts($id) {
        if (! (isset($id))) {$id = $_GET['id'];}
        $query = $this->db->get_where('HouseInformation',array("postedBy" => $id));
        $rows = $query->result();
        return json_encode(array("data" => $rows));
    }

    # post a new House
    public function newPost($id) {
      date_default_timezone_set('UTC');
      $data = array(
        'largeImage' => $this->input->post('largeImage'),
        'typeName' => $this->input->post('typeName'),
        'buildYear' => $this->input->post('buildYear'),
        'location' => $this->input->post('location'),
        'brNumber' => $this->input->post('brNumber'),
        'price' => $this->input->post('price'),
        'description' => $this->input->post('description'),
        'verified' => 0,
        'postTime' => date("Y/m/d"),
        'deleteStatus' => 0,
        'topPost' => 0,
        'viewTimes' => 0,
        'averageRating' => 0.0,
        'postedBy' => $id
      );
      return $this->db->insert('HouseInformation', $data);
    }

    # delete post $id
    public function deletePost($id) {
      # set deleteStatus to 1
      $data = array('deleteStatus' => 1);
      $this->db->where('id',$id);
      $query = $this->db->update('HouseInformation', $data);

      $query = $this->db->get_where('HouseInformation', array('id' => $id));
      return $query->row_array();
    }

    # get seller's information
    public function getSellerInformation($id) {
    $query = $this->db->get_where('HouseInformation', array('id' => $id));
    $row = $query->row();
    $query = $this->db->get_where('IndividualUser', array('id'=>$row->postedBy));
    return $query->row_array();
    }

    # get average rating of a post
    public function getPostAverageRating($id) {
    $query = $this->db->get_where('HouseInformation', array('id' => $id));
    return $query->row_array();
    }

    # get statistics of a tag
    public function getTagStatistics($id) {
    $query = $this->db->get_where('TagStatistics', array('usedBy' => $id));
    return $query->result_array();
    }

    # get view times of post $id
    public function getViewTimes($id) {
    $query = $this->db->get_where('HouseInformation', array('id' => $id));
    return $query->row_array();
    }

    # submit a new rating to post $relatedTo
    public function submitRatePost($postedBy,$relatedTo) {
      $data = array(
        'relatedTo' => $relatedTo,
        'postedBy' => $postedBy,
        'rating' => $this->input->post('rating')
      );
      return $this->db->insert('HouseRating', $data);
    }

    # set post $id as pin
    public function setPin($id) {
      # set topPost to 1
      # returns all the pin posts
      $data = array('topPost' => 1);
      $this->db->where('id',$id);
      $query = $this->db->update('HouseInformation', $data);

      $query = $this->db->get_where('HouseInformation', array('topPost' => 1));
      return $query->result_array();
    }

    # verify post $id
    public function verifyPost($id) {
      # set verified to 1
      $data = array('verified' => 1);
      $this->db->where('id',$id);
      $query = $this->db->update('HouseInformation', $data);

      $query = $this->db->get_where('HouseInformation', array('id' => $id));
      return $query->row_array();
    }

    # update post $id
    public function updatePost($id) {
      date_default_timezone_set('UTC');
      $data = array(
        'largeImage' => $this->input->post('largeImage'),
        'typeName' => $this->input->post('typeName'),
        'buildYear' => $this->input->post('buildYear'),
        'location' => $this->input->post('location'),
        'brNumber' => $this->input->post('brNumber'),
        'price' => $this->input->post('price'),
        'description' => $this->input->post('description'),
        'updateTime' => date("Y/m/d")
      );
      $this->db->where('id',$id);
      $query = $this->db->update('HouseInformation', $data);

      $query = $this->db->get_where('HouseInformation', array('id' => $id));
      return $query->row_array();
    }

}
