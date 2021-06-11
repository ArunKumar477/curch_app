/*
* ------------------------------------------------------------------------------
* Offerings js file 
* Includes scripts for Offerings
* Author Dinesh Kumar Muthukrishnan <dineshkumar@atozapplications.com>
* -------------------------------------------------------------------------------
*/

var serverUrl = "http://churchmgmt.in/";
var count = 0;

/*
* Clear message 
*/
$(document).ready(function(){
	$('.message').html('');
	$('.cheque_0').hide();

	$("#name").keyup(function(){
		$.ajax({
		type: "POST",
		url: "getUserList.php",
		data:'keyword='+$(this).val(),
		beforeSend: function(){
			$("#name").css("background","#FFF url(images/LoaderIcon.gif) no-repeat 165px");
		},
		success: function(data){
			$("#suggesstion-box").show();
			$("#suggesstion-box").html(data);
			$("#name").css("background","#FFF");
		}
		});
	});
});

function selectUser(val) {
	$("#name").val(val);
	$("#suggesstion-box").hide();
}

/*
* change event on mode
*/
$(document).on( 'change', '.mode', function(){
	var val = $(this).val();
	var thisId = $(this).attr('id');
	var cnt = thisId.split('_');
	console.log(cnt[1]);
	if( cnt[1] == "0"){
		if( val == 'cheque' ) {
			$('.cheque_0').show();
			$('.cheque_'+cnt[1]).addClass('show');
			$('.cheque_'+cnt[1]).removeClass('hide');
		}
		if( val == "cash" || val == "card" || val == "-1"  ){
			$('.cheque_0').hide();
			$('.cheque_'+cnt[1]).addClass('hide');
			$('.cheque_'+cnt[1]).removeClass('show');
		}
	}else{
		if( val == 'cheque' ) {
			$('.cheque_'+cnt[1]).addClass('show');
			$('.cheque_'+cnt[1]).removeClass('hide');
		}
		if( val == "cash" || val == "card" || val == "-1"  ){
			$('.cheque_'+cnt[1]).addClass('hide');
			$('.cheque_'+cnt[1]).removeClass('show');
		}
	}
});

/*
* change event on category
*/
$(document).on('change','.category',function(){
	var val = $(this).val();
	var thisId = $(this).attr('id');
	var cnt = thisId.split('_');
	var amt = $('#amount_'+cnt[1]).val();
	var cmshare = 0;
	var crshare = 0;
	$.ajax({
			url  : serverUrl+'getOffCategoryById.php',
			method : 'GET',
			data: { 'id' : val },
			success: function( response ) {
    			var objData = JSON.parse( response );
				if( objData.code == 200 ){
					$.each( objData.data,function( inx, dt ){
						var cms_share = dt.cmshare;
						var church_share = dt.crshare;
						if( cms_share == "50%"){
							cmshare = parseInt(amt)*50/100;
						}
						if( cms_share == "100%" ){
							cmshare = parseInt(amt)*100/100;
						}

						if( church_share == "50%"){
							crshare = parseInt(amt)*50/100;
						}
						if( church_share == "100%" ){
							crshare = parseInt(amt)*100/100;	
						}
					});					
				}
				console.log( cmshare + '-----' + crshare );
				$("#cms_share_"+cnt[1]).val(cmshare);
				$("#church_share_"+cnt[1]).val(crshare);		
		    },
		    error: function () {
		        $('.message').addClass('error').html('Request Failed. Cannot connect to server');
		    } 
	});
});


