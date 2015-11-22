<?php
/**
 * Created by PhpStorm.
 * User: YueLyu
 * Date: 11/21/15
 * Time: 10:35 AM
 */
    class UserInformation extends CI_Controller {

        public function __construct() {
            parent::__construct();
            $this->load->database();
            $this->load->library('session');
            $this->load->helper(array('form','url'));
            $this->load->model('IndividualUser');
        }

        public function viewProfile() {
            if (isset($_SESSION['id'])) {
                $data = $this->IndividualUser->getProfile($_SESSION['id']);
                $data['title'] = 'My Profile';

                $this->load->view('templates/header',$data);
                $this->load->view('user_profile',$data);
                $this->load->view('templates/footer');
            }
        }

        public function resetPassword($msg='') {
            $data['title'] = 'Reset Password';
            if (isset($msg)) {
                $data['msg'] = $msg;
            }
            $this->load->view('templates/header',$data);
            $this->load->view('password_reset',$data);
            $this->load->view('templates/footer');
        }

        public function submitNewPassword() {
            if ($_POST['pwd'] != $_SESSION['password']) {
                $this->resetPassword("Wrong Password");
            } elseif ($_POST['new_pwd'] != $_POST['new_pwd_again']) {
                $this->resetPassword("New Password failed in consistence check");
            } else {
                $this->resetPasswordSuccess($_POST['new_pwd']);
            }
        }

        public function resetPasswordSuccess($new_pwd) {
            $this->IndividualUser->resetPassword($_SESSION['id'],$new_pwd);
            $this->session->set_userdata("password", $new_pwd);
            $this->resetPassword("Password successfully reset");
        }
    }