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

if ($link == null) { 
	$json['error'] = "database connection failed";
	echo json_encode($json); 
} 

$username = $_POST['username'];
$password = $_POST['password'];
$confirm_password = $_POST['confirm_password'];
$email = $_POST['email'];
$code = $_POST['code'];

if(!$_SESSION['invite_code']) {
	$json['error'] = "Invite code not registered";
	echo json_encode($json);
}

//check username
$username = addslashes($username);
$query = "SELECT COUNT(*) as count FROM users WHERE username = '$username'";
$result = mysqli_query($link,$query);
$row = mysqli_fetch_assoc($result);

if($row['count'] == 1) {
	$json['error'] = "Username taken";
	echo json_encode($json);
}

//check passwords
if($password != $confirm_password) {
	$json['error'] = "Passwords don't match";
	echo json_encode($json);	
}

//go on
$password = addslashes($password);
$email = addslashes($email);
$hashed = hash('sha256',$password);
$code = addslashes($code);

$query = "INSERT INTO users(username, password, code, email,invites) VALUES('$username','$hashed','$code','$email',1)";
$result = mysqli_query($link,$query);
if(!$result) {
	$json['error'] = "Registration failed";
} else {
	$_SESSION['logged_user'] = $username;
	$json['success'] = true;
	$update = "UPDATE codes set used = 1 where code = '$code'";
	mysqli_query($link,$update);
}

echo json_encode($json);
?>