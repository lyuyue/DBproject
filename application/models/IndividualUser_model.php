<?php
/**
 * Created by PhpStorm.
 * User: YueLyu
 * Date: 11/18/15
 * Time: 1:22 PM
 */

class IndividualUser_model extends CI_Model {

    public function __construct() {
        $this->load->database();
    }

    public function get_loginInformation($username='', $password='') {
        $query = $this->db->get_where("IndividualUser", array("username" => $username));
        $row = $query->row();
        if ($row->password == $password) {
            $query = $this->db->get_where("User", array("id" => $row->id));
            $usertype = $query->row()->userType;
            return array('status' => 1,
                         'usertype' => $usertype);
        } else {
            return array('status' => 0);
        }
    }
}