
var serverUrl = "http://localhost/curch_app/";

//var serverUrl = "http://sdachurch.xyz/";

/*
* Clear message 
*/
$(document).ready(function(){
	$('.message').html('');
});

/*
* otp click event handler
*/
$(document).on('click','#otp',function() {
	
	var phone    = $('#phone').val();
	var password = $('#otp').val();
	var formData = $('#otpForm').serialize();
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

	if ( otp == "" ){
		message = "Please enter OTP";
		flag = 0;
		$('#otp').focus();
		$('.message').html(message);
	}

	if ( flag == 1 ){
		$.ajax({
			url  : serverUrl+'verifyOtp.php',
			data : formData,
			method : 'POST',
			success: function( response ) {
				console.log( response );
				var objData = JSON.parse( response );			
				if ( objData.code == 200 ){
		       		window.location.href = objData.url+'.php';
			    } else if ( objData.code == 405 ){
			    	message = objData.data;
			    }else if ( objData.code == 401 ){
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
