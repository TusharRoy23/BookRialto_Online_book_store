<html>
	<head>
		<?php $this->load->helper('url');?>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>All Books</title>
		<link rel="stylesheet" href="<?php echo base_url("assets/css/bootstrap.css"); ?>"/>
		<script type="text/javascript" src="<?php echo base_url("assets/js/jquery.js"); ?>"></script>
		<script type="text/javascript" src="<?php echo base_url("assets/js/bootstrap.js"); ?>"></script>
		<link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap-glyphicons.css" rel="stylesheet"/>
		<link href='https://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
		<link rel="stylesheet" href="/Library/style/style.css"/>
		<link rel="stylesheet" href="/Library/style/styleOne.css"/>
	</head>
	<body>
		<?php
			$data['id'] = "adminone";
			$this->load->view('header_view', $data);
			if($search_checks == 0):
		?>
		<div class = "search-bar">
			<center>
				<div class = "user-view-search-bar">
                    <input class="form-control searchInternalForAllUserView" id = "searchInternalForAllUserView" name="searchInternalForAllUserView" placeholder="Search" type="text"/>
                </div>
			</center>
		</div>
		<?php endif;?>
		<div class = "problem" id = "problem">
			<div class = "bookGallary" id = "bookGallary">
				<?php if(empty($books)): ?>
					<div class = "well well-lg" id = "No_books">
						<h3 class = "text-center" style = "color:red;"><b>No Books</b></h3>
					</div>
					<?php else:?>
							<table class="table table-striped table-bordered table-hover table-inverse">
								<thead>
									<tr>
										<th><b>Book Cover</b></th>
										<th><b>Book Name</b></th>
										<th><b>Author Name</b></th>
										<th><b>Owner Name</b></th>
										<th><b>Catgory</b></th>
										<th><b>Upload Date</b></th>
										<th><b>Showable</b></th>
										<th><b>Lendable Price</b></th>
										<th><b>Buyable Price</b></th>
										<th><b>Users</b></th>
										<th><b>Book View</b></th>
										<th><b>Reports</b></th>
									</tr>
								</thead>
								<tbody>
									<?php foreach ($books as $book):
										$bID = $book->bookID;?>
										<tr>
											<td>
												<?php if ($book->coverImg =='') :?>
													<img class = "img-size-in-table" src = "<?php echo base_url('defaults/noCover.png'); ?>"/>
												<?php else:?>
													<img class = "img-size-in-table" src = "<?php echo base_url('bookcover/'.$book->coverImg); ?>"/>
												<?php endif;?>
											</td>
											<td><p><?php echo $book->bookName;?></p></td>
											<td><p><?php echo $book->authorName; ?></p></td>
											<td><p><?php echo $book->firstName .' '.$book->lastName;?></p></td>
											<td><p><?php echo $book->category;?></p></td>
											<td><p><?php echo $book->uploadDate;?></p></td>
											<td><p>
												<?php if($book->showBooks == 0):?>
													<span class="label label-warning" data-toggle="tooltip" title="The Book is not Showable">Not Showable</span>
												<?php elseif($book->showBooks == 1):?>
													<span class="label label-success" data-toggle="tooltip" title="The Book is Showable">Showable</span>
												<?php endif;?>
											</p></td>
											<td><p>
												<?php if ($book->isLendable== 0) :?>
													<span class="label label-warning" data-toggle="tooltip" title="The Book is not Lendable">Not Lendable</span>
												<?php elseif($book->isLendable== 1) :?>
													<span class="label label-success" data-toggle="tooltip" title="The Book is Lendable">Lendable(<?php echo $book->isLendablePrice;?> TK)</span>
												<?php endif;?>
											</p></td>
											<td><p>
												<?php if ($book->isPurchasable== 0) :?>
													<span class="label label-warning" data-toggle="tooltip" title="The Book is not Buyable">Not Buyable</span>
												<?php elseif($book->isPurchasable== 1) :?>
													<span class="label label-success" data-toggle="tooltip" title="The Book is Buyable">Buyable(<?php echo $book->isBuyablePrice;?> TK)</span>
												<?php endif;?>
											</p></td>
											<td>
												<a onClick = "show_users('<?php echo $bID;?>')" class="btn btn-primary btn-xs"><span class = "badge ret">
													<?php $total_users = $this->book_model->return_total_user_of_a_book($book->ownerID, $bID); 
														echo sizeof($total_users);?></span>
												</a>
											</td>
											<td>
												<a onClick = "show_pages('<?php echo $bID;?>')" class="btn btn-success btn-xs">Show</a>
											</td>
											<td>
												<a onClick = "show_reports('<?php echo $bID;?>')" class="btn btn-danger btn-xs"><span class = "badge ret">
													<?php $total_reports = $this->book_model->return_total_reports_for_all_Book_view($bID); 
													echo sizeof($total_reports);?></span>
												</a>
											</td>
										</tr>
									<?php endforeach;?>
								</tbody>
							</table>
				<?php endif;?>
			</div>
		</div>
		<div class = "container"><!--modal of report-->
			<div class="modal fade" id="allUsersReportForBookView" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			    <div class="modal-dialog">
					 <div class="modal-content">
						  <div class="modal-header">
							   <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
							   <h4 class="modal-title" id="myModalLabel"><b>Reports</b></h4>
						  </div>
						  <div class="modal-body" >
									<div  id="Test">
										<img id = "imgTestReports" name = "allReportsCoverImg" src="<?php echo base_url('defaults/Start.png'); ?>"/>
										<div class = "detailsForReports" >
											Book Name: <b><p id ="bookNamess" style ="color:#8B008B;"></p></b>
											Author Name: <b><p id = "authorNamess" style ="color:#663399;"></p></b>
											Category: <b><p id = "categorys" style ="color:#7B68EE;"></p></b>
											Reporter Name: <b><p id = "reporterName" style ="color:#808000;"></p></b>
											Report: <textarea id="reportTxt" rows="3" cols="25" readonly></textarea><br><br>
											<a onClick ="sendMessageForAllUser_view()" class="btn btn-danger btn-xs message-btn-allUser_view">Send message</a>
										</div>
									</div>
									
						  </div>
						  <div class="modal-footer">
							  	<center>
							  	<button type="image" id="report_prevs_image" class = "btn btn-success"></button>
								<button type="image" id="report_nexts_image" class = "btn btn-success"></button>
								<input type="hidden" id="info_no" value="0">
						    </center>
						  </div>
					 </div>
				</div>
   			</div>
		</div>
		<div class = "container"><!--modal of user show-->
			<div class="modal fade" id="allUsersShowForBookView" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			    <div class="modal-dialog">
					 <div class="modal-content">
						  <div class="modal-header">
							   <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
							   <h4 class="modal-title" id="myModalLabel"><b>Reports</b></h4>
						  </div>
						  <div class="modal-body" >
									<div  id="Test">
										<img id = "imgTestUsers" name = "allUsersProfileImg" src="<?php echo base_url('defaults/Start.png'); ?>"/>
										<div class = "detailsForUsers" >
											Name: <b><p id ="Namess" style ="color:#8B008B;"></p></b>
											E-mail: <b><p id = "eMail" style ="color:#663399;"></p></b>
											Contact No: <b><p id = "contact" style ="color:#7B68EE;"></p></b>
											Member Since: <b><p id = "memberSince" style ="color:#808000;"></p></b>
										</div>
									</div>
									
						  </div>
						  <div class="modal-footer">
							  	<center>
							  	<button type="image" id="user_prevs_image" class = "btn btn-success"></button>
								<button type="image" id="user_nexts_image" class = "btn btn-success"></button>
								<input type="hidden" id="info_no" value="0">
						    </center>
						  </div>
					 </div>
				</div>
   			</div>
		</div>
		<div class = "container"><!--Show pages modal-->
			<div class="modal fade" id="showPagesModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			    <div class="modal-dialog">
					 <div class="modal-content">
						  <div class="modal-header">
							   <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
							   <h4 class="modal-title" id="myModalLabel"><b>Show Book</b></h4>
						  </div>
						  <div class="modal-body" id = "showForm">
						   		<center>
									<div id="slide_cont">
										<img id="slideshow_image" src="<?php echo base_url('defaults/Start.png'); ?>">
									</div>
								</center>
						  </div>
						  <div class="modal-footer">
							<center>
							  	<button type="image" id="prev_image" class = "btn btn-success"></button>
								<button type="image" id="next_image" class = "btn btn-success"></button>
								<input type="hidden" id="img_no" value="0">
						    </center>
						  </div>
					 </div>
				</div>
   			</div>
		</div>
		<div class = "container"><!-- Modal for msg-->
		   <div class="modal fade" id="msgModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
							<h4 class="modal-title text-center" id="myModalLabel"><b>Write a message for this book</b></h4>
						</div>
					    <div class="modal-body form">
							<form action="#" id="msgForm" class="form-horizontal" name = "forms">
								<input type="hidden" value="" name="bookID"/>
								<div class="form-body">
									<div class="form-group">
										<div class="col-md-9">
											<textarea name="msgTxt" id = 'msgTxt'></textarea>
											<span class="help-block"></span><br>
										</div>
									</div>
								</div>
							</form>
					    </div>
					    <div class="modal-footer">
							<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
							<a class="btn btn-info" id="btn_confirm" onClick = "sendMsg()" name="btn_confirm">Send</a>
					    </div>
					</div>
				</div>
		   </div>
		</div>
		<div class = "container"><!-- modal of extra features -->
			<div class="modal fade" id="extraFeatures" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			    <div class="modal-dialog">
					 <div class="modal-content">
						  <div class="modal-header">
							   <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
							   <h4 class="modal-title" id="myModalLabel"><b></b></h4>
						  </div>
						  <div class="modal-body" >
									
						  </div>
						  <div class="modal-footer">
							  	<button type="button" class="btn btn-default" data-dismiss="modal">OK</button>
						  </div>
					 </div>
				</div>
   			</div>
		</div>
	</body>
	<?php
		$show_users_for_book_view = site_url('user_dash/return_show_users_for_book_view');
		$show_pages = site_url("user_dash/return_pages_of_this_book");
		$show_reports_for_book_view = site_url("user_dash/return_reports_of_this_book");
		$return_all_reportsID_info = site_url('user_dash/return_all_reportsID');
		$startImage = base_url('defaults/Start.png');
		$endImage = base_url('defaults/End.png');
		$defaultBookImage = base_url('defaults/noCover.png');
		$BookImage = base_url('bookcover/');
		$isAccepted_in_report_table = site_url('user_dash/isAccepted_in_report_table');
		$send_messages = site_url('user_dash/send_messages_to_user');
		$check_in_msg_table = site_url('user_dash/check_in_msg_table');
		$defaultProfileImage = base_url('defaults/user-default.png');
		$ProfileImage = base_url('userdp/');
		$return_all_user_info = site_url('user_dash/return_all_user_info');
		$return_all_pages = site_url('user_dash/ajax_pages');
		$no_pages = base_url('defaults/noPage.png');
		$show_pages_of_a_book = base_url('bookpages/');
		$searchInternalForAllBook = site_url('search_book_for_admin/searchInternalForAllBook');
	?>
	<script>
		var show_users_for_book_view = "<?= $show_users_for_book_view?>";
		var show_pages = "<?= $show_pages?>";
		var show_reports_for_book_view = "<?= $show_reports_for_book_view?>";
		var return_all_reportsID_info = "<?= $return_all_reportsID_info?>";
		var startImage = "<?= $startImage?>";
		var endImage = "<?= $endImage?>";
		var defaultBookImage = "<?= $defaultBookImage?>";
		var BookImage = "<?= $BookImage?>";
		var isAccepted_in_report_table = "<?= $isAccepted_in_report_table?>";
		var send_messages = "<?= $send_messages?>";
		var check_in_msg_table = "<?= $check_in_msg_table?>";
		var defaultProfileImage = "<?= $defaultProfileImage?>";
		var ProfileImage = "<?= $ProfileImage?>";
		var return_all_user_info = "<?= $return_all_user_info?>";
		var return_all_pages = "<?= $return_all_pages?>";
		var no_pages = "<?= $no_pages?>";
		var show_pages_of_a_book = "<?= $show_pages_of_a_book?>";
		var searchInternalForAllBook = "<?= $searchInternalForAllBook?>";
	</script>
	<!--<script type="text/javascript" src="<?php echo base_url("assets/customJS/customJS.js");?>"></script>-->
	<script type="text/javascript" src="<?php echo base_url("assets/customJS/allBookJS.js");?>"></script>
</html>