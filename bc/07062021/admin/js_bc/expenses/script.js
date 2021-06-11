/*
* ------------------------------------------------------------------------------
* login js file 
* Includes scripts for logging in
* Author Dinesh Kumar Muthukrishnan <dineshkumar@atozapplications.com>
* -------------------------------------------------------------------------------
*/

var serverUrl = "http://churchmgmt.in/";
/*
* Clear message 
*/
$(document).ready(function(){
	$('.message').html('');
	loadCategory();
	loadUser();
});

function loadCategory(){
	$.ajax({
			url  : serverUrl+'getCategory.php',
			method : 'GET',
			success: function( response ) {
				var objData = JSON.parse( response );
				var htm = '';
				htm += '<option value="">-- Select --</option>';
				if ( objData.code == 200  ){
					$.each( objData.data,function( index, cat){
						htm += '<option value="' + cat.id + '">'+ cat.name + '</option>';
					});
					$('#cat_id').html(htm);
			    }
			    else if ( objData.code == 405 ){
			    	message = objData.data;
			    	$('.message').addClass('error').html(message);
			    } 			    
		    },
		    error: function () {
		        $('.message').addClass('error').html('Request Failed. Cannot connect to server');
		    } 
	});
}


function loadUser(){
	$.ajax({
			url  : serverUrl+'getUser.php',
			method : 'GET',
			success: function( response ) {
				console.log(response);
				var objData = JSON.parse( response );
				var htm = '';
				htm += '<option value="">-- Select --</option>';
				if ( objData.code == 200  ){
					$.each( objData.data,function( index, user ){
						htm += '<option value="' + user.id + '">'+ user.name + '</option>';
					});
					$('#created_by').html(htm);
			    }
			    else if ( objData.code == 405 ){
			    	message = objData.data;
			    	$('.message').addClass('error').html(message);
			    } 			    
		    },
		    error: function () {
		        $('.message').addClass('error').html('Request Failed. Cannot connect to server');
		    } 
	});
}

/*
* login click event handler
*/
$(document).on('click','#newExpense',function() {
	var cat_id    = $('#cat_id').val();
	var amount    = $('#amount').val();
	var created_by    = $('#created_by').val();
	var expense_date    = $('#expense_date').val();
	var formData  = $('#newExpenseForm').serialize();
	var message   = '';
	var flag     = 1 ;

	if ( expense_date == "" ){
		message = "Please select created_by";
		flag = 0;
		$('#cat_id').focus();
		$('.message').addClass('error').html(message);
	}

	if ( created_by == -1 ){
		message = "Please select created_by";
		flag = 0;
		$('#created_by').focus();
		$('.message').addClass('error').html(message);
	}

	if ( cat_id == -1 ){
		message = "Please select created by";
		flag = 0;
		$('#cat_id').focus();
		$('.message').addClass('error').html(message);
	}

	if ( ValidateNumber(amount) ){
		message = "Please enter valid amount";
		flag = 0;
		$('#amount').focus();
		$('.message').html(message);
	}

	if( amount == "" ){
		message = "Please enter expense amount";
		flag = 0;
		$('#amount').focus();
		$('.message').addClass('error').html(message);
	}

	if ( flag == 1 ){
		$.ajax({
			url  : serverUrl+'postExpense.php',
			data : formData,
			method : 'POST',
			success: function( response ) {
				console.log(response);
				var objData = JSON.parse( response );
				if ( objData.code == 200  ){
					message = objData.data;
					var url = objData.url;
		       		window.location.replace( url+'.php');
			    }
			    else if ( objData.code == 405 ){
			    	message = objData.data;
			    	$('.message').addClass('error').html(message);
			    } 			    
		    },
		    error: function () {
		        $('.message').addClass('error').html('Request Failed. Cannot connect to server');
		    } 
		});
	}

});

/*
* delete expesnse click event
*/
$(document).on('click','.deleteExpense',function() {
	var id = $(this).attr('data-id');
	$.ajax({
		url  : serverUrl+'deleteExpense.php',
		method : 'GET',
		data   : { 'id':id },
		success: function( response ) {
			var objData = JSON.parse( response );
			if( objData.code == 200 ){				
				message = objData.data;
				var url = objData.url;
		       	window.location.replace( url+'.php');
			}

			if( objData.code == 405 ){				
				message = objData.data;
			    $('.message').addClass('error').html(message);
			}
			
		}
	});
});