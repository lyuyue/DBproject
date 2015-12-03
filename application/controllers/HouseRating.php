<?php
/**
 * Created by PhpStorm.
 * User: YueLyu
 * Date: 11/14/15
 * Time: 9:45 PM
 */

class HouseRating extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->library('form_validation');
        $this->load->model(array('Houseinfo','RatingInfo'));
        #$this->load->helper(array('form','url','date'));
    }

    # rate post $id
    public function houseRating($id, $msg='') {
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
    public function submitHouseRating($id) {
      if ($this->RatingInfo->existHouseRating($_SESSION['id'],$id)) {
          $this->houseRating("Rating for this post exists.");
      }
      else {
      $data['id'] = $id;
      $this->RatingInfo->submitRateHouse($_SESSION['id'],$id);
      $data['msg'] = 'Submit rating successfully.';

      $this->view($id,$msg,0);
      }
    }
  }
