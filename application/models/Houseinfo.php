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

    public function getHouseInformation($id = 0) {
        if ($id === 0) {
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
}