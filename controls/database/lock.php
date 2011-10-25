<?php 
/*
 * @author Brandon Dixon
 * @date 02/07/2011
 * @description Check to make sure the user is authenticated
 * @return Redirects user if they aren't good
 */

include('database_connection.php');

session_start();
$user_check = $_SESSION['logged_user'];

$query = "SELECT username FROM users where username='$user_check'";
$result = mysqli_query($link,$query);
$row = mysqli_fetch_array($result);

$login_session = $row['username'];

if(!isset($login_session)) {
	header('Location: http://128.164.14.171/angry_jon/login.php');
}

?>