var bookID_arr = [];
var ins = 0;
var ins1 = 0;
var checks = 0;

var reportID_arr = [];
var ins2 = 0;
var ins3 = 0;
var checks1 = 0;

function total_books(userID){
	window.userID = userID;
	var myModal = $('#extraFeatures');
	$.ajax({
		url:totalBookUrl,
		type:"POST",
		data:{userID:window.userID},
		dataType:"JSON",
		success: function(data){
			var count = Object.keys(data).length;
			if(count != '0'){
				for(i = 0; i<count; i++){
					bookID_arr[i] = data[i].bookID;
				}
				$('#allUsersBook').modal('show');
				$("#allUsersBook").on("hidden.bs.modal", function(){
						location.reload();
				});
			}
			else{
				myModal.find('.modal-body').text('No Books available');
				myModal.find('.modal-title').text('Books');
				myModal.modal('show');
			}
			userAllPrevss();
		}
	});
}
function total_reports(userID){
	window.userID = userID;
	//alert(window.userID);
	var myModal = $('#extraFeatures');
	$.ajax({
		type:"POST",
		url:return_all_reports_for_a_user,
		dataType:"JSON",
		data:{userID:window.userID},
		success: function(data){
			var count = Object.keys(data).length;
			if(count != '0'){
				for(i = 0; i<count; i++){
					reportID_arr[i] = data[i].reportID;
				}
				myModal.modal('hide');
				$('#allUsersReport').modal('show');
				$("#allUsersReport").on("hidden.bs.modal", function(){
					location.reload();
				});
			}
			else{
				//alert("no reports");
				myModal.find('.modal-body').text('No Reports for this User');
				myModal.find('.modal-title').text('Reports');
				myModal.modal('show');
			}
			report_prevs();
		}
	});
}
$(document).ready(function(){
	$( "#userAllPrev_image" ).click(function(){
		userAllPrevss();
	});
	$( "#userAllNext_image" ).click(function(){
		userAllNextss();
	});
	$('#report_prevs_image').click(function(){
		report_prevs();
	});
	$('#report_nexts_image').click(function(){
		report_nexts();
	});
});
function report_prevs(){
	if(ins2 != 0){
		$('.detailsForReports').show();
		$.ajax({
			type:"POST",
			url:return_all_reportsID_info,
			data:{reportID: reportID_arr[ins2]},
			dataType:"JSON",
			success: function(data){
				window.reportedBookID = data.bookID;
				window.reportedBookName = data.bookName;
				window.reportIDs = data.reportID;
				$('#bookNamess').text(data.bookName);
				$('#authorNamess').text(data.authorName);
				$('#categorys').text(data.category);
				$('#reporterName').text(data.firstName+" "+data.lastName);
				$('#reportTxt').text(data.reports);
				if(!data.coverImg){
					$( '#imgTestReports' ).attr( 'src' , defaultBookImage);
				}
				else{
					$( '#imgTestReports' ).attr( 'src' , BookImage+"/"+ data.coverImg);
				}
			}
		});
		ins3 = ins2 + 1;
		ins2 = ins2 - 1;
		$('#report_nexts_image').prop('disabled', false);
	}
	else{
		if(checks1 == 1){
			$('.detailsForReports').show();
			$.ajax({
				type:"POST",
				url:return_all_reportsID_info,
				data:{reportID: reportID_arr[ins2]},
				dataType:"JSON",
				success: function(data){
					window.reportedBookID = data.bookID;
					window.reportedBookName = data.bookName;
					window.reportIDs = data.reportID;
					$('#bookNamess').text(data.bookName);
					$('#authorNamess').text(data.authorName);
					$('#categorys').text(data.category);
					$('#reporterName').text(data.firstName+" "+data.lastName);
					$('#reportTxt').text(data.reports);
					if(!data.coverImg){
						$( '#imgTestReports' ).attr( 'src' , defaultBookImage);
					}
					else{
						$( '#imgTestReports' ).attr( 'src' , BookImage+"/"+ data.coverImg);
					}
				}
			});
			ins3 = 1;
			ins2 = 0;
			checks1 = 0;
		}
		else{
			ins3 = 0;
			ins2 = 0;
			checks1 = 0;
			$('#bookNamess').text(" ");
			$('#authorNamess').text(" ");
			$('#reporterName').text(" ");
			$('#categorys').text(" ");
			$('#reportTxt').text(" ");
			$('#report_prevs_image').prop('disabled', true);
			$('#report_nexts_image').prop('disabled', false);
			$('.detailsForReports').hide();
			$('#imgTestReports').attr( 'src', startImage);
		}
	}
	$.ajax({
		type:"POST",
		url:isAccepted_in_report_table,
		data:{reportID:window.reportIDs},
		dataType: "JSON",
		success: function(data){
		},
		error: function (jqXHR, textStatus, errorThrown){
			alert("Error ");
		}
	});
}
function report_nexts(){
	checks1 = 1;
	if(reportID_arr.length > ins3){
		$('.detailsForReports').show();
		if(ins3 == 0){
			$('#report_prevs_image').prop('disabled', false);
			$.ajax({
				type:"POST",
				url:return_all_reportsID_info,
				data:{reportID: reportID_arr[ins3]},
				dataType:"JSON",
				success: function(data){
					window.reportedBookID = data.bookID;
					window.reportedBookName = data.bookName;
					window.reportIDs = data.reportID;
					$('#bookNamess').text(data.bookName);
					$('#authorNamess').text(data.authorName);
					$('#categorys').text(data.category);
					$('#reporterName').text(data.firstName+" "+data.lastName);
					$('#reportTxt').text(data.reports);
					if(!data.coverImg){
						$( '#imgTestReports' ).attr( 'src' , defaultBookImage);
					}
					else{
						$( '#imgTestReports' ).attr( 'src' , BookImage+"/"+ data.coverImg);
					}
				}
			});
			ins3 = ins3 + 1;
			ins2 = 0;
			checks1 = 0;
		}
		else{
			$('.detailsForReports').show();
			$('#report_prevs_image').prop('disabled', false);
			$.ajax({
				type:"POST",
				url:return_all_reportsID_info,
				data:{reportID: reportID_arr[ins3]},
				dataType:"JSON",
				success: function(data){
					window.reportedBookID = data.bookID;
					window.reportedBookName = data.bookName;
					window.reportIDs = data.reportID;
					$('#bookNamess').text(data.bookName);
					$('#authorNamess').text(data.authorName);
					$('#categorys').text(data.category);
					$('#reporterName').text(data.firstName+" "+data.lastName);
					$('#reportTxt').text(data.reports);
					if(!data.coverImg){
						$( '#imgTestReports' ).attr( 'src' , defaultBookImage);
					}
					else{
						$( '#imgTestReports' ).attr( 'src' , BookImage+"/"+ data.coverImg);
					}
				}
			});
			ins2 = ins3 - 1;
			ins3 = ins3 + 1;
		}
	}
	else{
		$('#bookNamess').text(" ");
		$('#authorNamess').text(" ");
		$('#reporterName').text(" ");
		$('#categorys').text(" ");
		$('#reportTxt').text(" ");
		$('#report_nexts_image').prop('disabled', true);
		$('.detailsForReports').hide();
		$('#imgTestReports').attr( 'src', endImage);
		ins2 =  reportID_arr.length - 1;
	}
	$.ajax({
		type:"POST",
		url:isAccepted_in_report_table,
		data:{reportID:window.reportIDs},
		dataType: "JSON",
		success: function(data){
			//alert("update");
		},
		error: function (jqXHR, textStatus, errorThrown){
			alert("Error ");
		}
	});
}
function sendMessageForAllUser_view(){
	var myModals = $('#extraFeatures');
	$.ajax({
		type:"POST",
		url:check_in_msg_table,
		data:{receiverID:window.userID, bookID:window.reportedBookID},
		dataType:"JSON",
		success: function(data){
			var count = Object.keys(data).length;
			if(count == '0'){
				$('#msgModal').modal('show');
				myModals.modal('hide');
				/*$("#msgModal").on("hidden.bs.modal", function(){
					location.reload();
				});*/
			}
			else{
				//alert("message already sent");
				 
				myModals.find('.modal-body').text('Message is already sent');
				myModals.find('.modal-title').text('Message');
				myModals.modal('show');
			}
		}
	});
}
function sendMsg(){
	var msgTopics = document.getElementById('msgTxt').value;
	var msgSubject = "Message for "+window.reportedBookName+" Book--> "+msgTopics;
	$.ajax({
		type:"POST",
		url:send_messages,
		data:{receiverID:window.userID, msgTopic:msgSubject, msgBookID:window.reportedBookID},
		dataType:"JSON",
		success: function(data){
			if(data.status){
				alert("message send");
				$('#msgModal').modal('hide');
			}
			else{
				alert("problem");
			}
		}
	});
}
function userAllPrevss(){
			if(ins != 0){
				$('.details').show();
				$.ajax({
					type:"POST",
					url: return_all_book_info,
					data:{bookID:bookID_arr[ins]},
					dataType:"JSON",
					success: function(data){
						$('#bookNames').text(data.bookName);
						$('#authorNames').text(data.authorName);
						$('#category').text(data.category);
						$('#uploadDate').text(data.uploadDate);
						$('#buyablePrice').text(data.isBuyablePrice);
						$('#lendablePrice').text(data.isLendablePrice);
						var lendable = data.isLendable;
						var buyable = data.isPurchasable;
						if(!data.coverImg){
							$( '#imgTest' ).attr( 'src' , defaultBookImage);
							if(lendable == '1' && buyable == '1'){
								$('.allUsersBuyableBook').show();
								$('.allUsersLendableBook').show();
							}
							else if(lendable == '1' && buyable == '0'){
								$('.allUsersBuyableBook').hide();
								$('.allUsersLendableBook').show();
							}
							else if(lendable == '0' && buyable == '1'){
								$('.allUsersBuyableBook').show();
								$('.allUsersLendableBook').hide();
							}
							else{
								$('.allUsersBuyableBook').hide();
								$('.allUsersLendableBook').hide();
							}
						}
						else{
							$( '#imgTest' ).attr( 'src' , BookImage+"/"+ data.coverImg);
							if(lendable == '1' && buyable == '1'){
								$('.allUsersBuyableBook').show();
								$('.allUsersLendableBook').show();
							}
							else if(lendable == '1' && buyable == '0'){
								$('.allUsersBuyableBook').hide();
								$('.allUsersLendableBook').show();
							}
							else if(lendable == '0' && buyable == '1'){
								$('.allUsersBuyableBook').show();
								$('.allUsersLendableBook').hide();
							}
							else{
								$('.allUsersBuyableBook').hide();
								$('.allUsersLendableBook').hide();
							}
						}
					}
				});
				ins1 = ins + 1;
				ins = ins - 1;
				$('#userAllNext_image').prop('disabled', false);
			}
			else{
				if(checks == 1){
					//$('.yesNoBtn').show();
					$('.details').show();
					//$('.deactiveLabels').show();
					$.ajax({
					type:"POST",
					url: return_all_book_info,
					data:{bookID:bookID_arr[ins]},
					dataType:"JSON",
					success: function(data){
							//window.clientID = data.userID;
							$('#bookNames').text(data.bookName);
							$('#authorNames').text(data.authorName);
							$('#category').text(data.category);
							$('#uploadDate').text(data.uploadDate);
							$('#buyablePrice').text(data.isBuyablePrice);
							$('#lendablePrice').text(data.isLendablePrice);
							var lendable = data.isLendable;
							var buyable = data.isPurchasable;
							if(!data.coverImg){
								$( '#imgTest' ).attr( 'src' , defaultBookImage);
								if(lendable == '1' && buyable == '1'){
									$('.allUsersBuyableBook').show();
									$('.allUsersLendableBook').show();
								}
								else if(lendable == '1' && buyable == '0'){
									$('.allUsersBuyableBook').hide();
									$('.allUsersLendableBook').show();
								}
								else if(lendable == '0' && buyable == '1'){
									$('.allUsersBuyableBook').show();
									$('.allUsersLendableBook').hide();
								}
								else{
									$('.allUsersBuyableBook').hide();
									$('.allUsersLendableBook').hide();
								}
							}
							else{
								$( '#imgTest' ).attr( 'src' , BookImage+"/"+ data.coverImg);
								if(lendable == '1' && buyable == '1'){
									$('.allUsersBuyableBook').show();
									$('.allUsersLendableBook').show();
								}
								else if(lendable == '1' && buyable == '0'){
									$('.allUsersBuyableBook').hide();
									$('.allUsersLendableBook').show();
								}
								else if(lendable == '0' && buyable == '1'){
									$('.allUsersBuyableBook').show();
									$('.allUsersLendableBook').hide();
								}
								else{
									$('.allUsersBuyableBook').hide();
									$('.allUsersLendableBook').hide();
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
					$('#bookNames').text(" ");
					$('#authorNames').text(" ");
					$('#uploadDate').text(" ");
					$('#category').text(" ");
					$('#buyablePrice').text(" ");
					$('#lendablePrice').text(" ");
					$('#userAllPrev_image').prop('disabled', true);
					$('#userAllNext_image').prop('disabled', false);
					$('.allUsersLendableBook').hide();
					$('.allUsersBuyableBook').hide();
					$('.details').hide();
					$('#imgTest').attr( 'src', startImage);
				}
			}
}
function userAllNextss(){
	checks = 1;
	if(bookID_arr.length > ins1){
	$('.details').show();
	if(ins1 == 0){
		$('#userAllPrev_image').prop('disabled', false);
		$.ajax({
		type:"POST",
		url:return_all_book_info,
		data:{bookID: bookID_arr[ins1]},
		dataType:"JSON",
		success: function(data){
							$('#bookNames').text(data.bookName);
							$('#authorNames').text(data.authorName);
							$('#category').text(data.category);
							$('#uploadDate').text(data.uploadDate);
							$('#buyablePrice').text(data.isBuyablePrice);
							$('#lendablePrice').text(data.isLendablePrice);
							var lendable = data.isLendable;
							var buyable = data.isPurchasable;
							if(!data.coverImg){
								$( '#imgTest' ).attr( 'src' , defaultBookImage);
								if(lendable == '1' && buyable == '1'){
									$('.allUsersBuyableBook').show();
									$('.allUsersLendableBook').show();
								}
								else if(lendable == '1' && buyable == '0'){
									$('.allUsersBuyableBook').hide();
									$('.allUsersLendableBook').show();
								}
								else if(lendable == '0' && buyable == '1'){
									$('.allUsersBuyableBook').show();
									$('.allUsersLendableBook').hide();
								}
								else{
									$('.allUsersBuyableBook').hide();
									$('.allUsersLendableBook').hide();
								}
							}
							else{
								$( '#imgTest' ).attr( 'src' , BookImage+"/" + data.coverImg);
								if(lendable == '1' && buyable == '1'){
									$('.allUsersBuyableBook').show();
									$('.allUsersLendableBook').show();
								}
								else if(lendable == '1' && buyable == '0'){
									$('.allUsersBuyableBook').hide();
									$('.allUsersLendableBook').show();
								}
								else if(lendable == '0' && buyable == '1'){
									$('.allUsersBuyableBook').show();
									$('.allUsersLendableBook').hide();
								}
								else{
									$('.allUsersBuyableBook').hide();
									$('.allUsersLendableBook').hide();
								}
							}
						}
					});
					ins1 = ins1 + 1;
					ins = 0;
					checks = 0;
				}
				else{
					$('.details').show();
					$('#userAllPrev_image').prop('disabled', false);
					$.ajax({
						type:"POST",
						url: return_all_book_info,
						data:{bookID:bookID_arr[ins1]},
						dataType:"JSON",
						success: function(data){
							$('#bookNames').text(data.bookName);
							$('#authorNames').text(data.authorName);
							$('#category').text(data.category);
							$('#uploadDate').text(data.uploadDate);
							$('#buyablePrice').text(data.isBuyablePrice);
							$('#lendablePrice').text(data.isLendablePrice);
							var lendable = data.isLendable;
							var buyable = data.isPurchasable;
							if(!data.coverImg){
								$( '#imgTest' ).attr( 'src' , defaultBookImage);
								if(lendable == '1' && buyable == '1'){
									$('.allUsersBuyableBook').show();
									$('.allUsersLendableBook').show();
								}
								else if(lendable == '1' && buyable == '0'){
									$('.allUsersBuyableBook').hide();
									$('.allUsersLendableBook').show();
								}
								else if(lendable == '0' && buyable == '1'){
									$('.allUsersBuyableBook').show();
									$('.allUsersLendableBook').hide();
								}
								else{
									$('.allUsersBuyableBook').hide();
									$('.allUsersLendableBook').hide();
								}
							}
							else{
								$( '#imgTest' ).attr( 'src' , BookImage+"/"+ data.coverImg);
								if(lendable == '1' && buyable == '1'){
									$('.allUsersBuyableBook').show();
									$('.allUsersLendableBook').show();
								}
								else if(lendable == '1' && buyable == '0'){
									$('.allUsersBuyableBook').hide();
									$('.allUsersLendableBook').show();
								}
								else if(lendable == '0' && buyable == '1'){
									$('.allUsersBuyableBook').show();
									$('.allUsersLendableBook').hide();
								}
								else{
									$('.allUsersBuyableBook').hide();
									$('.allUsersLendableBook').hide();
								}
							}
						}
						
					});
					ins = ins1 - 1;
					ins1 = ins1 + 1;
				}
			}
			else{
				$('#bookNames').text(" ");
				$('#authorNames').text(" ");
				$('#uploadDate').text(" ");
				$('#category').text(" ");
				$('#buyablePrice').text(" ");
				$('#lendablePrice').text(" ");
				$('#userAllNext_image').prop('disabled', true);
				$('.allUsersLendableBook').hide();
				$('.allUsersBuyableBook').hide();
				$('.details').hide();
				$('#imgTest').attr( 'src', endImage);
				ins =  bookID_arr.length - 1;
			}
}