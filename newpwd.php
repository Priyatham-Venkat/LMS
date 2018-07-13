<?php 
session_start();
$con = mysqli_connect("localhost","root","","lms");
if(isset($_POST['submit']))
{
	$uid = $_SESSION['uid'];
	$pwd = $_POST['password'];
	$res = mysqli_query($con,"update users set password = '$pwd' where uid = '$uid';");
	if($res)
	{
		session_destroy();
		header("location:index.php");
	}
} 


?>

<!DOCTYPE html>
<html>
<head>
	<title>SET NEW PWD</title>
</head>
<body>
<form method="POST">
	<label>PWD :</label><input type="text" name="password">
	<input type="submit" name="submit">
</form>
</body>
</html>