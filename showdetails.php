<?php
session_start();

if (!isset($_SESSION['uname']) || empty($_SESSION['uname'])) {
     header("location:index.php");
}

if($_SESSION['type'] == 'approval')
{
	header("location: approvals.php");
}

if($_SESSION['type'] == 'admin')
{
	header("location: admin.php");
}

$con = mysqli_connect("localhost","root","","lms") ;

$maxf = mysqli_query($con,"select * from max;");
$max = mysqli_fetch_array($maxf,MYSQLI_ASSOC);

$uname = $_SESSION['uname'] ;
$uid = $_SESSION['uid'];

$res = mysqli_query($con,"select * from al where uid = '$uid'");
$el = mysqli_query($con, "select * from elavail where uid = '$uid'");

$elrow = mysqli_fetch_array($el,MYSQLI_ASSOC);
$row = mysqli_fetch_array($res,MYSQLI_ASSOC);

$used = array($max['cl'] - $row['cl'], $max['scl'] - $row['scl'], $max['rh'] - $row['rhl'], $max['ml'] - $row['ml']);
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
				margin-left: 50px;
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
					<li class="active"><a href="showdetails.php">Overview</a></li>
					<li><a href="checkstatus.php">Check Status</a></li>
					<li><a href="leavehistory.php">Leave History</a></li>
					<li><button class="btn btn-success navbar-btn btn-group-justified" onclick="location.href = 'logout.php'" ><span class="glyphicon glyphicon-log-out"></span>LOG OUT</button></li>
				</ul>
			</div>
		</div>
	</nav>
	  <div class="row" id="row1">
		<div class="panel panel-primary col-lg-7" style="margin-left: 8px; margin-right: 55px; padding-left: 0px; padding-right: 0px;">
			<div class="panel-heading panel-title" align="center" style="font-size: 18px; ">
				AVAILABLE LEAVES
			</div>
			<div class="panel-body">
				<table class="table table-condensed table-hover">
					<thead>
					<tr style="font-size: 10px; font-weight: bold;">
						<td>Type of Leave</td>
						<td>Available</td>
						<td>Used</td>
						<td>Action</td>
					</tr>
					</thead>
					<tbody>
					<tr>
						<td>Casual Leave (CL)</td>
						<td><?php echo "{$row['cl']}"; ?></td>
						<td><?php echo "$used[0]"; ?></td>
						<td><button class="btn btn-success" data-toggle="modal" href='#cl-modal' <?php if($row['cl'] == 0) echo "disabled"; ?>>APPLY</button></td>
					</tr>
					<tr>
						<td>Special Casual Leave (SCL)</td>
						<td><?php echo "{$row['scl']}"; ?></td>
						<td><?php echo "$used[1]"; ?></td>
						<td><button class="btn btn-success" data-toggle="modal" href='#scl-modal' <?php if($row['scl'] == 0) echo "disabled"; ?>>APPLY</button></td>
					</tr>
					<tr>
						<td>Restricted Holiday (RH)</td>
						<td><?php echo "{$row['rhl']}"; ?></td>
						<td><?php echo "$used[2]"; ?></td>
						<td><button class="btn btn-success" data-toggle="modal" href='#rh-modal' <?php if($row['rhl'] == 0) echo "disabled"; ?>>APPLY</button></td>
					</tr>
					<tr>
						<td>Medical Leave (ML)</td>
						<td><?php echo "{$row['ml']}"; ?></td>
						<td><?php echo "$used[3]"; ?></td>
						<td><button class="btn btn-success" data-toggle="modal" href='#ml-modal' <?php if($row['ml'] == 0) echo "disabled"; ?>>APPLY</button></td>
					</tr>
					<tr>
						<td>Earned Leave (EL)</td>
						<td><?php echo "{$elrow['el']}" ; ?></td>
						<td> - </td>
						<td><button class="btn btn-success" data-toggle="modal" href='#el-modal' <?php if($row['el'] == 0) echo "disabled"; ?>>APPLY</button></td>
					</tr>
					</tbody>
				</table>
				<!-- Modals here -->
				<div class="modal fade" id="cl-modal">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header bg-primary">
								<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
								<h4 class="modal-title" align="center">CASUAL LEAVE APPLICATION</h4>
							</div>
							<div class="modal-body bg-warning">
								<form action="clform.php" method="POST" onsubmit="return confirm('Are you sure you want to apply fo this leave?')">
									<fieldset>
										<legend>Leave Information</legend>
								<table class="table table-responsive">
										<tr>
											<td><label>Period of Absence :</label></td>
											<td><label>From:</label><input type="date" name="fdate"><label> To:</label><input type="date" name="tdate"></td>
										</tr>
										<tr>
											<td><label>Purpose of leave :</label></td> 
											<td><textarea name="purpose" cols="50" rows="3"></textarea></td>
										</tr>
										<tr>
											<td><label>Head Quarter Leave required :</label></td>
											<td>
												<input type="radio" name="hql" value="yes">Yes <span class="col-lg-offset-3"></span>	
												<input type="radio" name="hql" value="no">No
											</td>
										</tr>
										<tr>
											<td><label>Contact during abscence</label></td>
											<td>
												Phone : <input type="number" name="absphone"> <br> <br>
												Address : <input type="text" name="absaddr">
											</td>
										</tr>
								</table>
								</fieldset>
								<fieldset>
									<legend>Substitution Details</legend>
								<table class="table table-condensed table-hover">
									<thead style="font-size: 10px;">
										<tr>
											<td><b>Name & Designation of Faculty</b></td>
											<td><b>Date</b></td>
											<td><b>Contact</b></td>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td><input type="text" name="sname1"></td>
											<td><input type="date" name="sdate1"></td>
											<td><input type="number" name="snumber1"></td>
										</tr>
										<tr>
											<td><input type="text" name="sname2"></td>
											<td><input type="date" name="sdate2"></td>
											<td><input type="number" name="snumber2"></td>
										</tr>
										<tr>
											<td><input type="text" name="sname3"></td>
											<td><input type="date" name="sdate3"></td>
											<td><input type="number" name="snumber3"></td>
										</tr>
										<tr>
											<td><input type="text" name="sname4"></td>
											<td><input type="date" name="sdate4"></td>
											<td><input type="number" name="snumber4"></td>
										</tr>
									</tbody>
								</table>
								</fieldset>
								
							</div>
							<div class="modal-footer bg-primary">
								<input type="submit" name="submit" class="btn btn-success" value="Apply Leave">
								</form>
							</div>
						</div>
					</div>
				</div>

				<div class="modal fade" id="scl-modal">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header bg-primary">
								<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
								<h4 class="modal-title" align="center">SPECIAL CASUAL LEAVE APPLICATION</h4>
							</div>
							<div class="modal-body bg-warning">
								<form action="sclform.php" method="POST" enctype="multipart/form-data" onsubmit="return confirm('Are you sure you want to apply fo this leave?')">
									<fieldset>
										<legend>Leave Information</legend>
								<table class="table table-responsive">
										<tr>
											<td><label>Period of Absence :</label></td>
											<td><label>From:</label><input type="date" name="fdate"><label> To:</label><input type="date" name="tdate"></td>
										</tr>
										<tr>
											<td><label>Purpose of leave :</label></td> 
											<td><textarea cols="50" rows="3" name="purpose"></textarea></td>
										</tr>
										<tr>
											<td><label>Upload Proof:</label></td>
											<td><input type="file" name="scldoc"></td>
										</tr>
										<tr>
											<td><label>Contact during abscence</label></td>
											<td>
												Phone : <input type="number" name="absphone"> <br> <br>
												Address : <input type="text" name="absaddr">
											</td>
										</tr>
								</table>
								</fieldset>
								<fieldset>
									<legend>Substitution Details</legend>
								<table class="table table-hover">
									<thead style="font-size: 10px;">
										<tr>
											<td><b>Name & Designation of Faculty</b></td>
											<td><b>Date</b></td>
											<td><b>Contact</b></td>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td><input type="text" name="sname1"></td>
											<td><input type="date" name="sdate1"></td>
											<td><input type="number" name="snumber1"></td>
										</tr>
										<tr>
											<td><input type="text" name="sname2"></td>
											<td><input type="date" name="sdate2"></td>
											<td><input type="number" name="snumber2"></td>
										</tr>
										<tr>
											<td><input type="text" name="sname3"></td>
											<td><input type="date" name="sdate3"></td>
											<td><input type="number" name="snumber3"></td>
										</tr>
									</tbody>
								</table>
								</fieldset>
							</div>
							<div class="modal-footer bg-primary">
								<button type="submit" name="submit" class="btn btn-success">Apply Leave</button>
							</div>
							</form>
						</div>
					</div>
				</div>

				<div class="modal fade" id="rh-modal">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header bg-primary">
								<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
								<h4 class="modal-title" align="center">RESTRICTED HOLIDAY LEAVE APPLICATION</h4>
							</div>
							<div class="modal-body bg-warning">
								<form action="rhlform.php" method="POST" onsubmit="return confirm('Are you sure you want to apply fo this leave?')">
									<fieldset>
										<legend>Leave Information</legend>
								<table class="table table-responsive">
										<tr>
											<td><label>Period of Absence :</label></td>
											<td><label>From:</label><input type="date" name="fdate"><label> To:</label><input type="date" name="tdate">
												<div align="center">
											<h3><a class="label label-default" target="_blank" href="http://www.nitrr.ac.in/downloads/forms/admin/Holidays%20List%20Year%202018.PDF">List of Restricted Holidays</a></h3>
										</div>
											</td>
										</tr>
										<tr>
											<td><label>Purpose of leave :</label></td> 
											<td><textarea cols="50" rows="3" name="purpose"></textarea></td>
										</tr>
										<tr>
											<td><label>Head Quarter Leave required :</label></td>
											<td>
												<input type="radio" name="hql" value="yes">Yes <span class="col-lg-offset-3"></span>
												<input type="radio" name="hql" value="no">No
											</td>
										</tr>
										<tr>
											<td><label>Contact during abscence</label></td>
											<td>
												Phone : <input type="number" name="absphone"> <br> <br>
												Address : <input type="text" name="absaddr">
											</td>
										</tr>
								</table>
								</fieldset>
								<fieldset>
									<legend>Substitution Details</legend>
								<table class="table table-hover">
									<thead style="font-size: 10px;">
										<tr>
											<td><b>Name & Designation of Faculty</b></td>
											<td><b>Date</b></td>
											<td><b>Contact</b></td>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td><input type="text" name="sname1"></td>
											<td><input type="date" name="sdate1"></td>
											<td><input type="number" name="snumber1"></td>
										</tr>
										<tr>
											<td><input type="text" name="sname2"></td>
											<td><input type="date" name="sdate2"></td>
											<td><input type="number" name="snumber2"></td>
										</tr>
										<tr>
											<td><input type="text" name="sname3"></td>
											<td><input type="date" name="sdate3"></td>
											<td><input type="number" name="snumber3"></td>
										</tr>
										<tr>
											<td><input type="text" name="sname4"></td>
											<td><input type="date" name="sdate4"></td>
											<td><input type="number" name="snumber4"></td>
										</tr>
									</tbody>
								</table>
								</fieldset>
							</div>
							<div class="modal-footer bg-primary">
								<button type="submit" name="submit" class="btn btn-success">Apply Leave</button>
							</div>
							</form>
						</div>
					</div>
				</div>
				
				<div class="modal fade" id="ml-modal">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header bg-primary">
								<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
								<h4 class="modal-title">MEDICAL LEAVE</h4>
							</div>
							<div class="modal-body bg-warning">
							<form action="uml.php" method="POST" onsubmit="return confirm('Are you sure you want to apply fo this leave?')">
								<fieldset>
									<legend>UNFIT</legend>
									<table class="table table-condensed">
										<tr align="left">
											<td><label>From :</label></td>
											<td><input type="date" name="udate"></td>
										</tr>
										<tr>
											<td><label>Upload Unfit Document:</label></td>
											<td><input type="file" name="udoc"></td>
										</tr>
									</table>
									<span class="col-lg-offset-10"></span> <button type="submit" name="submit1" class="btn btn-primary">Apply Unfit</button>
								</fieldset>
							</form>
							<form action="fml.php" method="POST" onsubmit="return confirm('Are you sure you want to apply fo this leave?')">
							<fieldset>
								<legend>FIT</legend>
								<table class="table table-condensed">
										<tr align="left">
											<td><label>End Date :</label></td>
											<td><input type="date" name="fdate"></td>
										</tr>
										<tr>
											<td><label>Upload Fit Document:</label></td>
											<td><input type="file" name="fdoc"></td>
										</tr>
									</table>
									<span class="col-lg-offset-10"></span> <button type="submit" name="submit2" class="btn btn-primary">Apply Fit</button>
							</fieldset>	
							</form>	
							</div>
							<div class="modal-footer bg-primary" style="text-align: left;">
								<div class="well text-primary">
									For Application of Medical Leave
									<ul>
										<li>Please Apply Unfit on the first day of your illness</li>
										<li>After Recovery Please Apply Fit</li>
										<li>After completion Leaves are counted</li>
									</ul>
								</div>
							</div>
						</div>
					</div>
				</div>

				<div class="modal fade" id="el-modal">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header bg-primary">
								<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
								<h4 class="modal-title" align="center">EARNED LEAVE APPLICATION</h4>
							</div>
							<div class="modal-body bg-warning">
								<div class="well" align="center">
								<span class="text-info">Earned Leave Can only be applied 20 Days prior to the leave date</span>
								</div>
								<form action="elform.php" method="POST" onsubmit="return confirm('Are you sure you want to apply fo this leave?')">
									<fieldset>
										<legend>Leave Information</legend>
								<table class="table table-responsive">
										<tr>
											<td><label>Period of Absence:</label></td>
											<td><label>From:</label><input type="date" name="fdate"><label> To:</label><input type="date" name="tdate"></td>
										</tr>
										<tr>
											<td><label>Purpose of leave :</label></td> 
											<td><textarea cols="50" rows="3" name="purpose"></textarea></td>
										</tr>
										<tr>
											<td><label>Head Quarter Leave required :</label></td>
											<td>
												<input type="radio" name="hql" value="yes">Yes <span class="col-lg-offset-3"></span>
												<input type="radio" name="hql" value="no">No
											</td>
										</tr>
										<tr>
											<td><label>Contact during abscence</label></td>
											<td>
												Phone : <input type="number" name="absphone"> <br> <br>
												Address : <input type="text" name="absaddr">
											</td>
										</tr>
								</table>
								</fieldset>
								<fieldset>
									<legend>Substitution Details</legend>
								<table class="table table-hover">
									<thead style="font-size: 10px;">
										<tr>
											<td><b>Name & Designation of Faculty</b></td>
											<td><b>Date</b></td>
											<td><b>Contact</b></td>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td><input type="text" name="sname1"></td>
											<td><input type="date" name="sdate1"></td>
											<td><input type="number" name="snumber1"></td>
										</tr>
										<tr>
											<td><input type="text" name="sname2"></td>
											<td><input type="date" name="sdate2"></td>
											<td><input type="number" name="snumber2"></td>
										</tr>
										<tr>
											<td><input type="text" name="sname3"></td>
											<td><input type="date" name="sdate3"></td>
											<td><input type="number" name="snumber3"></td>
										</tr>
										<tr>
											<td><input type="text" name="sname4"></td>
											<td><input type="date" name="sdate4"></td>
											<td><input type="number" name="snumber4"></td>
										</tr>
									</tbody>
								</table>
								</fieldset>
							</div>
							<div class="modal-footer bg-primary">
								<button type="submit" name="submit" class="btn btn-success">Apply Leave</button>
							</div>
							</form>
						</div>
					</div>
				</div>

				<!-- Modals End -->
			</div>
		</div>
		<div class="col-lg-4" align="center">
		<div class="calendar-wrapper" style="border: 2px solid GREEN;">
  			<button id="btnPrev" type="button"><b><< Prev</b></button>
	  		<button id="btnNext" type="button"><b>Next >></b></button>
	    	<div id="divCal"></div>
			</div>
		</div>
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
</div> <!--Container-->
<script type="text/javascript" src="js/bootstrap.min.js"></script>
<script type="text/javascript" src="js/calendar.js"></script>

</div>
</div>
</body>
</html>