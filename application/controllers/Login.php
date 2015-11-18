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
    }

    public function index() {
        $data['title'] = 'Welcome!';
        $this->load->view('templates/header',$data);
        $this->load->view('login');
        $this->load->view('templates/footer');
    }

    public function login_err() {
        if (isset($_GET['msg'])) {
            $data['msg'] = $_GET['msg'];
            $this->load->view('home',$data);
        }
    }

    public function login_sucess($data) {
        $this->session->set_userdata("login",1);
        $this->session->set_userdata("username", $data['username']);
        $this->session->set_userdata('usertype', $data['usertype']);
    }

    public function submitLogin() {
        $username = $_POST["username"];
        $password = $_POST["password"];

        if (trim($username) == '' ) {
            $redirectUrl = "login/login_err?msg=".urlencode("Username Needed");
            redirect($redirectUrl);
        }

        if (trim($password) == '' ) {
            $redirectUrl = "login/login_err?msg=".urlencode('Password Needed');
            redirect($redirectUrl);
        }

        $result = $this->IndividualUser_model->get_loginInformation($username, $password);
        if ($result['status'] == 0) {
            $redirectUrl = "login/login_err?msg=".urlencode("Username and Password do not match");
            redirect($redirectUrl);
        } else {
            $data = array("username" => $username, "usertype" => $result['usertype']);
            redirect('login/login_success', $data);
        }
    }
}