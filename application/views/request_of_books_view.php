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
			$this->load->view("header_view", $data);
		?>
		<div class = "gallary" id = "gallary">
			<?php if(empty($requests)): ?>
			<div class = "well well-lg" id = "No_books">
				<h3 class = "text-center" style = "color:red;"><b>No Requests Of Books</b></h3>
			</div>
			<?php else:
					foreach ($requestsChanged as $request):?>
					<div class = "img-gal" id = "img_gal">
						<?php 
						if ($request->coverImg =='') :?>
							<img class = "img-size" src = "<?php echo base_url('defaults/noCover.png'); ?>"/>
						<?php else:?>
							<img class = "img-size" src = "<?php echo base_url('bookcover/'.$request->coverImg); ?>"/>
						<?php endif;?>
						<div class = "descrip">
							<p class = "title"><b> <?php echo $request->bookName; ?> </b></p>
							<p class = "author"><b><?php echo $request->transDate; ?></b></p>
						</div>
							<a href="javascript:" onClick ="bookActivation('2','<?php echo $request->ownerID?>', '<?php echo $request->bookID?>')" class="btn btn-primary buyable-btn">Buyable <span class = "badge ret"><?php $buyable_request = $this->book_model->return_buyable_requests($request->ownerID, $request->bookID);
							echo sizeof($buyable_request);?></span></a>
							<a href="javascript:" onClick ="bookActivation('1','<?php echo $request->ownerID?>', '<?php echo $request->bookID?>')" class="btn btn-success lendable-btn">Lendable <span class = "badge ret"><?php $lendable_request = $this->book_model->return_lendable_requests($request->ownerID, $request->bookID);
							echo sizeof($lendable_request);?></span></a>
					</div>
					<?php endforeach;?>
			<?php endif;?>	
		</div>
		<div class = "container"><!--There is no request-->
			<div class="modal fade" id="requestedUsers" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			    <div class="modal-dialog">
					 <div class="modal-content">
						  <div class="modal-header">
							   <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
							   <h4 class="modal-title" id="myModalLabel"><b>Book Rialto</b></h4>
						  </div>
						  <div class="modal-body">
						   		<p class="text-center confm"> <b>There is no request</b> </p>
						  </div>
						  <div class="modal-footer">
							  	<button type="button" class="btn btn-default" data-dismiss="modal">OK</button>
						  </div>
					 </div>
				</div>
   			</div>
		</div>
		<div class = "container"><!--For Sure yes-->
			<div class="modal fade" id="sureForYes" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			    <div class="modal-dialog">
					 <div class="modal-content">
						  <div class="modal-header">
							   <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
							   <h4 class="modal-title" id="myModalLabel"><b>Book Rialto</b></h4>
						  </div>
						  <div class="modal-body">
						   		<p class="text-center confm"> <b>Are you sure ?</b> </p>
						  </div>
						  <div class="modal-footer">
							  	<button type="button" class="btn btn-default" id="yes" data-dismiss="modal">OK</button>
						  </div>
					 </div>
				</div>
   			</div>
		</div>
		<div class = "container"><!--For Sure no-->
			<div class="modal fade" id="sureForNo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			    <div class="modal-dialog">
					 <div class="modal-content">
						  <div class="modal-header">
							   <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
							   <h4 class="modal-title" id="myModalLabel"><b>Book Rialto</b></h4>
						  </div>
						  <div class="modal-body">
						   		<p class="text-center confm"> <b>This book is active now for the user </b> </p>
						  </div>
						  <div class="modal-footer">
							  	<button type="button" class="btn btn-default" id="no" data-dismiss="modal">OK</button>
						  </div>
					 </div>
				</div>
   			</div>
		</div>
		<div class = "container">
			<div class="modal fade" id="ShowRequestedUsers" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
											<span class="label label-success buyableBook" data-toggle="tooltip" title="He/she is want to buy">Want to Buy</span>
											<span class="label label-success lendableBook" data-toggle="tooltip" title="He/she is want to Lend">Want to Lend</span>
											<a onClick ="sendMessage()" class="btn btn-danger btn-xs message-btn">Send message</a>
										</div>
										<div class = "yesNoBtn">
											<center>
											<button onClick="Yes()" class="btn btn-success yesBtn">Yes</button>
											<button onClick="No()" class="btn btn-success noBtn">No</button>
											</center>
										</div>
									</div>
									
						  </div>
						  <div class="modal-footer">
							  	<center>
							  	<button type="image" id="prev_image" class = "btn btn-success"></button>
								<button type="image" id="next_image" class = "btn btn-success"></button>
								<input type="hidden" id="info_no" value="0">
						    </center>
						  </div>
					 </div>
				</div>
   			</div>
		</div>
		<div class = "container"><!--For Confirmation-->
			<div class="modal fade" id="confirmModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
							  	<a class="btn btn-danger btn-ok">Yes</a>
						  </div>
					 </div>
				</div>
   			</div>
		</div>
	</body>
	<script>
		var clientID_arr = [];
		var ins = 0;
		var ins1 = 0;
		var checks = 0;
		
		function sendMessage(){
			alert("clientID: "+window.clientID);
		}
		function sureYes(){
			//alert("Sure yes");
			$.ajax({
				type:"POST",
				url:"<?php echo site_url('user_dash/ajax_bookActivatePermission_for_yes')?>",
				dataType:"JSON",
				data: {clientID:window.clientID,bookID:window.bookID},
				success: function(data){
					if(data.status){
						alert("updated");
					}
					else{
						alert("not updated");
					}
				}
			});
		}
		function Yes(){
			window.confirm = "yes";
			$('#confirmModal').modal('show');
		}
		function sureNo(){
			//alert("In no");
			$.ajax({
				type:"POST",
				url:"<?php echo site_url('user_dash/ajax_bookActivatePermission_for_no')?>",
				dataType:"JSON",
				data: {clientID:window.clientID,bookID:window.bookID},
				success: function(data){
					if(data.status){
						alert("updated");
					}
					else{
						alert("not updated");
					}
				}
			});
		}
		function No(){
			window.confirm = "no";
			$('#confirmModal').modal('show');
		}
		function prevss(){
			//alert("HEllo");
			if(ins != 0){
				$('.yesNoBtn').show();
				$('.details').show();
				//$('.deactiveLabels').show();
				$.ajax({
					type:"POST",
					url: "<?php echo site_url('user_dash/ajax_return_requested_clients')?>/"+clientID_arr[ins],
					dataType:"JSON",
					success: function(data){
						window.clientID = data.userID;
						$('#name').text(data.firstName+" "+data.lastName);
						$('#email').text(data.eMail);
						$('#contact').text(data.contactNo);
						$('#member').text(data.memberSince);
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
				$('#next_image').prop('disabled', false);
			}
			else{
				if(checks == 1){
					$('.yesNoBtn').show();
					$('.details').show();
					//$('.deactiveLabels').show();
					$.ajax({
					type:"POST",
					url: "<?php echo site_url('user_dash/ajax_return_requested_clients')?>/"+clientID_arr[ins],
					dataType:"JSON",
					success: function(data){
							window.clientID = data.userID;
							$('#name').text(data.firstName+" "+data.lastName);
							$('#email').text(data.eMail);
							$('#contact').text(data.contactNo);
							$('#member').text(data.memberSince);
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
					$('#prev_image').prop('disabled', true);
					$('#next_image').prop('disabled', false);
					$('.lendableBook').hide();
					$('.buyableBook').hide();
					$('.yesNoBtn').hide();
					$('.details').hide();
					//$('.deactiveLabels').hide();
					//$('.activeLabels').hide();
					$('#imgTest').attr( 'src', "<?php echo base_url('defaults/Start.png')?>");
				}
			}
		}
		function nextss(){
			//alert("HEllo");
			checks = 1;
			if(clientID_arr.length > ins1){
				$('.yesNoBtn').show();
				$('.details').show();
				//$('.deactiveLabels').show();
				if(ins1 == 0){
					$('#prev_image').prop('disabled', false);
					$.ajax({
						type:"POST",
						url: "<?php echo site_url('user_dash/ajax_return_requested_clients')?>/"+clientID_arr[ins1],
						dataType:"JSON",
						success: function(data){
							window.clientID = data.userID;
							$('#name').text(data.firstName+" "+data.lastName);
							$('#email').text(data.eMail);
							$('#contact').text(data.contactNo);
							$('#member').text(data.memberSince);
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
								$( '#imgTest' ).attr( 'src' , "<?php echo base_url('userdp/')?>/" + data.imageLink);
								if(lendOrbuy == '1'){
									$('.lendableBook').show();
								}
								else{
									$('.buyableBook').show();
								}
							}
						}
					});
					ins1 = ins1 + 1;
					ins = 0;
					checks = 0;
				}
				else{
					$('.yesNoBtn').show();
					$('.details').show();
					//$('.deactiveLabels').show();
					$('#prev_image').prop('disabled', false);
					$.ajax({
						type:"POST",
						url: "<?php echo site_url('user_dash/ajax_return_requested_clients')?>/"+clientID_arr[ins1],
						dataType:"JSON",
						success: function(data){
							window.clientID = data.userID;
							$('#name').text(data.firstName+" "+data.lastName);
							$('#email').text(data.eMail);
							$('#contact').text(data.contactNo);
							$('#member').text(data.memberSince);
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
					ins = ins1 - 1;
					ins1 = ins1 + 1;
				}
			}
			else{
				$('#name').text(" ");
				$('#email').text(" ");
				$('#contact').text(" ");
				$('#member').text(" ");
				$('#next_image').prop('disabled', true);
				$('.yesNoBtn').hide();
				$('.details').hide();
				$('.lendableBook').hide();
				$('.buyableBook').hide();
				$('#imgTest').attr( 'src', "<?php echo base_url('defaults/End.png')?>");
				ins =  clientID_arr.length - 1;
			}
		}
		$(document).ready(function(){
				$( "#prev_image" ).click(function(){
					prevss();
				});
				$( "#next_image" ).click(function(){
					nextss();
				});
				$(".btn-ok").click(function(){
					
					if(window.confirm == "yes"){
						sureYes();
						$('#confirmModal').modal('hide');
					}
					else if(window.confirm == "no"){
						sureNo();
						$('#confirmModal').modal('hide');
					}
				});
		});
		function bookActivation(transType, ownerID, bookID){
			//alert("HEllo in");
			window.bookID = bookID;
			$.ajax({
				type:"POST",
				url: "<?php echo site_url('user_dash/ajax_bookActivation')?>",
				data:{transType:transType,ownerID:ownerID, bookID:bookID},
				dataType:"JSON",
				success: function(data){
					var count = Object.keys(data).length;
					for(i = 0; i<count; i++){
						//loops(data[i].clientID);
						clientID_arr[i] = data[i].clientID;
					} 
					if(clientID_arr.length != 0){
						$('#ShowRequestedUsers').modal('show');
						$("#ShowRequestedUsers").on("hidden.bs.modal", function(){
							location.reload();
						});
					}
					else{
						$('#requestedUsers').modal('show');
						$('#requestedUsers').on("hidden.bs.modal", function(){
							location.reload();
						});
					}
					prevss();
				},
				error: function (jqXHR, textStatus, errorThrown)
				{
					alert('Error get data from ajax ');
				}
			});
		}
		/*function loops(clients){
			
			$.ajax({
				type: "GET",
				url: "<?php echo site_url('user_dash/ajax_return_requested_clients')?>/"+clients,
				dataType: "JSON",
				success: function(data){
					var x = document.createElement("IMG");
					if(!data.imageLink){
						x.setAttribute("src", "<?php echo base_url('defaults/user-default.png')?>");
					}
					else{
						x.setAttribute("src", "<?php echo base_url('userdp/')?>/"+ data.imageLink);
					}
					$('#imgTest').append(x);
				},
				error: function(jqXHR, textStatus, errorThrown){
					alert("Error");
				}
			});
		}*/
	</script>
</html>