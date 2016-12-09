<html>
	<head>
		<link rel="stylesheet" href="/Library/style/style.css"/>
	</head>
		<?php
	class search_book extends CI_Controller {

		function __construct() {
			parent::__construct();
			$this->load->model('reg_model');
			$this->load->library('form_validation');
			$this->load->helper('url','form');
			$this->load->library('session');
        $this->load->model('book_model');
        $this->load->model('user_model');
              
			}
     function ajaxSearch()
     {
          if($this->input->method() == 'post')
          {
            //log_message('error','in Ajax search from post method .ajax worked');
            $q =$this->input->post("search");
            $str= $this->input->post("search");
            $results= $this->book_model->search($str);
            foreach($results as $res)
            {
              log_message('error',$res->bookName);
            }
             
              if(empty($results))
              {
                echo '<p>no result</p>';

              }
              else {
              foreach ($results as $res)
                  {
					  $ownerID = $res->ownerID;
                      $bookname=$res->bookName;
                      $author=$res->authorName;
                      $link=$res->coverImg;
                      $b_bookname='<strong><font size = 4px;>'.$q.'</font></strong>';
                      $b_author='<strong><font size = 4px ;>'.$q.'</font></strong>';
                      $final_bookname = str_ireplace($q, $b_bookname, $bookname);
                      $final_author = str_ireplace($q, $b_author, $author);
					  $userID = $this->session->userdata('userID');
                      ?>
							<div onClick = "checksFor('<?php echo $res->bookID; ?>','<?php echo $ownerID?>','<?php echo $userID?>')" align="left" class="show"  >
								<?php 
								if(!$link=='') : ?>
									<img  style="width:40px; height:43px; margin-right:6px; margin-top: -7px;"  src="<?php echo base_url('bookcover/'.$link);?> "/>
								<?php else: ?>
									<img style="width:40px; height:43px; margin-right:6px; margin-top: -7px;"  src="<?php echo base_url('defaults/noCover.png');?>" />
								<?php endif;?>
								<span id ="name" class="name text-left" style = "position:relative; left:-4px; top:-15px;"><?php echo $final_bookname; ?></span>&nbsp;<br/>
								<span id="author" class="text-left" style=" position:relative; left: 45px; font-size:10px; top :-25px;"><?php echo $final_author; ?></span>&nbsp;<br/>
							</div>
					<?php
				}
			}
        }
     }
     function load_search(){
               $username= $this->session->userdata('username');
               $userID = $this->session->userdata('userID');
               //debuging in log 
               //log_message('error',$username);
               log_message('error',$userID);


               $data['user']= $this->user_model->get_user_byid($userID);
               $data['books'] =$this->book_model->get_user_books($userID);
               /*$debugBook= $this->book_model->get_user_books($userID);
               foreach ($debugBook as $book) {
                    log_message('error',$book->bookName);
                    # code...
               }*/

               $this->load->view("searchbook_view",$data);
     }
	 function internal_book_search(){
		 if($this->input->method() == 'post'){
			 $userID = $this->session->userdata('userID');
			 $qs =$this->input->post("search");
            $strs = $this->input->post("search");
			$resultss = $this->book_model->get_books($userID, $strs);
			//$this->load_searched_books($resultss);
			if(empty($resultss))
            {
                ?> <div class = "well well-lg" id = "No_books">
						<h3 class = "text-center" style = "color:red;"><b>No Books</b></h3>
					</div>

            <?php }
			else{
				foreach ($resultss as $res){
					$bookID = $res->bookID;
					?> <div class = "img-gal" id = "img_gal">
							<a href="javascript:void(0)" onClick = "edit_book('<?php echo $bookID;?>')" data-toggle="modal" data-target="#editModal"> <!--Edit button-->
								<span class="glyphicon glyphicon-pencil edit-icon"></span>
							</a>
							<a href="#crossModal" data-href="<?php echo site_url('user_dash/delete_book/'.$res->bookID)?>" data-toggle="modal" data-target="#crossModal">
								<span class="glyphicon glyphicon-remove cross-icon"></span>
							</a>
							<?php if ($res->coverImg =='') :?>
							<img class = "img-size" src = "<?php echo base_url('defaults/noCover.png'); ?>"/>
								<a href="javascript:void(0)" onClick = "edit_poster('<?php echo $res->bookID;?>')" data-toggle = "modal" data-target = "#myPosterModal">
									<span class="glyphicon glyphicon-pencil edit-icon-img"></span>
								</a>
							<?php else:?>
							<img class = "img-size" src = "<?php echo base_url('bookcover/'.$res->coverImg); ?>"/>
								<a href="javascript:void(0)" onClick = "edit_poster('<?php echo $res->bookID;?>')" data-toggle = "modal" data-target = "#myPosterModal">
									<span class="glyphicon glyphicon-pencil edit-icon-img"></span>
								</a>
							<?php endif;?>
							<div class = "descrip">
								<p class = "title"><b><?php echo $res->bookName; ?> </b>
									<span></span>
								</p>
								<p class = "author"><b><?php echo $res->authorName; ?></b>
									<span></span>
								</p>
								<p class = "des">
									<div class = "deslimit">
										<span><?php echo $res->description; ?></span>
									</div>
								</p>
								<?php if ($res->isLendable== 0) :?>
									<span class="label label-warning lendable" data-toggle="tooltip" title="The Book is not Lendable">Not Lendable</span>
								<?php elseif($res->isLendable== 1) :?>
									<span class="label label-success lendable" data-toggle="tooltip" title="The Book is Lendable">Lendable(<?php echo $res->isLendablePrice;?> TK)</span>
								<?php endif;?>

								<?php if ($res->isPurchasable== 0) :?>
									<span class="label label-warning buyable" data-toggle="tooltip" title="The Book is not Buyable">Not Buyable</span>
								<?php elseif($res->isPurchasable== 1) :?>
									<span class="label label-success buyable" data-toggle="tooltip" title="The Book is Buyable">Buyable(<?php echo $res->isBuyablePrice;?> TK)</span>
								<?php endif;?>
								
								<?php if ($res->showBooks == 0) :?>
									<span class="label label-warning showable" data-toggle="tooltip" title="The Book is not Showable">Not Showable</span>
								<?php elseif($res->showBooks == 1) :?>
									<span class="label label-success showable" data-toggle="tooltip" title="The Book is Showable">Showable</span>
								<?php endif;?>
								<a href="javascript:void(0)" onClick = "add_pages('<?php echo $res->bookID;?>')" data-toggle = "modal" data-target = "#myPagesModal" class="btn btn-primary btn-xs request-btn">Requests</a>
								<a href="javascript:void(0)" onClick = "add_pages('<?php echo $res->bookID;?>')" data-toggle = "modal" data-target = "#myPagesModal" class="btn btn-primary btn-xs add-pages-btn">Add Pages</a>
								<a href="javascript:void(0)" onClick = "show_pages('<?php echo $res->bookID;?>')" data-toggle = "modal" data-target = "#showPagesModal" class="btn btn-primary btn-xs small-btn">Show Book</a>
							</div>
						</div>
						<br>
						<?php 
				}
			}
		 }
	 }
}
?>

</html>