<?php
	require_once('../includes/global.php');
	$q1 = "INSERT INTO `answers` (teamname, stageid, questionid, ans) VALUES('{$_SESSION['teamName']}', '{$_SESSION['stage']}', '{$_SESSION['questionid']}', '" . $mysqli->real_escape_string ( $_POST ['code'] ) . "') ON DUPLICATE KEY UPDATE teamname = VALUES(teamname), stageid = VALUES(stageid), questionid = VALUES(questionid), ans = VALUES(ans)";
	$q1 = $mysqli->query($q1);
	if(!$q1){
		echo "ERR";
	}else{
		echo "SYNCED";
	}
?>