<?php
	class search_user extends CI_Controller{
		function __construct() {
			parent::__construct();
			$this->load->model('reg_model');
			$this->load->library('form_validation');
			$this->load->helper('url','form');
			$this->load->library('session');
			$this->load->model('book_model');
			$this->load->model('user_model');  
		}
		function searchInternalForAllUser(){
			$userID = $this->session->userdata('userID');
            $strs = $this->input->post("search");
			$results = $this->user_model->return_searchInternalForAllUser($strs);
			if(empty($results)){
				$data['id'] = $userID;
				$data['user'] = $this->user_model->get_user_byid($userID);
				$data['allUsers'] = $this->user_model->return_searchInternalForAllUser($strs);
				$data['search_checks'] = "1";
				$this->load->view("allUser_view",$data);
				//echo json_encode($data);
			}
			else{
				$data['id'] = $userID;
				$data['user'] = $this->user_model->get_user_byid($userID);
				$data['allUsers'] = $this->user_model->return_searchInternalForAllUser($strs);
				$data['search_checks'] = "1";
				$this->load->view("allUser_view",$data);
				//echo json_encode($data);
			}
		}
	}
?>