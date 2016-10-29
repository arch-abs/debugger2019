<?php
	require_once('../includes/global.php');
	$res2 = $mysqli->query("SELECT * FROM questions WHERE `stageid` = '{$_POST['stage']}' AND `questionid` = '{$_SESSION['questionid']}'");
	$res2f = $res2->fetch_assoc();

	$ques = $res2f['question'];
	$code = $res2f['code'];
	echo json_encode(array("ques" => $ques, "code" => $code));
?>