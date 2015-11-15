<?php
/**
 * Created by PhpStorm.
 * User: YueLyu
 * Date: 11/14/15
 * Time: 9:45 PM
 */

class HouseInformation extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('HouseInformation_model');
        $this->load->helper('url_helper');
    }

    public function index() {
        $data['houseInformation'] = $this->HouseInformation_model->get_houseInformation();
    }

    public function view($id) {
        $data['id'] = $id;
        $data['houseInformation_item'] = $this->HouseInformation_model->get_houseInformation($id);
        $data['title'] = "House Information";

        $this->load->view('house_information', $data);
    }
}