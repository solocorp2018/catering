function token(){
return $('meta[name="csrf-token"]').attr('content');
}	
function feedUrl(url=''){
	var base_url = $('meta[name="base-url"]').attr('content');
	if(url) {
		return base_url+url;
	}
	return base_url;
}


$("#register-form").validate({
		rules: {
			name: {
				required:true,
				minlength:2,
				maxlength:50
			},
			email: {
				required: false,
				email: true				
			},			
			contact_number:{
				required: true,
				digits: true,
				minlength:10,
				maxlength:10,
				remote:triggerOtp()
			},
			otp : {
				required:true,
				digits:true,
				minlength:4,
				maxlength:4,
				remote:validateOtp()
			},
			address_line_1:{
				required:true,
				minlength:1,
				maxlength:100	
			},
			address_line_2:{
				required:false,
				minlength:1,
				maxlength:100	
			},
			city:{
				required:true,
				minlength:1,
				maxlength:50	
			},
			pincode:{
				required:true,
				digits:true,
				minlength:6,
				maxlength:7	
			},		
			otpVerified:{
				required:true
			}
		},
		messages: {			
			name: "Please enter your name",
			email: "Please enter a valid email address",
			contact_number: "Please enter a valid mobile number",
			otp: "Please enter a valid OTP",
			address_line_1: "Please enter a valid address line 1",
			address_line_2: "Please enter a valid address line 2",
			city: "Please enter a valid city name",
			pincode: "Please enter a valid pincode",
			otpVerified: "Please enter a valid pincode",
		},
		errorPlacement: function (error, element) {
		    error.insertAfter(element.parent('div'));
		},		
		submitHandler: function(form) {
		    registerForm();
		}
	});

$(document).on('keyup','#contact_number', function(){
	var contactNumber = $(this).val();
	if(contactNumber.length == 10) {
		$("#opt").val('');
		triggerOtp();
	} 
});

$(document).on('keyup','#otp', function(){
	var otp = $(this).val();
	if(otp.length == 4) {		
		if($("#contact_number").val().length == 10) {
			validateOtp();	
		} else {
			alert("Please Enter Valid Mobile Number");
		}		
	} 
});

$(document).on('click','.openRegisterModal',function() {
	$('.close').click();
});

$(document).on('click','.openLoginModal',function() {	
	$('.close').click();
	
});

function triggerOtp() {

	var contactNumber = $("#contact_number").val();

	if(typeof contactNumber == "undefined" || contactNumber.length < 10) {
		return false;
	}
	var formData = {
		_token:token(),
		contactNumber:contactNumber
	};
	console.log(formData);

	$.ajax({
        method:"POST",
        url: feedUrl('/api/trigger-otp'),
        data: formData, 
        success: function( data ) {
            alert( data.message );
        }
    });
}

function validateOtp() {

	var contactNumber = $("#contact_number").val();
	var otp = $("#otp").val();

	if(typeof contactNumber == "undefined" || contactNumber.length < 10) {
		return false;
	}
	if(typeof otp == "undefined" || otp.length < 4) {
		return false;
	}
	var formData = {
		_token:token(),
		contactNumber:contactNumber,
		otp:otp
	};
	$.ajax({
        type: "POST",
        url: feedUrl('/api/validate-otp'),
        data: formData, 
        success: function( data ) {
            alert( data.message );
            $("#contact_number").attr('disable',true);
            $("#otp").attr('disable',true);
            $("#otpVerified").val(token());
        }
    });
}

function registerForm() {

	var formData = {
		_token:$("#otpVerified").val(),
		name : $("#name").val(),
		contactNumber : $("#contact_number").val(),
		otp : $("#otp").val(),
		email : $("#email").val(),
		address_line_1 : $("#address_line_1").val(),
		address_line_2 : $("#address_line_2").val(),
		city : $("#city").val(),
		pincode : $("#pincode").val(),
	};
	$.ajax({
        type: "POST",
        url: feedUrl('/api/register-user'),
        data: formData, 
        success: function( data ) {
            alert( data.message );
        }
    });
}