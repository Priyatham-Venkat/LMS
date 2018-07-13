<?php
session_start();
$uid = $_SESSION['uid'];
$uname = $_SESSION['uname'];
$dept = $_SESSION['dept'] ;
if(isset($_POST['submit1']))
{
	$udate = $_POST['udate'];

	$file1 = $uid . " udoc ". $_FILES['udoc']['name'] ;
	$file_loc1 = $_FILES['udoc']['tmp_name'];
	move_uploaded_file($file_loc1, "/uploads/ml/uml/".$file1);
	

	$con = mysqli_connect("localhost","root","","lms") ;
	$res = mysqli_query($con,"insert into ml (uid,uname,udate,udoc,dept) values('$uid','$uname','$udate','$file1','$dept')");
	// $rtr = mysqli_query($con,"select appno from ml where uid = '$uid' and udate = '$udate';");

	// $row = mysqli_fetch_array($rtr,MYSQLI_ASSOC);

	// $_SESSION['mlno'] = $row['appno'];

	if($res)
	{
		echo "<script>";
        echo "window.alert('Applied for Unfit Medical Leave Sucessfully')";
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