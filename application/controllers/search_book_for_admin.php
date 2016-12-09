<?php
	class search_book_for_admin extends CI_Controller{
		function __construct() {
			parent::__construct();
			$this->load->model('reg_model');
			$this->load->library('form_validation');
			$this->load->helper('url','form');
			$this->load->library('session');
			$this->load->model('book_model');
			$this->load->model('user_model');  
		}
		function searchInternalForAllBook(){
			$userID = $this->session->userdata('userID');
			$strs = $this->input->post("search");
			$results = $this->book_model->AllBookSearch($strs);
			if(empty($results)){
				$data['id'] = $userID;
				$data['user'] = $this->user_model->get_user_byid($userID);
				//$data['books'] = $this->book_model->getAllBooks();
				$data['books'] = $this->book_model->AllBookSearch($strs);
				$data['search_checks'] = "1";
				$this->load->view("allBook_view",$data);
			}
			else{
				$data['id'] = $userID;
				$data['user'] = $this->user_model->get_user_byid($userID);
				//$data['books'] = $this->book_model->getAllBooks();
				$data['books'] = $this->book_model->AllBookSearch($strs);
				$data['search_checks'] = "1";
				$this->load->view("allBook_view",$data);
			}
		}
	}
?>