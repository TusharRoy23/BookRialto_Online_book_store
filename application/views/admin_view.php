<html>
	<head>
		<?php $this->load->helper('url');?>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Admin DashBoard</title>
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
		?>
		<div class = "container-fluid">
			<center>
				<div class = "allUsers">
					<a href = "<?php echo site_url('admin/allUsers')?>" target="_blank">
						<img src = "/Library/defaults/allUsers.png" style = "width:230px;">
					</a>
				</div>
				<div class = "allReports">
					<a href = "<?php echo site_url('admin/allReports')?>" target="_blank">
						<img src = "/Library/defaults/allReports.png" style = "width:230px;">
					</a>
				</div>
				<div class = "allBooks">
					<a href = "<?php echo site_url('admin/allBooks')?>" target="_blank">
						<img src = "/Library/defaults/allBooks.png" style = "width:230px;">
					</a>
				</div>
			</center>
		</div>
	</body>
</html>