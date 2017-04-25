<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="styles.css"/>
	<script src="jquery.js"></script>
	<script src="methods.js"></script>
</head>
<body>
	
	<h1 id="Hello">Welcome!</h1>
	<hr>
	<div id="left">
		<img class="UserImg"></br>
		<p class="UserData"></p>
	</div>
	<div id="center">
		<h2>You're playing: X</h2>
		<div class="table">
			<div class="row1">
				<div class="col1"></div>
				<div class="col2"></div>
				<div class="col3"></div>
			</div>
			
			<div class="row2">
				<div class="col1"></div>
				<div class="col2"></div>
				<div class="col3"></div>
			</div>

			<div class="row3">
				<div class="col1"></div>
				<div class="col2"></div>
				<div class="col3"></div>
			</div>
		</div></br>
		<button id="Restart">Restart</button>
	</div>
	<div id="right">
		<div class="FileData">
			<p>Choose file:</p>
			<input type="file" name="file_for_hash" id="file">
			<p id="HashResult"></p>
		</div>
	</div>

</body>
</html>