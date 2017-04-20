<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="styles.css"/>
	<script src="jquery.js"></script>
	<script type="text/javascript">

		$(document).ready(function(){
			$('#Send').click(function(){	
					var login = $('#username').val();
					var pass = $('#password').val();
					var f_name = $('#name1').val();
					var l_name = $('#name2').val();
					var email = $('#E-mail').val();
					var photo_path = $('#photo').val();

					photo_path = photo_path.split("\\");
					var photo = photo_path[photo_path.length - 1];

					if (login && pass) {

		 				$.ajax({
		 					type: "POST",
		 					url: 'SendData.php', 
		 					dataType: "json",
		 					data: {
		 						username: login,
		 						password: pass,
		 						name1: f_name,
		 						name2: l_name,
		 						E_mail: email,
		 						photo: photo
		 					}, 
		 					success: function(json){		
		 						if (json) {
		 							document.location.replace("Home.php");
		 						}
		 						else {
		 							alert("Registration failed! Login isn't free.");
		 						}
				        	},
		 				});	 		 					
	 				}
	 				else {
	 					alert("Please enter Login and/or Password.");
	 				}
	 		})
		});

	</script>
</head>
<body>
	<div id="inf2">
	<h1>Registration</h1>

	<form name="Form" enctype="multipart/form-data">
		<div id="data">

		Login: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		<input type="text" id="username" autofocus required><br><br>
		Password: &nbsp;&nbsp;<input type="password" id="password" required><br><br>
		First Name: <input type="text" id="name1"><br><br>
		Last Name: <input type="text" id="name2"><br><br>
		E-mail: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		<input type="email" id="E-mail"><br><br>
		Photo: <input type="file" accept=".jpg" id="photo"><br><br>	
		
		</div>

		<input type="button" value="Submit" id="Send">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="reset" value="Reset" id="Reset">
		</form>
	</div>	

</body>
</html>