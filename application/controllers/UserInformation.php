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
            $this->load->model(array('IndividualUser','RatingInfo'));
            $this->load->library('form_validation');
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

        public function registerIndividual($msg='') {
            $data['title'] = "New Individual User";
            if (isset($msg)) {
                $data['msg'] = $msg;
            }
            if (isset($_SESSION)) {
                $this->session->sess_destroy();
            }
            $this->load->view('templates/header', $data);
            $this->load->view('new_individual', $data);
            $this->load->view('templates/footer');
        }

        public function registerIndividualSubmit() {
            $username = $_POST['username'];
            $password = $_POST['pwd'];
            $email = $_POST['email'];
            $phone = $_POST['phone'];

            if ($this->IndividualUser->notUniqueUsername($username)) {
                $this->registerIndividual("Username has been registered.");
            } else {
                $this->IndividualUser->registerIndividual($username, $password, $email, $phone);
                $data['title'] = "Login";
                $data['msg'] = "Successfully registered, please Login.";
                $this->load->view('templates/header', $data);
                $this->load->view('login', $data);
                $this->load->view('templates/footer');
            }
        }

        public function registerCorporate($msg='') {
            $data['title'] = 'New Corporate User';
            if (isset($msg)) {
                $data['msg'] = $msg;
            }

            $this->load->view('templates/header', $data);
            $this->load->view('new_corporate', $data);
            $this->load->view('templates/footer');
        }

        public function registerCorporateSubmit() {
            $corpname = $_POST['corpname'];
            $id = $_SESSION['id'];

            $this->session->sess_destroy();

            $this->IndividualUser->registerCorporate($id, $corpname);
            $data['title'] = "Login";
            $data['msg'] = "Successfully registered, please Login.";
            $this->load->view('templates/header', $data);
            $this->load->view('login', $data);
            $this->load->view('templates/footer');

        }

        public function viewUnverifiedCorp() {
            $data['title'] = 'Unverified Corp User';

            $this->load->view('templates/header', $data);
            $this->load->view('corp_verification');
            $this->load->view('templates/footer');
        }

        public function unverifiedCorp() {
            echo $this->IndividualUser->unverifiedCorp();
        }

        public function verifyCorporateUser() {
            $list = explode(',', $_POST['data']);
            $this->IndividualUser->verifyCorporateUser($list);
        }

        # rate user $userid
        public function rateUser($userid, $msg='') {
            $data['userid'] = $userid;
            $data['title'] = 'Rate user';
            $data['UserInformation'] = $this->IndividualUser->getProfile($userid);

            if(isset($msg))
            { $data['msg'] = $msg;
            }

            $this->load->view('templates/header',$data);
            $this->load->view('rate_user',$data);
            $this->load->view('templates/footer');
        }

        # submit rate user $userid
        # need to check validation
        public function submitRateUser($userid) {
          $this->form_validation->set_rules('rating', 'Rating', 'required|in_list[1,2,3,4,5]');
          if ($this->form_validation->run() == FALSE){
              $this->rateUser($userid,'Error in input data. Input again.');
          }
          else{
            if ($this->RatingInfo->existUserRating($_SESSION['id'],$userid)) {
              $this->rateUser($userid,"Rating for this user exists.");
            }
            else {
            $data['id'] = $userid;
            $data['rateUser'] = $this->RatingInfo->submitRateUser($_SESSION['id'],$userid);
            $data['msg'] = 'Submit rating successfully.';

            $this->load->view('templates/header', $data);
            $this->load->view('submit_rate_user', $data);
            $this->load->view('templates/footer');
            }
          }
        }

    }
