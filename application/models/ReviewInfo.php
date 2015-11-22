<?php
/**
 * Created by PhpStorm.
 * User: YueLyu
 * Date: 11/21/15
 * Time: 3:22 PM
 */

    class ReviewInfo extends CI_Model {

        public function __construct() {
            parent::__construct();
            $this->load->database();

        }

        public function getMyReviews($id) {
            if (! isset($id)) {$id = $_GET['id'];}
            $query = $this->db->get_where('Review',array("postedBy" => $id));
            $rows = $query->result();
            return json_encode(array("data" => $rows));
            //return $this->db->last_query();
        }

    }