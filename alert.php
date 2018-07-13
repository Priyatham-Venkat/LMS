<?php
session_start();
if(isset($_POST['submit']))
{
	header("location: showdetails.php") ;
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>FORM SUBMITTED</title>
</head>
<body>
<form method="POST">
	<label>The form is submitted succesfully</label>
	<input type="submit" name="submit" value="Continue">
</form>
</body>
</html>