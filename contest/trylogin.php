<?php
require_once ("includes/global.php");
if (! isset ( $_POST ['teamName'] ) || ! isset ( $_POST ['password'] ))
	header ( "Location: login.php" ) && die ();
echo "<h2>";

$stmt = $mysqli->prepare ( "SELECT `status`, `stage`, `language` FROM `teams` WHERE `teamname` = ? AND `password` = ?" );


$teamname = $_POST ['teamName'];
$password = $_POST ['password'];

$stmt->bind_param ( "ss", $teamname, $password );
$stmt->execute ();
$Status = "No";
$stmt->store_result ();
$stmt->bind_result ( $status, $stage, $language );
$stmt->fetch ();
if ($stmt->num_rows == 1) {
	$_SESSION ['teamName'] = $_POST ['teamName'];
	$_SESSION ['status'] = $status;
	$_SESSION ['stage'] = $stage;
	$_SESSION ['language'] = $language;
	$Status = "YES";
}
echo $Status;
echo "</h2>";

?>