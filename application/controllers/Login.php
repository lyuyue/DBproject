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
        $this->load->model('IndividualUser_model');
    }

    public function index() {
        $data['title'] = 'Welcome!';
        $this->load->view('templates/header',$data);
        $this->load->view('login');
        $this->load->view('templates/footer');
    }

    public function login_err($err_msg) {
        $data['msg'] = $err_msg;
        $this->load->view('login',$data);
    }

    public function login_success($data) {
        $this->session->set_userdata("login",1);
        $this->session->set_userdata("username", $data['username']);
        $this->session->set_userdata('usertype', $data['usertype']);
        $data['title'] = 'test';
        $this->load->view('templates/header',$data);
        $this->load->view('test');
        $this->load->view('templates/footer');
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
            $result = $this->IndividualUser_model->get_loginInformation($username, $password);
            if ($result['status'] == 0) {
                $this->login_err('Username and Password do not match');
            } else {
                $data = array("username" => $username, "usertype" => $result['usertype']);
                $this->login_success($data);
            }
        }
    }
}