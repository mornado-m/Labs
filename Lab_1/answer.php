<!DOCTYPE html>
<html>
<body style="background-image: url(bg.jpg);">
<br><br><br><br><br><br><br><br><br><br>
<p style="text-align: center;">

<?php
$name1 = $name2 = $birthday = $Email = $password = $country = $sex = "";
$post = true;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $name1 = $_POST["name1"];
  $name2 = $_POST["name2"];
  $birthday = $_POST["birthday"];
  $Email = $_POST["E-mail"];
  $password = $_POST["password"];
  $country = $_POST["country"];
  $sex = $_POST["sex"];
  $photo = CheckFile($_FILES["photo"]["name"]);
}
else{
  $name1 = $_GET["name1"];
  $name2 = $_GET["name2"];
  $birthday = $_GET["birthday"];
  $Email = $_GET["E-mail"];
  $password = $_GET["password"];
  $country = $_GET["country"];
  $sex = $_GET["sex"];
  $photo = CheckFile($_GET["photo"]);
  $post = false;
}

function CheckFile($data){
	$ext = "";
	if ($data != "") {
		$ext = end(explode(".", $data));
		return $ext;
	}
	else{
		return "";
	}
}

?>

Welcome <?php echo $name1; echo " "; echo $name2; echo ". Registration was succsessful. "; ?>

<?php
if ($name1 != "Mykola" and $name2 != "Pavlenchyk"){
	echo "You are user.<br>";
}
else {
	echo "You are admin.<br>";
}

if ($Email != ""){
	echo "Your email address is: ";
	echo $Email;
	echo "<br>";
}

if ($sex != "") {
	if ($sex == "male") {		
		echo "You are the man. ";
	} elseif ($sex == "female") {
		echo "You are the women. ";
	}
}

if ($birthday != "") {
	echo "Your birthday: ";
	echo $birthday;
	echo ". ";
}

if ($country != "") {
	echo "You are from ";
	echo $country;
	echo ". ";
}


if($post){
	if ($photo != "") {
		echo "<br>";
		echo "You uploaded $photo file.";	
	}
}
else {
	echo "<br>";
	echo "You can't uploaded file by method get.";
}

?>

</p>

</body> 
</html>