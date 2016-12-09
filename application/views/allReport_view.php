<html>
	<head>
		<?php $this->load->helper('url');?>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>All Reports</title>
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
		?>
		<div class = "userGallary" id = "userGallary">
			<?php if(empty($reports)):?>
				<div class = "well well-lg" id = "No_books">
					<h3 class = "text-center" style = "color:red;"><b>No Reports</b></h3>
				</div>
			<?php else:?>
				<table class="table table-striped table-bordered table-hover table-inverse">
					<thead>
						<tr>
							<th><b>Book Cover</b></th>
							<th><b>Book Name</b></th>
							<th><b>Owner Name</b></th>
							<th><b>Reporter Name</b></th>
							<th><b>Report Topic</b></th>
							<th></th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($reports as $report):?>
							<tr>
								<td>
									<?php if ($report->coverImg =='') :?>
										<img class = "img-size-in-table" src = "<?php echo base_url('defaults/noCover.png'); ?>"/>
									<?php else:?>
										<img class = "img-size-in-table" src = "<?php echo base_url('bookcover/'.$report->coverImg); ?>"/>
									<?php endif;?>
								</td>
								<td><p id = "bookName"><?php echo $report->bookName; ?></p></td>
								<td><p id = "name"><?php echo $report->ownerFN .' '.$report->ownerLN;?></p></td>
								<td><p id = "reporterName"><?php echo $report->repFN .' '.$report->repLN;?></p></td>
								<td><p id = "reportTopic"><?php echo $report->reports?></p></td>
								<td><a class = "btn btn-danger send_message" onClick = "sendMsg()">Send Message</a></td>
							</tr>
						<?php endforeach;?>
					</tbody>
				</table>
			<?php endif;?>
		</div>
	</body>
</html>