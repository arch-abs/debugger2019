<?php
require_once ("includes/global.php");
if (isset ( $_SESSION ['teamName'] ) && ($_GET ['key'] != "M1112AER"))
	header ( "Location: index.php" ) && die ();
metadetails ();
?>
<!--<?php
// if(!isset($_POST['teamid'])){?>-->
</head>
<body>
	<div id="form-signin-container">
		<form id="form-signin" class="box" action="" method="POST">
			<h2 id="form-signin-heading">Please Sign In</h2>
			<input type="text" id="teamName" name="teamName" class="form-control" placeholder="Team Name" style="margin-bottom: 10px;">
			<input type="password" id="password" name="password" class="form-control" placeholder="Password" style="margin-bottom: 10px;">
				<br>
			<button class="btn btn-large btn-primary centerh"style="width: 100px;" id="btn-login" type="submit">Sign in</button>
		</form>
		<p style="color:white">click here to <a href="./signup.php">Signup</a></p>
	</div>
	<script src="js/jquery.min.js"></script>
	<script>
		$("#btn-login").click(function() {
			$("#alertdiv").remove();
			var tid = $("#teamName").val();
			var pass = $("#password").val();
			if (/*pass.length >16 || pass.length <8 ||*/ false) {
				$('#form-signin-container').append('<div id="alertdiv" class="alert alert-error" style="color:white;"> <button type="button" class="close" data-dismiss="alert">&times;</button><strong>Ooops!</strong>Looks like the ID or password you entered is not of correct length!</div>');
				setTimeout(function() { $("#alertdiv").remove(); }, 5000);
			}
			else
				$.ajax({
					type: "POST", url: "trylogin.php", data: 'teamName='  + tid + '&password=' + $("#password").val(),
					success: function(data) {
												p = $(data).html();
												if (p == "YES") window.location.href = 'index.php';
												else {
													$('#form-signin-container').append('<div id="alertdiv" class="alert alert-error" style="color:white;"> <button type="button" class="close" data-dismiss="alert">&times;</button><strong>Ooops!</strong>Looks like the ID or password you entered is incorrect!</div>');
													setTimeout(function() { $("#alertdiv").remove(); }, 5000);
												}
											},
					error: function() {
						$('#form-signin-container').append('<div id="alertdiv" class="alert alert-error" style="color:white;"> <button type="button" class="close" data-dismiss="alert">&times;</button><strong>Ooops!</strong>Something went wrong. Try Again!</div>');
						setTimeout(function() { $("#alertdiv").remove(); }, 5000);
					}
				});
			return false;
		} );
	</script>
	<script src="js/bootstrap.min.js"></script>
</body>