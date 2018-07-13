<?php 
session_start();

if (!isset($_SESSION['uname']) || empty($_SESSION['uname'])) {
     header("location:index.php");
}

$uname = $_SESSION['uname'] ;
$dept = $_SESSION['dept'] ;

if($_SESSION['type'] == 'faculty')
{
	header("location: showdetails.php");
}

if($_SESSION['type'] == 'admin')
{
	header("location: admin.php");
}

$con = mysqli_connect("localhost","root","","lms") ;

$clq = mysqli_query($con,"select * from cl where hod='pending' and ls='active' and dept='$dept';");
$sclq = mysqli_query($con,"select * from scl where hod='pending' and ls='active' and dept='$dept';");
$mlq = mysqli_query($con,"select * from ml where hod='pending' and ls='active' and dept='$dept';");
$rhlq = mysqli_query($con,"select * from rhl where hod='pending' and ls='active' and dept='$dept';");
$elq = mysqli_query($con,"select * from el where hod='pending' and ls='active' and dept='$dept';");

if(isset($_POST['accept']))
{
	$table = $_POST['type'] ;
	$appno = $_POST['appno'] ;

	$accept = mysqli_query($con,"update $table set hod='accepted' where appno='$appno' ; ");
	if(!$accept)
	{
		 echo "<script>";
         echo "window.alert('Could not grant the leave')";
         echo "</script>" ;
	}
	else
	{
		 echo "<script>";
         echo "window.alert('Leave Grant Successful')";
         echo "</script>" ;
	}
}

if(isset($_POST['decline']))
{
	$table = $_POST['type'] ;
	$appno = $_POST['appno'] ;

	$decline = mysqli_query($con,"update $table set hod='declined' where appno='$appno' ; ");
	if(!$accept)
	{
		 echo "<script>";
         echo "window.alert('The leave could not be declined')";
         echo "</script>" ;
	}
	else
	{
		 echo "<script>";
         echo "window.alert('Leave is denied')";
         echo "</script>" ;
	}
}

?>
<html>
<head>
	<title>Welcome :: Leave Manager :: NIT Raipur</title>
		<link rel="shortcut icon" href="assets/logo.png" type="image/x-icon">
		<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
		<link rel="stylesheet" type="text/css" href="css/calendar.css">
		<script type="text/javascript" src="js/jquery.js"></script>
		<meta charset="utf-8">
		<style type="text/css">
			.c1
			{
				box-shadow: 10px 10px 5px GREY;
			}
			body
			{
				background-image: url('assets/b2.jpg') ;
				background-repeat: repeat;
			}
			#row1
			{
				margin-left: 25px;
				margin-right: 25px;
			}
		</style>	
