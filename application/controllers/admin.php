<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
class admin extends CI_Controller{
	function __construct(){
		parent::__construct();
		$this->load->library('session');
	    $this->load->helper('form');
	    $this->load->helper('url');
	    $this->load->helper('html');
	    $this->load->database();
		$this->load->model('book_model');
	    $this->load->model('user_model');
	}
	function index(){
		if(!$this->session->userdata('userID'))
		{
			$data['error'] = "<div class=alert-danger><center>You must have to login to get access to the site</center></div>";
			$this->load->view("login_view",$data);
		}
		else{
			$username= $this->session->userdata('username');
			$userID = $this->session->userdata('userID');
			$this->load_admin();
		}
	}
	function load_admin(){
		$userID = $this->session->userdata('userID');
		$data['id'] = $userID;
		$data['user']= $this->user_model->get_user_byid($userID);
		$this->load->view('admin_view',$data);
	}
	function load_about_us(){
		$userID = $this->session->userdata('userID');
		$data['id'] = $userID;
		$data['user']= $this->user_model->get_user_byid($userID);
		$this->load->view("aboutus_view",$data);
	}
	function allBooks(){
		$userID = $this->session->userdata('userID');
		$data['id'] = $userID;
		$data['user'] = $this->user_model->get_user_byid($userID);
		$data['books'] = $this->book_model->getAllBooks();
		$data['search_checks'] = "0";
		$this->load->view("allBook_view",$data);
	}
	function allUsers(){
		$userID = $this->session->userdata('userID');
		$data['id'] = $userID;
		$data['user'] = $this->user_model->get_user_byid($userID);
		$data['allUsers'] = $this->user_model->getAllUsers();
		$data['search_checks'] = "0";
		$this->load->view("allUser_view",$data);
	}
	function allReports(){
		$userID = $this->session->userdata('userID');
		$data['id'] = $userID;
		$data['user'] = $this->user_model->get_user_byid($userID);
		$data['reports'] = $this->user_model->getAllReports();
		$this->load->view("allReport_view", $data);
	}
}
?>