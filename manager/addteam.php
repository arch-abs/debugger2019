<?php
require ("includes/global.php");
header ( 'Content-type: text/html; charset=utf-8' );
echo <<<CONTENT
<!DOCTYPE html>
<html>
  <head>
    <title>Game Of Bugs</title>
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
<title>Debugger</title>
<script src="js/jquery.min.js" type="text/javascript" charset="utf-8"></script>
</head>
<body>
		<header style="height: 50px; background-color: rgba(32, 169, 112, 0.14); text-align: center;">
			<div class="left" id="teamheader" style="float:left; margin-left: 20px; margin-top: 15px; "><a href="index.php">Hi Admin</a></div>
			<div class="right" id="logoutheader" style="float: right; float: right;margin-right: 20px;margin-top: 15px;"><a href="logout.php">LogOut</a></div>
		</header>
		<div id="formSignupContainer" >
			<form id="formSignup" class="box" action="" method="POST">
				<h2 id="formSignupHeading">Add Team</h2>
				<input type="text" id="contestant1" name="contestant1" class="form-control" placeholder="Contestant" style="margin-bottom: 10px;">
				<input type="text" id="contestant2" name="contestant2" class="form-control" placeholder="Contestant" style="margin-bottom: 10px;">
				<input type="text" id="teamName" name="teamName" class="form-control" placeholder="Team Name" style="margin-bottom: 10px;">
				<input type="password" id="password" name="password" class="form-control" placeholder="Password" style="margin-bottom: 10px;">
				<input type="password" id="confirmPassword" name="confirmPassword" class="form-control" placeholder="Confirm Password" style="margin-bottom: 10px;">
				<br>
				<button class="btn btn-large btn-primary centerh" style="width: 100px;" id="btnSignup" type="submit">SignUp</button>
			</form>
		</div>
	<script src="js/jquery.min.js"></script>
	<script>
		$("#btnSignup").click(function() {
			$("#alertdiv").remove();
			var con1 = $("#contestant1").val();
			var con2 = $("#contestant2").val();
			var teamName = $("#teamName").val();
			var password = $("#password").val();
			var confirmPassword = $("#confirmPassword").val();
			
			if(/*password.length <=8 || password.length >=16 ||*/ password != confirmPassword){
				$('#formSignupContainer').append('<div id="alertdiv" class="alert alert-error"> <button type="button" class="close" data-dismiss="alert">&times;</button><strong>Ooops!</strong>Passwords Don\'t match..</div>');
				setTimeout(function() { $("#alertdiv").remove(); }, 500000);
			}else{
				$.ajax({
					type: "POST", url: "trySignup.php", data: 'con1='+con1+'&con2='+con2+'&teamName='+teamName+'&password='+password,
					success: function(dat){
						p=$(dat).html();
						if(p=="YES"){ window.location.href="index.php";
						}else{
							console.log("hell");
							$('#formSignupContainer').append('<div id="alertdiv" class="alert alert-error"> <button type="button" class="close" data-dismiss="alert">&times;</button><strong>Ooops!</strong>choose a different Team Name</div>');
							setTimeout(function() { $("#alertdiv").remove(); }, 500000);
						}
					},
					error: function(){
						console.log("err");
						$('#formSignupContainer').append('<div id="alertdiv" class="alert alert-error"> <button type="button" class="close" data-dismiss="alert">&times;</button><strong>Ooops!</strong>Something went wrong. Try Again!</div>');
						setTimeout(function() { $("#alertdiv").remove(); }, 500000);
					}
				});
			return false;
			}
		} );
	</script>
	<script src="js/bootstrap.min.js"></script>
</body>
<?php
}
?>