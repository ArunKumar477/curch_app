/*
* ------------------------------------------------------------------------------
* login js file 
* Includes scripts for logging in
* Author Dinesh Kumar Muthukrishnan <dineshkumar@atozapplications.com>
* -------------------------------------------------------------------------------
*/

var serverUrl = "http://localhost/sda2020/";
/*
* Clear message 
*/
$(document).ready(function(){
	$('.message').html('');
});

/*
* login click event handler
*/
$(document).on('click','#newCategory',function() {
	var name    = $('#name').val();
	var active = $('#active').val();
	var formData = $('#newCategoryForm').serialize();
	var message = '';
	var flag     = 1 ;

	if ( active == -1 ){
		message = "Please select active";
		flag = 0;
		$('#active').focus();
		$('.message').addClass('error').html(message);
	}

	if( name == "" ){
		message = "Please enter expense category name";
		flag = 0;
		$('#name').focus();
		$('.message').addClass('error').html(message);
	}

	if ( flag == 1 ){
		$.ajax({
			url  : serverUrl+'postCategory.php',
			data : formData,
			method : 'POST',
			success: function( response ) {
				console.log(response);
				var objData = JSON.parse( response );
				if ( objData.code == 200  ){
					message = objData.data;
					var url = objData.url;
		       		window/location.replace( url+'.php');
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
* delete category click event
*/
$(document).on('click','.deleteExpCat',function() {
	var id = $(this).attr('data-id');
	$.ajax({
		url  : serverUrl+'deleteExpensesCategory.php',
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