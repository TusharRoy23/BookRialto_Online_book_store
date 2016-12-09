<html>
	<head>
		<?php $this->load->helper('url');?>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>About Us</title>
		<link rel="stylesheet" href="<?php echo base_url("assets/css/bootstrap.css"); ?>"/>
		<script type="text/javascript" src="<?php echo base_url("assets/js/jquery.js"); ?>"></script>
		<script type="text/javascript" src="<?php echo base_url("assets/js/bootstrap.js"); ?>"></script>
		<link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap-glyphicons.css" rel="stylesheet">
		<link href='https://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
		<link rel="stylesheet" href="/Library/style/style.css">
	</head>
	<body>
		<?php 
		$name = $user->userName;
		if($name == 'adminone'):
			$data['id']= 'adminone';
		else:
			$data['id']= $id;
		endif;
		$this->load->view('header_view',$data)?>
		<div>
			<div class="head1">
				<p>MISSION </p>
			</div>
			<div class="head2">
				<p>VISION </p>
			</div>
			<div class="head3">
				<p>GOAL</p>
			</div>
		</div>
		<div class="mydiv">
			<div id="myCarousel" class="carousel slide text-center" data-ride="carousel">
				<!-- Indicators -->
				<ol class="carousel-indicators">
					<li data-target="#myCarousel" data-slide-to="0" class="active"></li>
					 <li data-target="#myCarousel" data-slide-to="1"></li>
					 <li data-target="#myCarousel" data-slide-to="2"></li>
				</ol>
				<!-- Wrapper for slides -->
				<div class="carousel-inner" role="listbox">
					  <div class="item active">
						<h4>Spred knowledge among everyone and enhance the power of wisdom.<br></h4>
					  </div>
					  <div class="item">
						<h4>Share your knowledge to the rest of the world hidden in the linesof the books . <br/>Make books available to everyone and keep your library running with you anywhere you go.<br></h4>
					  </div>
					  <div class="item">
						<h4>Increase the habbit of reading book, being able 
						to store and read books online and also <strong>share</strong> with others</h4>
					  </div>
				</div>
				<!-- Left and right controls -->
				<a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
				  <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
				  <span class="sr-only">Previous</span>
				</a>
				<a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
				  <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
				  <span class="sr-only">Next</span>
				</a>
			</div>
		</div>
	</body>
</html>