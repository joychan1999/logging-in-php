<?php
//start session
session_start();
 
include_once('storing_con.php');
 
$user = new Databases();
 
if(isset($_POST['login'])){
	$username = $user->escape_string($_POST['username']);
	$password = $user->escape_string($_POST['password']);
 
	$auth = $user->login($username, $password);
 
	if(!$auth){
		$_SESSION['message'] = 'Invalid username or password';
    	header('location:../index.php');
	}
	else{
		$_SESSION['user'] = $auth;
		header('location:buyer.php');
	}
}
else{
	$_SESSION['message'] = 'You need to login first';
	header('location:../index.php');
}
?>