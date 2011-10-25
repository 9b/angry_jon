<!DOCTYPE html>
<html>
	<head>
		<title>Login</title>
	    <link rel="stylesheet" type="text/css" href="media/css/login.css"> 
	    <link rel="stylesheet" type="text/css" href="media/css/notifications.css"> 
	    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.4/jquery.min.js" type="text/javascript"></script>
   	    <script src="media/script/notifications.js" type="text/javascript"></script>
   	    <script src="media/script/login.js" type="text/javascript"></script>
	</head>

	<body>
		<div class="info message">
			<h3></h3>
		</div>
		
		<div class="error message">
			<h3 id="error_message"></h3>
		</div>
		
		<div class="warning message">
			<h3></h3>
		</div>
		
		<div class="success message">
			<h3 id="success_message"></h3>
		</div>
	
		<form id="login">
			<h1 id="header_login">Invite Code</h1>
		    <fieldset id="inputs">
		    	<input id="username" class="login_elements register_elements" type="text" placeholder="Username" autofocus required>
		    	<input id="email" class="register_elements" type="email" placeholder="E-mail" required>
       			<input id="password" class="login_elements register_elements" type="password" placeholder="Password" required>
       			<input id="confirm_password" class="register_elements" type="password" placeholder="Confirm Password" required>
		        <input id="invite_code" type="text" placeholder="Code" autofocus required>
		    </fieldset>
		    
		    <fieldset id="actions">
		        <input type="submit" id="submit" value="Submit">
		        <a href="" id="aux_links">Member Login</a>
		    </fieldset>
		</form>
	</body>

</html>