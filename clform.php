<?php
session_start();
$uid = $_SESSION['uid'];
$uname = $_SESSION['uname'];
if(isset($_POST['submit']))
{
	$fdate = $_POST['fdate'];
	$tdate = $_POST['tdate'];
	$purpose = $_POST['purpose'];
	$hql = $_POST['hql'];
	$absphone = $_POST['absphone'];
	$absaddr = $_POST['absaddr'];
	$c1 = $_POST['sname1'] ." on ". $_POST['sdate1'] ." contact :". $_POST['snumber1'] ;
	$c2 = $_POST['sname2'] ." on ". $_POST['sdate2'] ." contact :". $_POST['snumber2'] ;
	$c3 = $_POST['sname3'] ." on ". $_POST['sdate3'] ." contact :". $_POST['snumber3'] ;
	$c4 = $_POST['sname4'] ." on ". $_POST['sdate4'] ." contact :". $_POST['snumber4'] ;

	$con = mysqli_connect("localhost","root","","lms") ;
	$res = mysqli_query($con,"insert into cl (uid,uname,fdate,tdate,purpose,hql,absphone,absaddr,c1,c2,c3,c4) values('$uid','$uname','$fdate','$tdate','$purpose','$hql','$absphone','$absaddr','$c1','$c2','$c3','$c4')");
	if($res)
	{
		header("location:alert.php")
	}
	else
	{
		die('Unable to submit');
	}
	header("location:/showdetails.php");

}
?>