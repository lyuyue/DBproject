<?php
/**
 * Created by PhpStorm.
 * User: YueLyu
 * Date: 11/5/15
 * Time: 9:32 PM
 */

class Home extends CI_Controller {

    public function index()
    {
       $this->load->view("homepage");
    }

}