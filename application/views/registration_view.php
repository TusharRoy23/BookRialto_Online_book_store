<html>
	<head>
		<?php $this->load->helper('url');?>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Registration Form</title>
		<link rel="stylesheet" href="<?php echo base_url("assets/css/bootstrap.css"); ?>"/>
		<script type="text/javascript" src="<?php echo base_url("assets/js/jquery.js"); ?>"></script>
		<script type="text/javascript" src="<?php echo base_url("assets/js/bootstrap.js"); ?>"></script>
		<link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap-glyphicons.css" rel="stylesheet">
		<link rel="stylesheet" href="/Library/style/style.css">
	</head>
	<body class = "body-background-img">
		<?php 
		$data['id']="null";
		$this->load->view("header_view", $data)?>
	<div class = "container">
		<div class = "regscene">
		<h2><img class= "bookimg" src ="<?php echo base_url('image/book.png'); ?>"><span class="share">Share your books </span></h2>
		<h2><img class= "ideaimg" src ="<?php echo base_url('image/idea.png'); ?>"><span class="leftspace">Share your knowledge</span></h2>
		<span class = "space"><p>Thousands of people use <b>BookRialto</b> <br>
		to share their PDFs with others</p></span>
		</div>
		<div class = "regform">
			<div class = "form-signin">
				<legend><h3 class="text-left form-title"><b>Sign Up</b></h3></legend>
				        <?php   
						$attributes = array("id" => "registraform", "name" => "registraform", );
						echo form_open("reg_user/index", $attributes);
						?>
						<input  class="form-control" id="reg_username" name="reg_username" placeholder="Username" type="text" value="<?php echo set_value('reg_username'); ?>"/>
						<span class="text-danger"><?php echo form_error('reg_username'); ?> </span></br>
						<input class="form-control" id="reg_password" name="reg_password" placeholder="Password" type="password" value="<?php echo set_value('reg_password'); ?>" />
						<span class="text-danger"><?php echo form_error('reg_password'); ?></span></br>
						<input class="form-control" id="reg_firstname" name="reg_firstname" placeholder="Firstname" type="text" value="<?php echo set_value('reg_firstname'); ?>" />
						<span class="text-danger"><?php echo form_error('reg_firstname'); ?></span></br>
						<input class="form-control" id="reg_lastname" name="reg_lastname" placeholder="Lastname" type="text" value="<?php echo set_value('reg_lastname'); ?>" />
						<span class="text-danger"><?php echo form_error('reg_lastname'); ?></span></br>
						<input class="form-control" id="reg_email" name="reg_email" placeholder="example@mail.com" type="text" value="<?php echo set_value('reg_email'); ?>" />
						<span class="text-danger"><?php echo form_error('reg_email'); ?></span></br>
						<input class="form-control" id="reg_address" name="reg_address" placeholder="Address" type="text" value="<?php echo set_value('reg_address'); ?>" />
						<span class="text-danger"><?php echo form_error('reg_address'); ?></span></br>
						<input class="form-control" id="reg_phn_number" name="reg_phn_number" placeholder="Phone Number" type="text" value="<?php echo set_value('reg_phn_number'); ?>" />
						<span class="text-danger"><?php echo form_error('reg_phn_number'); ?></span></br>
						<div class="form-actions">
							<input id="btn_confirm" name="btn_confirm" type="submit" class="btn btn-info" value="Confirm"  />
						</div>
						<?php echo form_close(); ?>
						<?php echo $this->session->flashdata('msg'); ?>
			</div>
		</div>
	</div>
	</body>

</html>
