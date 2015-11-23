<?php
/**
 * Created by PhpStorm.
 * User: YueLyu
 * Date: 11/18/15
 * Time: 1:22 PM
 */

class IndividualUser extends CI_Model {

    public function __construct() {
        $this->load->database();
    }

    public function getLoginInformation($username='', $password='') {
        $query = $this->db->get_where("IndividualUser", array("username" => $username));
        $row = $query->row();
        if ($row->password == $password) {
            $id = $row->id;
            $query = $this->db->get_where("User", array("id" => $row->id));
            $usertype = $query->row()->userType;
            return array('status' => 1,
                         'id' => $id,
                         'usertype' => $usertype);
        } else {
            return array('status' => 0);
        }
    }

    public function getProfile($id) {
        $query = $this->db->get_where('IndividualUser', array('id' => $id));
        $row = $query->row();
        return $result = array(
                    'username' => $row->username,
                    'email' => $row->email,
                    'phone' => $row->phone
                );
    }

    public function resetPassword($id, $new_pwd) {
        $sql = "update IndividualUser set password = '$new_pwd' where id = $id";
        return $this->db->query($sql);
    }

    public function notUniqueUsername($username) {
        $query = $this->db->get_where("IndividualUser", array("username" => $username));
        return $query->num_rows();
    }

    public function registerIndividual($username='', $password='', $email='', $phone='') {
        $sql = "insert into User('userType','username') values(2,$username)";
        $id = $this->db->insert_id($sql);
        $sql = "insert into IndividualUser ('id', 'username', 'password', 'email', 'phone') values($id, '$username', '$password', '$email', '$phone')";
        $this->db->query($sql);
    }
}