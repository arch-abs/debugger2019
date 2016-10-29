<?php
	require_once('../includes/global.php');
	require_once '../includes/class.Diff.php';
	$res = $mysqli->query("INSERT INTO `submissions` (teamname, stageid, questionid, ans, time, changes) VALUES('{$_SESSION['teamName']}', '{$_SESSION['stage']}', '{$_SESSION['questionid']}', '" . $mysqli->real_escape_string ( $_POST ['ans'] ) . "',NOW(),0) ON DUPLICATE KEY UPDATE teamname = VALUES(teamname), stageid = VALUES(stageid), questionid = VALUES(questionid), ans = VALUES(ans),time=NOW()");

	if (!file_exists('files')) {
		mkdir('files', 0777, true);
	}
	if(!file_exists('questions')){
		mkdir('questions',0777,true);
	}

	$res = $mysqli->query("SELECT * FROM `submissions` WHERE `stageid`='{$_POST['stage']}' AND `teamname`='{$_SESSION['teamName']}' AND `questionid`='{$_SESSION['questionid']}'");
	if(!$res){
		die('Error'.$mysqli->error);
	}
	$res2 = $mysqli->query("SELECT * FROM questions WHERE `stageid` = '{$_POST['stage']}' AND `questionid` = '{$_SESSION['questionid']}'");
	$res3 = $mysqli->query("SELECT * FROM `solutions` WHERE `stageid`='{$_SESSION['stage']}' AND 	`questionid`='{$_SESSION['questionid']}'");
	$resf = $res->fetch_assoc();
	$res2f = $res2->fetch_assoc();
	$res3f = $res3->fetch_assoc();

	if(!$res2 || !$res3){
		die('Error'.$mysqli->error);
	}

	$stageid = $_SESSION['stage'];
	$fname = $stageid.$_SESSION['questionid'].".q";
	$i = file_put_contents("questions/".$fname, $res2f['code']);
	if(!chmod("questions/" . $fname,0777))
			die('error in changing folder permissions');

	$fname2 = $_SESSION['teamName'].$_POST['stage'].$_SESSION['questionid'];
	$fname3 = $_SESSION['stage'].$_SESSION['questionid'];
	$directory = 'files/';
	$codename = $fname2.'.cpp';
	$outname = $fname2.'.out';
	$tstname = $fname3.'.tst';
	$tstout = $fname3.'.tstout';
	$i = file_put_contents("files/".$codename, $resf['ans']);
	$j = file_put_contents("files/".$tstname, $res3f['input']);
	$k = file_put_contents("files/".$tstout, $res3f['output']);
	if($i === FALSE || $j === FALSE || $k === FALSE){
		echo "Goto Hell";
		die();
	}
	if(!chmod("files/" . $codename,0777) || !chmod("files/" . $tstname,0777) || !chmod("files/" . $tstout,0777))
			die('error in changing file permissions');

	$cmd = "./compile.sh '{$directory}{$outname}' '{$directory}{$codename}' 2>&1";
	unset($arr);
    $lastLine = exec($cmd, $arr, $retval);
	// foreach ($arr as $i) {
	// 	echo $i,'<br>';
	// }
 //    echo '$retval = ', $retval, '<br>';
 //    echo '$lastLine = ', $lastLine, '<br>';
    if(!$retval){
    	$ansfile = $fname2.'.ans';
    	$cmd1 = "./run.sh '{$directory}{$outname}' '{$directory}{$ansfile}' '{$directory}{$tstname}' '{$directory}{$tstout}'";
		unset($arr);
        $lastLine = exec($cmd1, $arr, $retval);
		// foreach ($arr as $i) {
		// 	echo $i,'<br>';
		// }
		// echo '$retval = ', $retval, '<br>';
		// echo '$lastLine = ', $lastLine, '<br>';
		$lastLine = intval($lastLine);
		if($lastLine!=0){
			$res = $mysqli->query("SELECT * FROM `submissions` WHERE `stageid`='{$_POST['stage']}' AND `teamname`='{$_SESSION['teamName']}' AND `questionid`='{$_SESSION['questionid']}'");
	    	if(!$res){
				die('Error'.$mysqli->error);
			}
			$resf = $res->fetch_assoc();
			if ($resf['accept']==1) {
				echo json_encode(array("accept"=>1));
			}else
				echo json_encode(array("accept"=>0));	
		}else{
			unset($arr);
			$cmd1 = './changes.sh '.$directory.$codename.' questions/'.$stageid.$_SESSION['questionid'].'.q';
			$lastLine = exec($cmd1, $arr, $retval);
			$res4 = $mysqli->query("UPDATE `submissions` SET `changes`='{$lastLine}',`accept`=1 WHERE `teamname`='{$_SESSION['teamName']}' AND `stageid`='{$_POST['stage']}' AND `questionid`='{$_SESSION['questionid']}'");
			if(!$res4){
				die('Error'.$mysqli->error);
			}
			echo json_encode(array("accept"=>1));
		}
    }else{
    	$res = $mysqli->query("SELECT * FROM `submissions` WHERE `stageid`='{$_POST['stage']}' AND `teamname`='{$_SESSION['teamName']}' AND `questionid`='{$_SESSION['questionid']}'");
    	if(!$res){
			die('Error'.$mysqli->error);
		}
		$resf = $res->fetch_assoc();
		if ($resf['accept']==1) {
			echo json_encode(array("accept"=>1));
		}else
			echo json_encode(array("accept"=>0));
    }
?>