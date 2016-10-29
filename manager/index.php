<?php
require_once ("includes/global.php");
header ( 'Content-type: text/html; charset=utf-8' );
echo '
<!DOCTYPE html>
<html>
  <head>
    <title>Debugger : Manager</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
    <link href="css/main.css" rel="stylesheet" media="screen">
';
if (! isset ( $_SESSION ['admin'] ))
	header ( 'Location: login.php' ) && die ();

?>

<html>
<head>
<style>
h1 {
	text-align: center;
}

p {
	text-align: center;
}
</style>
<title>Debugger</title>
<script src="../js/jquery.min.js" type="text/javascript" charset="utf-8"></script>
</head>

<body>
	<header style="height: 50px; background-color: rgba(32, 169, 112, 0.14); text-align: center;">
		<div class="left" id="teamheader" style="float:left; margin-left: 20px; margin-top: 15px; ">Hi Admin</div>
		<div class="right" id="logoutheader" style="float: right; float: right;margin-right: 20px;margin-top: 15px;"><a href="logout.php">LogOut</a></div>
	</header>
	<h1 align=center>Welcome to the Manager's Platform</h1>
	<br>
  <p align=center>Content Management System for Debugger</p>
	<a href="addq.php"><button>
			<h3 style="color: black">Submit new question</h3>
		</button></a>
	<br>
  <a href="viewq.php"><button>
			<h3 style="color: black">View questions</h3>
		</button></a>
	<br>
	<a href="addteam.php"><button>
			<h3 style="color: black">Add new team</h3>
		</button></a>
	<br>
	<a href="addstage.php"><button>
			<h3 style="color: black">Add new stage</h3>
		</button></a>

	<br>
	<a href="results.php"><button>
			<h3 style="color: black">View Results</h3>
		</button></a>

	<br>
	<a href="startstage.php"><button>
			<h3 style="color: black">Start a Stage</h3>
		</button></a>
	<br>
	<a href="stopstage.php"><button>
			<h3 style="color: black">Stop a Stage</h3>
		</button></a>
</body>
</html>
