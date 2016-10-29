<?php 

require_once ("includes/global.php");
if (! isset ( $_SESSION ['teamName'] )) {
	// If Not Logged In
	header ( "Location: login.php" ) && die ();
} 
// elseif ($_SESSION ['status'] < 2) {
// 	// If Not Started
// 	header ( "Location: index.php" ) && die ();
// } elseif (! isset ( $_SESSION ['stage'] )) {
// 	// No Idea yet what it does
// 	header ( "Location: index.php" ) && die ();
// }

if(!isset($_POST['op'])){
	metadetails();
	echo '</head>';
	echo '<body>';
	echo '<header style="height: 50px; background-color: rgba(32, 169, 112, 0.14); text-align: center;">
		<div class="left" id="teamheader" style="float:left; margin-left: 20px; margin-top: 15px; ">Hi'. $_SESSION["teamName"] . '</div>
		<div class="right" id="logoutheader" style="float: right; float: right;margin-right: 20px;margin-top: 15px;"><a href="logout.php">LogOut</a></div>
	</header>';
	$stageQuery = "SELECT * FROM `stages` WHERE `stageid` = '{$_SESSION['stage']}';";
	$stageResult = $mysqli->query ( $stageQuery );
	$stageResultRow = $stageResult->fetch_assoc ();
	$_SESSION ['questionid'] = 1;
	if ($stageResultRow ['type'] == "syntax" || $stageResultRow ['type'] == "logical" || $stageResultRow ['type'] == "obfuscated") {
		$time = $stageResultRow['time']*60;
		$quizQuery = "INSERT INTO `quiz` VALUES ('{$_SESSION['teamName']}','{$_SESSION['stage']}','{$time}');";
		$quizResult = $mysqli->query( $quizQuery );
		$quizQuery = "SELECT * FROM `quiz` WHERE `stageid` = '{$_SESSION['stage']}' AND `teamname` = '{$_SESSION['teamName']}';";
		$quizResult = $mysqli->query ( $quizQuery );
		$quizResultRow = $quizResult->fetch_assoc ();
		$time = $quizResultRow ['timeleft'];
?>
	<div style="width: 90%; top: 40px; margin: auto">
        <div id="content" class="box" style="height: 70vh; margin-top: 30px;"></div>
        <?php
			$quesQuery = "SELECT COUNT(*) FROM `questions` WHERE `stageid`='{$_SESSION['stage']}'";
			$quesResult = $mysqli->query ( $quesQuery );
			$noOfQuestions = 0;
			if($quesResult != False){
				$quesResultRow = $quesResult->fetch_assoc ();
				$noOfQuestions = $quesResultRow['COUNT(*)'];
			}
	?>
            <div >
                <ul id="paginator" class="pagination">
                    <?php
			for ($i = 1; $i<=$noOfQuestions; $i=$i+1) {
				echo "<li id='{$i}' onclick=\"GetQuestion('question.php', '{$_SESSION['stage']}', '{$i}', ace.edit('content').getValue(),this.id);\"><a href=\"#\" id=\"a{$i}\">{$i}</a></li>";
			}
			?>
                </ul>
            </div>
    </div>
    <button id="resetAnswer" onclick="ResetAns('question.php', '<?php echo $_SESSION['stage']; ?>')" class="btn btn-large btn-danger" style="position: absolute; right: 1%; bottom: 5%; width: 200px;">Reset Answer
    </button>

    <button id="submitsol" onclick="SubmitAns('question.php', '<?php echo $_SESSION['stage']; ?>')" class="btn btn-large btn-success" style="position: absolute; right: 50%; bottom: 5%; width: 200px;">Submit ALL Solutions
    </button>

    <button id="timer_count" class="btn btn-large btn-warning" style="position: absolute; left: 1%; bottom: 5%; width: 200px;"></button>

    <script src="src/ace.js" type="text/javascript" charset="utf-8"></script>
    <script src="js/jquery.min.js" type="text/javascript" charset="utf-8"></script>
    <script type="text/javascript">
        timer_active = false,
        timer_count = 0;
        function timer() {
            var sec_num = timer_count;
            var hours = Math.floor(sec_num / 3600);
            var minutes = Math.floor((sec_num - (hours * 3600)) / 60);
            var seconds = sec_num - (hours * 3600) - (minutes * 60);
            if (hours == 0) {
                if (minutes == 0)
                    $('#timer_count').html("Time Left: " + seconds + "s");
                else
                    $('#timer_count').html("Time Left: " + minutes + "m " + seconds + "s");
            } else
                $('#timer_count').html("Time Left: " + hours + "h " + minutes + "m " + seconds + "s");
            if (timer_count > 0) {
                setTimeout(function () {
                    timer();
                }, 1000);
                timer_count -= 1;
                if (timer_count % 10 == 8)
                    Sync('question.php', '<?php echo $_SESSION['stage'] ?>', timer_count);
            } else
                timer_end(true);
        }

        function start_timer(wait_time) {
            if (timer_active)
                return;
            timer_count = wait_time;
            timer();
            timer_active = true;
        }

        function timer_end(go) {
            SubmitAns('question.php', '<?php echo $_SESSION['stage']; ?>', 3);
        }
        function GetQuestion(page, b, c, d, e) {
            $.post(page, {
                    stage: b,
                    q: c,
                    ans: d,
                    op: 1
                },
                function (data) {
                    //val1 = data.getElementById
                    ace.edit('content').setValue(data);
					ace.edit('content').clearSelection();
					
                });
            var i = 1;
            while (i < 5) {
                var link = document.getElementById("a" + i);
                if (link)
                    link.style.backgroundColor = "white";
                i = i + 1;
            }
            var link = document.getElementById("a" + e);
            link.style.backgroundColor = "black";

        }


        function Sync(a, b, c) {
            position = ace.edit('content').getCursorPosition();
            lineNumber = ace.edit('content').getFirstVisibleRow();
            
            $.post(a, {
                    stage: b,
                    timeLeft: c,
                    ans: ace.edit('content').getValue(),
                    op: 5
                },
                function (data) {
                    ace.edit('content').setValue(data);
                    ace.edit('content').clearSelection();
                    ace.edit('content').moveCursorToPosition(position);
                    ace.edit('content').moveCursorToPosition(position);
					ace.edit('content').scrollToLine(lineNumber, false, true);
					
                });
        }

        function ResetAns(a, b) {
            $.post(a, {
                    stage: b,
                    op: 2
                },
                function (data) {
                    ace.edit('content').setValue(data);
					ace.edit('content').clearSelection();
					
                });
        }

        function SubmitAns(a, b, c) {
            if (!c)
                var r = confirm("Are you sure you want to submit ? You cannot edit any answers after this!");
            else
                r = true;

            if (r == true) {
                $.post(a, {
                        stage: b,
                        ans: ace.edit('content').getValue(),
                        op: 3,
                        time: timer_count
                    },
                    function () {
                        $(location).attr('href', 'index.php');
                    });
            }
        }
        GetQuestion('question.php', '<?php echo $_SESSION['stage'] ?>', '1', '', 1);
        start_timer(<?php echo $time; ?>);
    </script>
<?php 
}
foreach ( $_POST as $field => $value ) {
		echo "$field = $value<br>";
	}
	echo '</body>';
	echo '</html>';
} else {
	echo $_POST['op'];
	if ($_POST ['op'] == 1) {
		$res = $mysqli->query ( "SELECT * FROM `answers` WHERE `teamname` = '{$_SESSION['teamName']}' AND `stageid` = '{$_POST['stage']}' AND `questionid` = '{$_POST['q']}'" );
		if ($res->num_rows == 0) {
			$res = $mysqli->query ( "SELECT * FROM `questions` WHERE `stageid` = '{$_POST['stage']}' AND `questionid` = '{$_POST['q']}'" );
			$res = $res->fetch_assoc ();
			echo $res ['question'];
		} else {
			$res = $res->fetch_assoc ();
			echo $res ['ans'];
		}
		if ($_POST ['ans'] != '')
			$mysqli->query ( "INSERT INTO `answers` (teamname, stageid, questionid, ans) VALUES('{$_SESSION['teamName']}', '{$_SESSION['stage']}', '{$_SESSION['questionid']}', '" . $mysqli->real_escape_string ( $_POST ['ans'] ) . "')
	ON DUPLICATE KEY UPDATE teamname = VALUES(teamname), stageid = VALUES(stageid), questionid = VALUES(questionid), ans = VALUES(ans)" );
		$_SESSION ['questionid'] = $_POST ['q'];
	} elseif ($_POST ['op'] == 2) {
		$res = $mysqli->query ( "SELECT * FROM `questions` WHERE `stageid` = '{$_POST['stage']}' AND `questionid` = '{$_SESSION['questionid']}'" );
		$res = $res->fetch_assoc ();
		echo $res ['question'];
		$mysqli->query ( "INSERT INTO `answers` (teamname, stageid, questionid, ans) VALUES('{$_SESSION['teamName']}', '{$_SESSION['stage']}', '{$_SESSION['questionid']}', '" . $mysqli->real_escape_string ( $res ['question'] ) . "')
			ON DUPLICATE KEY UPDATE teamname = VALUES(teamname), stageid = VALUES(stageid), questionid = VALUES(questionid), ans = VALUES(ans)" );
	} elseif ($_POST ['op'] == 3) {
		$t = $_POST ['time'];
		$mysqli->query ( "INSERT INTO `answers` (teamname, stageid, questionid, ans,time) VALUES('{$_SESSION['teamName']}', '{$_SESSION['stage']}', '{$_SESSION['questionid']}', '" . $mysqli->real_escape_string ( $_POST ['ans'] ) . "','{$t}')
	ON DUPLICATE KEY UPDATE teamname = VALUES(teamname), stageid = VALUES(stageid), questionid = VALUES(questionid), ans = VALUES(ans), time = VALUES(time)" );
		$_SESSION ['status'] = 1;
		$_SESSION ['questionid'] = 0;
		if ($_SESSION ['stage'] == '3a' || $_SESSION ['stage'] == '3b')
			$_SESSION ['status'] = '3';
		if ($_SESSION ['stage'] == '2a')
			$_SESSION ['stage'] = '3a';
		if ($_SESSION ['stage'] == '2b')
			$_SESSION ['stage'] = '3b';
		if ($_SESSION ['stage'] == '1a')
			$_SESSION ['stage'] = '2a';
		if ($_SESSION ['stage'] == '1b')
			$_SESSION ['stage'] = '2b';
		$mysqli->query ( "UPDATE `teams` SET `stage` = '{$_SESSION['stage']}', `status` = '{$_SESSION['status']}' WHERE `teamname` = '{$_SESSION['teamName']}'" );
	} elseif ($_POST ['op'] == 4) {
		if ($_SESSION ['language'] == 1)
			$filename = $_SESSION ['teamName'] . '_' . $_SESSION ['questionid'] . '.c';
		else
			$filename = $_SESSION ['teamName'] . '_' . $_SESSION ['questionid'] . '.cpp';
		file_put_contents ( $filename, $_POST ['ans'] );
		$output = shell_exec ( './run.sh ' . $filename );
		$output = file_get_contents ( $filename . '.log' );
		echo $output;
	}
	elseif ($_POST ['op'] == 5) {
		$t = $_POST ['timeLeft'];
		$quizResult = $mysqli->query ( "INSERT INTO `answers` (teamname, stageid, questionid, ans) VALUES('{$_SESSION['teamName']}', '{$_SESSION['stage']}', '{$_SESSION['questionid']}', '" . $mysqli->real_escape_string ( $_POST ['ans'] ) . "') ON DUPLICATE KEY UPDATE teamname = VALUES(teamname), stageid = VALUES(stageid), questionid = VALUES(questionid), ans = VALUES(ans)" );
		if($quizResult === False){
			echo 'Error 247:',mysqli_error($mysqli),'<br>';
		}
		$quizResult = $mysqli->query ( "INSERT INTO `quiz` (teamname, stageid, timeLeft) VALUES('{$_SESSION['teamName']}', '{$_SESSION['stage']}', '{$_POST['timeLeft']}') ON DUPLICATE KEY UPDATE teamname = VALUES(teamname), stageid = VALUES(stageid), timeLeft = VALUES(timeLeft)" );
		if($quizResult === False){
			echo mysqli_error($mysqli),'<br>';
		}
//		echo $_POST ['ans'];
		$res = $mysqli->query ( "SELECT * FROM `answers` WHERE `teamname` = '{$_SESSION['teamName']}' AND `stageid` = '{$_POST['stage']}' AND `questionid` = '{$_SESSION['questionid']}'" );
		//echo $_SESSION['questionid'],'<br>';
		$res = $res->fetch_assoc ();
		echo $res ['ans'];
	}
}
?>