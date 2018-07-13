<?php
session_start();
$uid = $_SESSION['uid'];
$uname = $_SESSION['uname'];
$dept = $_SESSION['dept'] ;
if(isset($_POST['submit']))
{
	$fdate = $_POST['fdate'];
	$tdate = $_POST['tdate'];
	$purpose = $_POST['purpose'];

	$file = $uid . " scl ". $_FILES['scldoc']['name'] ;
	$file_loc = $_FILES['scldoc']['tmp_name'];
	move_uploaded_file($file_loc, "uploads/scl/".$file);

	$absphone = $_POST['absphone'];
	$absaddr = $_POST['absaddr'];
	if($_POST['sname1'] != "") $c1 = $_POST['sname1'] ." on ". $_POST['sdate1'] ." contact :". $_POST['snumber1'] ;
	if($_POST['sname2'] != "") $c2 = $_POST['sname2'] ." on ". $_POST['sdate2'] ." contact :". $_POST['snumber2'] ;
	if($_POST['sname3'] != "") $c3 = $_POST['sname3'] ." on ". $_POST['sdate3'] ." contact :". $_POST['snumber3'] ;
	if($_POST['sname4'] != "") $c4 = $_POST['sname4'] ." on ". $_POST['sdate4'] ." contact :". $_POST['snumber4'] ;

	$con = mysqli_connect("localhost","root","","lms") ;
	$res = mysqli_query($con,"insert into scl (uid,uname,fdate,tdate,purpose,file,absphone,absaddr,c1,c2,c3,c4,dept) values('$uid','$uname','$fdate','$tdate','$purpose','$file','$absphone','$absaddr','$c1','$c2','$c3','$c4','$dept')");
	if($res)
	{
		echo "<script>";
        echo "window.alert('Applied for Special Casual Leave Sucessfully')";
        echo "</script>" ;
        header("location: checkstatus.php")	;
	}
	else
	{
		echo "<script>";
        echo "window.alert('Couldn't Apply the Leave, please contact Administrator')";
        echo "</script>" ;
        header("location: showdetails.php");
	}

}
?>