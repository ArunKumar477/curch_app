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
});

/*
* login click event handler
*/
$(document).on('click','#login',function() {
	
	var phone    = $('#phone').val();
	var password = $('#password').val();
	var formData = $('#loginForm').serialize();
	var message = '';
	var flag     = 1 ;

	if( phone == "" ){
		message = "Please enter Phone";
		flag = 0;
		$('#phone').focus();
		$('.message').html(message);
	}

	if ( ValidatePhone(phone) ){
		message = "Please enter valid Phone";
		flag = 0;
		$('#phone').focus();
		$('.message').html(message);
	}

	if ( password == "" ){
		message = "Please enter password";
		flag = 0;
		$('#password').focus();
		$('.message').html(message);
	}

	if ( flag == 1 ){
		$.ajax({
			url  : serverUrl+'login.php',
			data : formData,
			method : 'POST',
			success: function( response ) {
				console.log( response );
				var objData = JSON.parse( response );
				if ( objData.code == 200 && objData.is_verified == 1 ){
		       		window.location.href = objData.url+'.php'
			    }
			    else if ( objData.code == 401 ){
			    	message = objData.data;
			    } else if ( objData.code == 405 ){
			    	message = objData.data;
			    }

			    $('.message').html(message);
		    },
		    error: function () {
		        if ( response.code == 401){
		       		window.location.replace('/');		       	
		        }
		        $('.message').html(message);
		    } 
		});
	}

});
