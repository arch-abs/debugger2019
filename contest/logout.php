<?php 
	require_once ("includes/global.php");
	if(!isset($_SESSION)) {
		session_start(); 
	}

	if (! isset ( $_SESSION ['teamName'] ))
		header ( "Location: login.php" ) && die ();
	metadetails();
	session_destroy();
	echo '<div id="main-content" class="box center" style="text-align: center; font-size:18px">
			<h2>And That\'s All Folks!!</h2>
			We hope you liked our event!
			<br><br>
			We\'re open to feedback. Do send an email to debugger@tathva.org with your fedback.
			You have been logged out. <a href="login.php">click here</a> to login
		</div> ';
?>