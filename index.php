<?php 
include('controls/database/lock.php');
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Angry Jon</title>
	    <link rel="stylesheet" type="text/css" href="media/css/notifications.css"> 
	    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.4/jquery.min.js" type="text/javascript"></script>
   	    <script src="media/script/notifications.js" type="text/javascript"></script>
   	    <script src="media/script/invite.js" type="text/javascript"></script>
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
		
    	<input id="email" class="register_elements" type="email" placeholder="E-mail" required>
        <input type="submit" id="submit" value="Submit">
	</body>

</html>