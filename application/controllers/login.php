<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class login extends CI_Controller
{

     public function __construct()
     {
          parent::__construct();
          $this->load->library('session');
          $this->load->helper('form');
          $this->load->helper('url');
          $this->load->helper('html');
          $this->load->database();
          $this->load->library('form_validation');
          //load the login model
          $this->load->model('login_model');
          $this->load->model('reg_model');
     }
	 
	 
	 public function reg ()
	 {
		 $this->load->view("test");

	 }

      public function logout(){
          $this->session->unset_userdata('loginuser');
          $this->session->unset_userdata('userID');
          $this->session->sess_destroy();
          redirect("login/index");
      }

      

     public function index()
     {
          //get the posted values
          $username = $this->input->post("txt_username");
          $password = $this->input->post("txt_password");

          //set validations
          $this->form_validation->set_rules("txt_username", "Username", "trim|required");
          $this->form_validation->set_rules("txt_password", "Password", "trim|required");

          if ($this->form_validation->run() == FALSE)
          {
               //validation fails
			   //$this->load->view('header_view');
               //$this->load->view('login_body_view');
			   $this->load->view('login_view');
          }
          else
          {
               //jdi valid hoi
               if ($this->input->post('btn_login') == "Login")
               {
                    //check if username and password is correct
                    $usr_result = $this->login_model->get_user($username, $password);
                    if ($usr_result) //active user record is present
                    {
                         //session e data rakhtc
                         $block_or_not = $this->login_model->check_block_or_not($usr_result->userID);
						 if($block_or_not){
							if($username == 'adminone' && $password == 'adminone'){
								$sessiondata = array(
								  'loginuser' => TRUE,
								  'userID' => $usr_result->userID
								);
								$this->session->set_userdata($sessiondata);
								redirect("admin/index");
							}
							else{
								$sessiondata = array(
								  'loginuser' => TRUE,
								  'userID' => $usr_result->userID
								);
								$this->session->set_userdata($sessiondata);
								redirect("user_dash/index");
							}
						 }
						 else{
							$this->session->set_flashdata('msg', '<div class="alert alert-danger text-center">You are currently block for 48 hours. Because of many reports against you.</div>');
							redirect("login/index");
						 }
                    }
                    else
                    {
                         $this->session->set_flashdata('msg', '<div class="alert alert-danger text-center">Invalid username and password!</div>');
                         redirect("login/index");
                        // $this->load->view('login_view');
                    }
               }
               else
               {
                    redirect('login/index');
                    //$this->load->view('login_view');
               }
          }
     }
}?>