<?php
session_start();
$uid = $_SESSION['uid'];
$uname = $_SESSION['uname'];
if(isset($_POST['submit2']))
{
	$fdate = $_POST['fdate'];

	$file2 = $uid . " fdoc ". $_FILES['fdoc']['name'] ;
	$file_loc2 = $_FILES['fdoc']['tmp_name'];
	move_uploaded_file($file_loc2, "/uploads/ml/fml/".$file2);
	

	$con = mysqli_connect("localhost","root","","lms") ;
	$res = mysqli_query($con,"update ml set fdate = '$fdate' , fdoc = '$file2' where uid = '$uid';");
	if($res)
	{
		echo "<script>";
        echo "window.alert('Applied for Fit Medical Leave Sucessfully')";
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