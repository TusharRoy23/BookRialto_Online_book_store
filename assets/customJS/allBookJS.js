var reportID_arr = [];
var ins2 = 0;
var ins3 = 0;
var checks1 = 0;

var userID_arr = [];
var ins = 0;
var ins1 = 0;
var checks = 0;

var pages = [];
var ins4 = 0;
var ins5 = 0;
var checks2 = 0;

function show_users(bookID){
	var myModal = $('#extraFeatures');
	$.ajax({
		type:"POST",
		url:show_users_for_book_view,
		data:{bookID:bookID},
		dataType: "JSON",
		success:function(data){
			var count = Object.keys(data).length;
			if(count != '0'){
				for(i = 0; i<count; i++){
					userID_arr[i] = data[i].clientID;
				}
				$('#allUsersShowForBookView').modal('show');
				$("#allUsersShowForBookView").on("hidden.bs.modal", function(){
					location.reload();
				});
			}
			else{
				myModal.find('.modal-body').text('No User available');
				myModal.find('.modal-title').text('Reports');
				myModal.modal('show');
			}
			user_prevs();
		}
	});
}
function user_prevs(){
	if(ins != 0){
		$('.detailsForUsers').show();
		$.ajax({
			type:"POST",
			url:return_all_user_info,
			data:{userID:userID_arr[ins]},
			dataType:"JSON",
			success:function(data){
				$('#Namess').text(data.firstName +" "+data.lastName);
				$('#eMail').text(data.eMail);
				$('#contact').text(data.contactNo);
				$('#memberSince').text(data.memberSince);
				if(!data.imageLink){
					$( '#imgTestUsers' ).attr( 'src' , defaultProfileImage);
				}
				else{
					$( '#imgTestUsers' ).attr( 'src' , ProfileImage+"/"+ data.imageLink);
				}
			}
		});
		ins1 = ins + 1;
		ins = ins - 1;
		$('#user_nexts_image').prop('disabled', false);
	}
	else{
		if(checks == 1){
			$('.detailsForUsers').show();
			$.ajax({
				type:"POST",
				url:return_all_user_info,
				data:{userID:userID_arr[ins]},
				dataType:"JSON",
				success:function(data){
					$('#Namess').text(data.firstName +" "+data.lastName);
					$('#eMail').text(data.eMail);
					$('#contact').text(data.contactNo);
					$('#memberSince').text(data.memberSince);
					if(!data.imageLink){
						$( '#imgTestUsers' ).attr( 'src' , defaultProfileImage);
					}
					else{
						$( '#imgTestUsers' ).attr( 'src' , ProfileImage+"/"+ data.imageLink);
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
			$('#Namess').text(" ");
			$('#eMail').text(" ");
			$('#contact').text(" ");
			$('#memberSince').text(" ");
			$('#user_prevs_image').prop('disabled', true);
			$('#user_nexts_image').prop('disabled', false);
			$('.detailsForUsers').hide();
			$('#imgTestUsers').attr( 'src', startImage);
		}
	}
}
function user_nexts(){
	checks = 1;
	if(userID_arr.length > ins1){
		$('.detailsForUsers').show();
		if(ins1 == 0){
			$('#user_prevs_image').prop('disabled', false);
			$.ajax({
				type:"POST",
				url:return_all_user_info,
				data:{userID:userID_arr[ins1]},
				dataType:"JSON",
				success:function(data){
					$('#Namess').text(data.firstName +" "+data.lastName);
					$('#eMail').text(data.eMail);
					$('#contact').text(data.contactNo);
					$('#memberSince').text(data.memberSince);
					if(!data.imageLink){
						$( '#imgTestUsers' ).attr( 'src' , defaultProfileImage);
					}
					else{
						$( '#imgTestUsers' ).attr( 'src' , ProfileImage+"/"+ data.imageLink);
					}
				}
			});
			ins1 = ins1 + 1;
			ins = 0;
			checks = 0;
		}
		else{
			$('.detailsForUsers').show();
			$('#user_prevs_image').prop('disabled', false);
			$.ajax({
				type:"POST",
				url:return_all_user_info,
				data:{userID:userID_arr[ins1]},
				dataType:"JSON",
				success:function(data){
					$('#Namess').text(data.firstName +" "+data.lastName);
					$('#eMail').text(data.eMail);
					$('#contact').text(data.contactNo);
					$('#memberSince').text(data.memberSince);
					if(!data.imageLink){
						$( '#imgTestUsers' ).attr( 'src' , defaultProfileImage);
					}
					else{
						$( '#imgTestUsers' ).attr( 'src' , ProfileImage+"/"+ data.imageLink);
					}
				}
			});
			ins = ins1 - 1;
			ins1 = ins1 + 1;
		}
	}
	else{
		$('#Namess').text(" ");
		$('#eMail').text(" ");
		$('#contact').text(" ");
		$('#memberSince').text(" ");
		$('#user_nexts_image').prop('disabled', true);
		$('.detailsForUsers').hide();
		$('#imgTestUsers').attr( 'src', endImage);
		ins =  userID_arr.length - 1;
	}
}
function show_pages(bookID){
	var myModal = $('#extraFeatures');
	$.ajax({
		type:"POST",
		url:return_all_pages,
		data:{bookID:bookID},
		dataType:"JSON",
		success:function(data){
			var count = Object.keys(data).length;
			if(count != '0'){
				for(i = 0; i<count; i++){
					pages[i] = data[i].pageImageLink;
				}
				$('#showPagesModal').modal('show');
				$('.modal-title').text('Show Pages');
				$("#showPagesModal").on("hidden.bs.modal", function(){
					location.reload();
				});
			}
			else{
				myModal.find('.modal-body').text('No Page available');
				myModal.find('.modal-title').text('Reports');
				myModal.modal('show');
			}
			prev();
		}
	});
}
function prev(){
	if(pages.length != 0){
		if(ins4 != 0){
			$( '#slideshow_image' ).attr( 'src' , show_pages_of_a_book+"/"+ pages[ins4]);
			ins5 = ins4 + 1;
			ins4 = ins4 - 1;
			$('#next_image').prop('disabled', false);
		}
		else{
			if(checks2 == 1){
				$( '#slideshow_image' ).attr( 'src' , show_pages_of_a_book+"/"+ pages[ins4]);
				ins5 = 1;
				ins4 = 0;
				checks2 = 0;
			}
			else{
				ins5 = 0;
				ins4 = 0;
				checks2 = 0;
				$('#prev_image').prop('disabled', true);
				$('#next_image').prop('disabled', false);
				$('#slideshow_image').attr( 'src', startImage);
			}
		}
	}
	else{
		$('#next_image').prop('disabled', true);
		$('#prev_image').prop('disabled', true);
		$('#slideshow_image').attr( 'src', no_pages);
	}
}
function nexts(){
	checks2 = 1;
	if(pages.length != 0){
		if(pages.length > ins5){
			if(ins1 == 0){
				$('#prev_image').prop('disabled', false);
				$( '#slideshow_image' ).attr( 'src' , show_pages_of_a_book+"/"+ pages[ins5]);
				ins5 = ins5 + 1;
				ins4 = 0;
				checks2 = 0;
			}
			else{
				$('#prev_image').prop('disabled', false);
				$( '#slideshow_image' ).attr( 'src' , show_pages_of_a_book+"/"+ pages[ins5]);
				ins4 = ins5 - 1;
				ins5 = ins5 + 1;
			}
		}
		else{
			$('#next_image').prop('disabled', true);
			$('#slideshow_image').attr( 'src', endImage);
			ins4 =  pages.length - 1;
		}
	}
	else{
		$('#next_image').prop('disabled', true);
		$('#prev_image').prop('disabled', true);
		$('#slideshow_image').attr( 'src', no_pages);
	}
}
function show_reports(bookID){
	var myModal = $('#extraFeatures');
	$.ajax({
		type:"POST",
		url:show_reports_for_book_view,
		data:{bookID:bookID},
		dataType:"JSON",
		success:function(data){
			var count = Object.keys(data).length;
			if(count != '0'){
				for(i = 0; i<count; i++){
					reportID_arr[i] = data[i].reportID;
				}
				$('#allUsersReportForBookView').modal('show');
				$("#allUsersReportForBookView").on("hidden.bs.modal", function(){
					location.reload();
				});
			}
			else{
				myModal.find('.modal-body').text('No Reports for this User');
				myModal.find('.modal-title').text('Reports');
				myModal.modal('show');
			}
			report_prevs();
		}
	});
}
$(document).ready(function(){
	$( "#user_prevs_image" ).click(function(){
		user_prevs();
	});
	$( "#user_nexts_image" ).click(function(){
		user_nexts();
	});
	$('#report_prevs_image').click(function(){
		report_prevs();
	});
	$('#report_nexts_image').click(function(){
		report_nexts();
	});
	$( "#prev_image" ).click(function(){
		prev();
	});
	$( "#next_image" ).click(function(){
		nexts();
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
$(function(){
	$(".searchInternalForAllUserView").keyup(function(){
		var searchid = $('#searchInternalForAllUserView').val();
		var dataString = 'search='+ searchid; 
		if(searchid !=''){
			$.ajax({
				url:searchInternalForAllBook,
				type: "POST",
				data: dataString,
				cache: false,
				success: function(html){
					$("#problem").html(html).show();
					/*$("#name").append(html.firstName +" "+html.lastName);
					$("#email").append(html.eMail);
					$("#contactNo").append(html.contactNo);*/
					
				}
			});
		}
		else{
			$.ajax({
				url:searchInternalForAllBook,
				type: "POST",
				data: dataString,
				cache: false,
				success: function(html){
					$("#problem").html(html).show();
				}
			});
		}
		return false; 
	});
});