var serverUrl = "http://localhost/curch_app/";
/*
* Clear message 
*/
$(document).ready(function() {
	$('.message').html('');
	loadOrganizations();
});

/*
* login click event handler
*/
$(document).on('click','#login',function() {
	var phone    = $('#phone').val();
	var password = $('#password').val();
	var org_id  = $('#org_id').val();
	var formData = $('#loginForm').serialize();
	var message = '';
	var flag     = 1 ;

	if( phone == "" ){
		message = "Please enter Phone";
		flag = 0;
		$('#phone').focus();
		$('.message').addClass('error').html(message);
	}	

	if ( ValidatePhone(phone) ){
		message = "Please enter valid Phone";
		flag = 0;
		$('#phone').focus();
		$('.message').addClass('error').html(message);
	}

	if ( password == "" ){
		message = "Please enter password";
		flag = 0;
		$('#password').focus();
		$('.message').addClass('error').html(message);
	}

	if( org_id == "-1" ){
		message = "Please enter Organization";
		flag = 0;
		$('#org_id').focus();
		$('.message').addClass('error').html(message);
	}

	if ( flag == 1 ){
		$.ajax({
			url  : serverUrl+'login.php',
			data : formData,
			method : 'POST',
			success: function( response ) {
			console.log(response)
				var objData = JSON.parse( response );
				if ( objData.code == 200 && objData.is_verified == 1 ){
		       		window.location.href = objData.url+'.php'
			    }
			    else if ( objData.code == 401 ){
			    	message = objData.data;
			    } else if ( objData.code == 405 ){
			    	message = objData.data;
			    }
			    $('.message').addClass('error').html(message);
		    },
		    error: function () {
		        if ( response.code == 401){
		       		window.location.replace('/');		       	
		        }
		        $('.message').addClass('error').html(message);
		    } 
		});
	}

});


/*
* loads the organization @ document ready
*/
function loadOrganizations(){
	$.ajax({
		url  : serverUrl+'getOrganization.php',
		method : 'GET',
		success: function( response ) {
			var objData = JSON.parse( response );
			var htm = '';
			htm += '<option value="-1">-- Select --</option>';
			if ( objData.code == 200  ){
				$.each( objData.data,function( index, cat){
					htm += '<option value="' + cat.id + '">'+ cat.name + '</option>';
				});
				$('#org_id').html(htm);
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