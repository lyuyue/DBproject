<?php
/**
 * Created by PhpStorm.
 * User: YueLyu
 * Date: 11/21/15
 * Time: 11:58 AM
 */
    class Logout extends CI_Controller {

        public function __construct() {
            parent::__construct();
            $this->load->library('session');
            $this->load->helper(array('url'));
        }

        public function index() {
            $this->session->sess_destroy();
            redirect("/main");
        }
    }