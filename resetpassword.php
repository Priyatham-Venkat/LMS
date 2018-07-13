<?php 
session_start();
$con = mysqli_connect("localhost","root","","lms");
if(isset($_POST['submit']))
{
	$uid = $_POST['uid'] ;
	$password = $_POST['password'] ;

	$res = mysqli_query($con,"select * from fp where uid='$uid';");

	$row = mysqli_fetch_array($res,MYSQLI_ASSOC);
	$count = mysqli_num_rows($res);

	if($count == 1)
	{
		if($password == $row['password'])
		{	
			$res = mysqli_query($con,"select * from users where uid = '$uid'");
			$row = mysqli_fetch_array($res,MYSQLI_ASSOC);
		 $_SESSION['uname'] = $row['uname'];
         $_SESSION['uid'] = $row['uid'];
         $_SESSION['type'] = $row['type'];
			header("location: newpwd.php");
		}
		else
		{
			die('No account found');
		}
	}
}
mysqli_close($con);
?>
<html>
<head>
	<title>PASSWORD RESET</title>
</head>
<body>
<h3>Enter the password sent to you on Mail</h3>
<form method="POST">
	<label>UID:</label><input type="text" name="uid">
	<label>PWD:</label><input type="password" name="password">
	<input type="submit" name="submit">
</form>
</body>
</html>