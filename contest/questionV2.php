<?php
	require_once ("includes/global.php");
	if (! isset ( $_SESSION ['teamName'] )) {
		header ( "Location: login.php" ) && die ();
	}elseif ($_SESSION ['status'] < 2) {
		header ( "Location: index.php" ) && die ();
	} elseif (! isset ( $_SESSION ['stage'] )) {
		header ( "Location: index.php" ) && die ();
	}

	metadetails();
	echo '</head>';
	echo '<body>';
	echo '<header style="height: 50px; background-color: rgba(32, 169, 112, 0.14); text-align: center;">
		<div class="left" id="teamheader" style="float:left; margin-left: 20px; margin-top: 15px; color:white;">Hi '. $_SESSION["teamName"] . '</div>
		<div class="right" id="logoutheader" style="float: right; float: right;margin-right: 20px;margin-top: 15px;"><a href="logout.php" style="color:white;">LogOut</a></div>
	</header>';
	$stageQuery = "SELECT * FROM `stages` WHERE `stageid` = '{$_SESSION['stage']}';";
	$stageResult = $mysqli->query ( $stageQuery );
	$stageResultRow = $stageResult->fetch_assoc ();
	$_SESSION ['questionid'] = 1;
	if ($stageResultRow ['type'] == "syntax" || $stageResultRow ['type'] == "logical" || $stageResultRow ['type'] == "obfuscated") {
		$quizQuery = "INSERT INTO `quiz2` VALUES ('{$_SESSION['teamName']}','{$_SESSION['stage']}',NOW());";
		$quizResult = $mysqli->query( $quizQuery );

		$quizQuery = "SELECT * FROM `quiz2` WHERE `stageid` = '{$_SESSION['stage']}' AND `teamname` = '{$_SESSION['teamName']}';";
		$quizResult = $mysqli->query ( $quizQuery );
		$quizResultRow = $quizResult->fetch_assoc ();
		$time = $quizResultRow ['starttime'];
	}
