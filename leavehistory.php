<?php 
session_start();

if (!isset($_SESSION['uname']) || empty($_SESSION['uname'])) {
     header("location:index.php");
}

$uname = $_SESSION['uname'] ;
$uid = $_SESSION['uid'] ;

if($_SESSION['type'] == 'approval')
{
	header("location: approvals.php");
}

if($_SESSION['type'] == 'admin')
{
	header("location: admin.php");
}

$con = mysqli_connect("localhost","root","","lms") ;

$clq = mysqli_query($con,"select * from cl where uid = '$uid' and hod = 'accepted';");
$sclq = mysqli_query($con,"select * from scl where uid = '$uid' and hod = 'accepted' and dir = 'accepted';");
$mlq = mysqli_query($con,"select * from ml where uid = '$uid' and hod = 'accepted' and dir = 'accepted';");
$rhlq = mysqli_query($con,"select * from rhl where uid = '$uid' and hod = 'accepted' and dir = 'accepted';");
$elq = mysqli_query($con,"select * from el where uid = '$uid' and hod = 'accepted' and dir = 'accepted';");

?>
<html>
<head>
	<title>Check Status :: Leave Manager :: NIT Raipur</title>
		<link rel="shortcut icon" href="assets/logo.png" type="image/x-icon">
		<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
		<link rel="stylesheet" type="text/css" href="css/calendar.css">
		<meta charset="utf-8">
		<style type="text/css">
			body
			{
				background-image: url('assets/b2.jpg') ;
				background-repeat: repeat;
			}
			h2, h4
			{
				color: #002b80;
			}
			table
			{
				border: 1px solid GREEN ;
			}
			table thead
			{
				background-color: #84cc8a ;
				font-size: 10px; 
				font-weight: BOLD ;
			}
			table tbody 
			{
				background-color:#bef9b3 ;
			}
		</style>
</head>
<body>
<div class="container" style="background: #eaf0f9; ">
		<div class="jumbotron" style="padding: 10px; text-align: center; background: #bad4ff;" >
		<div class="row">
			<div class="col-lg-8 col-sm-8">
				<h2>National Institute of Technology, Raipur</h2>
				<h4>राष्ट्रीय प्रौद्योगिकी संस्थान ,रायपुर</h4>
				<p style="color: #006600;">Leave Manager</p>
			</div>
			<div class="col-lg-4 col-sm-4" style="padding-right: 50px;">
				<a href="#"><img align="right" height="135" width="120" src="assets/logo.png"></a>
			</div>
		</div>
	</div>
	<nav class="navbar navbar-default" role="navigation" style="background: #ccf2ab;">
		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar">Overview</span>
					<span class="icon-bar">Check Status</span>
					<span class="icon-bar">Leave History</span>
				</button>
			</div>
			<div class="collapse navbar-collapse navbar-ex1-collapse">
				<ul class="nav nav-pills nav-justified">
					<li class="navbar-text" style="font-size: 15px;"><span class="glyphicon glyphicon-user"></span> Welcome <b><?php echo $uname ?></b></li>
					<li><a href="showdetails.php">Overview</a></li>
					<li><a href="checkstatus.php">Check Status</a></li>
					<li class="active"><a href="leavehistory.php">Leave History</a></li>
					<li><button class="btn btn-success navbar-btn btn-group-justified" onclick="location.href = 'logout.php'" ><span class="glyphicon glyphicon-log-out"></span>LOG OUT</button></li>
				</ul>
				</div>
		</div>
	</nav>
	<div>
		<div class="row container-fluid">
		<table class="table table-hover table-condensed">
			<thead>
			<tr>
				<td>App. NO</td>
				<td>Leave Start Date</td>
				<td>Leave End Date</td>
				<td>Category</td>
				<td>Purpose</td>
			</tr>
			</thead>
			<tbody>
			<?php 
			while( $row = mysqli_fetch_array($clq,MYSQLI_ASSOC) )
			{
				echo "<tr>" ;
				echo "<td> NITRR/CL/" . $row['appno'] . "</td>" ;
				echo "<td>" . $row['fdate'] . "</td>" ;
				echo "<td>" . $row['tdate'] . "</td>" ;
				echo "<td> CL </td>" ;
				echo "<td>" . $row['purpose'] . "</td>";
				echo "</tr>" ;
			}
			while( $row = mysqli_fetch_array($sclq,MYSQLI_ASSOC) )
			{
				echo "<tr>" ;
				echo "<td> NITRR/SCL/" . $row['appno'] . "</td>" ;
				echo "<td>" . $row['fdate'] . "</td>" ;
				echo "<td>" . $row['tdate'] . "</td>" ;
				echo "<td> SCL </td>" ;
				echo "<td>" . $row['purpose'] . "</td>";
				echo "</tr>" ;
			}
			while( $row = mysqli_fetch_array($mlq,MYSQLI_ASSOC) )
			{
				echo "<tr>" ;
				echo "<td> NITRR/ML/" . $row['appno'] . "</td>" ;
				echo "<td>" . $row['udate'] . "</td>" ;
				echo "<td>" . $row['fdate'] . "</td>" ;
				echo "<td> ML </td>" ;
				echo "<td> Medical Leave </td>";
				echo "</tr>" ;
			}
			while( $row = mysqli_fetch_array($rhlq,MYSQLI_ASSOC) )
			{
				echo "<tr>" ;
				echo "<td> NITRR/RHL/" . $row['appno'] . "</td>" ;
				echo "<td>" . $row['fdate'] . "</td>" ;
				echo "<td>" . $row['tdate'] . "</td>" ;
				echo "<td> RHL </td>" ;
				echo "<td>" . $row['purpose'] . "</td>";
				echo "</tr>" ;
			}
			while( $row = mysqli_fetch_array($elq,MYSQLI_ASSOC) )
			{
				echo "<tr>" ;
				echo "<td> NITRR/EL/" . $row['appno'] . "</td>" ;
				echo "<td>" . $row['fdate'] . "</td>" ;
				echo "<td>" . $row['tdate'] . "</td>" ;
				echo "<td> EL </td>" ;
				echo "<td>" . $row['purpose'] . "</td>";
				echo "</tr>" ;
			}
			?>
			</tbody>
		</table>
    	</div>	 

	<div class="panel-footer" style="border-radius: 10px; background: #bad4ff ;">
		<p style="color: #002b80 ; font-size: 17px ;" align="center">NITRR - Leave Management Sytem | Designed and Developed by Team Encoders</p> <hr>
		<div class="row">
			<div class="col-lg-9">
		<p align="center"><a href="http://www.nitrr.ac.in" target="_blank">NITRR</a></p>
		<p align="center">NIT RAIPUR &copy; 2018. All rights Reserved.</p>
			</div>
			<div class="col-lg-3">
				<h4 class="text-primary">CONTACT US</h4>
				<span class="glyphicon glyphicon-user"></span> &nbsp; Sundar Kumar Akella <br>
				<span class="glyphicon glyphicon-envelope"></span> &nbsp;akellasundarkumar1997@gmail.com
			</div>
		</div>
	</div>
<script type="text/javascript" src="js/bootstrap.js"></script>
<script type="text/javascript" src="js/calendar.js"></script>
</div>
</div>
</body>
</html>