<html>
	<head>
		<?php $this->load->helper('url');?>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>User DashBoard</title>
		<link rel="stylesheet" href="<?php echo base_url("assets/css/bootstrap.css"); ?>"/>
		<script type="text/javascript" src="<?php echo base_url("assets/js/jquery.js"); ?>"></script>
		<script type="text/javascript" src="<?php echo base_url("assets/js/bootstrap.js"); ?>"></script>
		<!--<script type="text/javascript" src="<?php echo base_url("assets/js/jquery-1.8.0.min.js"); ?>"></script>-->
		<link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap-glyphicons.css" rel="stylesheet"/>
		<link href='https://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
		<link rel="stylesheet" href="/Library/style/style.css"/>
	</head>
	<body>
		<nav class="navbar navbar-default navbar-fixed-top navcolor" >
			<div class="container-fluid">
				<ul class="nav navbar-nav">
					<li class="nav-logo"><a class="portrait" href="<?php echo site_url("home/index");?>"><img src = "/Library/image/icon.png"/></a></li>
					<li class="active homepos"><a href="<?php echo site_url("home/index");?>">Home</a></li>
					<li class="homepos"><a href="<?php echo site_url("home/about_us");?>">About Us</a></li>
				</ul>
				<ul class="nav navbar-nav navbar-right">
					<li class = "globalSearch">
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
							<a href="#" class="dropdown-toggle profile-image " data-toggle="dropdown">
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
													<a href="#" class="btn btn-primary btn-block btn-sm">View Profile</a>
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
	</body>
	<script>
        $('#lists li').on('click', function(){
            $('#reg_category').val($(this).text());
        });
        $('#search_lists li').on('click', function(){
            $('#reg_search_category').val($(this).text());
        });
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

			jQuery("body").on("click",'#result',function(ev){ 
				var $clicked = $(ev.target);
				var $name = $clicked.find('.name').html();
				var decoded = $("<div/>").html($name).text();
				$('#searchid').val(decoded);
			});
			jQuery("body").on("click",document, function(ev) { 
				var $clicked = $(ev.target);
				if (! $clicked.hasClass("search")){
				jQuery("#result").fadeOut(); 
				}
			});
			$('#searchid').click(function(){
				jQuery("#result").fadeIn();
			});
		});
    </script>
</html>