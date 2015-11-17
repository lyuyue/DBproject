<?php
/**
 * Created by PhpStorm.
 * User: YueLyu
 * Date: 11/5/15
 * Time: 9:54 PM
 */

class Home extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->library('session');
        $this->load->helper(array('form', 'url'));
    }

    public function index() {
        $this->load->view('home');
    }

    public function login() {
        if (isset($_GET['msg'])) {
            $data['msg'] = $_GET['msg'];
            $this->load->view('home',$data);
        }
    }

    public function submitLogin() {
        $username = $_POST["username"];
        $password = $_POST["password"];

        if (trim($username) == '' ) {
            $redirectUrl = "home/login?msg=".urlencode("Username Needed");
        }

        if (trim($password) == '' ) {
            $redirectUrl = "home/login?msg=".urlencode('Password Needed');
        }

        redirect($redirectUrl);

    }
}