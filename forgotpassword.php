<?php
$con = mysqli_connect("localhost","root","","lms");
function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}
if (isset($_POST['submit'])) {
	$uid = $_POST['uid'] ;
	$res = mysqli_query($con,"select * from users where uid='$uid';");

	$row = mysqli_fetch_array($res,MYSQLI_ASSOC);
	$count = mysqli_num_rows($res);

	if ($count == 1) {
		$pwd = generateRandomString(10);
		$mr = mail("ask1997test@gmail.com", "NEW PASSWORD", $pwd);
		if(!mr)
		{
			die('mail couldnt be sent');
		}
		else
		{
		$res = mysqli_query($con,"insert into fp values('$uid','$pwd');");
		header("location:resetpassword.php");
		}
	}
	else
	{
		die("The User ID is not found, contact the administrator ");
	}

}
mysqli_close($con);
?>
<html>
<head>
	<title>FORGOT PASSWORD</title>
</head>
<body>
<form method="POST">
	<label>User ID : </label><input type="text" name="uid">
	<input type="submit" name="submit">
</form>
</body>
</html>