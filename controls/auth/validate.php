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

$code = $_POST['code'];
$username = $_POST['username'];
$password = $_POST['password'];

//$username = "bullshit";
//$password = "fuck";

#sanity checks
if ($code == "" && ($username == "" && $password == "")) {
	$json['error'] = "No data was passed";
	echo json_encode($json); 	
}

if ($code == "") { //handle login
	$username = addslashes($username);
	$password = addslashes($password);
	$hashed = hash('sha256',$password);
	$query = "SELECT COUNT(*) as count FROM users WHERE username = '$username' AND password = '$hashed'";
	$result = mysqli_query($link,$query);
	$row = mysqli_num_rows($result);
	
	if($row >= 1) {
		$_SESSION['logged_user'] = $username;
		$json['success'] = true;
		$json['results'] = "login";
	} else {
		$json['error'] = "Wrong username/password combination";
	}
	
	echo json_encode($json);
	
} else { //handle code validation
	$code = addslashes($code);
	$query = "SELECT COUNT(*) as count FROM codes WHERE code = '$code' AND used = 0";
	$result = mysqli_query($link,$query);
	$row = mysqli_fetch_assoc($result);
	
	if($row['count'] == 1) { //code is valid
		$_SESSION['invite_code'] = $code;
		$json['success'] = true;
	} else { //invalid code or already in use
		$json['error'] = "Invalid code";
	}

	echo json_encode($json);
}

?>