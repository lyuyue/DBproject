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
        $this->load->model('Houseinfo_model');
        $this->load->helper(array('form','url'));
    }

    public function index() {
        $data['houseInformation'] = $this->Houseinfo_model->get_houseInformation();
    }

    public function view($id) {
        $data['id'] = $id;
        $data['houseInformation_item'] = $this->Houseinfo_model->get_houseInformation($id);
        $data['title'] = "House Information";

        $this->load->view('house_information', $data);
    }
}