?>
	<div style="width: 90%; top: 40px; margin: auto">
		<div id="questionContent" class="box" style="height:auto; width: 81%;padding: 15px;margin-top: 20px;margin-bottom: 20px;margin-left: 0px;"></div>
        <!-- <div id="content" class="" style="height: auto; margin-top: 30px; text-align:center;"></div> -->
        <textarea id="textbox" name="textbox" rows="20" cols="115" spellcheck="false" style="width:950px"></textarea>
        <?php
			$quesQuery = "SELECT COUNT(*) FROM `questions` WHERE `stageid`='{$_SESSION['stage']}'";
			$quesResult = $mysqli->query ( $quesQuery );
			$noOfQuestions = 0;
			if($quesResult != False){
				$quesResultRow = $quesResult->fetch_assoc ();
				$noOfQuestions = $quesResultRow['COUNT(*)'];
			}
		?>
		<div>
			<ul id="paginator" class="pagination">
	            <?php
					for ($i = 1; $i<=$noOfQuestions; $i=$i+1) {
						echo "<li id='{$i}' onclick=\"GetQuestion('submissions/GetQuestion.php', '{$_SESSION['stage']}', '{$i}', $('#textbox').val(),this.id);\"><a href=\"#\" id=\"a{$i}\">{$i}</a></li>";
					}
				?>
			</ul>
		</div>
	</div>
	<button id="resetAnswer" onclick="ResetAns('submissions/Reset.php', '<?php echo $_SESSION['stage']; ?>')" class="btn btn-large btn-danger" style="position: absolute; right: 3%; bottom: 70%; width: 200px;">Reset Answer
	</button>

    <button id="submitsol" onclick="SubmitAns('submissions/submit.php', '<?php echo $_SESSION['stage']; ?>', $('#textbox').val())" class=" btn btn-large btn-success" style="position: absolute; right: 3%; bottom: 5%; width: 200px;">Submit solution
    </button>

    <button id="timer_count" class="btn btn-large btn-warning" style="position: absolute; right: 3%; bottom: 80%; width: 200px;"></button>

    <div id="status" class="" style="background-color:white; width:200px; right:3%; bottom: 60%; position: absolute; text-align: center;"></div>

    <script src="src/ace.js" type="text/javascript" charset="utf-8"></script>
    <script src="js/jquery.min.js" type="text/javascript" charset="utf-8"></script>
    <script type="text/javascript">
    	var timer_active = false;
    	var time;
    	var timeoutId;
    	var incTime;
    	function GetQuestion(page,st,i,cont,id){
    		$.post(page, {
                    stage: st,
                    q: i,
                    ans: cont,
                },
                function (data) {
                    var t1=JSON.parse(data);
                    $('#questionContent').html('<label>'+t1.ques+'</label>');
                    $('#textbox').val(t1.code);
                    if(t1.accept==0){
                    	$('#status').html('<label style="color:black">solution Not Submitted</label>');
                    	$('#submitsol').prop("disabled",false);
                    }else if(t1.accept==2){
                    	$('#status').html('<label style="color:green">solution Accepted</label>');
                    	$('#submitsol').prop("disabled",true);
                    }else{
                    	$('#status').html('<label style="color:red">solution Rejected</label>');
                    	$('#submitsol').prop("disabled",false);
                    }
                    // console.log($('#textbox').val());
					
                });
            var j = 1;
            var n;
            if(st=='1a' || st=='1b')
            	n=6;
            else
            	n=5;
            while (j < n) {
                var link = document.getElementById("a" + j);
                if (link)
                    link.style.backgroundColor = "white";
                j = j + 1;
            }
            var link = document.getElementById("a" + id);
            link.style.backgroundColor = "black";
    	}

    	function ResetAns(page,st){
    		$.post(page, {
    				stage: st
				},
				function (data) {
					var t1=JSON.parse(data);
					$('#questionContent').html('<label>'+t1.ques+'</label>');
					$('#textbox').val(t1.code);
			});
    	}

    	function SubmitAns(page,st,ans){
    		$.ajax({
				type: "POST",
				url: page,
				data: {
                    stage: st,
                    ans: ans
                },
				beforeSend: function(xhr) {
					$('#status').html('<label style="color:blue">Compiling And Running</label>');
				},
				success: function (data) {
                    var t1= JSON.parse(data);
                    if(t1.accept==0){
                    	$('#status').html('<label style="color:red">solution Rejected</label>');
                    	$('#submitsol').prop("disabled",false);
                    }else{
                    	$('#status').html('<label style="color:green">solution Accepted</label>');
                    	$('#submitsol').prop("disabled",true);
                    }
					
                }
			});
    	}

    	function timer(){
    		var date = new Date();
    		var endDate = new Date(time);

    		var curTime = date.getTime();
    		var endTime = endDate.getTime()+45*60*1000;

    		var remTime = endTime - curTime + incTime;
    		if(remTime>0){
	    		s = Math.floor(remTime/1000);
	    		m = Math.floor(s/60);
	    		h = Math.floor(m/60);
	    		
	    		s%=60;
	    		m%=60;
	    		h%=24;

	    		s=(s<10)?"0"+s:s;
	    		m=(m<10)?"0"+m:m;
	    		h=(h<10)?"0"+h:h;
	    		$('#timer_count').html("TIMER  "+h+":"+m+":"+s);
	    		setTimeout(timer,1000);
	    	}
	    	else{
	    		endTimer();
	    	}
    	}

    	function startTimer(endtime){
    		if (timer_active)
                return;
            $.post('getTime.php',{
            	a:1
            },
            function(data){
            	time = endtime;
            	var date = new Date();
	    		var endDate = new Date(time);

	    		var curTime = data*1000;
	    		var endTime = endDate.getTime()+45*60*1000;

	    		var t1 = date.getTime();
	    		incTime = t1-curTime;
	    		// if(incTime<0)
	    		// 	incTime=-1*incTime;

	    		var remTime = endTime - curTime;
	    		if(remTime>0){
	    			GetQuestion('submissions/GetQuestion.php', '<?php echo $_SESSION['stage'] ?>', 1, '', 1);
	    			timer();
	    		}
	    		else{
	    			endTimer();
	    		}
	    		timer_active = true;
            });
    	}

    	function endTimer(){
    		window.location.href = "done.php"
    	}

    	$('textarea').on('input propertychange change', function() {
		    clearTimeout(timeoutId);
		    timeoutId = setTimeout(function() {
		        saveToDB('submissions/sync.php','<?php echo $_SESSION['stage'] ?>','<?php echo $_SESSION['questionid']?>',$('#textbox').val());
		    }, 1000);
		});

		function saveToDB(page,st,quesid,data){
			$.ajax({
				type: "POST",
				url: page,
				data: {
					stage: st,
					ques: quesid,
					code: data
				},
				beforeSend: function(xhr) {
					$('#content').html('Saving...');
				},
				success: function(data){
					if(data!="SYNCED"){
						$('#content').html('sync failed');
					}else{
						$('#content').html('saved');
					}
				}
			});
		}
    	startTimer('<?php echo $time; ?>')

    </script>
</body>
</html>