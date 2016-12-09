<html>
	<head>
		<?php $this->load->helper('url');?>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Book Add</title>
		<link rel="stylesheet" href="<?php echo base_url("assets/css/bootstrap.css"); ?>"/>
		<script type="text/javascript" src="<?php echo base_url("assets/js/jquery.js"); ?>"></script>
		<script type="text/javascript" src="<?php echo base_url("assets/js/bootstrap.js"); ?>"></script>
		<link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap-glyphicons.css" rel="stylesheet"/>
		<link rel="stylesheet" href="/BookRialto/style/style.css"/>
	</head>
	<body>
	<?php 
		$data['id'] = $id;
		$this->load->view("header_view", $data);
	?>
		<div class = "container">
			<?php
				if(isset($success_msg))
					echo $success_msg;
				?>
			<p class = "head-of-add">Add your book below</p>
			<div class = "book-add-form jumbotron">
				<div class = "form-signin">
					<?php   
						$attributes = array("id" => "registraform", "name" => "registraform");
						echo form_open_multipart("reg_book/index", $attributes);
					?>
					<input class="form-control" id="reg_bookname" name="reg_bookname" placeholder="Book Name" type="text" value="<?php echo set_value('reg_bookname'); ?>"/>
					<span class="text-danger" style = "font-size:5px;"><?php echo form_error('reg_bookname'); ?> </span></br>
					<input class="form-control" id="reg_authorname" name="reg_authorname" placeholder="Author Name" type="text" value="<?php echo set_value('reg_authorname'); ?>" />
					<span class="text-danger"><?php echo form_error('reg_authorname'); ?></span></br>
					<div class="input-group">                                            
							<input class="form-control" id="reg_category" name="reg_category" placeholder="Category" type="text" value="<?php echo set_value('reg_category'); ?>"/>
							
							<div class="input-group-btn">
								<button type="button" class="btn btn-primary dropdown-toggle bt-size" data-toggle="dropdown">
									<span class="caret"></span>
								</button>
								<ul id="lists" class="dropdown-menu">
									<li>Romance</li>
									<li>Fiction</li>
									<li>Ideolgy</li>
									<li>Thriller</li>
									<li>Nobel</li>
									<li>Programing Language</li>
									<li>Other</li>
								</ul>
							</div>
						</div>
						<span class="text-danger"><?php echo form_error('reg_category'); ?></span>
						</br>
						<label>Cover Image Upload</label>
						<input id="coverupload" name="coverupload" type="file"></br>
						<?php if (isset($covererror)):?>
						<span class= "alert alert-danger"><?php echo $covererror;?></span>
						<?php endif; ?>
						<label for="comment">Description:</label>
						<textarea class="form-control" rows="5" name="comment"></textarea><br>
						<label class = "add-book-pa">Do you want to make this book Lendable to others ?</label><br>
						<input type='radio' name='lendable' value="1" <?php echo set_radio('lendable', '1', TRUE); ?> />Yes
						<input type='radio' name='lendable'  value="0"<?php echo set_radio('lendable', '0');?>/>No<br>
						<label class = "add-book-pa">Do you want to make this book Buyable to others ?</label><br>
						<input type='radio' name='buyable' value="1" <?php echo set_radio('buyable', '1', TRUE); ?> />Yes
						<input type='radio' name='buyable' value="0"<?php echo set_radio('buyable', '0'); ?>/>No</br>
						
						<label class = "add-book-pa">Do you want to make this book visibile to others ?</label><br>
						<input type='radio' name='showable' value="1" <?php echo set_radio('showable', '1', TRUE); ?> />Yes
						<input type='radio' name='showable' value="0"<?php echo set_radio('showable', '0'); ?>/>No</br>
						<div class="form-actions">
							<a id="btn_back" href = "<?php echo site_url('user_dash/index'); ?>" name="btn_back"  class="btn btn-info">Back</a>
							<input id="btn_confirm" name="btn_confirm" type="submit" class="btn btn-info" value="Confirm" />
						</div>
					<?php echo form_close();?>
				</div>
			</div>		
		</div>
	</body>
	<script>
		$('#lists li').on('click', function(){
			$('#reg_category').val($(this).text());
		});
	</script>
</html>