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
            $query = $this->db->get_where("IndividualUser", array('id' => $id));
            $viewPreference = $query->row()->viewPreference;
            return array('status' => 1,
                         'id' => $id,
                         'usertype' => $usertype,
                         'viewPreference' => $viewPreference);
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

    public function updateProfile($id, $email, $phone) {
        $this->db->update(
          "IndividualUser",
            array(
              'email' => $email,
                'phone' => $phone
            ),
            array('id' => $id)
        );
    }

    public function getAuthority($usertype) {
        $sql = "select p.privilege from Privilege p join Authority a on p.id = a.authority where a.typeName = $usertype;";
        $query = $this->db->query($sql);
        return $query->result_array();
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
        $data['userType'] = 2;
        $this->db->insert('User',$data);
        $id = $this->db->insert_id();
        $data = array(
            'id' => $id,
            'username' => $username,
            'password' => $password,
            'email' => $email,
            'phone' => $phone,
            'viewPreference' => 0
        );
        $this->db->insert('IndividualUser', $data);
    }

    public function registerCorporate($id='', $corpname='') {
        $data['userType'] = 3;
        $sql = "update User set usertype =3 where id = $id";
        $this->db->query($sql);
        $data = array(
            'id' => $id,
            'corpName' => $corpname,
            'verified' => 0,
            'registeredTime' => date('Y-m-d'),
            'applicationTime' => date('Y-m-d'),
        );
        $this->db->insert('CorporateUser', $data);
    }

    public function unverifiedCorp() {
        $query = $this->db->get_where('CorporateUser',array('verified' => 0));
        $rows = $query->result();
        return json_encode(array('data' => $rows));
    }

    public function verifyCorporateUser($ids) {
        foreach ($ids as $id) {
            $this->db->update('CorporateUser', array('verified' => 1), array('id' => $id));
        }
    }

    public function changeViewMode($id,$value) {
        $this->db->update('IndividualUser', array('viewPreference' => 1-$value), array('id' => $id));
    }

}
