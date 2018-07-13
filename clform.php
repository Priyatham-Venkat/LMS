<?php
session_start();
$uid = $_SESSION['uid'];
$uname = $_SESSION['uname'];
$dept = $_SESSION['dept'] ;
if(isset($_POST['submit']))
{
	$fdate = $_POST['fdate'];
	$tdate = $_POST['tdate'];
	$number = (strtotime($tdate) - strtotime($fdate))  / (60 * 60 * 24); 
	$purpose = $_POST['purpose'];
	$hql = $_POST['hql'];
	$absphone = $_POST['absphone'];
	$absaddr = $_POST['absaddr'];
	if($_POST['sname1'] != "") $c1 = $_POST['sname1'] ." on ". $_POST['sdate1'] ." contact :". $_POST['snumber1'] ;
	if($_POST['sname2'] != "") $c2 = $_POST['sname2'] ." on ". $_POST['sdate2'] ." contact :". $_POST['snumber2'] ;
	if($_POST['sname3'] != "") $c3 = $_POST['sname3'] ." on ". $_POST['sdate3'] ." contact :". $_POST['snumber3'] ;
	if($_POST['sname4'] != "") $c4 = $_POST['sname4'] ." on ". $_POST['sdate4'] ." contact :". $_POST['snumber4'] ;

	$con = mysqli_connect("localhost","root","","lms") ;
	$av = mysqli_query($con,"select * from al where uid='$uid';");
	$row = mysqli_fetch_array($av,MYSQLI_ASSOC);
	if($row['cl'] < (round($number) + 1) || (round($number) + 1) > 4)
	{
		echo "<script>";
		echo "window.alert('Unable')";
		echo "</script>";
        header("location: showdetails.php")	;
        return ;
	}
	$res = mysqli_query($con,"insert into cl(uid,uname,fdate,tdate,purpose,hql,absphone,absaddr,c1,c2,c3,c4,dept) values('$uid','$uname','$fdate','$tdate','$purpose','$hql','$absphone','$absaddr','$c1','$c2','$c3','$c4','$dept')");
	if($res)
	{
		echo "<script>";
        echo "window.alert('Applied for Casual Leave Sucessfully')";
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