</head>
<body>
<div class="container c1" style="background: #eaf0f9; ">
		<div class="jumbotron" style="padding: 10px; text-align: center; background: #bad4ff;" >
		<div class="row">
			<div class="col-lg-8 col-sm-8">
				<h2 style="color: #002b80;">National Institute of Technology, Raipur</h2>
				<h4 style="color: #002b80;">राष्ट्रीय प्रौद्योगिकी संस्थान ,रायपुर</h4>
				<p style="color: #006600;">LEAVE SYSTEM : APPROVALS PORTAL :: HOD PORTAL</p>
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
				</button>
			</div>
			<div class="collapse navbar-collapse navbar-ex1-collapse">
				<ul class="nav navbar-header nav-justified">
					<li class="navbar-text navbar-brand" style="font-size: 20px;"><span class="glyphicon glyphicon-user"></span> Welcome <b><?php echo $uname ?></b></li>
					<li align="right"><button class="btn btn-success navbar-btn" onclick="location.href='logout.php'"><span class="glyphicon glyphicon-log-out"></span>LOG OUT</a></button></li>
				</ul>
			</div>
		</div>
	</nav>
	<div>
	  <div class="row" id="row1">
	  	<table class="table table-condensed table-bordered table-responsive">
	  		<thead>
	  			<tr style="font-size: 12px;">
	  				<td>Application ID</td>
	  				<td>Name of Applicant</td>
	  				<td>Dept.</td>
	  				<td>Reason</td>
	  				<td>Start Date</td>
	  				<td>End Date</td>
	  				<td>Quota</td>
	  				<td>Action</td>
	  			</tr>
	  		</thead>
	  		<tbody>
	  			<?php 
			while( $row = mysqli_fetch_array($clq,MYSQLI_ASSOC) )
			{
				echo "<tr>" ;
				echo "<td> NITRR/CL/" . $row['appno'] . "</td>" ;
				echo "<td>" . $row['uname'] . "</td>" ;
				echo "<td>" . $row['dept'] . "</td>" ;
				echo "<td>" . $row['purpose'] . "</td>" ;
				echo "<td>" . $row['fdate'] . "</td>" ;
				echo "<td>" . $row['tdate'] . "</td>" ;
				echo "<td> CL </td>" ;
				echo "<td>
				<form method='POST'>
				<input type='hidden' name='type' value='cl' />
				<input type='hidden' name='appno' value=" . $row['appno'] . ">
				<input type='submit' name='accept' value='accept' class='btn btn-success'>
				<input type='submit' name='decline' value='decline' class='btn btn-danger'>
				</form>
				</td>";
				echo "</tr>" ;
			}
			while( $row = mysqli_fetch_array($sclq,MYSQLI_ASSOC) )
			{
				echo "<tr>" ;
				echo "<td> NITRR/SCL/" . $row['appno'] . "</td>" ;
				echo "<td> SCL </td>" ;
				echo "<td>" . $row['fdate'] . "</td>" ;
				echo "<td>" . $row['tdate'] . "</td>" ;
				echo "<td>" . $row['hod'] . "</td>" ;
				echo "<td>" . $row['dir'] . "</td>" ;
				echo "<td><form method='POST' onsubmit='return confirm(\"Do you really want to Cancel the Leave?\")'>
				<input type='hidden' name='type' value='scl' />
				<input type='hidden' name='appno' value=" . $row['appno'] . ">
				<input type='submit' name='sclcancel' value='Cancel' class='btn btn-danger'" ;
				if($today > $row['fdate'])
					echo "disabled";
				echo ">
				</form></td>"
				;
				echo "</tr>" ;
			}
			while( $row = mysqli_fetch_array($mlq,MYSQLI_ASSOC) )
			{
				echo "<tr>" ;
				echo "<td> NITRR/ML/" . $row['appno'] . "</td>" ;
				echo "<td> ML </td>" ;
				echo "<td>" . $row['udate'] . "</td>" ;
				echo "<td>" . $row['fdate'] . "</td>" ;
				echo "<td>" . $row['hod'] . "</td>" ;
				echo "<td>" . $row['dir'] . "</td>" ;

				echo "<td><form method='POST' onsubmit='return confirm(\"Do you really want to Cancel the Leave?\")'>
				<input type='hidden' name='type' value='ml' />
				<input type='hidden' name='appno' value=" . $row['appno'] . ">
				<input type='submit' name='mlcancel' value='Cancel' class='btn btn-danger'" ;
				if($today > $row['udate'])
					echo "disabled";
				echo ">
				</form></td>"
				;
				echo "</tr>" ;
			}
			while( $row = mysqli_fetch_array($rhlq,MYSQLI_ASSOC) )
			{
				echo "<tr>" ;
				echo "<td> NITRR/RHL/" . $row['appno'] . "</td>" ;
				echo "<td> RHL </td>" ;
				echo "<td>" . $row['fdate'] . "</td>" ;
				echo "<td>" . $row['tdate'] . "</td>" ;
				echo "<td>" . $row['hod'] . "</td>" ;
				echo "<td>" . $row['dir'] . "</td>" ;
				echo "<td><form method='POST' onsubmit='return confirm(\"Do you really want to Cancel the Leave?\")'>
				<input type='hidden' name='type' value='rhl' />
				<input type='hidden' name='appno' value=" . $row['appno'] . ">
				<input type='submit' name='rhlcancel' value='Cancel' class='btn btn-danger'" ;
				if($today > $row['fdate'])
					echo "disabled";
				echo ">
				</form></td>"
				;
				echo "</tr>" ;
			}
			while( $row = mysqli_fetch_array($elq,MYSQLI_ASSOC) )
			{
				echo "<tr>" ;
				echo "<td> NITRR/EL/" . $row['appno'] . "</td>" ;
				echo "<td> EL </td>" ;
				echo "<td>" . $row['fdate'] . "</td>" ;
				echo "<td>" . $row['tdate'] . "</td>" ;
				echo "<td>" . $row['hod'] . "</td>" ;
				echo "<td>" . $row['dir'] . "</td>" ;
				echo "<td><form method='POST' onsubmit='return confirm(\"Do you really want to Cancel the Leave?\")'>
				<input type='hidden' name='type' value='el' />
				<input type='hidden' name='appno' value=" . $row['appno'] . ">
				<input type='submit' name='elcancel' value='Cancel' class='btn btn-danger'" ;
				if($today > $row['fdate'])
					echo "disabled";
				echo ">
				</form></td>"
				;
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
<script type="text/javascript" src="js/bootstrap.min.js"></script>
<script type="text/javascript" src="js/calendar.js"></script>


</div>
</div>
</body>
</html>