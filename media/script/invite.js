$(document).ready(function() {
	$('#submit').click(function() {
		var friend_email = $('#email').val();
	    $.ajax({
	        url: 'controls/core/invite.php',
	        type: 'post',
	        dataType: 'json',
	        data: { friend_email: friend_email },
	        success: function(data) {
	        	if (data.success){
	        		$('#success_message').text("Invite sent");
        			$('.success').animate({top:"0"}, 500).delay(3000).animate({top: -$('.success').outerHeight()}, 500);
	        	} else {
	        		$('#error_message').text(data.error);
        			$('.error').animate({top:"0"}, 500).delay(3000).animate({top: -$('.error').outerHeight()}, 500);
	        	}
	        }
	    })
		return false;
	});
});