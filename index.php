<?php
session_start();

if(isset($_SESSION['uname']))
{
	header("location: showdetails.php");
}

if(isset($_POST['submit']))
{
	$con = mysqli_connect("localhost","root","","lms");

$uid = mysqli_real_escape_string($con,$_POST['userid']);
$password = md5(mysqli_real_escape_string($con,$_POST['password']));

$res = mysqli_query($con,"select * from users where uid='$uid' and password='$password';");

$row = mysqli_fetch_array($res,MYSQLI_ASSOC);
$count = mysqli_num_rows($res);

if($count == 1) {
		 $_SESSION['uname'] = $row['uname'];
         $_SESSION['uid'] = $row['uid'];
         $_SESSION['type'] = $row['type'];
         $_SESSION['dept'] = $row['dept'] ;
		if($row['type'] == 'faculty'){
         header("location: showdetails.php");
         }
         else if($row['type'] == 'approval')
         {
         header("location: approvals.php");
         }
         else if($row['type'] == 'admin')
         {
         	header("location: admin.php");
         }
     
      }else {
         echo "<script>";
         echo "window.alert('Username or Password is incorrect')";
         echo "</script>" ;
      }

mysqli_close($con) ;
}
?>

<html>
<head>
	<title>Leave Management System :: NIT Raipur</title>
		<link rel="shortcut icon" href="assets/logo.png" type="image/x-icon">
		<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
		<link rel="stylesheet" type="text/css" href="css/index.css">
		<meta charset="utf-8">
</head>
<body>
<div class="container-fluid" id="contain">
	<div class="jumbotron heading">
		<div class="row">
			<div class="col-lg-8 col-sm-8 col-xs-8">
				<h2>National Institute of Technology, Raipur</h2>
				<h4>राष्ट्रीय प्रौद्योगिकी संस्थान ,रायपुर</h4>
				<p>Leave Management System</p>
			</div>
			<div class="col-lg-4 col-sm-4 col-xs-4">
				<a href="#"><img align="right" height="135" width="120" src="assets/logo.png"></a>
			</div>
		</div>
	</div>
	<div class="row">
		<form class="form" name="login" method="POST">
			<div class="well col-lg-9 col-sm-7 well-div">
			<span class="text-info" >PLEASE USE YOUR LMS DETAILS TO LOGIN</span>
			</div>
			<table class="table-condensed table-hover table-responsive" align="center" cellspacing="20px">
				<tr>
					<td><label class="text-danger">User ID</label></td>
					<td><b> : </b><input type="text" name="userid" placeholder="Enter User ID here" required></td>
				</tr>
				<tr>
					<td><label class="text-danger">Password</label></td>
					<td><b> : </b><input type="Password" name="password" placeholder="Enter Password here" required></td>
				</tr>
		    </table>
		    
		    <br />
		    <div align="center">
		    	<a href="forgotpassword.php" class="text-danger" data-toggle="tooltip" title="Reset your password through email in case you have forgotten your password">Forgot Password?</a><br><br>
		    	<input class="btn btn-success" type="submit" name="submit">
		    </div>	
		</form>
	</div>
	<br />
	<div class="panel-footer footer">
		<p>NITRR - Leave Management Sytem | Designed and Developed by Team Encoders</p> <hr>
		<div class="row">
			<div class="col-lg-9">
		<p><a href="http://www.nitrr.ac.in" target="_blank">NITRR</a></p>
		<p>NIT RAIPUR &copy; 2018. All rights Reserved.</p>
			</div>
			<div class="col-lg-3" align="center">
				<h4 class="text-primary">CONTACT US</h4>
				<span class="glyphicon glyphicon-user"></span> &nbsp; Sundar Kumar Akella <br>
				<span class="glyphicon glyphicon-envelope"></span> &nbsp;akellasundarkumar1997@gmail.com
			</div>
		</div>
	</div>
	</div>
	<script type="text/javascript" src="js/bootstrap.js"></script>
</body>
</html>