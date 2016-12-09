<?php

	class reg_user extends CI_Controller {

		function __construct() {
			parent::__construct();
			$this->load->model('reg_model');
			$this->load->library('form_validation');
			$this->load->helper('url','form');
			$this->load->library('session'); 
			//$this->load->library('email');
		}
		function index() {
			

               //kothai dekhabe error ta
          //$this->form_validation->set_error_delimiters('<div class="error">', '</div>');

          //Validating UserName Field
          $this->form_validation->set_rules('reg_username', 'Username', 'required|min_length[4]|max_length[15]');
          $this->form_validation->set_rules('reg_password', 'Password ', 'required|min_length[8]|max_length[15]');  //password validate korbe
          $this->form_validation->set_rules('reg_firstname', 'Firstname', 'required|min_length[4]|max_length[15]'); //fname and lastname validate korbe
          $this->form_validation->set_rules('reg_lastname', 'Lastname', 'required|min_length[4]|max_length[15]'); //fname and lastname validate korbe
          $this->form_validation->set_rules('reg_email', 'Email', 'required|valid_email');

          //Validating Mobile no. Field
          $this->form_validation->set_rules('reg_phn_number', 'Mobile No.', 'required|regex_match[/^[0-9]{11}$/]'); //0 theke 9 er moddhe naki, 11ta naki check kortese

          //Validating Address Field
          $this->form_validation->set_rules('reg_address', 'Address', 'required|min_length[10]|max_length[50]');

         /* if ($this->input->post('reg_username') == '')
               {
                     log_message('error', 'Khali string');
                    }
               else{
                    //$msg= validation_errors();
                    log_message('error', $this->input->post('reg_username'));
                    log_message('error', $this->input->post('reg_password'));
               }
*/

         if ($this->form_validation->run() == FALSE) {
               log_message('error', $this->input->post('reg_username'));
               log_message('error',"Form Validation False"); 
              
               $this->load->view("registration_view");           
          }
               
           
          else {
          //Setting values for tabel columns
               
			$now = new DateTime();
			$now->setTimezone(new DateTimeZone('Asia/Dhaka'));
			$date= $now->format('Y-m-d');  
			$hash = md5(rand(0, 1000));
			$firstname = $this->input->post('reg_firstname');
			$user_email = $this->input->post("reg_email");
			$user_password = $this->input->post('reg_password');
			
			$data = array(
			  'userName' => $this->input->post('reg_username'),
			  'password' => md5($this->input->post('reg_password')),
			  'firstName' => $firstname,
			  'lastName' => $this->input->post('reg_lastname'),
			  'eMail' => $user_email,
			  'contactNo' =>  $this->input->post("reg_phn_number"),
			  'memberSince'=> $date,
			  'hash' => $hash,
			  'isActiveAccount' => '0',
			  'userType' => 'member'
			);
				   //Transfering data to Model ; insert kortese DB te
			$this->reg_model->insert_user_info($data);
			$data['message'] = $this->input->post('reg_username');

			  //Loading View
			//log_message('error', $data['message']);
			$this->send_confirmation($hash,$user_email, $firstname, $user_password);
			$this->load->view('login_view', $data);
			  //echo "success";
        }
    }
	function send_confirmation($hash,$user_email, $firstname, $user_password){
		
		/*$config['protocol']    = 'smtp';
	
		//$config['smtp_crypto'] = 'ssl';
            $config['smtp_host']    = 'ssl://smtp.gmail.com';

            $config['smtp_port']    = '465';

            $config['smtp_timeout'] = '7';

            $config['smtp_user']    = 'risenboy24@gmail.com';

            $config['smtp_pass']    = 'priankailoveyou';

            $config['charset']    = 'utf-8';

            $config['newline']    = "\r\n";
			
			//$config['crlf']    = "\r\n";
			
			$config['wordwrap'] = TRUE;

            $config['mailtype'] = 'text'; // or html

            $config['validation'] = TRUE; // bool whether to validate email or not      

            $this->email->initialize($config);*/
		$config = Array(
			'protocol' => 'smtp',
			'smtp_host' => 'tls://smtp.gmail.com',
			'smtp_port' => 587,
			'smtp_user' => 'risenboy24@gmail.com',
			'smtp_pass' => '*******' ,	
			'mailtype'  => 'html', 
			'charset'   => 'iso-8859-1'
		);
		$this->load->library('email', $config);
		$this->email->set_newline("\r\n");	
		$this->email->from('risenboy24@gmail.com', 'BookRialto.com');
		$subject = "Welcome to BookRialto.";
		$message = 'Thanks for signing up, '. $firstname . '! 
		Your account has been created.
		Here is the login details.
		---------------------------------------
		Email: ' . $user_email . '
		Password: ' . $user_password . '
		---------------------------------------
		Please click this link to activate your account: 
		' . site_url('reg_user/verify/'. $hash);
		
		$this->email->to($user_email);
		$this->email->subject($subject);
		$this->email->message($message);
		//$this->email->send();
		if (!$this->email->send()) {
            // Raise error message
            show_error($this->email->print_debugger());
        } else {
            // Show success notification or other things here
            echo 'Success to send email';
        }
	}
	
	function verify($hash){
		$this->user_model->user_activation($hash);
		$this->load->view("login_view");
	}
}

?>

