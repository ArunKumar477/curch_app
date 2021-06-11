/*
* ------------------------------------------------------------------------------
* Offerings Category js file 
* Includes scripts for Offerings category
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
* Offering Category click event handler
*/
$(document).on('click','#newOfferingCat',function() {
	var name    = $('#name').val();
	var cms_share = $('#cms_share').val();
	var church_share = $('#church_share').val();
	var active = $('#active').val();
	var formData = $('#offeringCatForm').serialize();
	var message = '';
	var flag     = 1 ;

	if ( active == -1 ){
		message = "Please select active";
		flag = 0;
		$('#active').focus();
		$('.message').addClass('error').html(message);
	}

	if( name == "" ){
		message = "Please enter Offering category name";
		flag = 0;
		$('#name').focus();
		$('.message').addClass('error').html(message);
	}

	if( cms_share == "" ){
		message = "Please enter CMS share";
		flag = 0;
		$('#cms_share').focus();
		$('.message').addClass('error').html(message);
	}

	if( church_share == "" ){
		message = "Please enter Church share";
		flag = 0;
		$('#church_share').focus();
		$('.message').addClass('error').html(message);
	}

	if ( flag == 1 ){
		$.ajax({
			url  : serverUrl+'postOfferingCat.php',
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
$(document).on('click','.deleteOffCat',function() {
	var id = $(this).attr('data-id');
	$.ajax({
		url  : serverUrl+'deleteOfferingsCategory.php',
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