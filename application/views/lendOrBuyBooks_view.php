<html>
	<head>
		<?php $this->load->helper('url');?>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Library</title>
		<link rel="stylesheet" href="<?php echo base_url("assets/css/bootstrap.css"); ?>"/>
		<script type="text/javascript" src="<?php echo base_url("assets/js/jquery.js"); ?>"></script>
		<script type="text/javascript" src="<?php echo base_url("assets/js/bootstrap.js"); ?>"></script>
		<script type="text/javascript" src="<?php echo base_url("assets/js/jquery.watermark.min.js"); ?>"></script>
		<script type="text/javascript" src="<?php echo base_url("assets/js/jquery.watermark.js"); ?>"></script>
		<link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap-glyphicons.css" rel="stylesheet"/>
		<link href='https://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
		<link rel="stylesheet" href="/Library/style/style.css"/>
	</head>
	<body>
		<?php 
		$data['id'] = $id;
		$this->load->view("header_view", $data);?>
		<div class = "container-fluid">
			<div class = "lendOrBuygallary" id = "lendOrBuygallary">
				<?php if(empty($lendOrBuy)): ?>
				<div class = "well well-lg" id = "No_books">
					<h3 class = "text-center" style = "color:red;"><b>No Books available</b></h3>
				</div>
				<?php else:
					foreach ($lendOrBuy as $book):
					$bID = $book->bookID;?>
					<div class = "img-gal" id = "img_gal">
						<a href="#crossModal" data-href="<?php echo site_url('user_dash/delete_book/'.$book->bookID)?>" data-toggle="modal" data-target="#crossModal">
							<span class="glyphicon glyphicon-remove cross-icon"></span>
						</a>
						<?php if ($book->coverImg =='') :?>
							<img class = "img-size" src = "<?php echo base_url('defaults/noCover.png'); ?>"/>
						<?php else:?>
							<img class = "img-size" src = "<?php echo base_url('bookcover/'.$book->coverImg); ?>"/>
						<?php endif;?>
						<div class = "descrip">
							<p class = "title"><b> <?php echo $book->bookName; ?> </b>
								<span></span>
							</p>
							<p class = "author"><b><?php echo $book->authorName; ?></b>
								<span></span>
							</p>
							<p class = "des" style="color:green; font-size: 15px;"><b><?php echo $book->firstName ." ". $book->lastName;?></b>
							</p>
							<?php if ($book->transType == "1") :?>
								<span class="label label-danger lendable" data-toggle="tooltip" title="The Book was Lended">Lend(<?php echo $book->isLendablePrice;?> TK)</span>
							<?php elseif($book->transType== "2") :?>
								<span class="label label-danger lendable" data-toggle="tooltip" title="The Book was Bought">Buy(<?php echo $book->isBuyablePrice;?> TK)</span>
							<?php endif;?>
							<a onClick = "showBook(<?php echo $book->bookID;?>, <?php echo $book->ownerID?>)" class="btn btn-primary btn-xs read-btn">Read Book</a>
							<a onClick = "makeReports(<?php echo $book->bookID;?>, <?php echo $book->ownerID?>)" class = "btn btn-success btn-xs report-btn">Report</a>
						</div>
				<?php endforeach; 
				endif;?>		
					</div>
			</div>
		</div>
		<div class = "container">
			<div class="modal fade" id="showPages" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			    <div class="modal-dialog">
					 <div class="modal-content">
						  <div class="modal-header">
							   <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
							   <h4 class="modal-title" id="myModalLabel"><b>Show Book</b></h4>
						  </div>
						  <div class="modal-body" id = "showForm">
						   		<center>
									<div id="slide_cont">
										<img class = "water" id="slideshow_image" src="<?php echo base_url('defaults/Start.png'); ?>">
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
		<div class = "container"><!-- Modal for report-->
		   <div class="modal fade" id="reportModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
							<h4 class="modal-title text-center" id="myModalLabel"><b>Upload Cover Image for this book</b></h4>
						</div>
					    <div class="modal-body form">
							<form action="#" id="reportForm" class="form-horizontal" name = "forms">
								<input type="hidden" value="" name="bookID"/>
								<div class="form-body">
									<div class="form-group">
										<div class="col-md-9">
											<textarea name="reportTxt" id = 'reportTxt'></textarea>
											<span class="help-block"></span><br>
										</div>
									</div>
								</div>
							</form>
					    </div>
					    <div class="modal-footer">
							<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
							<a class="btn btn-info" id="btn_confirm" onClick = "sendReport()" name="btn_confirm">Confirm</a>
					    </div>
					</div>
				</div>
		   </div>
		</div>
		<div class = "container"><!-- Modal for already reported-->
		   <div class="modal fade" id="alreadyReportModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
							<h4 class="modal-title text-center" id="myModalLabel"><b>Upload Cover Image for this book</b></h4>
						</div>
					    <div class="modal-body">
							<p class="text-center confm"> <b>You are already reported</b> </p>
					    </div>
					    <div class="modal-footer">
							<button type="button" class="btn btn-success" data-dismiss="modal">OK</button>
					    </div>
					</div>
				</div>
		   </div>
		</div>
		<div class = "container"><!-- Modal for report success-->
		   <div class="modal fade" id="successReportModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
							<h4 class="modal-title text-center" id="myModalLabel"><b>Upload Cover Image for this book</b></h4>
						</div>
					    <div class="modal-body">
							<p class="text-center confm"> <b>Report sent</b> </p>
					    </div>
					    <div class="modal-footer">
							<button type="button" class="btn btn-success" data-dismiss="modal">OK</button>
					    </div>
					</div>
				</div>
		   </div>
		</div>
	</body>
	<script type="text/javascript" src="<?php echo base_url("assets/js/jquery.watermark.min.js"); ?>"></script>
	<script type="text/javascript" src="<?php echo base_url("assets/js/jquery.watermark.js"); ?>"></script>
	<script>
		var pages = [];
		var ins = 0;
		var ins1 = 0;
		var checks = 0; 
		
		function prev(){
			//alert("prev " + pages[ins]);
			if(pages.length != 0){
				if(ins != 0){
					$( '#slideshow_image' ).attr( 'src' , "<?php echo base_url('bookpages/')?>/"+ pages[ins]);
					$('.water').watermark({ //Actual watermark Image
						path: '<?php echo base_url('watermark/watermark.png')?>',
						margin: 90,
						gravity: 'nw',
						opacity: 0.3,
						outputWidth: 500,
						outputHeight: 600
					});
					ins1 = ins + 1;
					ins = ins - 1;
					$('#next_image').prop('disabled', false);
				}
				else{
					if(checks == 1){
						$( '#slideshow_image' ).attr( 'src' , "<?php echo base_url('bookpages/')?>/"+ pages[ins]);
						$('.water').watermark({ //Actual watermark Image
							path: '<?php echo base_url('watermark/watermark.png')?>',
							margin: 90,
							gravity: 'nw',
							opacity: 0.3,
							outputWidth: 500,
							outputHeight: 600
						});
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
							$('.water').watermark({ //Actual watermark Image
								path: '<?php echo base_url('watermark/watermark.png')?>',//return a bookID
								margin: 90,
								gravity: 'nw',
								opacity: 0.3,
								outputWidth: 500,
								outputHeight: 600
							});
							ins1 = ins1 + 1;
							ins = 0;
							checks = 0;
						}
						else{
							$('#prev_image').prop('disabled', false);
							$( '#slideshow_image' ).attr( 'src' , "<?php echo base_url('bookpages/')?>/"+ pages[ins1]);
							$('.water').watermark({ //Actual watermark Image
								path: '<?php echo base_url('watermark/watermark.png')?>',
								margin: 90,
								gravity: 'nw',
								opacity: 0.3,
								outputWidth: 800,
								outputHeight: 600
							});
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
		function showBook(bookID, ownerID){
			//alert("bookID "+bookID+" onw: "+ ownerID);
			$.ajax({
				url : "<?php echo site_url('user_dash/ajax_active_pages')?>/"+bookID,
				type: "POST",
				dataType: "JSON",
				success: function(data){
					var lal = JSON.stringify(data);
					var oks = JSON.parse(lal);
					$.each(oks, function(i, item){
						pages[i] = item.pageImageLink;
					});
					$('#showPages').modal('show');
					$('.modal-title').text('Show Pages');
					$("#showPages").on("hidden.bs.modal", function(){
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
		//books = window.bookID;
		//owner = window.ownerID;
		function sendReport(){
			var reportLetter = document.getElementById('reportTxt').value;
			$.ajax({
				url: "<?php echo site_url('user_dash/insert_report')?>",
				data: {booksID:window.bookID, ownersID:window.ownerID, reportField:reportLetter},
				type: "POST",
				dataType: "JSON",
				success: function(data){
					if(data.status){
						//alert("success");
						$('#successReportModal').modal('show');
						$("#successReportModal").on("hidden.bs.modal", function(){
							location.reload();
						});
					}
					else{
						alert(" not success");
					}
				},
				error: function (jqXHR, textStatus, errorThrown){
					alert("Error ");
				}
			});
		}
		function makeReports(bookID,  ownerID){
			window.bookID = bookID;
			window.ownerID = ownerID;
			$.ajax({
				url:"<?php echo site_url('user_dash/check_for_report')?>",
				type:"POST",
				dataType:"JSON",
				data:{bookID:window.bookID, ownerID:window.ownerID},
				success: function(data){
					if(data){
						$("#alreadyReportModal").modal('show');
						$("#alreadyReportModal").on("hidden.bs.modal", function(){
							location.reload();
						});
					}
					else{
						$("#reportModal").modal('show');
						$("#reportModal").on("hidden.bs.modal", function(){
							location.reload();
						});
					}	
				}
			});
		}
	</script>
</html>