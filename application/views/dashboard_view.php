<html>
	<head>
		<?php $this->load->helper('url');?>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>User DashBoard</title>
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
		$this->load->view("header_view", $data);?>
		<div class = "container-fluid">
			<div class = "jumbotron user-profile">
				<?php 
								if($user->imageLink=='') : ?>
								<img src="/Library/defaults/user-default.png" class = "pro-img"/>
								<a href="javascript:void(0)"  data-toggle = "modal" data-target = "#myProfileModal">
									<span class="glyphicon glyphicon-pencil edit-profile-img"></span>
								</a>
							<?php else: ?>
								<img src="/Library/userdp/<?php echo $user->imageLink; ?>" class = "pro-img"/>
								<a href="javascript:void(0)" onClick = "edit_profile_poster('<?php echo $id;?>')" data-toggle = "modal" data-target = "#myProfileModal">
									<span class="glyphicon glyphicon-pencil edit-profile-img"></span>
								</a>
				<?php endif; ?>
				<?php //$this->load->model('book_model'); ?>
				<div class = "pro-details">
					<p class="text-center label-primary" style = "font-size:20px; color:#E1E8ED;"><b><?php echo $user->firstName.' '; echo $user->lastName ?></b></p>
					<p class="text-center" style = "font-size:15px; color:#6699CC">@<?php echo $user->userName; ?></p>
					<p class=" text-center" style = "font-size:15px;">Number of Book(s): <font color="#3366FF"><?php echo sizeof($books);?></font></p>
					<p class="text-center" style = "font-size:15px;" >Member Since: <font color="#3366FF"><?php echo date('F d, Y', strtotime($user->memberSince));?></font></p>
					<a class="btn btn-success" href = "<?php echo site_url('user_dash/add_book');?>" style = "position:absolute; left:100px; top:140px;">Add Book</a>
				</div>
			</div>
            <div class = "search-bar">
                <h1 class = "rialto-header" style ="color:#006666;">My Rialto</h1>
               <!-- the form starts here-->
                <?php   
                    $attributes = array("id" => "bookform", "name" => "bookform");
                    echo form_open("reg_book/index", $attributes);
                ?>
                    <div class = "text-bar">
                        <input class="form-control searchInternal" id = "searchInternal" name="searchInternal" placeholder="Search" type="text"/>
                    </div>
                <?php echo form_close(); ?>
            </div>
			<div class = "gallary" id = "gallary">
			<!-- Shuru -->
			<?php if(empty($books)): ?>
				<div class = "well well-lg" id = "No_books">
					<h3 class = "text-center" style = "color:red;"><b>No Books</b></h3>
				</div>
			<?php else:
					foreach ($books as $book):
					$bID = $book->bookID;?>
				<div class = "img-gal" id = "img_gal">
					<a href="javascript:void(0)" onClick = "edit_book('<?php echo $bID;?>')" data-toggle="modal" data-target="#editModal"> <!--Edit button-->
						<span class="glyphicon glyphicon-pencil edit-icon"></span>
					</a>
					<a href="#crossModal" data-href="<?php echo site_url('user_dash/delete_book/'.$book->bookID)?>" data-toggle="modal" data-target="#crossModal">
						<span class="glyphicon glyphicon-remove cross-icon"></span>
					</a>
					
					<?php if ($book->coverImg =='') :?>
							<img class = "img-size" src = "<?php echo base_url('defaults/noCover.png'); ?>"/>
								<a href="javascript:void(0)" onClick = "edit_poster('<?php echo $bID;?>')" data-toggle = "modal" data-target = "#myPosterModal">
									<span class="glyphicon glyphicon-pencil edit-icon-img"></span>
								</a>
							
						<?php else:?>
							<img class = "img-size" src = "<?php echo base_url('bookcover/'.$book->coverImg); ?>"/>
								<a href="javascript:void(0)" onClick = "edit_poster('<?php echo $bID;?>')" data-toggle = "modal" data-target = "#myPosterModal">
									<span class="glyphicon glyphicon-pencil edit-icon-img"></span>
								</a>
					<?php endif;?>
					<div class = "descrip">
						<p class = "title"><b> <?php echo $book->bookName; ?> </b>
							<span></span>
						</p>
						<p class = "author"><b><?php echo $book->authorName; ?></b>
							<span></span>
						</p>
						<p class = "des">
							<div class = "deslimit">
								<span><?php echo $book->description; ?></span>
							</div>
						</p>
						<?php if ($book->isLendable== 0) :?>
							<span class="label label-warning lendable" data-toggle="tooltip" title="The Book is not Lendable">Not Lendable</span>
						<?php elseif($book->isLendable== 1) :?>
							<span class="label label-success lendable" data-toggle="tooltip" title="The Book is Lendable">Lendable(<?php echo $book->isLendablePrice;?> TK)</span>
						<?php endif;?>

						<?php if ($book->isPurchasable== 0) :?>
							<span class="label label-warning buyable" data-toggle="tooltip" title="The Book is not Buyable">Not Buyable</span>
						<?php elseif($book->isPurchasable== 1) :?>
							<span class="label label-success buyable" data-toggle="tooltip" title="The Book is Buyable">Buyable(<?php echo $book->isBuyablePrice;?> TK)</span>
						<?php endif;?>
						
						<?php if ($book->showBooks == 0) :?>
							<span class="label label-warning showable" data-toggle="tooltip" title="The Book is not Showable">Not Showable</span>
						<?php elseif($book->showBooks == 1) :?>
							<span class="label label-success showable" data-toggle="tooltip" title="The Book is Showable">Showable</span>
						<?php endif;?>
						<a href="javascript:void(0)" onClick = "show_users('<?php echo $bID;?>')" class="btn btn-primary btn-xs request-btn">User <span class = "badge ret">
						<?php $total_users = $this->book_model->return_total_user_of_a_book($book->ownerID, $bID); 
							echo sizeof($total_users);?></span></a>
						<a class = "btn btn-primary btn-xs  watermarkImg" onClick = "watermark('<?php echo $bID;?>')">Watermark Image</a>
						<a href="javascript:void(0)" onClick = "add_pages('<?php echo $bID;?>')" data-toggle = "modal" data-target = "#myPagesModal" class="btn btn-primary btn-xs add-pages-btn">Add Pages</a>
						<a href="javascript:void(0)" onClick = "show_pages('<?php echo $bID;?>')" data-toggle = "modal"  class="btn btn-primary btn-xs small-btn">Show Book</a>
					</div>
				</div>
				
				<br>
				<?php endforeach; 
					endif;?>
				<!-- ekhan porjonto -->
			</div>
		</div>
		<div class = "container"><!--For delete-->
			<div class="modal fade" id="crossModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			    <div class="modal-dialog">
					 <div class="modal-content">
						  <div class="modal-header">
							   <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
							   <h4 class="modal-title" id="myModalLabel"><b>Confirm Delete</b></h4>
						  </div>
						  <div class="modal-body">
						   		<p class="text-center confm"> <b>Are Your Sure ?</b> </p>
						  </div>
						  <div class="modal-footer">
							  	<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
							  	<a class="btn btn-danger btn-ok">Delete</a>
						  </div>
					 </div>
				</div>
   			</div>
		</div>
		<div class = "container"><!--For watermark-->
			<div class="modal fade" id="waterMarkModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			    <div class="modal-dialog">
					 <div class="modal-content">
						  <div class="modal-header">
							   <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
							   <h4 class="modal-title" id="myModalLabel"><b>Confirm Delete</b></h4>
						  </div>
						  <div class="modal-body">
						   		<div  id="Test">
									<center>
										<img id = "waterImg" name = "waterImg" src=""/>
										<a onClick = "edit_watermark()">
											<span class="glyphicon glyphicon-pencil edit-water-img"></span>
										</a>
									</center>
								</div>
						  </div>
						  <div class="modal-footer">
							  	<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
							  	<a class="btn btn-danger btn-ok">ok</a>
						  </div>
					 </div>
				</div>
   			</div>
		</div>
		<div class = "container"><!-- Modal Of Edit watermark-->
		   <div class="modal fade" id="editWatermarkModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
							<h4 class="modal-title text-center" id="myModalLabel"><b>Upload Cover Image for this book</b></h4>
						</div>
					    <div class="modal-body form">
							<form action="#" id="watermark_form" class="form-horizontal" name = "forms">
								<input type="hidden" value="" name="bookID"/>
								<div class="form-body">
									<div class="form-group">
										<div class="col-md-9">
											<input id="watermarkImg" type="file" name = "watermarkImg" >
											<span class="help-block"></span><br>
										</div>
									</div>
								</div>
							</form>
					    </div>
					    <div class="modal-footer">
							<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
							<a class="btn btn-info" id="btn_confirm" onClick = "saveWatermark()" name="btn_confirm">Confirm</a>
					    </div>
					</div>
				</div>
		   </div>
		</div>
		<!-- Modal for show pages-->
		<div class = "container">
			<div class="modal fade" id="showPagesModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			    <div class="modal-dialog">
					 <div class="modal-content">
						  <div class="modal-header">
							   <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
							   <h4 class="modal-title" id="myModalLabel"><b>Show Book</b></h4>
						  </div>
						  <div class="modal-body" id = "showForm">
						   		<center>
									<div id="slide_cont">
										<img id="slideshow_image" src="<?php echo base_url('defaults/Start.png'); ?>">
									</div>
								</center>
						  </div>
						  <div class="modal-footer">
							<center>
							  	<button type="image" id="prev_image" class = "btn btn-success"></button>
								<button type="image" id="next_image" class = "btn btn-success"></button>
								<input type="hidden" id="img_no" value="0">
						    </center>
						  </div>
					 </div>
				</div>
   			</div>
		</div>
		<!-- Bootstrap modal for edit-->
		<div class = "container">
			<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							   <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
							   <h4 class="modal-title" id="myModalLabel"><b>Edit Book</b></h4>
						</div>
						<div class="modal-body form">
						   	<form action="#" id="form" class="form-horizontal">
							<input type="hidden" value="" name="bookID"/> 
								<div class="form-body">
									<div class="form-group">
										<label class="control-label col-md-3">Book Name</label>
										<div class="col-md-9">
											<input name="bookName" placeholder="Book Name" class="form-control" type="text" >
											<span class="help-block"></span><br>
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-md-3">Author Name</label>
										<div class="col-md-9">
											<input name="authorName" placeholder="Author Name" class="form-control" type="text">
											<span class="help-block"></span><br>
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-md-3">Category</label>
										<div class="col-md-9">
											<select name="category" class="form-control">
												<option value="">--Select Category--</option>
												<option value="romance">Romance</option>
												<option value="fiction">Fiction</option>
												<option value="ideology">Ideology</option>
												<option value="thriller">Thriller</option>
												<option value="programing language">Programing Language</option>
												<option value="other">Other</option>
											</select>
											<span class="help-block"></span><br>
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-md-3">Description</label>
										<div class="col-md-9">
											<textarea class="form-control" rows="5" name="description"></textarea>
											<span class="help-block"></span>
										</div>
									</div>
									<div class="form-group">
										<label class = "add-book-pa">Do you want to make this book Lendable to others ?</label><br>
										<div class="col-md-9">
											<select name="isLendable" class="form-control">
												<option value ="1">Yes</option>
												<option value ="0">No</option>
											</select>
											<span class="help-block"></span><br>
										</div>
										<label class = "add-book-pa">Do you want to make this book Buyable to others ?</label><br>
										<div class="col-md-9">
											<select name="isPurchasable" class="form-control">
												<option value ="1">Yes</option>
												<option value ="0">No</option>
											</select>
											<span class="help-block"></span><br>
										</div>
										<label class = "add-book-pa">Do you want to make this book Visible to others ?</label><br>
										<div class="col-md-9">
											<select name="showBooks" class="form-control">
												<option value ="1">Yes</option>
												<option value ="0">No</option>
											</select>
											<span class="help-block"></span><br>
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-md-3">Set a lendable price</label>
										<div class="col-md-9">
											<input name="lendablePrice" placeholder="Lendable Price" class="form-control" type="text" >
											<span class="help-block"></span><br>
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-md-3">Set a buyable price</label>
										<div class="col-md-9">
											<input name="buyablePrice" placeholder="buyable Price" class="form-control" type="text" >
											<span class="help-block"></span><br>
										</div>
									</div>
								</div>
							</form>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
							<a class="btn btn-danger btn-save" id="btnSave" onclick="save('<?php echo $id;?>')">Save</a>
						</div>
					</div>
				</div>
			</div>
		</div>
		
		<div class = "container"><!-- Modal Of Edit poster-->
		   <div class="modal fade" id="myPosterModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
							<h4 class="modal-title text-center" id="myModalLabel"><b>Upload Cover Image for this book</b></h4>
						</div>
					    <div class="modal-body form">
							<form action="#" id="forms" class="form-horizontal" name = "forms">
								<input type="hidden" value="" name="bookID"/>
								<div class="form-body">
									<div class="form-group">
										<div class="col-md-9">
											<input id="coverImg" type="file" name = "coverImg" >
											<span class="help-block"></span><br>
										</div>
									</div>
								</div>
							</form>
					    </div>
					    <div class="modal-footer">
							<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
							<a class="btn btn-info" id="btn_confirm" onClick = "savePoster()" name="btn_confirm">Confirm</a>
					    </div>
					</div>
				</div>
		   </div>
		</div>
		
		<div class = "container"><!-- Modal for pages addition-->
		   <div class="modal fade" id="myPagesModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
							<h4 class="modal-title text-center" id="myModalLabel"><b>Upload Cover Image for this book</b></h4>
						</div>
					    <div class="modal-body form">
							<form action="#" id="pagesform" class="form-horizontal" name = "pagesform">
								<input type="hidden" value="" name="bookID"  id = "bookID"/>
								<div class="form-body">
									<div class="form-group">
										<div class="col-md-9">
											<input id="pagesImg" type="file" name = "pagesImg" >
											<span class="help-block"></span><br>
										</div>
									</div>
								</div>
							</form>
					    </div>
					    <div class="modal-footer">
							<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
							<a class="btn btn-info" id="btn_confirm" onClick = "savePages()" name="btn_confirm">Confirm</a>
					    </div>
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
		<div class = "container"><!--There is no request-->
			<div class="modal fade" id="noReadableUsers" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			    <div class="modal-dialog">
					 <div class="modal-content">
						  <div class="modal-header">
							   <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
							   <h4 class="modal-title" id="myModalLabel"><b>Book Rialto</b></h4>
						  </div>
						  <div class="modal-body">
						   		<p class="text-center confm"> <b>No user for for this book</b> </p>
						  </div>
						  <div class="modal-footer">
							  	<button type="button" class="btn btn-default" data-dismiss="modal">OK</button>
						  </div>
					 </div>
				</div>
   			</div>
		</div>
		<div class = "container">
			<div class="modal fade" id="ShowReadableUsers" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			    <div class="modal-dialog">
					 <div class="modal-content">
						  <div class="modal-header">
							   <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
							   <h4 class="modal-title" id="myModalLabel"><b>Requested Users</b></h4>
						  </div>
						  <div class="modal-body" >
									<div  id="Test">
										<img id = "imgTest" name = "profileImg" src="<?php echo base_url('defaults/Start.png'); ?>"/>
										<div class = "details" >
											Name: <b><p id ="name"></p></b>
											E-mail: <b><p id = "email"></p></b>
											Contact: <b><p id = "contact"></p></b>
											Member Since: <b><p id = "member"></p></b>
											Duration(In days): <b><p id = "duration"></p></b><br><br>
											<span class="label label-success buyableBook" data-toggle="tooltip" title="Buyable for this user">Buyable</span>
											<span class="label label-success lendableBook" data-toggle="tooltip" title="Lendable for this user">Lendable</span>
										</div>
									</div>
									
						  </div>
						  <div class="modal-footer">
							  	<center>
									<button type="image" id="prevs_image" class = "btn btn-success"></button>
									<button type="image" id="nexts_image" class = "btn btn-success"></button>
									<input type="hidden" id="info_no" value="0">
								</center>
						  </div>
					 </div>
				</div>
   			</div>
		</div>
	</body>	
	<script>
	 	$('#crossModal').on('show.bs.modal', function(e) {
	 		$(this).find('.confm').innerHtml=$(e.relatedTarget).data('href');

            $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
        });
       $("a[data-target=#myPosterModal]").click(function(e) {
			e.preventDefault();
			var target = $(this).attr("href");

			// load the url and show modal on success
			$("#myPosterModal.modal-body").load(target, function() { 
				 $("#myPosterModal").modal("show"); 
			});
		});
	 </script>
	 <script>
		function saveWatermark(){
			var data = new FormData($('#watermark_form')[0]);
			  $.ajax({
               type:"POST",
               url:"<?php echo site_url('user_dash/book_watermark_edit');?>",
               data:data,
               mimeType: "multipart/form-data",
                contentType: false,
                cache: false,
                processData: false,
               success:function(data)
              {
                    $('#editWatermarkModal').modal('hide');
					location.reload();
               }
			});
		}
		function edit_watermark(){
			$('#watermark_form')[0].reset(); 
			$.ajax({
			url : "<?php echo site_url('user_dash/ajax_edit')?>/" + window.bookID,
			type: "GET",
			dataType: "JSON",
			success: function(data)
			{
				//alert('i am in ' + data);
				$('[name="bookID"]').val(data.bookID);
				$('[name="watermarkImg"]').val(data.watermarkImg);
				$('#editWatermarkModal').modal('show'); // show bootstrap modal when complete loaded
				$('.modal-title').text('Edit Watermark Image'); // Set title to Bootstrap modal title
			},
			error: function (jqXHR, textStatus, errorThrown)
			{
				alert('Error get data from ajax ' + bookid);
			}
		});
		}
		function watermark(bookID){
			//alert(bookID);
			window.bookID = bookID;
			$.ajax({
				type:"GET",
				url:"<?php echo site_url('user_dash/ajax_watermarkImg')?>/"+bookID,
				dataType: "JSON",
				success: function(data){
					$('#waterMarkModal').modal('show');
					if(data.watermarkImg){
						$('#waterImg').attr('src', '<?php echo base_url('watermark/')?>/'+ data.watermarkImg);
					}
					else{
						$('#waterImg').attr('src', '<?php echo base_url('watermark/watermark.png')?>');
					}
				},
				error: function (jqXHR, textStatus, errorThrown)
				{
					alert('Error get data from ajax ');
				}
			});
		}
	 </script>
	 <script>
		 $(function(){
			$(".searchInternal").keyup(function() //class name of input
			{ 
				var searchid = $('#searchInternal').val();
				var dataString = 'search='+ searchid; // search in post method
				if(searchid !='')
				{
					$.ajax({
					type: "POST",
					url: "<?php echo site_url('search_book/internal_book_search') ?>",
					data: dataString,
					cache: false,
					success: function(html)
					{
					$("#gallary").html(html).show();
					}
					});
				}
				else{
					$.ajax({
					type: "POST",
					url: "<?php echo site_url('search_book/internal_book_search') ?>",
					data: dataString,
					cache: false,
					success: function(html)
					{
					$("#gallary").html(html).show();
					}
					});
				}
				return false;    
			});
		});
    </script>
	<script>
		//var hellox; 
		function edit_book(bookID)
		{
			//var hellox = bookID;
			save_method = 'update';
			$('#form')[0].reset(); // reset form on modals
			$('.form-group').removeClass('has-error'); // clear error class
			$('.help-block').empty(); // clear error string

			//Ajax Load data from ajax
			$.ajax({
			url : "<?php echo site_url('user_dash/ajax_edit')?>/" + bookID,
			type: "GET",
			dataType: "JSON",
			success: function(data)
			{
				//alert('i am in ' + hellox);
				$('[name="bookID"]').val(data.bookID);
				$('[name="bookName"]').val(data.bookName);
				$('[name="authorName"]').val(data.authorName);
				$('[name="category"]').val(data.category);
				$('[name="description"]').val(data.description);
				$('[name="isLendable"]').val(data.isLendable);
				$('[name="isPurchasable"]').val(data.isPurchasable);
				$('[name="showBooks"]').val(data.showBooks);
				$('[name="lendablePrice"]').val(data.isLendablePrice);
				$('[name="buyablePrice"]').val(data.isBuyablePrice);
				$('#editModal').modal('show'); // show bootstrap modal when complete loaded
				$('.modal-title').text('Edit Book'); // Set title to Bootstrap modal title
			},
			error: function (jqXHR, textStatus, errorThrown)
			{
				alert('Error get data from ajax ' + bookID);
			}
		});
	}
	function save(id){
		$('#btnSave').text('saving...'); //change button text
		$('#btnSave').attr('disabled',true); //set button disable 
		var url;

    if(save_method == 'add') {
        //url = "<?php echo site_url('person/ajax_add')?>";
    } else {
        url = "<?php echo site_url('user_dash/ajax_update')?>";
    }

    // ajax adding data to database
    $.ajax({
        url : url,
        type: "POST",
        data: $('#form').serialize(),
        dataType: "JSON",
        success: function(data)
        {

            if(data.status) //if success close modal and reload ajax table
            {
                $('#editModal').modal('hide');
                location.reload();
            }
            else
            {
                for (var i = 0; i < data.inputerror.length; i++) 
                {
                    $('[name="'+data.inputerror[i]+'"]').parent().parent().addClass('has-error'); //select parent twice to select div form-group class and add has-error class
                    $('[name="'+data.inputerror[i]+'"]').next().text(data.error_string[i]); //select span help-block class set text error string
                }
            }
            $('#btnSave').text('save'); //change button text
            $('#btnSave').attr('disabled',false); //set button enable 


        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error adding / update data '+id);
            $('#btnSave').text('save'); //change button text
            $('#btnSave').attr('disabled',false); //set button enable 
        }
    });
	}
	</script>
	<script>
		function savePoster(){
			 var data = new FormData($('#forms')[0]);
			  $.ajax({
               type:"POST",
               url:"<?php echo site_url('user_dash/book_cover_edit');?>",
               data:data,
               mimeType: "multipart/form-data",
                contentType: false,
                cache: false,
                processData: false,
               success:function(data)
              {
                    $('#myPosterModal').modal('hide');
					location.reload();
 
               }
       });
		}
		function edit_poster(bookid){
			$('#forms')[0].reset(); // reset form on modals
			$('.form-group').removeClass('has-error'); // clear error class
			$('.help-block').empty(); // clear error string
			
			$.ajax({
			url : "<?php echo site_url('user_dash/ajax_edit')?>/" + bookid,
			type: "GET",
			dataType: "JSON",
			success: function(data)
			{
				//alert('i am in ' + data);
				$('[name="bookID"]').val(data.bookID);
				$('[name="coverImg"]').val(data.coverImg);
				$('#myPosterModal').modal('show'); // show bootstrap modal when complete loaded
				$('.modal-title').text('Edit Poster'); // Set title to Bootstrap modal title
			},
			error: function (jqXHR, textStatus, errorThrown)
			{
				alert('Error get data from ajax ' + bookid);
			}
		});
		}
	</script>
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
	<script>
		function savePages(){
			var data = new FormData($('#pagesform')[0]);
			$.ajax({
				type:"POST",
				url:"<?php echo site_url('reg_book/add_pages');?>",
				data:data,
				mimeType: "multipart/form-data",
                contentType: false,
                cache: false,
                processData: false,
				success:function(data)
				{	
					//alert("ok");
					//$('#myPagesModal').hide().show();
					//$('.help-block').text('Page Uploaded');
					$('#myPagesModal').fadeOut(function(){
					$(this).modal('hide')
					}).fadeIn("slow",function(){
						$('#pagesform')[0].reset();
						$('.help-block').text('Page Uploaded');
						$(this).modal('show')
					});
				},
				error: function (jqXHR, textStatus, errorThrown)
				{
					alert('Error get data from ajax ');
				}
			});
		}
		function add_pages(bookid){
			$('#pagesform')[0].reset(); // reset form on modals
			$('.form-group').removeClass('has-error'); // clear error class
			$('.help-block').empty();
			$.ajax({
				url : "<?php echo site_url('user_dash/ajax_edit')?>/" + bookid,
				type: "GET",
				dataType: "JSON",
				success: function(data)
				{
					//alert('i am in ' + hellox);
					$('[name="bookID"]').val(data.bookID);
					$('#myPagesModal').modal('show'); // show bootstrap modal when complete loaded
					$('.modal-title').text('Add Pages'); // Set title to Bootstrap modal title
				},
				error: function (jqXHR, textStatus, errorThrown)
				{
					alert('Error get data from ajax ' + bookid);
				}
			});
		}
	</script>
	<script>
		var pages = [];
		var ins = 0;
		var ins1 = 0;
		var checks = 0; 
		//var checks2 = 0;
		
		function prev(){
			//alert("prev " + pages[ins]);
			if(pages.length != 0){
				if(ins != 0){
					$( '#slideshow_image' ).attr( 'src' , "<?php echo base_url('bookpages/')?>/"+ pages[ins]);
					ins1 = ins + 1;
					ins = ins - 1;
					$('#next_image').prop('disabled', false);
				}
				else{
					if(checks == 1){
						$( '#slideshow_image' ).attr( 'src' , "<?php echo base_url('bookpages/')?>/"+ pages[ins]);
						ins1 = 1;
						ins = 0;
						checks = 0;
					}
					else{
						ins1 = 0;
						ins = 0;
						checks = 0;
						$('#prev_image').prop('disabled', true);
						$('#next_image').prop('disabled', false);
						$('#slideshow_image').attr( 'src', "<?php echo base_url('defaults/Start.png')?>");
					}
				}
			}
			else{
				$('#next_image').prop('disabled', true);
				$('#prev_image').prop('disabled', true);
				$('#slideshow_image').attr( 'src', "<?php echo base_url('defaults/noPage.png')?>");
			}	
		}
		function nexts(){
				checks = 1;
				if(pages.length != 0){
					if(pages.length > ins1){
						if(ins1 == 0){
							$('#prev_image').prop('disabled', false);
							$( '#slideshow_image' ).attr( 'src' , "<?php echo base_url('bookpages/')?>/"+ pages[ins1]);
							ins1 = ins1 + 1;
							ins = 0;
							checks = 0;
						}
						else{
							$('#prev_image').prop('disabled', false);
							$( '#slideshow_image' ).attr( 'src' , "<?php echo base_url('bookpages/')?>/"+ pages[ins1]);
							ins = ins1 - 1;
							ins1 = ins1 + 1;
						}
					}
					else{
						$('#next_image').prop('disabled', true);
						$('#slideshow_image').attr( 'src', "<?php echo base_url('defaults/End.png')?>");
						ins =  pages.length - 1;
					}
				}
				else{
					$('#next_image').prop('disabled', true);
					$('#prev_image').prop('disabled', true);
					$('#slideshow_image').attr( 'src', "<?php echo base_url('defaults/noPage.png')?>");
				}
		}
		$(document).ready(function(){
				$( "#prev_image" ).click(function(){
					prev();
				});
				$( "#next_image" ).click(function(){
					nexts();
				});
		}); 
		//var incom;
		function show_pages(bookid){
			$.ajax({
				url : "<?php echo site_url('user_dash/ajax_pages')?>",
				type: "POST",
				data:{bookID:bookid},
				dataType: "JSON",
				success: function(data){
					var lal = JSON.stringify(data);
					var oks = JSON.parse(lal);
					$.each(oks, function(i, item){
						pages[i] = item.pageImageLink;
					});
					$('#showPagesModal').modal('show');
					$('.modal-title').text('Show Pages');
					$("#showPagesModal").on("hidden.bs.modal", function(){
						location.reload();
					});
				},
				error: function (jqXHR, textStatus, errorThrown){
					alert("Error ");
				}
			});
		}
	</script>
	<script>
		var clientID_arr = [];
		var ins = 0;
		var ins1 = 0;
		var checks = 0;
		function prevsss(){
			//alert('hello prevs');
			if(ins != 0){
				$('.yesNoBtn').show();
				$('.details').show();
				//$('.deactiveLabels').show();
				$.ajax({
					type:"POST",
					url: "<?php echo site_url('user_dash/ajax_return_active_clients')?>/"+clientID_arr[ins],
					dataType:"JSON",
					success: function(data){
						window.clientID = data.userID;
						$('#name').text(data.firstName+" "+data.lastName);
						$('#email').text(data.eMail);
						$('#contact').text(data.contactNo);
						$('#member').text(data.memberSince);
						$('#duration').text(data.duration);
						var lendOrbuy = data.transType;
						if(!data.imageLink){
							$( '#imgTest' ).attr( 'src' , "<?php echo base_url('defaults/user-default.png')?>");
							if(lendOrbuy == '1'){
								$('.lendableBook').show();
							}
							else{
								$('.buyableBook').show();
							}
						}
						else{
							$( '#imgTest' ).attr( 'src' , "<?php echo base_url('userdp/')?>/"+ data.imageLink);
							if(lendOrbuy == '1'){
								$('.lendableBook').show();
							}
							else{
								$('.buyableBook').show();
							}
						}
					}
				});
				ins1 = ins + 1;
				ins = ins - 1;
				$('#nexts_image').prop('disabled', false);
			}
			else{
				if(checks == 1){
					$('.yesNoBtn').show();
					$('.details').show();
					//$('.deactiveLabels').show();
					$.ajax({
					type:"POST",
					url: "<?php echo site_url('user_dash/ajax_return_active_clients')?>/"+clientID_arr[ins],
					dataType:"JSON",
					success: function(data){
							window.clientID = data.userID;
							$('#name').text(data.firstName+" "+data.lastName);
							$('#email').text(data.eMail);
							$('#contact').text(data.contactNo);
							$('#member').text(data.memberSince);
							$('#duration').text(data.duration);
							var lendOrbuy = data.transType;
							if(!data.imageLink){
								$( '#imgTest' ).attr( 'src' , "<?php echo base_url('defaults/user-default.png')?>");
								if(lendOrbuy == '1'){
									$('.lendableBook').show();
								}
								else{
									$('.buyableBook').show();
								}
							}
							else{
								$( '#imgTest' ).attr( 'src' , "<?php echo base_url('userdp/')?>/"+ data.imageLink);
								if(lendOrbuy == '1'){
									$('.lendableBook').show();
								}
								else{
									$('.buyableBook').show();
								}
							}
						}
					});
					ins1 = 1;
					ins = 0;
					checks = 0;
				}
				else{
					ins1 = 0;
					ins = 0;
					checks = 0;
					$('#name').text(" ");
					$('#email').text(" ");
					$('#contact').text(" ");
					$('#member').text(" ");
					$('#duration').text(" ");
					$('#prevs_image').prop('disabled', true);
					$('#nexts_image').prop('disabled', false);
					$('.lendableBook').hide();
					$('.buyableBook').hide();
					//$('.yesNoBtn').hide();
					$('.details').hide();
					//$('.deactiveLabels').hide();
					//$('.activeLabels').hide();
					$('#imgTest').attr( 'src', "<?php echo base_url('defaults/Start.png')?>");
				}
			}
		}
		function nextsss(){
			//alert("Hello nexts");
			checks = 1;
			if(clientID_arr.length > ins1){
				//$('.yesNoBtn').show();
				$('.details').show();
				//$('.deactiveLabels').show();
				if(ins1 == 0){
					$('#prevs_image').prop('disabled', false);
					$.ajax({
						type:"POST",
						url: "<?php echo site_url('user_dash/ajax_return_active_clients')?>/"+clientID_arr[ins1],
						dataType:"JSON",
						success: function(data){
							window.clientID = data.userID;
							$('#name').text(data.firstName+" "+data.lastName);
							$('#email').text(data.eMail);
							$('#contact').text(data.contactNo);
							$('#member').text(data.memberSince);
							$('#duration').text(data.duration);
							var lendOrbuy = data.transType;
							if(!data.imageLink){
								$( '#imgTest' ).attr( 'src' , "<?php echo base_url('defaults/user-default.png')?>");
								if(lendOrbuy == '1'){
									$('.lendableBook').show();
									$('.buyableBook').hide();
								}
								else{
									$('.buyableBook').show();
									$('.lendableBook').hide();
								}
							}
							else{
								$( '#imgTest' ).attr( 'src' , "<?php echo base_url('userdp/')?>/" + data.imageLink);
								if(lendOrbuy == '1'){
									$('.lendableBook').show();
									$('.buyableBook').hide();
								}
								else{
									$('.buyableBook').show();
									$('.lendableBook').hide();
								}
							}
						}
					});
					ins1 = ins1 + 1;
					ins = 0;
					checks = 0;
				}
				else{
					//$('.yesNoBtn').show();
					$('.details').show();
					//$('.deactiveLabels').show();
					$('#prevs_image').prop('disabled', false);
					$.ajax({
						type:"POST",
						url: "<?php echo site_url('user_dash/ajax_return_active_clients')?>/"+clientID_arr[ins1],
						dataType:"JSON",
						success: function(data){
							window.clientID = data.userID;
							$('#name').text(data.firstName+" "+data.lastName);
							$('#email').text(data.eMail);
							$('#contact').text(data.contactNo);
							$('#member').text(data.memberSince);
							$('#duration').text(data.duration);
							var lendOrbuy = data.transType;
							if(!data.imageLink){
								$( '#imgTest' ).attr( 'src' , "<?php echo base_url('defaults/user-default.png')?>");
								if(lendOrbuy == '1'){
									$('.lendableBook').show();
									$('.buyableBook').hide();
								}
								else{
									$('.buyableBook').show();
									$('.lendableBook').hide();
								}
							}
							else{
								$( '#imgTest' ).attr( 'src' , "<?php echo base_url('userdp/')?>/"+ data.imageLink);
								if(lendOrbuy == '1'){
									$('.lendableBook').show();
									$('.buyableBook').hide();
								}
								else{
									$('.buyableBook').show();
									$('.lendableBook').hide();
								}
							}
						}
						
					});
					ins = ins1 - 1;
					ins1 = ins1 + 1;
				}
			}
			else{
				$('#name').text(" ");
				$('#email').text(" ");
				$('#contact').text(" ");
				$('#member').text(" ");
				$('#duration').text(" ");
				$('#nexts_image').prop('disabled', true);
				$('.yesNoBtn').hide();
				$('.details').hide();
				$('.lendableBook').hide();
				$('.buyableBook').hide();
				$('#imgTest').attr( 'src', "<?php echo base_url('defaults/End.png')?>");
				ins =  clientID_arr.length - 1;
			}
		}
		$(document).ready(function(){
				$( "#prevs_image" ).click(function(){
					prevsss();
				});
				$( "#nexts_image" ).click(function(){
					nextsss();
				});
		});
		function show_users(bookID){
			$.ajax({
				type: "GET",
				url: "<?php echo site_url('user_dash/show_users')?>/"+bookID,
				dataType:"JSON",
				success: function(data){
					var count = Object.keys(data).length;
					for(i = 0; i<count; i++){
						clientID_arr[i] = data[i].clientID;
					}
					if(clientID_arr.length != 0){
						//alert("users");
						$('.details').hide();
						$('#ShowReadableUsers').modal('show');
						$("#ShowReadableUsers").on("hidden.bs.modal", function(){
							location.reload();
						});
					}
					else{
						$('#noReadableUsers').modal('show');
						$('#noReadableUsers').on("hidden.bs.modal", function(){
							location.reload();
						});
					}
				}
			});
		}
	</script>
</html>