<?php
error_reporting(0);
include('db.php');

	$su_id=$_POST["su_id"];
	
	$su_name=$_POST["su_name"];
	$su_email=$_POST["su_email"];
	$su_mobile=$_POST["su_mobile"];

		$sql = "UPDATE su_admin set username='$su_name',email='$su_email',mobile='$su_mobile' WHERE id = '$su_id'";
		$result = mysql_query($sql) or die("Error in Selection Query <br> ".$sql."<br>". mysql_error());
		echo "Successfully Updated.";
	
?>
