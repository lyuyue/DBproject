<?php
/**
 * Created by PhpStorm.
 * User: YueLyu
 * Date: 11/5/15
 * Time: 9:54 PM
 */

class Login extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->library('session');
        $this->load->helper(array('form', 'url'));
        $this->load->model('IndividualUser');
    }

    public function index() {
        $data['title'] = 'Welcome!';
        $this->load->view('templates/header',$data);
        $this->load->view('login',$data);
        $this->load->view('templates/footer');
    }

    public function login_err($err_msg) {
        $data['msg'] = $err_msg;
        $this->load->view('login',$data);
    }

    public function login_success($data) {
        $this->session->set_userdata("login",1);
        $this->session->set_userdata('id',$data['id']);
        $this->session->set_userdata("username", $data['username']);
        $this->session->set_userdata("password", $data['password']);
        $this->session->set_userdata('usertype', $data['usertype']);
        $this->session->set_userdata('viewPreference', $data['viewPreference']);
        redirect("/main");
    }

    public function submitLogin() {
        $username = $_POST["username"];
        $password = $_POST["password"];

        if (trim($password) == '' ) {
            $data['msg'] ="Password Needed";
        }

        if (trim($username) == '' ) {
            $data['msg'] = "Username Needed";
        }

        If (isset($data['msg'])) {
            $this->login_err($data['msg']);
        } else {
            $result = $this->IndividualUser->getLoginInformation($username, $password);
            if ($result['status'] == 0) {
                $this->login_err('Username and Password do not match');
            } else {
                $data = array("id" => $result["id"],
                              "username" => $username,
                              "password" => $password,
                              "usertype" => $result['usertype'],
                              "viewPreference" => $result['viewPreference']);
                $this->login_success($data);
            }
        }
    }
}