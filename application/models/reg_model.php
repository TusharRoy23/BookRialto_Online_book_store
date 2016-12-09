<?php

	class reg_model extends CI_Model
	{
     function __construct()
     {
          // Call the Model constructor
          parent::__construct();
          $this->load->database();
     }

     //users table e data push kore

     function insert_user_info($data)
     {
         $this->db->insert('users',$data);
     }
}?>