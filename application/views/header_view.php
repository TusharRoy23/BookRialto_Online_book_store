<html>
	<head>
		<?php $this->load->helper('url');?>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Home</title>
		<link rel="stylesheet" href="<?php echo base_url("assets/css/bootstrap.css"); ?>"/>
		<script type="text/javascript" src="<?php echo base_url("assets/js/jquery.js"); ?>"></script>
		<script type="text/javascript" src="<?php echo base_url("assets/js/bootstrap.js"); ?>"></script>
		<link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap-glyphicons.css" rel="stylesheet">
		<link href='https://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
		<link rel="stylesheet" href="/Library/style/style.css">
	</head>
	<body>
			<?php if($id == "null"):?>
			<nav class="navbar navbar-default navbar-fixed-top">
				<div class="container-fluid">
					<ul class="nav navbar-nav">
						<li class="nav-logo"><a class="portrait" href="<?php echo site_url("home/index")?>"><img src = "/Library/image/icon.png"/></a></li>
						<li class="active homepos"><a href="<?php echo site_url("home/index")?>">Home</a></li>
						<li class="homepos"><a href="<?php echo site_url("home/about_us");?>">About Us</a></li>
					</ul>
					<ul class="nav navbar-nav navbar-right">
						<li class = "nav-search homepos">
							<form action= "<?php  echo site_url('search_book/ajaxSearch');?>" method = "POST">
								<div class="form-group">
								<!-- dropdown starts -->
									<div class="input-group">
										<input type="text" class="form-control homepos search" id="searchid" placeholder="Search by book title"/>
										<div id="result">
											<br>
										</div>
										<!-- dropdown search-->
										<span class="input-group-btn">
											<button type="submit" class="btn btn-default homepos searchbtn">
												<span class="glyphicon glyphicon-search"></span>
											</button>
										</span>
									</div>
								</div>
							</form>
						</li>
						<li class="homepos"><a href="<?php echo site_url('reg_user');?>"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
						<li class="homepos"><a href="<?php echo site_url('login');?>"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
					</ul>
				</div>
			</nav>
		<?php else:
				if($id == 'adminone'):?>
					<nav class = "navbar navbar-default navbar-fixed-top navcolor">
						<div class="container-fluid">
							<ul class="nav navbar-nav">
								<li class="nav-logo"><a class="portrait" href="<?php echo site_url("admin/index");?>"><img src = "/Library/image/icon.png"/></a></li>
								<li class="active homepos"><a href="<?php echo site_url("admin/index");?>">Home</a></li>
								<li class="homepos"><a href="<?php echo site_url("admin/load_about_us");?>">About Us</a></li>
							</ul>
							<ul class="nav navbar-nav navbar-right">
								<li class = "nav-search homepos">
									<form action= "<?php  echo site_url('search_book/ajaxSearch');?>" method = "POST">
										<div class="form-group">
										<!-- dropdown starts -->
											<div class="input-group">
												<input type="text" class="form-control homepos search" id="searchid" placeholder="Search by book title"/>
												<div id="result">
													<br>
												</div>
												<!-- dropdown search-->
												<span class="input-group-btn">
													<button type="submit" class="btn btn-default homepos searchbtn">
														<span class="glyphicon glyphicon-search"></span>
													</button>
												</span>
											</div>
										</div>
									</form>
									<li class="dropdown homepos">
										<a href="#" class="dropdown-toggle profile-image" data-toggle="dropdown">
										<?php 
											if($user->imageLink=='') : ?>
											<img src="/Library/defaults/user-default.png" class="img-circle special-img glowing-border"/>
										<?php else: ?>
											<img src="/Library/userdp/<?php echo $user->imageLink; ?>" class="img-circle special-img "/>
										<?php endif; ?>
										</a>
										<ul class="dropdown-menu">
											<li>
												<div class="navbar-login">
													<div class="row">
														<div class="col-lg-4">
															<p class="text-center">
																<?php 
																	if($user->imageLink=='') : ?>
																	<span>
																		<img src="/Library/defaults/user-default.png" class="drop-img"/>
																	</span>
																	<?php else: ?>
																	<span>
																		<img src="/Library/userdp/<?php echo $user->imageLink; ?>" class="drop-img"/>
																	</span>
																<?php endif; ?>													
															</p>
														</div>
														<div class="col-lg-8">
															<p class="text-left ">Hi <strong><?php echo $user->firstName; ?></strong></p>
															<!--<p class="text-left">
																<a href="<?php echo site_url('user_dash/view_profile');?>" class="btn btn-primary btn-block btn-sm">View Profile</a>
															</p>
															<p class="text-left">
																<a href="<?php echo site_url('user_dash/request_of_books');?>" target="_blank" class="btn btn-primary btn-block btn-sm">Request of books(<b style="color:red;"><?php echo sizeof($transaction);?></b>)</a>
															</p>
															<p class = "text-left">
																<a href = "<?php echo site_url('user_dash/lendOrBuyBooks');?>" target="_blank" class = "btn btn-primary btn-block btn-sm">Lend/Buy Books</a>
															</p>-->
														</div>
													</div>
												</div>
											</li>
											<li class="divider"></li>
											<li>
												<div class="navbar-login navbar-login-session">
													<div class="row">
														<div class="col-lg-12">
															<p>
																<a href="<?php echo site_url('login/logout');?>" class="btn btn-danger btn-block">Logout</a>
															</p>
														</div>
													</div>
												</div>
											</li>
										</ul>
									</li>
								</li>
							</ul>
						</div>
					</nav>
				<?php else:?>
					<nav class="navbar navbar-default navbar-fixed-top navcolor" >
						<div class="container-fluid">
							<ul class="nav navbar-nav">
								<li class="nav-logo"><a class="portrait" href="<?php echo site_url("user_dash/index");?>"><img src = "/Library/image/icon.png"/></a></li>
								<li class="active homepos"><a href="<?php echo site_url("user_dash/index");?>">Home</a></li>
								<li class="homepos"><a href="<?php echo site_url("user_dash/load_about_us");?>">About Us</a></li>
							</ul>
							<ul class="nav navbar-nav navbar-right">
								<li class = "nav-search homepos">
									<form action= "<?php  echo site_url('search_book/ajaxSearch');?>" method = "POST">
										<div class="form-group">
										<!-- dropdown starts -->
											<div class="input-group">
												<input type="text" class="form-control homepos search" id="searchid" placeholder="Search by book title"/>
												<div id="result">
													<br>
												</div>
												<!-- dropdown search-->
												<span class="input-group-btn">
													<button type="submit" class="btn btn-default homepos searchbtn">
														<span class="glyphicon glyphicon-search"></span>
													</button>
												</span>
											</div>
										</div>
									</form>
									<li class="dropdown homepos">
										<a href="#" class="dropdown-toggle profile-image" data-toggle="dropdown">
										<?php 
											if($user->imageLink=='') : ?>
											<img src="/Library/defaults/user-default.png" class="img-circle special-img glowing-border"/>
										<?php else: ?>
											<img src="/Library/userdp/<?php echo $user->imageLink; ?>" class="img-circle special-img "/>
										<?php endif; ?>
											<!--<span class="glyphicon glyphicon-chevron-down"></span>-->
										</a>
										<ul class="dropdown-menu">
											<li>
												<div class="navbar-login">
													<div class="row">
														<div class="col-lg-4">
															<p class="text-center">
																<?php 
											if($user->imageLink=='') : ?>
													<span>
													<img src="/Library/defaults/user-default.png" class="drop-img"/>
													</span>
											<?php else: ?>
													<span>
													<img src="/Library/userdp/<?php echo $user->imageLink; ?>" class="drop-img"/>
													</span>

											<?php endif; ?>													
															</p>
														</div>
														<div class="col-lg-8">
															<p class="text-left ">Hi <strong><?php echo $user->firstName; ?></strong></p>
															<p class="text-left">
																<a href="<?php echo site_url('user_dash/view_profile');?>" class="btn btn-primary btn-block btn-sm">View Profile</a>
															</p>
															<p class="text-left">
																<a href="<?php echo site_url('user_dash/request_of_books');?>" target="_blank" class="btn btn-primary btn-block btn-sm">Request of books(<b style="color:red;"><?php echo sizeof($transaction);?></b>)</a>
															</p>
															<p class = "text-left">
																<a href = "<?php echo site_url('user_dash/lendOrBuyBooks');?>" target="_blank" class = "btn btn-primary btn-block btn-sm">Lend/Buy Books</a>
															</p>
															<p class = "text-left">
																<a href = "<?php echo site_url('user_dash/message');?>" target= "_blank" class = "btn btn-primary btn-block btn-sm">Message(<b style = "color:red;"><?php echo sizeof($message);?></b>)</a>
															</p>
														</div>
													</div>
												</div>
											</li>
											<li class="divider"></li>
											<li>
												<div class="navbar-login navbar-login-session">
													<div class="row">
														<div class="col-lg-12">
															<p>
																<a href="<?php echo site_url('login/logout');?>" class="btn btn-danger btn-block">Logout</a>
															</p>
														</div>
													</div>
												</div>
											</li>
										</ul>
									</li>
								</li>
							</ul>
						</div>
					</nav>
				<?php endif;?>
		<?php endif;?>
		<div class = "container"><!--For global Search modal-->
			<div class="modal fade" id="showSearchedModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			    <div class="modal-dialog">
					 <div class="modal-content">
						  <div class="modal-header">
							   <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
							   <h4 class="modal-title" id="myModalLabel"><b>Books</b></h4>
						  </div>
						  <div class="modal-body form" id = "tryForm">
						   		<div id = "globalSearchResult" >
									<div  class="form-horizontal">
										<img id = "cov" name = "coverImg" src=""/>
									</div>
									<div class = "buyAndLendButton">
										<center>
											<button id = "lendablebtn" onClick ="transactions('1')" class = "btn btn-success">Lend</button>
											<button id = "buyablebtn" onClick ="transactions('2')" class = "btn btn-success">Buy</button>
										</center>
									</div>
									<div class = "details" >
										OWNER NAME: <b><p id="ownerName"></p></b>
										BOOK NAME: <b><p id="bookName"></p></b>
										AUTHOR NAME: <b><p id="authorName" ></p></b>
										Description: <textarea id="description" rows="6" cols="25" readonly></textarea><br><br>
													 <img id = "lendables" src="" />
													<b><p class = "isLendablePrice" id = "isLendablePrice"></p></b>
													<p class = "lendtaka">TAKA</p><br>
													 <img id = "buyables" src="" />
													<b><p class = "isBuyablePrice" id = "isBuyablePrice"></p></b>
													<p class = "buytaka">TAKA</p><br>		 
									</div>
								</div>
						  </div>
						  <div class="modal-footer">
						  </div>
					 </div>
				</div>
   			</div>
		</div>
		<div class = "container">
			<div class="modal fade" id="ownerBookModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			    <div class="modal-dialog">
					 <div class="modal-content">
						  <div class="modal-header">
							   <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
							   <h4 class="modal-title" id="myModalLabel"><b>Book Rialto</b></h4>
						  </div>
						  <div class="modal-body">
						   		<p class="text-center confm"> <b>You can't lend/buy your books</b> </p>
						  </div>
						  <div class="modal-footer">
							  	<button type="button" class="btn btn-default" data-dismiss="modal">OK</button>
						  </div>
					 </div>
				</div>
   			</div>
		</div>
		<div class = "container">
			<div class="modal fade" id="confirmBookModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			    <div class="modal-dialog">
					 <div class="modal-content">
						  <div class="modal-header">
							   <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
							   <h4 class="modal-title" id="myModalLabel"><b>Book Rialto</b></h4>
						  </div>
						  <div class="modal-body">
						   		<p class="text-center confm"> <b>You will notify later for your request, Thank you</b> </p>
						  </div>
						  <div class="modal-footer">
							  	<button type="button" class="btn btn-default" data-dismiss="modal">OK</button>
						  </div>
					 </div>
				</div>
   			</div>
		</div>
		<div class = "container">
			<div class="modal fade" id="isActivated" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			    <div class="modal-dialog">
					 <div class="modal-content">
						  <div class="modal-header">
							   <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
							   <h4 class="modal-title" id="myModalLabel"><b>Book Rialto</b></h4>
						  </div>
						  <div class="modal-body">
						   		<p class="text-center confm"> <b>This Book is already active for you</b> </p>
						  </div>
						  <div class="modal-footer">
							  	<button type="button" class="btn btn-default" data-dismiss="modal">OK</button>
						  </div>
					 </div>
				</div>
   			</div>
		</div>
		<div class = "container">
			<div class="modal fade" id="onPending" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			    <div class="modal-dialog">
					 <div class="modal-content">
						  <div class="modal-header">
							   <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
							   <h4 class="modal-title" id="myModalLabel"><b>Book Rialto</b></h4>
						  </div>
						  <div class="modal-body">
						   		<p class="text-center confm"> <b>Your request is already accepted. Please wait for activation</b> </p>
						  </div>
						  <div class="modal-footer">
							  	<button type="button" class="btn btn-default" data-dismiss="modal">OK</button>
						  </div>
					 </div>
				</div>
   			</div>
		</div>
	</body>
	<script type="text/javascript" src="<?php echo base_url("assets/js/jquery.js"); ?>"></script>
	<script type="text/javascript" src="<?php echo base_url("assets/js/bootstrap.js"); ?>"></script>
	
	<script>
        $(function(){
			$(".search").keyup(function() //class name of input
			{ 
				var searchid = $(this).val();
				var dataString = 'search='+ searchid; // search in post method
				if(searchid !='')
				{
					$.ajax({
					type: "POST",
					url: "<?php echo site_url('search_book/ajaxSearch') ?>",
					data: dataString,
					cache: false,
					success: function(html)
					{
						$("#result").html(html).show();
					}
					});
				}
				return false;    
			});
		});
    </script>
	<script>
	function checksFor(bookID, ownerID, userID){
		//alert("owner: "+ownerID);
		var coverImages = "";
		$('#form')[0].reset();
		if(ownerID != userID){
			$('#showSearchedModal').modal('show');
			$.ajax({
			url : "<?php echo site_url('user_dash/ajax_searched_book')?>",
			data:{bookIDs:bookID},
			type: "POST",
			dataType: "JSON",
			success: function(data)
			{
				coverImages = data.coverImg;
				if(coverImages == ""){
					$('#cov').attr('src', "<?php echo base_url('defaults/noCover.png')?>");
				}
				else{
					$('#cov').attr('src', "<?php echo base_url('bookcover/')?>/"+data.coverImg);
				}
				window.ownerID = ownerID;
				window.bookID = bookID;
				$('#bookName').text(data.bookName);
				$('#authorName').text(data.authorName);
				$('#description').text(data.description);
				$('#ownerName').text(data.firstName +" "+data.lastName);
				$('#isLendablePrice').text(data.isLendablePrice);
				$('#isBuyablePrice').text(data.isBuyablePrice);
				if(data.isLendable == 0){
					$('#lendables').attr('src', "<?php echo base_url('defaults/notLendable.png')?>");
					$('#lendablebtn').prop('disabled', true);
				}
				if(data.isPurchasable == 0){
					$('#buyables').attr('src', "<?php echo base_url('defaults/notBuyable.png')?>");
					$('#buyablebtn').prop('disabled', true);
				}
				else if(data.isLendable == 1){
					$('#lendables').attr('src', "<?php echo base_url('defaults/Lendable.png')?>");
					$('#lendablebtn').prop('disabled', false);
				}
				else if(data.isPurchasable == 2){
					$('#buyables').attr('src', "<?php echo base_url('defaults/Buyable.png')?>");
					$('#buyablebtn').prop('disabled', false);
				}
			},
			error: function (jqXHR, textStatus, errorThrown)
			{
				alert('Error get data from ajax ' + bookID);
			}
		});
		}
		else{
			$('#showSearchedModal').modal('hide');
			$('#ownerBookModal').modal('show');
		}
	}
	function transactions(transactionsID){
		//alert("empty "+ window.bookID);
		var bookID = window.bookID;
		$.ajax({
			type: "GET",
			url: "<?php echo site_url('user_dash/is_Hired_Or_Not')?>/"+bookID,
			dataType: "JSON",
			success: function(datas){
				if(!datas){
					//alert("empty "+ window.bookID);
					$.ajax({
						type: "POST",
						url: "<?php echo site_url('user_dash/ajax_requested_book')?>",
						dataType: "JSON",
						data:{ownerID: window.ownerID, bookID: window.bookID, transType: transactionsID},
						success: function(res){
							$('#confirmBookModal').modal('show');
						},
						error: function (jqXHR, textStatus, errorThrown){
							alert("Not OK");
						}
					});
				}
				else{
					//alert("Not empty "+ window.bookID);
					if(datas.isActive == "0"){
						$('#onPending').modal('show');
					}
					else if(datas.isActive == "1"){
						$('#isActivated').modal('show');
					}
				}
			},
			error: function (jqXHR, textStatus, errorThrown){
				alert("Not OK");
			}
		});
	}
</script>
</html>