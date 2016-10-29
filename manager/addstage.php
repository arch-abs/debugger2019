<?php
require_once ("includes/global.php");
header ( 'Content-type: text/html; charset=utf-8' );
echo <<<CONTENT
<!DOCTYPE html>
<html>
  <head>
    <title>Debugger - Add a stage</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
    <link href="css/main.css" rel="stylesheet" media="screen">
CONTENT;
if (! isset ( $_SESSION ['admin'] ))
	header ( 'Location: login.php' ) && die ();
if (! isset ( $_POST ["q"] )) {
	?>
<html>
<head>
<title>Debugger - Add a stage</title>
<script src="js/jquery.min.js" type="text/javascript" charset="utf-8"></script>
</head>
<body>
	<header style="height: 50px; background-color: rgba(32, 169, 112, 0.14); text-align: center;">
		<div class="left" id="teamheader" style="float:left; margin-left: 20px; margin-top: 15px; "><a href="index.php">Hi Admin</a></div>
		<div class="right" id="logoutheader" style="float: right; float: right;margin-right: 20px;margin-top: 15px;"><a href="logout.php">LogOut</a></div>
	</header>
<h3>Add a new Stage</h3>
<br>
<form action="" method="POST">
	<label for="stage">Stage ID </label> <input type="text" name="stageid"
		id="stage" placeholder="For example: 1a" required /><br> <label
		for="type">Type </label> <input type="text" name="type" id="type"
		placeholder="syntax, logical, obfuscated" required /><br> <label
		for="time">Time </label> <input type="text" name="time" id="time"
		placeholder="In minutes" required /><br> <input type="hidden" name="q"
		value="1" /> <input type="submit" />
</form>
<br>
<?php
} else {
	include 'includes/connection.php';
	$stageid = $_POST ['stageid'];
	$type = $_POST ['type'];
	$time = $_POST ['time'];
	$sql = "INSERT INTO stages VALUES(\"$stageid\", \"$type\", \"$time\", 0)";
	if (! $result = $mysqli->query ( $sql )) {
		die ( "Error" . $mysqli->error );
	}
	header ( 'Location: index.php');
}
?>
</body>
</html>