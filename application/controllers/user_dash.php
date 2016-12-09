<?php

	class user_dash extends CI_Controller {

		function __construct(){
			  parent::__construct();
			  $this->load->library('session');
	          $this->load->helper('form');
	          $this->load->helper('url');
	          $this->load->helper('html');
	          $this->load->database();
	          //$this->load->library('form_validation');
	          //load the book model for book table
	          $this->load->model('book_model');
	          //model for the user table
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
				//debuging in log 
				//log_message('error',$username);
				log_message('error',$userID);

				$this->load_dash();
			}
		}
	function add_book(){

		$this->load_addbook();
	}
	function profile_cover_edit(){
		$userID = $this->session->userdata('userID');
		$imgLink= 'profileImg_'.$userID.'_'.rand().'.png';
		
		$config['upload_path'] = './userdp/';
        $config['allowed_types'] = 'jpg|png|jpeg';
        $config['max_size'] = '9184928';
		$config['max_width']  = '5000';
        $config['max_height']  = '5000';
		$config['file_name'] = $imgLink ;
        $this->load->library('upload', $config);
		if (!$this->upload->do_upload('imageLink')){
			// case - failure
					$imgLink = '';
					$data = array(
						  'imageLink' => $imgLink
					);
					 $this->user_model->updateProfileImg(array('userID' => $this->session->userdata('userID')), $data);
					echo json_encode(array("status" => TRUE));
		}
		else{
			$data = array(
						  'imageLink' => $imgLink
					);
					 $this->user_model->updateProfileImg(array('userID' => $this->session->userdata('userID')), $data);
					echo json_encode(array("status" => TRUE));
		}
	}
	function book_cover_edit(){
		$now = new DateTime();
		$now->setTimezone(new DateTimeZone('Asia/Dhaka'));
		$date= $now->format('Y-m-d');
		//$this->do_upload_cover($date);
		$imgLink= 'bookcover_'.$userID.'_'.rand().'.png';
          $userID = $this->session->userdata('userID');

          $config['upload_path'] = './bookcover/';
          $config['allowed_types'] = 'jpg|png|jpeg';
          $config['max_size'] = '9081211';
          $config['max_width']  = '512';
          $config['max_height']  = '512';
		  $config['file_name'] = $imgLink ;
          $this->load->library('upload', $config);
		  if (!$this->upload->do_upload('coverImg'))
               {
            // case - failure
					$imgLink = '';
					$data = array(
						  'coverImg' => $imgLink,
						  'uploadDate'=> $date
					);
					 $this->book_model->update(array('bookID' => $this->input->post('bookID')), $data);
					echo json_encode(array("status" => TRUE));
          }
		  else
        {
            // case - success
			$data = array(
						  'coverImg' => $imgLink,
						  'uploadDate'=> $date,
					);
            $upload_data = $this->upload->data();
			$this->book_model->update(array('bookID' => $this->input->post('bookID')), $data);
			echo json_encode(array("status" => TRUE));
	   }
	}
	function book_watermark_edit(){
		$userID = $this->session->userdata('userID');
		$imgLink= 'watermark_'.$userID.'_'.rand().'.png';
		$config['upload_path'] = './watermark/';
          $config['allowed_types'] = 'jpg|png|jpeg';
          $config['max_size'] = '9081211';
          $config['max_width']  = '512';
          $config['max_height']  = '512';
		  $config['file_name'] = $imgLink ;
          $this->load->library('upload', $config);
		  if (!$this->upload->do_upload('watermarkImg')){
			 $imgLink = '';
					$data = array(
						  'watermarkImg' => $imgLink
					);
					 $this->book_model->update(array('bookID' => $this->input->post('bookID')), $data);
					echo json_encode(array("status" => TRUE));
		  }
		  else{
			  $data = array(
						  'watermarkImg' => $imgLink
					);
            $upload_data = $this->upload->data();
			$this->book_model->update(array('bookID' => $this->input->post('bookID')), $data);
			echo json_encode(array("status" => TRUE));
		  }
	}
	function load_addbook(){
		$userID = $this->session->userdata('userID');
		//$data['book'] =$this->book_model->get_book_by_id($bookID);
		$data['id'] = $userID;
		$data['user']= $this->user_model->get_user_byid($userID);
		//log_message('error',$data['book']->bookName);
		$this ->load->view('addbook_view',$data);
	}

	function load_bookDetails($bookID){
		$userID = $this->session->userdata('userID');
		$data['book'] =$this->book_model->get_book_by_id($bookID);
		$data['user']= $this->user_model->get_user_byid($userID);
		log_message('error',$data['book']->bookName);
		$this->load->view("bookDetails_view",$data);
	}
	function load_header_view(){
		$userID = $this->session->userdata('userID');
		$data['id'] = $userID;
		$data['user']= $this->user_model->get_user_byid($userID);
		//$data['books'] =$this->book_model->get_user_books($userID);
		$data['message'] = $this->book_model->return_all_message($userID);
		$data['transaction'] = $this->book_model->return_transactions($userID);
		$this->load->view("header_view", $data);
	}
	function load_dash(){
		//$username= $this->session->userdata('username');
			$userID = $this->session->userdata('userID');
			$data['id'] = $userID;
			$data['user']= $this->user_model->get_user_byid($userID);
			$data['books'] =$this->book_model->get_user_books($userID);
			$data['message'] = $this->book_model->return_all_message($userID);
			$data['transaction'] = $this->book_model->return_transactions($userID);
			$this->load->view("dashboard_view",$data);
	}
	function load_about_us(){
		$username= $this->session->userdata('username');
		$userID = $this->session->userdata('userID');
		$data['id'] = $userID;
		$data['user']= $this->user_model->get_user_byid($userID);
		$data['books'] =$this->book_model->get_user_books($userID);
		$data['transaction'] = $this->book_model->return_transactions($userID);
		$this->load->view("aboutus_view",$data);
	}
	function delete_book($id)
	{
		$this->book_model->del_by_id($id);
		$this->load_dash();
		log_message('error','deletecalled'.$id);

	}
	public function ajax_requested_book(){
		$now = new DateTime();
		$now->setTimezone(new DateTimeZone('Asia/Dhaka'));
		$date= $now->format('Y-m-d');
		$data = array(
			'bookID' => $this->input->post('bookID'),
			'ownerID' => $this->input->post('ownerID'),
			'transType' => $this->input->post('transType'),
			'clientID' => $this->session->userdata('userID'),
			'transDate' => $date,
			'duration' => "0",
			'isActive' => "0",
			'isRequested' => "1"
		);
		$this->book_model->waitForTransaction($data);
		echo json_encode($data);
	} 
	public function ajax_bookActivation(){
		$data = $this->book_model->return_requested_users($this->input->post('transType'),$this->input->post('ownerID'), $this->input->post('bookID'));
		echo json_encode($data);
	}
	public function ajax_edit($bookID)
	{
		$data = $this->book_model->user_specific_book($bookID);
		echo json_encode($data);
	}
	function ajax_watermark_edit($bookID){
		$data = $this->book_model->watermarkImg_edit($bookID);
		echo json_encode($data);
	}
	public function ajax_searched_book(){
		$bookID = $this->input->post('bookIDs');
		$data = $this->book_model->searched_book($bookID);
		echo json_encode($data);
	}
	public function ajax_profile_edit($userID)
	{
		$data = $this->book_model->user_profile($userID);
		echo json_encode($data);
	}
	public function is_Hired_Or_Not($bookID){
		$clientID = $this->session->userdata('userID');
		$datas = $this->book_model->check_for_hired($clientID, $bookID);
		echo json_encode($datas);
	}
	/*public function ajax_max_transID(){
		$clientID = $this->session->userdata('userID');
		$data =  $this->book_model->return_max_transID($clientID);
		$transID = $data;
		//$this->ajax_is_active($transID);
		$this->ajax_is_requested($transID);
		//echo json_encode($data);
		//$output = print_r($data, true);
		//file_put_contents('C:/xampp/htdocs/file.txt', $output);
	}*/
	public function ajax_is_active($transID){
		$clientID = $this->session->userdata('userID');
		$data = $this->book_model->active_users($clientID, $transID);
		echo json_encode($data);
	}
	public function ajax_update(){
		$this->_validate();
		$data = array(
				'bookName' => $this->input->post('bookName'),
				'authorName' => $this->input->post('authorName'),
				'description' => $this->input->post('description'),
				'category' => $this->input->post('category'),
				'isLendable' => $this->input->post('isLendable'),
				'isPurchasable' => $this->input->post('isPurchasable'),
				'showBooks' => $this->input->post('showBooks'),
				'isLendablePrice' => $this->input->post('lendablePrice'),
				'isBuyablePrice' => $this->input->post('buyablePrice')
			);
		$this->book_model->update(array('bookID' => $this->input->post('bookID')), $data);
		echo json_encode(array("status" => TRUE));
	}
	function ajax_bookActivatePermission_for_yes(){
		$data = array(
				'isActive' => "1",
				'isRequested' => "2"
			);
		$where = array(
				'clientID' => $this->input->post('clientID'),
				'bookID' => $this->input->post('bookID'),
				'isActive' => "0",
				'isRequested' => "1"
			);	
		$this->book_model->update_permission_of_books($data, $where);
		echo json_encode(array("status" => TRUE));
	}
	function ajax_bookActivatePermission_for_no(){
		$data = array(
				'isActive' => "0",
				'isRequested' => "2"
			);
		$where = array(
				'clientID' => $this->input->post('clientID'),
				'bookID' => $this->input->post('bookID'),
				'isActive' => "1",
				'isRequested' => "2"
			);	
		$this->book_model->update_permission_of_books($data, $where);
		echo json_encode(array("status" => TRUE));
	}
	public function ajax_pages(){
		//$userID = $this->session->userdata('userID');
		$bookID = $this->input->post('bookID');
		$data = $this->book_model->return_pages($bookID);
		echo json_encode($data);
	}
	function ajax_active_pages($bookID){
		//$ownerID = $this->input->post('ownerID');
		//$bookID = $this->input->post('bookID');
		$data = $this->book_model->return_active_pages($bookID);
		//log_message("error",count($data));
		echo json_encode($data);
	}
	public function view_profile(){
		$userID = $this->session->userdata('userID');
		$data['id']= $userID;
		$data['user']= $this->user_model->get_user_byid($userID);
		$data['books'] =$this->book_model->get_user_books($userID);
		$data['message'] = $this->book_model->return_all_message($userID);
		$data['transaction'] = $this->book_model->return_transactions($userID);
		$this->load->view("view_profile_view",$data);
	}
	public function return_transaction_request(){
		$userID = $this->session->userdata('userID');
		
	}
	public function request_of_books(){
		$userID = $this->session->userdata('userID');
		$data['id']= $userID;
		$data['user']= $this->user_model->get_user_byid($userID);
		$data['transaction'] = $this->book_model->return_transactions($userID);
		$data['requests'] = $this->book_model->return_book_requests($userID);
		$data['message'] = $this->book_model->return_all_message($userID);
		$data['requestsChanged'] = $this->book_model->return_book_requestsChanged($userID);
		$this->load->view("request_of_books_view",$data);
	}
	function lendOrBuyBooks(){
		$userID = $this->session->userdata('userID');
		$data['id']= $userID;
		$data['user']= $this->user_model->get_user_byid($userID);
		$data['transaction'] = $this->book_model->return_transactions($userID);
		$data['requests'] = $this->book_model->return_book_requests($userID);
		$data['message'] = $this->book_model->return_all_message($userID);
		$data['requestsChanged'] = $this->book_model->return_book_requestsChanged($userID);
		$data['lendOrBuy']= $this->book_model->return_lendOrBuyBooks($userID);
		$this->load->view("lendOrBuyBooks_view",$data);
	}
	function message(){
		$userID = $this->session->userdata('userID');
		$data['id']= $userID;
		$data['user']= $this->user_model->get_user_byid($userID);
		$data['transaction'] = $this->book_model->return_transactions($userID);
		$data['requests'] = $this->book_model->return_book_requests($userID);
		$data['requestsChanged'] = $this->book_model->return_book_requestsChanged($userID);
		$data['lendOrBuy']= $this->book_model->return_lendOrBuyBooks($userID);
		$data['message'] = $this->book_model->return_all_message($userID);
		$this->load->view("message_view",$data);
	}
	public function ajax_return_requested_clients($clientID){
		$data = $this->book_model->get_requested_clients($clientID);
		//log_message("error",count($data));
		echo json_encode($data);
	}
	function ajax_return_active_clients($clientID){
		$data = $this->book_model->get_activated_clients($clientID);
		echo json_encode($data);
	}
	public function ajax_watermarkImg($bookID){
		$userID = $this->session->userdata('userID');
		$data = $this->book_model->return_watermarkImg($bookID, $userID);
		log_message("error", count($data));
		echo json_encode($data);
	}
	function show_users($bookID){
		$data = $this->book_model->return_readable_users($bookID);
		echo json_encode($data);
	}
	function check_for_report(){
		$bookID = $this->input->post('bookID');
		$ownerID = $this->input->post('ownerID');
		$userID = $this->session->userdata('userID');
		$data = $this->user_model->return_reported_user($bookID, $ownerID, $userID);
		echo json_encode($data);
	}
	function insert_report(){
		$data = array('reporterID' => $this->session->userdata('userID'),
					'ownerID' => $this->input->post('ownersID'),
					'bookID' => $this->input->post('booksID'),
					'reports' => $this->input->post('reportField'),
					'accepted' => '0');
		$this->user_model->insert_into_reports($data);
		echo json_encode(array("status" => TRUE));
	}
	function showAllBooks(){
		$userID = $this->input->post('userID');
		$data = $this->book_model->return_all_info_aboutBook($userID);
		echo json_encode($data);
	}
	function returns_all_book_info(){
		$bookID = $this->input->post('bookID');
		$data = $this->book_model->returns_all_book_information($bookID);
		echo json_encode($data);
	}
	function return_all_reports(){
		$userID = $this->input->post('userID');
		$data = $this->book_model->return_all_reported_issue($userID);
		echo json_encode($data);
	}
	function return_reports_of_this_book(){
		$bookID = $this->input->post('bookID');
		$data = $this->book_model->return_all_reported_book($bookID);
		echo json_encode($data);
	}
	function return_show_users_for_book_view(){
		$bookID = $this->input->post('bookID');
		$data = $this->book_model->return_all_users_for_book_view($bookID);
		echo json_encode($data);
	}
	function return_all_reportsID(){
		$reportID = $this->input->post('reportID');
		$data = $this->book_model->return_all_reports_with_reporterID($reportID);
		echo json_encode($data);
	}
	function send_messages_to_user(){
		$now = new DateTime();
		$now->setTimezone(new DateTimeZone('Asia/Dhaka'));
		$date= $now->format('Y-m-d');
		$data = array('senderID' => $this->session->userdata('userID'),
					'receiverID' => $this->input->post('receiverID'),
					'msg' => $this->input->post('msgTopic'),
					'bookID' => $this->input->post('msgBookID'),
					'msgDate' => $date,
					'msgAccepted' => '0');
		$this->book_model->insert_into_msg_table($data);
		echo json_encode(array("status" => TRUE));
	}
	function isAccepted_in_report_table(){
		$reportID = $this->input->post('reportID');
		$this->book_model->update_the_report_table($reportID);
		echo json_encode(array("status" => TRUE));
	}
	function check_in_msg_table(){
		$where = array('senderID' => $this->session->userdata('userID'),
					'receiverID' => $this->input->post('receiverID'),
					'bookID' => $this->input->post('bookID'));
		$data = $this->book_model->check_in_msg_table_accepted_or_not($where);
		echo json_encode($data);
	}
	function return_all_user_info(){
		$userID = $this->input->post('userID');
		$data = $this->user_model->return_all_user_information($userID);
		echo json_encode($data);
	}
	function blockOrNot(){
		$userID = $this->input->post("userID");
		$data = $this->user_model->return_all_user_information($userID);
		echo json_encode($data);
	}
	function confirmAndBlock(){
		$item = array('block' => $this->input->post('blockIDs'));
		$where = array('userID' => $this->input->post('userIDs'));
		$this->user_model->update_blockID($item, $where);
		echo json_encode(array("status" => TRUE));
	}
	private function _validate()
	{
		$data = array();
		$data['error_string'] = array();
		$data['inputerror'] = array();
		$data['status'] = TRUE;

		if($this->input->post('bookName') == '')
		{
			$data['inputerror'][] = 'bookName';
			$data['error_string'][] = 'Book name is required';
			$data['status'] = FALSE;
		}

		if($this->input->post('authorName') == '')
		{
			$data['inputerror'][] = 'authorName';
			$data['error_string'][] = 'Author name is required';
			$data['status'] = FALSE;
		}

		if($this->input->post('category') == '')
		{
			$data['inputerror'][] = 'category';
			$data['error_string'][] = 'Category is required';
			$data['status'] = FALSE;
		}

		if($data['status'] === FALSE)
		{
			echo json_encode($data);
			exit();
		}
	}
}
?>