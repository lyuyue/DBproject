<?php
/**
 * Created by PhpStorm.
 * User: YueLyu
 * Date: 11/14/15
 * Time: 9:13 PM
 */
class Houseinfo_model extends CI_Model {

    public  function __construct() {
        $this->load->database();
    }

    public function get_houseInformation($id = 0) {
        if ($id === 0) {
            $query = $this->db->get('HouseInformation');
            return $query->result->result_array();
        }

        $query = $this->db->get_where('HouseInformation', array('id' => $id));
        return $query->row_array();
    }
}