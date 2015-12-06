<?php
/**
 * Created by PhpStorm.
 * User: YueLyu
 * Date: 11/21/15
 * Time: 3:22 PM
 */

    class ReviewInfo extends CI_Model {

        public function __construct() {
            parent::__construct();
            $this->load->database();

        }

        public function getMyReviews($id) {
            if (! isset($id)) {$id = $_GET['id'];}
            $query = $this->db->get_where('Review',array("postedBy" => $id));
            $rows = $query->result();
            return json_encode(array("data" => $rows));
            //return $this->db->last_query();
        }
		public function getMyreview($id,$house)
		{
			$sql = "select Review.description from Review where postedBy = ? AND belongsTo = ? ";
			return $this->db->query($sql, array($id,$house));
		}
		public function getHouseReview($id,$house)
		{
<<<<<<< HEAD
			$sql ="select r.*, i.username from Review r, IndividualUser i where r.belongTo = ? and r.postBy = i.id";
			$query = $this->db->query($sql,$id);
=======
			$query = $this->db->get_where('Review',array("belongsTo"=>$house));
>>>>>>> 59e3c2893e722f5377849de796a6052273c4dd87
			return $query->result_array();
		}
		public function createReview($id,$house)
		{
			$data = array(
			'postedBy' => $id,
			'belongsTo' => $house,
			'description'=> $this->input->post('description')
			);

			$this->db->insert('Review', $data);
		}
		public function editReview($id, $house){
			$data = array(
			'postedBy' => $id,
			'belongsTo' => $house,
			'description'=> $this->input->post('description')
			);

			$this->db->replace('Review', $data);
		}
		public function deleteReview($id,$house)
		{
			$this->db->delete('Review',array('postedBy'=>$id,'belongsTo'=>$house));
		}

    }
