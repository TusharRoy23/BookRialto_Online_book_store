<html>
	<head>
		<?php $this->load->helper('url');?>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Requested Books</title>
		<link rel="stylesheet" href="<?php echo base_url("assets/css/bootstrap.css"); ?>"/>
		<script type="text/javascript" src="<?php echo base_url("assets/js/jquery.js"); ?>"></script>
		<script type="text/javascript" src="<?php echo base_url("assets/js/bootstrap.js"); ?>"></script>
		<link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap-glyphicons.css" rel="stylesheet">
		<link href='https://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
		<link rel="stylesheet" href="/Library/style/style.css">
	</head>
	<body>
		<?php 
		$data['id'] = $id;
		$this->load->view("header_view", $data);?>
		<div class = "bookGallary" id = "gallary">
			<?php if(empty($message)): ?>
				<div class = "well well-lg" id = "No_books">
					<h3 class = "text-center" style = "color:red;"><b>No Users</b></h3>
				</div>
			<?php else:
					foreach ($message as $msg):?>
					<div class = "book-img-gal" id = "img_gal">
						<?php if ($msg->imageLink =='') :?>
							<img class = "img-size" src = "<?php echo base_url('defaults/user-default.png'); ?>"/>
						<?php else:?>
							<img class = "img-size" src = "<?php echo base_url('userdp/'.$msg->imageLink); ?>"/>
						<?php endif;?>
						<div class = "descrip">
							<p class = "title"><b> <?php echo $msg->firstName .' '.$msg->lastName;?> </b>
								<span></span>
							</p>
							<p class = "author">E-mail: <b><?php echo $msg->eMail; ?></b>
								<span></span>
							</p>
							<p class = "owner"><b>Date: <?php echo $msg->msgDate; ?> </b>
							</p>
							<p class = "msgDescrib">
								Message: <textarea id="reportTxt" rows="4" cols="27" readonly>
									<?php echo $msg->msg;?>
								</textarea>
							</p>
						</div>
					</div>
					<?php endforeach; 
					endif;?>
		</div>
	</body>
</html>