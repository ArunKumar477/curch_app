/*
* ------------------------------------------------------------------------------
* Common js file 
* Includes scripts for validations on form elements
* Author Dinesh Kumar Muthukrishnan <dineshkumar@atozapplications.com>
* -------------------------------------------------------------------------------
*/

/*
* Method for validating email
*/
function ValidateEmail(email) {
	if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(email))	{
	    return true;
	}
	else{
		return false;
	}
}

/*
* Method for validating username
*/
function validateUsername( username ){
	var pattern = /^([_a-z0-9]+(\.[_a-z0-9]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,5}))|\d+$/;
	if( pattern.test(username) ){
		return true;
	}else{
		return false;
	}
}

/*
* Method for validating Phone
*/
function ValidatePhone( phone ){
	var pattern = /^([0-9]{10,10})$/;
	if( pattern.test(phone) ){
		return true;
	}else{
		return false;
	}
}


/*
* Method for validating Phone
*/
function ValidateNumber( no ){
	var pattern = /^([0-9])$/;
	if( pattern.test(no) ){
		return true;
	}else{
		return false;
	}
}
