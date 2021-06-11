

var serverUrl = "http://localhost/curch_app/";
/*
* Clear message 
*/
$(document).ready(function(){
	$('.message').html('');
});

/*
* change password click event handler
*/
$(document).on('click','#changePwd',function() {
	var old_pwd    = $('#old_password').val();
	var new_pwd    = $('#new_password').val();
	var formData   = $('#pwdChangeForm').serialize();
	var message   = '';
	var flag     = 1 ;

	if( new_pwd == "" ){
		message = "Please enter New Password";
		flag = 0;
		$('#new_password').focus();
		$('.message').addClass('error').html(message);
	}

	if ( old_pwd == "" ){
		message = "Please enter Old Password";
		flag = 0;
		$('#old_password').focus();
		$('.message').addClass('error').html(message);
	}

	if ( flag == 1 ){
		$.ajax({
			url  : serverUrl+'resetPwd.php',
			data : formData,
			method : 'POST',
			success: function( response ) {
				console.log(response);
				var objData = JSON.parse( response );
				if ( objData.code == 200  ){
					message = objData.data;
					$('.message').addClass('success').html(message);
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
