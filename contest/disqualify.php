<?php
require_once ("includes/global.php");
metadetails ();

$sql = $mysqli->query("UPDATE `teams` SET `disqualify`=1 WHERE `teamname`='{$_SESSION['teamName']}'");

session_destroy();
?>
</head>
<body>
	<div id="main-content" class="box center" style="text-align: center; font-size:18px">
		<h2>And That's All Folks!!</h2>
		Contact Manager :) <br><br>
		We're open to feedback. Do send an email to debugger@tathva.org with your fedback.
	</div> 
</body>
</html>