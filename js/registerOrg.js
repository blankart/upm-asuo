function OrgRegEmailChecker(){
	var email = $("#OrgRegEmailAdd").val();
	$.ajax({
		type: "post",
		url: "<?php echo base_url(); ?>org/checkRegOrgEmail",
		cache: false,
		data: {orgemail: email},
		dataType: 'json',
		async: false,
		success: function(result){
			swal("something");
			if (result){
				$("#orgEmailTaken").removeClass();
				$("#orgEmailTaken").html('');
				$("#orgEmailTaken").addClass('notice notice-sm notice-success');
				$('#orgEmailTaken').html('<strong>You\'re good to go! Email is valid.</strong>');
				$('#orgEmailTaken').fadeIn();
			}
			else{

			}
		}
	});
	
}