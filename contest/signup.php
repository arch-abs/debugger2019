<?php 
	require_once ("includes/global.php");
	if(!isset($_SESSION)) {
		session_start(); 
	}
	metadetails();
?>
</head>
<body>
		<div id="formSignupContainer" >
			<form id="formSignup" class="box" action="" method="POST">
				<h2 id="formSignupHeading">SignUp</h2>
				<input type="text" id="contestant1" name="contestant1" class="form-control" placeholder="Contestant-1" style="margin-bottom: 10px;">
				<input type="text" id="contestant2" name="contestant2" class="form-control" placeholder="Contestant-2" style="margin-bottom: 10px;">
				<input type="text" id="teamName" name="teamName" class="form-control" placeholder="Team Name" style="margin-bottom: 10px;">
				<input type="password" id="password" name="password" class="form-control" placeholder="Password" style="margin-bottom: 10px;">
				<input type="password" id="confirmPassword" name="confirmPassword" class="form-control" placeholder="Confirm Password" style="margin-bottom: 10px;">
				<br>
				<button class="btn btn-large btn-primary centerh" style="width: 100px;" id="btnSignup" type="submit">SignUp</button>
			</form>
			<p style="color:white">click here to <a href="./login.php">login</a></p>
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
			
			if(password.length <8 || password.length >16){
				$('#formSignupContainer').append('<div id="alertdiv" class="alert alert-error" style="color:white"> <button type="button" class="close" data-dismiss="alert">&times;</button><strong>Ooops!</strong>passord length should be between 8 and 16...</div>');
				setTimeout(function() { $("#alertdiv").remove(); }, 50000);
			}else if( password != confirmPassword){
				$('#formSignupContainer').append('<div id="alertdiv" class="alert alert-error" style="color:white"> <button type="button" class="close" data-dismiss="alert">&times;</button><strong>Ooops!</strong>Passwords Don\'t match..</div>');
				setTimeout(function() { $("#alertdiv").remove(); }, 50000);
			}else{
				$.ajax({
					type: "POST", url: "trySignup.php", data: 'con1='+con1+'&con2='+con2+'&teamName='+teamName+'&password='+password,
					success: function(dat){
						p=$(dat).html();
						if(p=="YES"){ window.location.href="index.php";
						}else{
							console.log("hell");
							$('#formSignupContainer').append('<div id="alertdiv" class="alert alert-error" style="color:white;"> <button type="button" class="close" data-dismiss="alert">&times;</button><strong>Ooops!</strong>choose a different Team Name</div>');
							setTimeout(function() { $("#alertdiv").remove(); }, 50000);
						}
					},
					error: function(){
						console.log("err");
						$('#formSignupContainer').append('<div id="alertdiv" class="alert alert-error" style="color:white;"> <button type="button" class="close" data-dismiss="alert">&times;</button><strong>Ooops!</strong>Something went wrong. Try Again!</div>');
						setTimeout(function() { $("#alertdiv").remove(); }, 50000);
					}
				});
			}
			return false;
		} );
	</script>
	<script src="js/bootstrap.min.js"></script>
</body>