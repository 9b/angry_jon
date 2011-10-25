<?php 
session_start(); 

#JSON is expected on the client side
header("Content-type: text/json");

$json = array(
	"results" => "",
	"error" => "",
	"success" => false
);

include '../database/database_connection.php';

if(!$_SESSION['logged_user']) {
	$json['error'] = "Login to send invites";
	echo json_encode($json);
}

$friend = $_POST['friend_email'];
$friend = addslashes($friend);

$username = $_SESSION['logged_user'];
$query = "SELECT invites FROM users WHERE username = '$username'";
$result = mysqli_query($link,$query);
$row = mysqli_fetch_assoc($result);
if($row['invites'] >= 1) {
	$len = 20;
	$invite_code = "";
	$symb = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890";
	for ($i = 0; $i < $len; $i++) {
		$num = rand(0, strlen($symb)-1);
		if (ereg($symb[ $num ],$invite_code)) {
			$i=$i-1;
		} else {
	     	$invite_code .= $symb[ $num ];
		}
	}
	
	//add the invite key to the database
	$save_code = "INSERT INTO codes(code,used) values('$invite_code',0)";
	$result = mysqli_query($link,$save_code);
	if($result) {
		$invites_left = $row['invites'] - 1;
		$withdraw = "UPDATE users SET invites = $invites_left";
		$result = mysqli_query($link,$withdraw);
		if($result) {
			$json['success'] = true;
		} else {
			$json['error'] = "Invite check failed";
			echo json_encode($json);
		}
	} else {
		$json['error'] = "Saving the invite failed";
		echo json_encode($json);	
	}

	//send out the invite
	$to = $friend;
	$headers = "From: <no-reply@angryjon.com>";
	$subject = "Invite to join Angry Jon";
	$message = "Someone thought you were worth an invite to AngryJon.com. Go check it out using this invite code: $invite_code";
	mail($to,$subject,$message,$headers);
				
	echo json_encode($json);
	
} else {
	$json['error'] = "No invites left";
	echo json_encode($json);	
}

?>