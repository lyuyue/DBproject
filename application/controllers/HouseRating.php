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
        $this->load->database();
        $this->load->model('Houseinfo','RatingInfo');
        $this->load->library('session','form_validation');
        #$this->load->helper(array('form','url','date'));
    }

    # rate post $id
    public function housRating($id, $msg='') {
      $data['id'] = $id;
      $data['ratePost'] = $this->Houseinfo->getHouseInformation($id);
      $data['title'] = "House Information";

      if(isset($msg))
      { $data['msg'] = $msg;
      }

      $this->load->view('templates/header', $data);
      $this->load->view('rate_house', $data);
      $this->load->view('templates/footer');
    }

    # submit rate post $id
    # need to check validation
    public function submitHousRating($id) {
      if ($this->RatingInfo->existHouseRating($_SESSION['id'],$id)) {
          $this->housRating("Rating for this post exists.");
      }
      else {
      $data['id'] = $id;
      $data['ratePost'] = $this->RatingInfo->submitRateHouse($_SESSION['id'],$id);
      $data['title'] = "House Information";
      $data['msg'] = 'Submit rating successfully.';

      $this->load->view('templates/header', $data);
      $this->load->view('submit_rate_house', $data);
      $this->load->view('templates/footer');
      }
    }
  }
