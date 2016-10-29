<?php
require_once ("includes/global.php");
header ( 'Content-type: text/html; charset=utf-8' );
echo <<<CONTENT
<!DOCTYPE html>
<html>
  <head>
    <title>Debugger: Manager : Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
    <link href="css/main.css" rel="stylesheet" media="screen">
CONTENT
;
if (isset ( $_SESSION ['admin'] ) && ($_GET ['key'] != "M1112AER")) {
	header ( "Location: index.php" );
}
if (! isset ( $_POST ["username"] )) {
	
	?>
</head>
<body>
	<div id="form-signin-container">
		<form id="form-signin" class="box" action="" method="POST">
			<h2 id="form-signin-heading">Please Sign In</h2>
			<div class="input-group" style="padding: 10px 0 10px 0;">
				<span class="input-group-addon">ID</span> <input class="span2" name="username"
					id="manager" type="text" placeholder="Manager ID">
			</div>
			<input type="password" id="password" name="password"
				class="form-control" placeholder="Password" style="margin-bottom: 10px;">
			<br>
			<button class="btn btn-large btn-primary centerh"
				style="width: 100px;" id="btn-login" type="submit">Sign in</button>
		</form>
	</div>
	<script src="../js/jquery.min.js"></script>
	<script src="../js/bootstrap.min.js"></script>

</body>
</html>
<?php
} else {
	include '/includes/connection.php';
	$uid = $_POST ['username'];
	$pass = $_POST ['password'];
	$sql = "SELECT * FROM manager WHERE username = '{$uid}' AND password = '{$pass}'";
	echo ($sql);
	$result = $mysqli->query ( $sql );
	if ($result->num_rows) {
		$_SESSION ['admin'] = True;
		header ( 'Location: index.php' );
	} else {
		header ( 'Location: login.php' );
	}
}

?>
