$(function(){
	$(".searchInternalForAllUserView").keyup(function(){
		var searchid = $('#searchInternalForAllUserView').val();
		var dataString = 'search='+ searchid; 
		if(searchid !=''){
			$.ajax({
				url:searchInternalForAllUser,
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
				url:searchInternalForAllUser,
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
function userBlock(userID){
	window.userID = userID;
	$('#ModalOfBlock').modal('show');
	$.ajax({
		type:"POST",
		url:blockOrNot,
		data:{userID:userID},
		dataType: "JSON",
		success: function(data){
			window.block = data.block;
		}
	});
}
function confirmBlock(){
	if(window.block == 0){
		yesOrNo(1);
	}
	else{
		yesOrNo(0);
	}
}
function yesOrNo(blockID){
	$.ajax({
		type:"POST",
		url:confirmAndBlock,
		data:{blockIDs:blockID, userIDs:window.userID},
		dataType:"JSON",
		success: function(data){
			$("#ModalOfBlock").modal('hide');
			$("#ModalOfBlock").on("hidden.bs.modal", function(){
				location.reload();
			});
		}
	});
}