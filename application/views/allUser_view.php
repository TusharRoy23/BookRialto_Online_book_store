<html>
	<head>
		<?php $this->load->helper('url');?>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>All Users</title>
		<link rel="stylesheet" href="<?php echo base_url("assets/css/bootstrap.css"); ?>"/>
		<script type="text/javascript" src="<?php echo base_url("assets/js/jquery.js"); ?>"></script>
		<script type="text/javascript" src="<?php echo base_url("assets/js/bootstrap.js"); ?>"></script>
		<link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap-glyphicons.css" rel="stylesheet"/>
		<link href='https://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
		<link rel="stylesheet" href="/Library/style/style.css"/>
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
		<div class = "userGallary" id = "userGallary">
			<?php if(empty($allUsers)): ?>
					<div class = "well well-lg" id = "No_books">
						<h3 class = "text-center" style = "color:red;"><b>No Users</b></h3>
					</div>
			<?php else:?>
					<table class="table table-striped table-bordered table-hover table-inverse">
						<thead>
							<tr>
								<th><b>Name</b></th>
								<th><b>E-mail</b></th>
								<th><b>Contact</b></th>
								<th><b>Books</b></th>
								<th><b>Reports</b></th>
								<th></th>
							</tr>
						</thead>
						<tbody>
							<?php foreach ($allUsers as $users):?>
							<tr>
								<td><b><p id = "name"><?php echo $users->firstName .' '.$users->lastName;?></p></b></td>
								<td><b><p id = "email"><?php echo $users->eMail; ?></p></b></td>
								<td><b><p id = "contactNo"><?php echo $users->contactNo; ?></p></b></td>
								<td><a class = "btn btn-success total_books" onClick ="total_books(<?php echo $users->userID;?>)"><span class = "badge ret"><?php $total_books = $this->book_model->return_totalBookOfAUser($users->userID);
									echo sizeof($total_books);?></span></a></td>
								<td><a class = "btn btn-warning total_reports" onClick ="total_reports('<?php echo $users->userID;?>')"><span class = "badge ret"><?php $total_reports = $this->book_model->return_total_reports($users->userID);
									echo sizeof($total_reports);?></span></a></td>
								<?php if($users->block == 0):?>
									<td><a class = "btn btn-danger block_user" onClick = "userBlock('<?php echo $users->userID;?>')">Block</a></td>
								<?php else:?>
									<td><a class = "btn btn-warning block_user" onClick = "userBlock('<?php echo $users->userID;?>')">Unblock</a></td>
								<?php endif;?>
							</tr>
							<?php endforeach;?>
						</tbody>
					</table>
			<?php endif;?>
		</div>
	</div>
		<div class = "container"><!-- modal of Block -->
			<div class="modal fade" id="ModalOfBlock" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			    <div class="modal-dialog">
					 <div class="modal-content">
						  <div class="modal-header">
							   <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
							   <h4 class="modal-title" id="myModalLabel"><b></b></h4>
						  </div>
						  <div class="modal-body" >
								<p>Are you sure?</p>
						  </div>
						  <div class="modal-footer">
							  	<button type="button" class="btn btn-danger" data-dismiss="modal">NO</button>
								<a onClick = "confirmBlock()" class="btn btn-success">YES</a>
						  </div>
					 </div>
				</div>
   			</div>
		</div>
		<div class = "container"><!-- modal of Books -->
			<div class="modal fade" id="allUsersBook" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			    <div class="modal-dialog">
					 <div class="modal-content">
						  <div class="modal-header">
							   <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
							   <h4 class="modal-title" id="myModalLabel"><b>Books</b></h4>
						  </div>
						  <div class="modal-body" >
									<div  id="Test">
										<img id = "imgTest" name = "allUsersCoverImg" src="<?php echo base_url('defaults/Start.png'); ?>"/>
										<div class = "details" >
											Book Name: <b><p id ="bookNames" style ="color:#8B008B;"></p></b>
											Author Name: <b><p id = "authorNames" style ="color:#663399;"></p></b>
											Category: <b><p id = "category" style ="color:#7B68EE;"></p></b>
											Upload Date: <b><p id = "uploadDate" style ="color:#808000;"></p></b>
											<span class="label label-success allUsersBuyableBook" data-toggle="tooltip" title="This book is Buyable">Buyable
											<p class = "badge ret" id ="buyablePrice"></p>TK</span>
											<span class="label label-success allUsersLendableBook" data-toggle="tooltip" title="This book is Lendable">Lendable
											<p class = "badge ret" id ="lendablePrice"></p>TK</span>
										</div>
									</div>
									
						  </div>
						  <div class="modal-footer">
							  	<center>
							  	<button type="image" id="userAllPrev_image" class = "btn btn-success"></button>
								<button type="image" id="userAllNext_image" class = "btn btn-success"></button>
								<input type="hidden" id="info_no" value="0">
						    </center>
						  </div>
					 </div>
				</div>
   			</div>
		</div>
		<div class = "container"><!--modal of report-->
			<div class="modal fade" id="allUsersReport" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
	<?php $totalBookUrl = site_url('user_dash/showAllBooks');
		  $startImage = base_url('defaults/Start.png');
		  $endImage = base_url('defaults/End.png');
		  $defaultBookImage = base_url('defaults/noCover.png');
		  $BookImage = base_url('bookcover/');
		  $return_all_book_info = site_url('user_dash/returns_all_book_info');
		  $return_all_reports_for_a_user = site_url('user_dash/return_all_reports');
		  $return_all_reportsID_info = site_url('user_dash/return_all_reportsID');
		  $send_messages = site_url('user_dash/send_messages_to_user');
		  $check_in_msg_table = site_url('user_dash/check_in_msg_table');
		  $isAccepted_in_report_table = site_url('user_dash/isAccepted_in_report_table');
		  $searchInternalForAllUser = site_url('search_user/searchInternalForAllUser');
		  $blockOrNot = site_url('user_dash/blockOrNot');
		  $confirmAndBlock = site_url('user_dash/confirmAndBlock'); 
	?>
	<script type="text/javascript">
		var totalBookUrl = "<?= $totalBookUrl?>";
		var startImage = "<?= $startImage?>";
		var endImage = "<?= $endImage?>";
		var defaultBookImage = "<?= $defaultBookImage?>";
		var BookImage = "<?= $BookImage?>";
		var return_all_book_info = "<?= $return_all_book_info?>";
		var return_all_reports_for_a_user = "<?= $return_all_reports_for_a_user?>";
		var return_all_reportsID_info = "<?= $return_all_reportsID_info?>";
		var send_messages = "<?= $send_messages?>";
		var check_in_msg_table = "<?= $check_in_msg_table?>";
		var isAccepted_in_report_table = "<?= $isAccepted_in_report_table?>";
		var searchInternalForAllUser = "<?= $searchInternalForAllUser?>";
		var blockOrNot = "<?= $blockOrNot?>";
		var confirmAndBlock = "<?= $confirmAndBlock?>";
	</script>
	<script type="text/javascript" src="<?php echo base_url("assets/customJS/customJS.js");?>"></script>
	<script type="text/javascript" src="<?php echo base_url("assets/customJS/globalUserSearch.js");?>"></script>
</html>