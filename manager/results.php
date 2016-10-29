<?php 
	require_once 'includes/global.php';
require_once 'includes/class.Diff.php';
header('Content-type: text/html; charset=utf-8');
echo '
			<!DOCTYPE html>
			<html>
			<head>
				<title>Debugger</title>
				<meta name="viewport" content="width=device-width, initial-scale=1.0">
				<link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
				<link href="css/main.css" rel="stylesheet" media="screen">
			';
if (!isset($_SESSION ['admin'])) {
    header('Location: login.php') && die();
}
?>
<script src="js/jquery.min.js" type="text/javascript" charset="utf-8"></script>
</head>

<body>
	<header style="height: 50px; background-color: rgba(32, 169, 112, 0.14); text-align: center;">
		<div class="left" id="teamheader" style="float:left; margin-left: 20px; margin-top: 15px; "><a href="index.php">Hi Admin</a></div>
		<div class="right" id="logoutheader" style="float: right; float: right;margin-right: 20px;margin-top: 15px;"><a href="logout.php">LogOut</a></div>
	</header>
<h3>View Solutions</h3>
<br>
<br>
<form action="" method="POST" class="form-horizontal" role="form">
<select name="stage">
	<option value="1a">1a</option>
	<option value="1b">1b</option>
	<option value="2a">2a</option>
	<option value="2b">2b</option>
	<option value="3a">3a</option>
	<option value="3b">3b</option>
</select>
		<button type="submit" class="btn btn-default">Submit</button>
	</form>
<?php 
	if(isset($_POST['stage'])) {
		$sql = "SELECT `teamname`, COUNT(*) AS 'SCORE', SUM(`changes`) AS 'TOTAL CHANGES', MAX(`time`) AS 'TIME TAKEN' FROM `submissions` WHERE `stageid`='{$_POST['stage']}' AND `accept`=1 GROUP BY `teamname` ORDER BY COUNT(*) DESC, SUM(`changes`) ASC , MAX(`time`) ASC";
		$res = $mysqli->query($sql);
		echo "<h2>Results after Stage '{$_POST['stage']}'</h2><br>";
		$row = $res->fetch_assoc();
		if ($row == null) {
	        echo "<p class='text-danger text-center bg-danger' id='notf'>Table is empty</p>";
	    }else{
	    	echo '<div class="table-responsive"><table class="table">';
        	echo '<tr>';

	        foreach ($row as $heado => $bods) {
	            echo '<th>'.$heado.'</th>';
	            $first = $row;
	        }
	        ;
	        echo '</tr>';
	        echo '<tr>';

	        foreach ($first as $heado => $bods) {
	            echo '<td>'.$bods.'</td>';
	        }
	        ;
	        echo '</tr>';

	        while ($row = $res->fetch_assoc()) {
	            echo '<tr>';

	            foreach ($row as $heado => $bods) {
	                echo '<td>'.$bods.'</td>';
	            }
	            ;
	            echo '</tr>';
	        }
	        echo '</table></div>';
	    }
	}
?>
</body>
</html>