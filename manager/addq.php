<?php
require_once ("includes/global.php");
header ( 'Content-type: text/html; charset=utf-8' );
echo <<<CONTENT
<!DOCTYPE html>
<html>
  <head>
    <title>Debugger - Add a question</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
    <link href="css/main.css" rel="stylesheet" media="screen">
CONTENT;
if (! isset ( $_SESSION ['admin'] ))
	header ( 'Location: login.php' ) && die ();
if (! isset ( $_POST ["q"] )) {
	?>
<html>
<head>
<title>Debugger - Add a question</title>
<script src="js/jquery.min.js" type="text/javascript" charset="utf-8"></script>
</head>

<body>
	<header style="height: 50px; background-color: rgba(32, 169, 112, 0.14); text-align: center;">
    <div class="left" id="teamheader" style="float:left; margin-left: 20px; margin-top: 15px; "><a href="index.php">Hi Admin</a></div>
    <div class="right" id="logoutheader" style="float: right; float: right;margin-right: 20px;margin-top: 15px;"><a href="logout.php">LogOut</a></div>
  </header>
	<h3>Submit new question</h3>

	<br>
  <div id="main-content" class="box center">
	<form action="" method="POST">
		<label for="stage">Stage ID </label> <input type="text" name="stageid" id="stage" placeholder="For example: 1a" required /><br>
    <label for="question">Question ID </label>
    <input type="text" name="questionid" placeholder="For example: 2" required/><br>
    <label for="Q">Question </label><br>
		<textarea name="question" id="Q" required style="height: 60ch; width: 70ch;"></textarea>
		<br> <label for="code">Code to Display </label><br>
		<textarea name="code" id="code" required style="height: 60ch; width: 70ch;"></textarea>
		<br> <label for="ans">Expected Output </label><br>
		<textarea name="answer" id="ans" required style="height: 60ch; width: 70ch;"></textarea>
		<br> <label for="testcase">Sample Test Case </label><br>
		<textarea name="testcase" id="testcase" required style="height: 60ch; width: 70ch;"></textarea>
		<br> <label for="outputtestcase">Sample Test Case Output </label><br>
		<textarea name="outputtestcase" id="outputtestcase" required style="height: 60ch; width: 70ch;"></textarea>
		<br> <input type="hidden" name="q" value="1" />
		<button type="submit" class="btn btn-default">Submit</button>
	</form>
</div>
	<br>
</body>
</html>
<?php
} else {
	include 'includes/connection.php';
	$stageid = $_POST ['stageid'];
	$questionid = $_POST ['questionid'];
	$question = $_POST ['question'];
	$code = $_POST['code'];
	$answer = $_POST ['answer'];
	$input = $_POST['testcase'];
	$output = $_POST['outputtestcase'];
  $question1 = $mysqli->real_escape_string($question);
  $sql = "INSERT INTO questions VALUES('{$stageid}',{$questionid},'{$question1}','{$code}')";
  $sql2 = "INSERT INTO solutions VALUES('{$stageid}',{$questionid},'{$answer}','{$input}','{$output}')";
	echo $sql, '<br>';
	if (! $result = $mysqli->query ( $sql )) {
		die ( "Error" . $mysqli->error );
	}
  echo 'Question added';
    if (! $result = $mysqli->query ( $sql2 )) {
		die ( "Error" . $mysqli->error );
	}
	echo 'solution added';
	header('Location: index.php');
}
?>
