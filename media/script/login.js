/*
 * Controls the functionality for the login page
 */

$(document).ready(function() {
	$('#aux_links').click(function() {
		$(this).text("Invite Code");
		$('#header_login').fadeOut(500,function(){
			$(this).text("Login").fadeIn(500);
		})
		
		$('#invite_code').val('');
		$('#login').animate({
			height: '250px'
		})
		
		$('.login_elements').fadeIn(1000);
		$('#invite_code').hide();
		$('#confirm_password').hide();
		return false;
	});
	
	$('#submit').click(function() {
		var code = $('#invite_code').val();
		var login_username = $('#username').val();
		var login_password = $('#password').val();
		
		if (code != "" || (login_username != "" && login_password != "")) {
		    $.ajax({
		        url: 'controls/auth/validate.php',
		        type: 'post',
		        dataType: 'json',
		        data: { username: login_username, password: login_password, code: code },
		        success: function(data) {
		        	if (data.success){
		        		var login = data.results;
		        		if(login == "login") {
		        			window.location = "index.php";
		        		} else {
		        			$('#header_login').fadeOut(500,function(){
		        				$(this).text("Register").fadeIn(500);
		        			})
		        			$('#login').animate({
		        				height: '375px'
		        			})
		        			$('.register_elements').fadeIn(1000);
		        			$('#invite_code').hide();
		        			$('#submit').attr("class","register");
		        			$('.register').bind('click',function() {
		        				var username = $('#username').val();
		        				var password = $('#password').val();
		        				var confirm_password = $('#confirm_password').val();
		        				var email = $('#email').val();
		        				if (password != confirm_password) {
		    		        		$('#error_message').text("Passwords do not match");
		    	        			$('.error').animate({top:"0"}, 500).delay(3000).animate({top: -$('.error').outerHeight()}, 500);
		        				} else {
			        				$.ajax({
			        			        url: 'controls/auth/register.php',
			        			        type: 'post',
			        			        dataType: 'json',
			        			        data: { username: username, password: password, confirm_password: confirm_password, email: email, code: code },
			        			        success: function(data) {
			        			        	if (data.success){
			        			        		$('#success_message').text("Registration successful");
					    	        			$('.success').animate({top:"0"}, 500).delay(3000).animate({top: -$('.success').outerHeight()}, 500);
					    	        			window.location = "index.php";
			        			        	} else {
			        			        		$('#error_message').text("Registration failed");
					    	        			$('.error').animate({top:"0"}, 500).delay(3000).animate({top: -$('.error').outerHeight()}, 500);
			        			        	}
			        			        }
			        				});	
		        				}
		        			})
		        		}
		        	} else {
		        		$('#error_message').text(data.error);
	        			$('.error').animate({top:"0"}, 500).delay(3000).animate({top: -$('.error').outerHeight()}, 500);
		        	}
		        }
		    })	
		}	  
		return false;
		// --- END submit click ---
	});
});
 