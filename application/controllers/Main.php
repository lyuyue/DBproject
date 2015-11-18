<?php
/**
 * Created by PhpStorm.
 * User: YueLyu
 * Date: 11/18/15
 * Time: 2:22 PM
 */

class Main extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->library('session');
        $this->load->helper(array('form', 'url'));
    }

    public function index() {
        $data['title'] = 'Welcome!';
        $this->load->view('templates/header',$data);
        $this->load->view('main');
        $this->load->view('templates/footer');
    }

}