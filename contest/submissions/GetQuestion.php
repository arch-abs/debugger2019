<?php
	require_once('../includes/global.php');
	$res = $mysqli->query("SELECT * FROM `submissions` WHERE `stageid`='{$_POST['stage']}' AND `teamname`='{$_SESSION['teamName']}' AND `questionid`='{$_POST['q']}'");
	$res1 = $mysqli->query("SELECT * FROM `answers` WHERE `teamname`='{$_SESSION['teamName']}' AND `stageid` = '{$_POST['stage']}' AND `questionid` = '{$_POST['q']}'");
	$res2 = $mysqli->query("SELECT * FROM questions WHERE `stageid` = '{$_POST['stage']}' AND `questionid` = '{$_POST['q']}'");
	$resf = $res->fetch_assoc();
	$res1f = $res1->fetch_assoc();
	$res2f = $res2->fetch_assoc();

	$ques = $res2f['question'];
	$code = $res2f['code'];
	if($res1->num_rows > 0){
		$code = $res1f['ans'];
	}

	$state = 0;
	if($res->num_rows > 0){
		if($resf['accept']==0)
			$state = 1;
		else
			$state = 2;
	}

	echo json_encode(array("ques" => $ques, "code" => $code, "accept"=> $state));

	if($_POST['ans'] !=''){
		$q1 = "INSERT INTO `answers` (teamname, stageid, questionid, ans) VALUES('{$_SESSION['teamName']}', '{$_SESSION['stage']}', '{$_SESSION['questionid']}', '" . $mysqli->real_escape_string ( $_POST ['ans'] ) . "') ON DUPLICATE KEY UPDATE teamname = VALUES(teamname), stageid = VALUES(stageid), questionid = VALUES(questionid), ans = VALUES(ans)";
		$q1 = $mysqli->query($q1);
	}

	$_SESSION['questionid'] = $_POST['q'];
?>