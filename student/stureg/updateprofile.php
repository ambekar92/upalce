<?php
error_reporting(0);
include('db.php');
	
if(isset($_GET['user_id']))
{
	$user_id=$_GET["user_id"];
	
	$stu_name=$_GET["stu_name"];
	//$stu_email=$_GET["stu_email"];
	$stu_mobile=$_GET["stu_mobile"];
	//$stu_college_name=$_GET["stu_college_name"];
	$stu_usn=$_GET["stu_usn"];
	//$stu_gender=$_GET["stu_gender"];
	//$stu_country=$_GET["stu_country"];
	//$stu_state=$_GET["stu_state"];
	$stu_current_loc=$_GET["stu_current_loc"];
	
	$dob=$_GET["dob"];
	$father_name=$_GET["father_name"];
	$mother_name=$_GET["mother_name"];
	$address=$_GET["address"];
	$alternate_mobile=$_GET["alternate_mobile"];
	
		$sql = "UPDATE stu_student set firstname='$stu_name',usn='$stu_usn',mobile='$stu_mobile',current_loc='$stu_current_loc',
		dob='$dob',father_name='$father_name',mother_name='$mother_name',address='$address',alternate_mobile='$alternate_mobile' WHERE id = '$user_id'";
		$result = mysql_query($sql) or die("Error in Selection Query <br> ".$sql."<br>". mysql_error());
		echo "Successfully Updated.";
		
		
}

?>
