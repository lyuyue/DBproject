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
            $query = $this->db->get_where('HouseInformation',array('verified' => 1));
            return json_encode(array("data" => $query->result()));
        }

        $query = $this->db->get_where('HouseInformation', array('id' => $id, 'verified' => 1));
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
        'typeName' => $this->input->post('typeName'),
        'buildYear' => $this->input->post('buildYear'),
        'location' => $this->input->post('location'),
        'brNumber' => $this->input->post('brNumber'),
        'price' => $this->input->post('price'),
        'description' => $this->input->post('description'),
        'verified' => 1,
        'postTime' => date("Y/m/d"),
        'deleteStatus' => 0,
        'topPost' => 0,
        'viewTimes' => 0,
        'averageRating' => 0.0,
        'postedBy' => $id
      );
      $this->db->insert('HouseInformation', $data);
      return $this->db->insert_id();
    }

    # $type: 1- large image, 2- list image
    public function updateImage($id,$image,$type){
      if($type == 1){
      $data = array('largeImage' => $image);
      }
      else{
        $data = array('listImage' => $image);
      }
      $this->db->where('id',$id);
      $query = $this->db->update('HouseInformation', $data);
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

    # get corp's information
    public function getCorpInformation($id) {
    $query = $this->db->get_where('HouseInformation', array('id' => $id));
    $row = $query->row();
    $query = $this->db->get_where('CorporateUser', array('id' => $row->postedBy,'verified' => 1));
    return $query->row_array();
    }

    # get statistics of a tag
    public function getTagStatistics($id) {
    	$sql = "select * from Tag JOIN TagStatistics ON Tag.id=TagStatistics.tagId WHERE TagStatistics.usedBy=?";
		$query = $this->db->query($sql,$id);
		return $query->result_array();
    }

    # add view times of post $id
    public function addViewTimes($id) {
    $query = $this->db->get_where('HouseInformation', array('id' => $id));
    $viewTimes = $query->row()->viewTimes;
    $data = array('viewTimes' => $viewTimes + 1);
    $this->db->where('id',$id);
    return $query = $this->db->update('HouseInformation', $data);
    }

    # get view times of post $id
    public function getViewTimes($id) {
    $query = $this->db->get_where('HouseInformation', array('id' => $id));
    return $query->row_array();
    }

    # set post $id as pin
    public function setPin($id) {
      # set topPost to 1
      # returns all the pin posts
      $data = array('topPost' => 1);
      $this->db->where('id',$id);
      $query = $this->db->update('HouseInformation', $data);
    }

    public function unverifiedPost() {
      $this->db->select('HouseInformation.*, IndividualUser.username');
      $this->db->from('HouseInformation');
      $this->db->join('IndividualUser', 'IndividualUser.id = HouseInformation.postedBy');
      $this->db->where(array('HouseInformation.verified' => 0));

      $query = $this->db->get();
      $rows = $query->result();
      return json_encode(array('data' => $rows));
    }

    public function verifyPost($ids) {
        foreach ($ids as $id) {
            $this->db->update('HouseInformation', array('verified' => 1), array('id' => $id));
        }
    }

    # update post $id
    public function editPost($id) {
      date_default_timezone_set('UTC');
      $data = array(
        'typeName' => $this->input->post('typeName'),
        'buildYear' => $this->input->post('buildYear'),
        'location' => $this->input->post('location'),
        'brNumber' => $this->input->post('brNumber'),
        'price' => $this->input->post('price'),
        'description' => $this->input->post('description'),
        'updateTime' => date("Y/m/d"),
        'verified' => 0
      );
      $this->db->where('id',$id);
      return $query = $this->db->update('HouseInformation', $data);
    }

}
