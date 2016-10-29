<?php
require_once ("includes/global.php");
if (!isset($_POST ['con1']) || !isset($_POST['con2']) || !isset($_POST ['teamName']) || !isset($_POST['password']))
	header ( "Location: signup.php" ) && die ();

$stmt = $mysqli->prepare("INSERT INTO `teams` (`contestant1`,`contestant2`,`teamname`,`password`,`status`,`stage`,`language`) VALUES (?, ?, ?, ?, 0, '1a',0)");

$con1 = $_POST ['con1'];
$con2 = $_POST ['con2'];
$teamname = $_POST ['teamName'];
$pass = $_POST ['password'];

$stmt->bind_param("ssss",$con1,$con2,$teamname,$pass);
$stmt->execute();
$Status = "NO";

if($stmt->affected_rows>=1){
	$Status="YES";
}
echo "<h2>";
echo $Status;
echo "</h2>";
?>
