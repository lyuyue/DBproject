<?php
/**
 * Created by PhpStorm.
 * User: YueLyu
 * Date: 11/21/15
 * Time: 10:35 AM
 */
    class UserRating extends CI_Controller {

        public function __construct() {
            parent::__construct();
            $this->load->database();
            $this->load->library('session');
            $this->load->helper(array('form','url'));
            $this->load->model('RatingInfo');
        }

        # rate user $userid
        public function rateUser($userid, $msg='') {
            $data['userid'] = $userid;
            $data['title'] = 'Rate user';
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
          if ($this->UserRating->existUserRating($_SESSION['id'],$userid)) {
              $this->rateUser("Rating for this user exists.");
          }
          else {
          $data['id'] = $userid;
          $data['rateUser'] = $this->IndividualUser->submitRateUser($_SESSION['id'],$userid);
          $data['title'] = "User Information";
          $data['msg'] = 'Submit rating successfully.';

          $this->load->view('templates/header', $data);
          $this->load->view('submit_rate_user', $data);
          $this->load->view('templates/footer');
          }
        }
      }
