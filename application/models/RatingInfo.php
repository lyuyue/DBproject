<?php
/**
 * Created by PhpStorm.
 * User: YueLyu
 * Date: 11/18/15
 * Time: 1:22 PM
 */

class RatingInfo extends CI_Model {

    public function __construct() {
        $this->load->database();
    }

    # submit a new rating to user $relatedTo
    public function submitRateUser($postedBy,$relatedTo) {
      $data = array(
        'relatedTo' => $relatedTo,
        'postedBy' => $postedBy,
        'rating' => $this->input->post('rating')
      );
      $this->db->insert('UserRating', $data);
      return $this->RatingInfo->updateUserRating($relatedTo);
    }

    public function updateUserRating($id) {
      $this->db->select('AVG(rating) as rating')
              ->from('UserRating')
              ->where('relatedTo', $id);
      $rating = $this->db->get()->row()->rating;

      $data = array('averageRating' => $rating);
      $this->db->where('id',$id);
      return $this->db->update('IndividualUser', $data);
    }

    # check whether the rating $relatedTo by $postedBy exists
    public function existUserRating($postedBy,$relatedTo) {
        $query = $this->db->get_where("UserRating", array("postedBy" => $postedBy,"relatedTo" => $relatedTo));
        return $query->num_rows();
    }

    public function submitRateHouse($postedBy,$relatedTo) {
      $data = array(
        'relatedTo' => $relatedTo,
        'postedBy' => $postedBy,
        'rating' => $this->input->post('rating')
      );
      $this->db->insert('HouseRating', $data);

      return $this->RatingInfo->updateHouseRating($relatedTo);
    }

    public function updateHouseRating($id) {
      $this->db->select('AVG(rating) as rating')
              ->from('HouseRating')
              ->where('relatedTo', $id);
      $rating = $this->db->get()->row()->rating;

      $data = array('averageRating' => $rating);
      $this->db->where('id',$id);
      return $this->db->update('HouseInformation', $data);
    }

    # check whether the rating $relatedTo by $postedBy exists
    public function existHouseRating($postedBy,$relatedTo) {
        $query = $this->db->get_where("HouseRating", array("postedBy" => $postedBy,"relatedTo" => $relatedTo));
        return $query->num_rows();
    }
  }
