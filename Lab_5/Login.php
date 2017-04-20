<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="styles.css"/>
	<script src="jquery.js"></script>
	<script>

		function Send() {
			var login = $('#username').val();
			var pass = $('#password').val();

			$.ajax({
				type: "POST",
				url: 'CheckData.php', 
				dataType: "json",
				data: {
					username: login,
					password: pass,
				}, 
				success: function(json){		
					if (json) {	
						document.location.href = "Home.php";
					}
					else {
						alert("Incorrect Login or Password.");
					}
				},
			});
		}

		$(document).ready(function(){
	 		$('#Registration').click(function(){
	 			document.location.href = "Registration.php";
	 		})
		});

	</script>
</head>
<body>
	<div id="inf">
	<h1>Log in</h1>

	<form name="Form" method="POST" action="Home.php" enctype="multipart/form-data">

		<div id="data">
			Login: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="username" id="username" autofocus required><br><br>
			Password: <input type="password" name="password" id="password" required><br><br>
		</div>

		<input type="button" value="Log in" id="LogIn" onclick="return Send();">&nbsp;&nbsp;&nbsp;<input type="reset" value="Reset"></br></br>
		<input type="button" value="Registration" id="Registration">

	</form>
	</div>

</body>
</html>