/*
* ------------------------------------------------------------------------------
* customers js file 
* Includes scripts for Memnbers
* Author Dinesh Kumar Muthukrishnan <dineshkumar@atozapplications.com>
* -------------------------------------------------------------------------------
*/

var serverUrl = "http://churchmgmt.in/";
/*
* Clear message 
*/
$(document).ready(function(){
	$('.message').html('');
	loadSubscription()
});

/*
* loads the Subscription @ document ready
*/
function loadSubscription(){
	var htm = '';
	htm += '<option value="-1">--- Select ---</option>';
	$.ajax({
		url  : serverUrl+'getSubscriptions.php',
		method : 'GET',
		success: function( response ) {
			var objData = JSON.parse( response );
			if( objData.code == 200 ){				
				$.each( objData.data ,function( index, subs ){
					htm += '<option value="'+ subs.id +'">'+ subs.name +'</option>';
				});
				$('#subscription').html(htm);
			}

			if( objData.code == 405 ){				
				message = objData.data;
			    $('.message').addClass('error').html(message);
			}
			
		}
	});
}

/*
* newMember click event handler
*/
$(document).on('click','#newCustomer',function() {
	var name      = $('#name').val();
	var alternate_no       = $('#alternate_no').val();
	var email     = $('#email').val();
	var mobile    = $('#phone').val();
	var address   = $('#address').val();
	var stype     = $('#subscription').val();
	var active    = $('#active').val();
	var formData  = new FormData($('#customerForm')[0]);
	var message   = '';
	var flag     = 1 ;

	if ( active == "-1" ){
		message = "Please select active";
		flag = 0;
		$('#active').focus();
		$('.message').addClass('error').html(message);
	}

	if ( stype == "-1" ){
		message = "Please select subscription";
		flag = 0;
		$('#subscription').focus();
		$('.message').addClass('error').html(message);
	}

	if ( address == "" ){
		message = "Please enter address";
		flag = 0;
		$('#address').focus();
		$('.message').addClass('error').html(message);
	}

	if ( mobile == "" ){
		message = "Please enter mobile";
		flag = 0;
		$('#phone').focus();
		$('.message').addClass('error').html(message);
	}

	if ( ValidatePhone(mobile) ==  false ){
		message = "Please enter valid Mobile";
		flag = 0;
		$('#phone').focus();
		$('.message').html(message);
	}

	if( email == "" ){
		message = "Please enter email";
		flag = 0;
		$('#email').focus();
		$('.message').addClass('error').html(message);
	}

	if ( ValidateEmail(email) ==  false ){
		message = "Please enter valid email";
		flag = 0;
		$('#email').focus();
		$('.message').html(message);
	}

	if ( flag == 1 ){
		$.ajax({
			url  : serverUrl+'postCustomer.php',
			data : formData,
			method : 'POST',
			processData: false,
    		contentType: false,
			success: function( response ) {
				console.log(response);
				var objData = JSON.parse( response );
				if ( objData.code == 200  ){
					message = objData.data;
					var url = objData.url;
		       		window.location.replace( url+'.php');
			    }else if ( objData.code == 401 ){
			    	message = objData.data;
			    	$('.message').addClass('error').html(message);
			    } else if ( objData.code == 405 ){
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
* Edit Member click event handler
*/
$(document).on('click','#editMember',function() {
	var name      = $('#name').val();
	var age       = $('#age').val();
	var email     = $('#email').val();
	var mobile    = $('#mobile').val();
	var address   = $('#address').val();
	var mtype     = $('#mtype').val();
	var active    = $('#active').val();
	var is_child_sch    = $('#is_child_sch').val();
	var no_of_child_sch    = $('#no_of_child_sch').val();
	var formData  = $('#editMemberForm').serialize();
	var message   = '';
	var flag     = 1 ;

	if ( active == "-1" ){
		message = "Please select active";
		flag = 0;
		$('#active').focus();
		$('.message').addClass('error').html(message);
	}

	if ( address == "" ){
		message = "Please enter address";
		flag = 0;
		$('#address').focus();
		$('.message').addClass('error').html(message);
	}

	if ( age == "" ){
		message = "Please enter age";
		flag = 0;
		$('#age').focus();
		$('.message').addClass('error').html(message);
	}

	if ( mobile == "" ){
		message = "Please enter mobile";
		flag = 0;
		$('#mobile').focus();
		$('.message').addClass('error').html(message);
	}

	if ( ValidatePhone(mobile) ==  false ){
		message = "Please enter valid Mobile";
		flag = 0;
		$('#mobile').focus();
		$('.message').html(message);
	}

	if( email == "" ){
		message = "Please enter email";
		flag = 0;
		$('#email').focus();
		$('.message').addClass('error').html(message);
	}

	if ( ValidateEmail(email) ==  false ){
		message = "Please enter valid email";
		flag = 0;
		$('#email').focus();
		$('.message').html(message);
	}

	if ( flag == 1 ){
		$.ajax({
			url  : serverUrl+'postMember.php',
			data : formData,
			method : 'POST',
			success: function( response ) {
				console.log(response);
				var objData = JSON.parse( response );
				if ( objData.code == 200  ){
					message = objData.data;
					var url = objData.url;
		       		window.location.replace( url+'.php');
			    }else if ( objData.code == 401 ){
			    	message = objData.data;
			    	$('.message').addClass('error').html(message);
			    } else if ( objData.code == 405 ){
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
* delete member click event
*/
$(document).on('click','.deleteMember',function() {
	var id = $(this).attr('data-id');
	$.ajax({
		url  : serverUrl+'deleteMember.php',
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