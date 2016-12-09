<html>
<head>
	<?php $this->load->helper('url');?>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>User Profile</title>
		<link rel="stylesheet" href="<?php echo base_url("assets/css/bootstrap.css"); ?>"/>
		<script type="text/javascript" src="<?php echo base_url("assets/js/jquery.js"); ?>"></script>
		<script type="text/javascript" src="<?php echo base_url("assets/js/bootstrap.js"); ?>"></script>
		<link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap-glyphicons.css" rel="stylesheet"/>
		<link href='https://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
		<link rel="stylesheet" href="/Library/style/style.css"/>
</head>
<body>
 	<?php 
	$data['id'] = $id;
	$this->load->view("header_view", $data);
	?>
	<div class="container-fluid">
		<div class = "jjumbotron user-profile-view">
			<div class="viewprofile-image">
				<?php 
					if($user->imageLink=='') : ?>
						<img src="/Library/defaults/user-default.png" class="img-circle" height="200" width="200"/>
						<a href="javascript:void(0)"  data-toggle = "modal" data-target = "#myProfileModal">
							<span class="glyphicon glyphicon-pencil edit-view-profile-img"></span>
						</a>
				<?php else: ?>
						<img src="/Library/userdp/<?php echo $user->imageLink; ?>" class="img-circle" height="200" width="200"/>
						<a href="javascript:void(0)" onClick = "edit_profile_poster('<?php echo $id;?>')" data-toggle = "modal" data-target = "#myProfileModal">
							<span class="glyphicon glyphicon-pencil edit-view-profile-img"></span>
						</a>
				<?php endif; ?>
			</div>
			<div class="about-profile-view">
				<h1><?php echo $user->firstName.' '; echo $user->lastName ?></h1>
				<p>DOB:<b><?php echo $user->dateOfBirth ?></b></p>
				<p>Member Since: <b><?php echo $user->memberSince ?></b></p>
				<p>E-mail: <b><?php echo $user->eMail ?></b></p>
				<p>Contact No: <b><?php echo $user->contactNo?></b></p>
			</div>
			<div class="book-info">
				<div class="balance">
					<h1>Total Balance</h1>
					<p>Aikhane taka show korabi</p>
				</div>
				<div class="total-book">
					<h1>Total Books</h1>
					<p>Aikhane total boi koyta show korabi</p>
				</div>
				<div class="sold-book">
					<h1>Sold Books</h1>
					<p>Aikhane koita boi sell hoise show korabi</p>
				</div>
			</div>
		</div>
	</div>
	<div class = "container"><!-- Modal Of Edit profile poster-->
		   <div class="modal fade" id="myProfileModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
							<h4 class="modal-title text-center" id="myModalLabel"><b>Edit Profile picture</b></h4>
						</div>
					    <div class="modal-body form">
							<form action="#" id="formss" class="form-horizontal" name = "forms">
								<input type="hidden" value="" name="userID"/>
								<div class="form-body">
									<div class="form-group">
										<div class="col-md-9">
											<input id="imageLink" type="file" name = "imageLink" >
											<span class="help-block"></span><br>
										</div>
									</div>
								</div>
							</form>
					    </div>
					    <div class="modal-footer">
							<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
							<a class="btn btn-info" id="btn_confirm" onClick = "saveProfile()" name="btn_confirm">Confirm</a>
					    </div>
					</div>
				</div>
		   </div>
		</div>
</body>
<script>
		function saveProfile(){
			var data = new FormData($('#formss')[0]);
			$.ajax({
				type:"POST",
				url:"<?php echo site_url('user_dash/profile_cover_edit');?>",
				data:data,
				mimeType: "multipart/form-data",
                contentType: false,
                cache: false,
                processData: false,
				success:function(data)
				{
                    $('#myProfileModal').modal('hide');
					location.reload();
				}
			});
		}
</script>
</html>