<?php
session_start();

if($_SESSION['type'] == 'faculty')
{
	header("location: showdetails.php");
}

if($_SESSION['type'] == 'approval')
{
	header("location: approvals.php");
}

?>

<!DOCTYPE html>
<html>
<head>
	<title>ADMIN</title>
</head>
<body>
	<h1>PAGE UNDER CONSTRUCTION</h1><hr>
<a href="logout.php">LOG OUT</a>
</body>
</html>