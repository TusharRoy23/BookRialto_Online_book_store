<?php

	class home extends CI_Controller {

		function __construct() {
			parent:: __construct();
			$this->load->library('session');
			$this->load->helper('url','form');
    }
	
	function index() {
		$data['id'] = "null"; 
      $this->load->view("home_view", $data);
  }
  function about_us(){
		$data['id'] = "null";
		$this->load->view("aboutus_view", $data);
  }
}
?>