/*
* Offering click event handler
*/
$(document).on('click','#newOffering',function() {
	var name      = $('#name').val();
	var email     = $('#email').val();
	var mode      = $('#mode').val();
	var mobile    = $('#mobile').val();
	var address   = $('#address').val();
	var dt        = $('#off_date').val();
	var mtype     = $('#mtype').val();
	var active    = $('#active').val();
	var cat_id    = $('#category').val();
	var amount    = $('#amount').val();
	var cms_share    = $('#cms_share').val();
	var church_share    = $('#church_share').val();
	var formData = $('#newOfferingForm').serialize();
	var message = '';
	var flag     = 1 ;

	if ( active == "-1"  ){
		message = "Please select active";
		flag = 0;
		$('#active').focus();
		$('.message').addClass('error').html(message);
	}

	if ( cat_id == "-1"  ){
		message = "Please select Category";
		flag = 0;
		$('#category').focus();
		$('.message').addClass('error').html(message);
	}

	if ( mode == "-1" ){
		message = "Please select mode";
		flag = 0;
		$('#mode').focus();
		$('.message').addClass('error').html(message);
	}

	if ( address == "" ){
		message = "Please enter address";
		flag = 0;
		$('#address').focus();
		$('.message').addClass('error').html(message);
	}

	if ( amount == "" ){
		message = "Please enter Aamount";
		flag = 0;
		$('#amount').focus();
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

	if( name == "" ){
		message = "Please enter Name";
		flag = 0;
		$('#name').focus();
		$('.message').addClass('error').html(message);
	}

	if ( flag == 1 ){
		$.ajax({
			url  : serverUrl+'postOffering.php',
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
* load category on page load event
*/
function getOffCategory( cnt ){	
	var off = '';
	$.ajax({
		url  : serverUrl+'getOffCategory.php',
		method : 'GET',
		success: function( response ) {
			var objData = JSON.parse( response );
			if( objData.code == 200 ){				
				off += '<option value=""-1" ">-- SELECT --</option>';
				$.each( objData.data,function( inx, dt ){					
					off += '<option value="'+ dt.id +'" class="uppercase">'+ dt.name +'</option>';
				});
			}
			$('#category_'+cnt ).html(off);
		}
	});
}

/*
* delete category click event
*/
$(document).on('click','.deleteOffering',function() {
	var id = $(this).attr('data-id');
	$.ajax({
		url  : serverUrl+'deleteOfferings.php',
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


/*
* load category on page load event
*/
function loadOfferingsCat(){

	var html = '';
	html += '<div class="col-lg"-1" 2"><fieldset>';
	html += '<div class="col-lg-6">';
	html += '<div class="form-group">';
	html += '<label for="amount_'+count+'" class="col-md-4 control-label">Amount</label>';
	html += '<div class="col-md-6 amt">';
	html += '<input id="amount_'+count+'" type="text" class="form-control amount" name="amount[]" value="" required>';
	html += '</div>';
	html += '</div>';

	html += '<div class="form-group">';
	html += '<label for="mode_'+count+'" class="col-md-4 control-label">Mode</label>';
	html += '<div class="col-md-6">';
	html += '<select id="mode_'+count+'" name="mode[]" class="form-control mode">';
	html += '<option value=""-1" ">-- Mode of Fund --</option>';
	html += '<option value="cash">Cash</option>';
	html += '<option value="card">Card</option>';
	html += '<option value="cheque">Cheque</option>';
	html += '</select>';
	html += '</div>';
	html += '</div>';


	html += '<div class="form-group">';
	html += '<label for="category_'+count+'" class="col-md-4 control-label">Category</label>';
	html += '<div class="col-md-6">';
	html += '<select id="category_'+count+'" name="category[]" class="form-control uppercase category">';
	var cat = getOffCategory(count);
	html += cat;
	html += '</select>';
	html += '</div>';
	html += '</div>';                                
	html += '</div>';
	html += '<div class="col-lg-6">';
	html += '<div class="form-group hide cheque_'+count+'">';                                       
    html += '<label for="cheque_'+count+'" class="col-md-4 control-label">Cheque No</label>';
    html += '<div class="col-md-6">';
    html += '<input id="cheque_'+count+'" type="text" class="form-control cheque" name="cheque[]" value="" required>';
	html += '</div>';
    html += '</div>';
	html += '<div class="form-group">';
	html += '<label for="cms_share_'+count+'" class="col-md-4 control-label">CMS</label>';
	html += '<div class="col-md-6">';
	html += '<input id="cms_share_'+count+'" type="text" class="form-control" name="cms_share[]" value="" readonly>';
	html += '</div>';
	html += '</div>';
	html += '<div class="form-group">';
	html += '<label for="church_share_'+count+'" class="col-md-4 control-label">LCF</label>';
	html += '<div class="col-md-6">';
	html += '<input id="church_share_'+count+'" type="text" class="form-control" name="church_share[]" value="" readonly>';
	html += '</div>';
	html += '</div>';
	html += '</div>';
	html += '</fieldset>';
	html += '<a href="void:javascript(0);" class="addMoreBlk" id="addMoreBlk_'+ count+'">Add More</a></div>';
	return html;
}

$(document).on('click', '.addMoreBlk', function(){
	count++;
	var htm = '';
	htm += loadOfferingsCat();
	$(this).after(htm); 	
});


/*
* Offering click event handler
*/
$(document).on('click','#editOffering',function() {
	var name      = $('#name').val();
	var email     = $('#email').val();
	var mobile    = $('#mobile').val();
	var dt        = $('#off_date').val();
	var address   = $('#address').val();
	var mode      = $('#mode').val();
	var mtype     = $('#mtype').val();
	var active    = $('#active').val();
	var cat_id    = $('#category').val();
	var amount    = $('#amount').val();
	var cms_share    = $('#cms_share').val();
	var church_share    = $('#church_share').val();
	var formData = $('#editOfferingForm').serialize();
	var message = '';
	var flag     = 1 ;

	if ( active == "-1"  ){
		message = "Please select active";
		flag = 0;
		$('#active').focus();
		$('.message').addClass('error').html(message);
	}

	if ( cat_id == "-1"  ){
		message = "Please select Category";
		flag = 0;
		$('#category').focus();
		$('.message').addClass('error').html(message);
	}

	if ( mode == "-1" ){
		message = "Please select mode";
		flag = 0;
		$('#mode').focus();
		$('.message').addClass('error').html(message);
	}

	if ( address == "" ){
		message = "Please enter address";
		flag = 0;
		$('#address').focus();
		$('.message').addClass('error').html(message);
	}

	if ( amount == "" ){
		message = "Please enter Aamount";
		flag = 0;
		$('#amount').focus();
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

	if( name == "" ){
		message = "Please enter Name";
		flag = 0;
		$('#name').focus();
		$('.message').addClass('error').html(message);
	}

	if ( flag == 1 ){
		$.ajax({
			url  : serverUrl+'postOffering.php/',
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