<?php
/**
 * Created by PhpStorm.
 * User: YueLyu
 * Date: 11/21/15
 * Time: 3:18 PM
 */
    class Review extends CI_Controller {

        public function __construct() {
            parent::__construct();
            $this->load->helper(array('form','url'));
            $this->load->database();
            $this->load->library('session');
            $this->load->model('ReviewInfo');
        }

        public function showMyReviews() {
            $this->load->view("templates/header");
            $this->load->view("review");
            $this->load->view("templates/footer");
        }

        public function myReviews() {
            $id = $_SESSION['id'];
            echo $this->ReviewInfo->getMyReviews($id);
        }
    }