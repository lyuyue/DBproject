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
      return $this->db->insert('UserRating', $data);
    }

    # check whether the rating $relatedTo by $postedBy exists
    public function existUserRating($postedBy,$relatedTo) {
        $query = $this->db->get_where("UserRating", array("postedBy" => $postedBy,"relatedTo" => $relatedTo));
        return $query->num_rows();
    }
  }
