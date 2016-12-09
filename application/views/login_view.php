<html>
	<head>
		<?php $this->load->helper('url');?>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Login Form</title>
		<link rel="stylesheet" href="<?php echo base_url("assets/css/bootstrap.css"); ?>"/>
		<script type="text/javascript" src="<?php echo base_url("assets/js/jquery.js"); ?>"></script>
		<script type="text/javascript" src="<?php echo base_url("assets/js/bootstrap.js"); ?>"></script>
		<link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap-glyphicons.css" rel="stylesheet">
		<link rel="stylesheet" href="/Library/style/style.css">
	</head>
	<body class = "body-background-img">
		<?php 
		$data['id']="null";
		$this->load->view("header_view",$data)?>
		<div class = "container centerdiv">
		<div class="col-sm-4 col-md-5 col-md-offset-2">
			<div class="account-wall">
				<div class = "form-signin">

				<?php

				 if(isset($message)){
					echo '<div class="alert alert-success text-center"><b>'. $message .'</b> please,<br> Check your E-mail.</div>';
				}
				if(isset($error)){
					echo $error;
				}
					?>
					<legend><h3 class="text-left form-title"><b>Login</b></h3></legend>
				<?php 
					$attributes = array("id" => "loginform", "name" => "loginform");
					echo form_open("login/index", $attributes);?>
					<input class="form-control" id="txt_username" name="txt_username" placeholder="Username" type="text" value="<?php echo set_value('txt_username'); ?>" /></br>
                    <span class="text-danger"><?php echo form_error('txt_username'); ?></span></br>
					<input class="form-control" id="txt_password" name="txt_password" placeholder="Password" type="password" value="<?php echo set_value('txt_password'); ?>" /></br>
                    <span class="text-danger"><?php echo form_error('txt_password'); ?></span></br>
					<input id="btn_login" name="btn_login" type="submit" class="btn btn-lg btn-primary btn-block" value="Login" /></br>
					<a href="<?php echo site_url('reg_user');?>"  class="regfont" ><b><u>Not a member yet?Register here..</u></b></a>
					<?php echo form_close(); ?>
					<?php echo $this->session->flashdata('msg'); ?>
				</div>
			</div>
		</div>
	</div>
	</body>
</html>