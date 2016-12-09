<?php
//all the functions that are related to the book table of bookhub database
	class book_model extends CI_Model
	{
     function __construct()
     {
          // Call the Model constructor
          parent::__construct();
          $this->load->database();
     }

     //book table theke userID milai book ane-- sourav

     function get_user_books($uID)
     {
        $this->db->where('ownerID', $uID);
        $query = $this->db->get('book');
        return $query->result();
     }
     //id er respect a ekta BOOK row return korbe --sourav
     function get_book_by_id($id)
     {
        $this->db->where('bookID', $id);
        $query = $this->db->get('book');
        return $query->row();

     }
     //inserts a book
     function insert_book($data)
     {
         $this->db->insert('book',$data);
     }
	function insert_pages($data){
		$this->db->insert('pages', $data);
	}
     //eta userid dile book er number return korbe
	 function searched_book($bookID){
		$this->db->select('bookID, bookName, firstName, lastName, authorName, isLendable, isPurchasable, isLendablePrice, isBuyablePrice, coverImg, description');
		$this->db->join('users', 'users.userID = book.ownerID');
		$this->db->where('bookID', $bookID);
		$query = $this->db->get('book');
		return $query->row();
	 }
     function user_books($ownerid)
      {
              $this->db->where('ownerID', $ownerid);
              $query = $this->db->get('book');
              return $query->row();
       }
	   //$transID = "0";
	   function requested_users($clientID, $transID){
		   $this->db->select('isRequested, transID');
		   $this->db->where('clientID', $clientID);
		   $this->db->group_start();
		   $this->db->like('transID', $transID);
		   $this->db->or_like('isRequested', "1");
		   $this->db->group_end();
		   $query = $this->db->get("transaction");
		   return $query->row();
	   }
	   function return_max_transID($clientID){
		   $this->db->select_max('transID');
		   $this->db->where('clientID', $clientID);
		   $query = $this->db->get("transaction");
		   //return $query->row();
		   foreach($query->result() as $row){
			   $transID = $row->transID;
		   }
		   return $transID;
		   //$result = $this->db->get('transaction')->row();  
			//return $result->maxTransID;
		   //$output = print_r($query->result(), true);
		   //file_put_contents('C:/xampp/htdocs/file.txt', $output);
		   //$file = fopen("file.txt","w");
			//echo fwrite($file,$transID);
			//fclose($file);
	   }
	   function active_users($clientID, $transID){
		  $this->db->select('isActive');
		  $this->db->where('clientID', $clientID);
		  $this->db->group_start();
		  $this->db->like('transID', $transID);
		   $this->db->or_like('isActive', "1");
		   $this->db->group_end();
		   $query = $this->db->get("transaction");
		   return $query->row();
	   }
	   function user_specific_book($bookID){
			$this->db->where('bookID', $bookID);
            $query = $this->db->get('book');
            return $query->row();
	   }
       //sourav -deletes a book by id
       function del_by_id($bid){
          $this->db->where('bookID', $bid);
          $this->db->delete('book');
       }
	   function return_pages($bookID){
		   $this->db->select('pageImageLink');
		   //$this->db->where('userID', $userID);
		   $this->db->where('bookID', $bookID);
		   $query = $this->db->get("pages");
		   return $query->result();
	   }
       function search($text){
		   $vals = 1;
		   $this->db->where('showBooks',$vals);
		   $this->db->group_start();
           $this->db->like('bookName',$text);
		   $this->db->or_like('authorName', $text);
		   $this->db->group_end();
           $this->db->limit(10);
           $query =$this->db->get("book");
           return $query->result(); 
       }
	   function AllBookSearch($text){
		   //$this->db->where(array('bookName' => $text, 'authorName' => $text, 'category' => $text));
		   //$this->db->group_start();
		   $this->db->join('users', 'users.userID = book.ownerID');
		   $this->db->like('book.bookName',$text);
		   $this->db->or_like('book.authorName', $text);
		   $this->db->or_like('book.category', $text);
		   //$this->db->or_like('category', $text);
		   //$this->db->group_end();
		   $this->db->limit(10);
		   $query = $this->db->get('book');
		   return $query->result();
	   }
       public function update($where, $data)
	  {
		$this->db->update('book', $data, $where);
		return $this->db->affected_rows();
	  }
	  function update_permission_of_books($data, $where){
		  $this->db->update('transaction', $data, $where);
		  return $this->db->affected_rows();
	  }
		public function get_books($userID,$search){
			//$this->db->where(array('ownerID' => $userID, 'bookName' => $search));
			$this->db->where('ownerID',$userID);
			$this->db->like('bookName',$search);
			$this->db->limit(10);
			$query =$this->db->get("book");
            return $query->result();
		}
		public function waitForTransaction($data){
			$this->db->insert('transaction', $data);
		}
		public function return_transactions($userID){
			$this->db->select('bookID');
			$this->db->where(array('ownerID' => $userID, 'isActive' => "0"));
			$this->db->like('isRequested', "1");
			$query = $this->db->get("transaction");
			return $query->result();
		}
		public function check_for_hired($clientID, $bookID){
			$this->db->select('isRequested, isActive');
			$this->db->where(array('clientID' => $clientID, 'bookID' => $bookID, 'isActive' => "0"));
			$this->db->like('isRequested', "1");
			$query = $this->db->get("transaction");
		   return $query->row();
		}
		function return_requested_bookID($userID){
			$this->db->select('transaction.bookID');
			$this->db->join('book', 'book.bookID = transaction.bookID');
			$this->db->where('transaction.ownerID', $userID);
			$query = $this->db->get('transaction');
			return $query->result();
		}
		function return_book_requestsChanged($userID){
			$this->db->group_by('bookID');
			$this->db->select('transID, transaction.ownerID, transaction.clientID, transaction.bookID, bookName, coverImg, transDate');
			$this->db->join('book', 'book.bookID = transaction.bookID');
			$this->db->where('transaction.ownerID', $userID);
			//$this->db->where(array('transaction.ownerID' => $userID, 'transaction.bookID' => $bookID));
			$query = $this->db->get('transaction');
			return $query->result();
		}
		
		function return_book_requests($userID){
			//$this->db->group_by('bookID');
			$this->db->select('transID, transaction.ownerID, transaction.clientID, transaction.bookID, bookName, coverImg, transDate');
			$this->db->join('book', 'book.bookID = transaction.bookID');
			$this->db->where('transaction.ownerID', $userID);
			//$this->db->where(array('transaction.ownerID' => $userID, 'transaction.bookID' => $bookID));
			$query = $this->db->get('transaction');
			return $query->result();
		}
		function return_buyable_requests($userID, $bookID){
			$this->db->select('transID');
			$this->db->where(array('ownerID' => $userID, 'transType' => "2", 'bookID' => $bookID));
			$this->db->like('isRequested', "1");
			$query = $this->db->get("transaction");
			return $query->result();
		}
		function return_lendable_requests($userID, $bookID){
			$this->db->select('transID');
			$this->db->where(array('ownerID' => $userID, 'transType' => "1", 'bookID' => $bookID));
			$this->db->like('isRequested', "1");
			$query = $this->db->get("transaction");
			return $query->result();
		}
		function return_total_user_of_a_book($userID, $bookID){
			$this->db->select('transID');
			$this->db->where(array('ownerID' => $userID, 'isActive' => "1", 'bookID' => $bookID));
			$query = $this->db->get("transaction");
			return $query->result();
		}
		function return_requested_users($transType,$ownerID,$bookID){
			//$this->db->select('clientID');
			$this->db->where(array('bookID' => $bookID, 'ownerID' => $ownerID,'transType'=> $transType, 'isRequested' => "1"));
			$query = $this->db->get("transaction");
			return $query->result();
		}
		function get_requested_clients($clientID){
			$this->db->join('users', 'users.userID = transaction.clientID');
			$this->db->where(array('transaction.clientID' => $clientID, 'isActive' => '0', 'isRequested' => '1'));
			$query = $this->db->get("transaction");
			return $query->row();
		}
		function return_lendOrBuyBooks($clientID){
			//$this->db->select('*');
			$this->db->join('book', 'book.bookID = transaction.bookID');
			$this->db->join('users', 'users.userID = transaction.ownerID', 'left');
			$this->db->where(array('transaction.clientID' => $clientID, 'isActive' => "1", 'isRequested' => "2"));
			$query = $this->db->get('transaction');
			return $query->result();
		}
		function return_active_pages($bookID){
			$this->db->select('pageImageLink');
		    $this->db->where('bookID', $bookID);
		    $query = $this->db->get("pages");
			//log_message('error', $query->result());
			return $query->result();
		}
		function return_watermarkImg($bookID, $userID){
			$this->db->select('watermarkImg');
			$this->db->where('bookID', $bookID);
			//$this->db->like('bookID', $bookID);
			$query = $this->db->get('book');
			return $query->row();
		}
		function watermarkImg_edit($data){
			$this->db->where('bookID', $bookID);
            $query = $this->db->get('book');
            return $query->row();
		}
		function return_readable_users($bookID){
			$this->db->join('users', 'users.userID = transaction.clientID');
			$this->db->where(array('transaction.bookID' => $bookID, 'isActive' => '1'));
			$query = $this->db->get('transaction');
			return $query->result();
		}
		function get_activated_clients($clientID){
			$this->db->join('users', 'users.userID = transaction.clientID');
			$this->db->where(array('transaction.clientID' => $clientID, 'isActive' => '1'));
			$query = $this->db->get("transaction");
			return $query->row();
		}
		function getAllBooks(){
			$this->db->join('users', 'users.userID = book.ownerID');
			$query = $this->db->get('book');
			return $query->result();
		}
		function return_totalBookOfAUser($userID){
			$this->db->where('ownerID', $userID);
			$query = $this->db->get('book');
			return $query->result();
		}
		function return_total_reports($userID){
			$this->db->where(array('ownerID' => $userID, 'accepted' => '0'));
			$query = $this->db->get('report');
			return $query->result();
		}
		function return_total_reports_for_all_Book_view($bookID){
			$this->db->where(array('bookID' => $bookID, 'accepted' => '0'));
			$query = $this->db->get('report');
			return $query->result();
		}
		function return_all_info_aboutBook($userID){
			$this->db->join('users', 'users.userID = book.ownerID');
			//$this->db->join('report', 'users.userID = report.ownerID', 'left');
			$this->db->where(array('book.ownerID' => $userID));
			$query = $this->db->get('book');
			return $query->result();
		}
		function returns_all_book_information($bookID){
			$this->db->where('bookID', $bookID);
			$query = $this->db->get('book');
			return $query->row();
		}
		function return_all_reported_issue($userID){
			//$this->db->join('book', 'book.bookID = report.bookID');
			$this->db->where(array('ownerID' => $userID, 'accepted' => '0'));
			$query = $this->db->get('report');
			return $query->result();
		}
		function return_all_reported_book($bookID){
			$this->db->where(array('bookID' => $bookID, 'accepted' => '0'));
			$query = $this->db->get('report');
			return $query->result();
		}
		function return_all_reports_with_reporterID($reportID){
			$this->db->join('book', 'book.bookID = report.bookID');
			$this->db->join('users', 'users.userID = report.reporterID', 'left');
			$this->db->where('report.reportID', $reportID);
			$query = $this->db->get('report');
			return $query->row();
		}
		function insert_into_msg_table($data){
			$this->db->insert('message', $data);
		}
		function update_the_report_table($reportID){
			$data = array('accepted' => '1');
			$where = array('reportID' => $reportID);
			$this->db->update('report', $data, $where);
			return $this->db->affected_rows();
			//$this->db->where('reportID', );
		}
		function check_in_msg_table_accepted_or_not($where){
			$this->db->where($where);
			$query = $this->db->get('message');
			return $query->result();
		}
		function return_all_message($userID){	
			$this->db->join('users', 'users.userID = message.senderID');
			$this->db->where(array('message.receiverID' => $userID, 'message.msgAccepted' => '0'));
			$query = $this->db->get('message');
			return $query->result();
		}
		function return_all_users_for_book_view($bookID){
			$this->db->join('users', 'users.userID = transaction.clientID');
			//$this->db->where('', );
			$this->db->where(array('transaction.bookID' => $bookID, 'transaction.isActive' => '1'));
			$query = $this->db->get('transaction');
			return $query->result();
		}
}?>