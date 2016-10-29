<?php 
	require_once ("includes/global.php");
	if(!isset($_SESSION)) {
		session_start(); 
	}

	if (! isset ( $_SESSION ['teamName'] ))
		header ( "Location: login.php" ) && die ();
	metadetails();
	unset($_SESSION['admin']);
	echo 'You have been logged out. <a href="login.php">click here</a> to login';
?>