<?php
error_reporting(0);
session_start(); 



include('../common_db.php'); 
$connection=mysql_connect("$server_host_name","$server_username","$server_password") or DIE('connection failed');
mysql_select_db("$server_db_name") or DIE('Database name is not available!');



if (!isset($_SESSION['email'])) {
	echo "<script> window.location='logout.php';</script>";
}

$email=$_SESSION['email'];

	$table='stu_student';
	$whereCond="email='$email'";
	//$whereCond='id=1';	
$Query = 'select * from '.$table.' where '.$whereCond;
$Result = mysql_query($Query) or die("Error in Selection Query <br> ".$Query."<br>". mysql_error());
while($row=mysql_fetch_array($Result)) 
	{
		$stu_id=$row['id']; 
		$stu_firstname=$row['firstname']; 
		$stu_profile_img=$row['profile_img']; 
		$stu_email=$row['email']; 
		$stu_password=$row['password']; 
		$stu_college_name=$row['college_name']; 
		$stu_college_id=$row['college_id']; 
		$stu_usn=$row['usn']; 
		$stu_mobile=$row['mobile']; 
		$stu_gender=$row['gender']; 
		$stu_country=$row['country']; 
		$stu_state=$row['state']; 
		$stu_current_loc=$row['current_loc']; 
		$stu_resume_name=$row['resume_name']; 
		$stu_terms_cond=$row['terms_cond']; 
		$stu_profile_summary=$row['profile_summary']; 
		$stu_cover_letter=$row['cover_letter']; 
		$stu_random_num_gen=$row['random_num_gen']; 
		$stu_modified=$row['modified']; 
		$stu_status=$row['status']; 
		$type=$row['type'];
		
		$dob=$row['dob'];	
		$father_name=$row['father_name'];	
		$mother_name=$row['mother_name'];	
		$address=$row['address'];	
		$alternate_mobile=$row['alternate_mobile'];	
		$project_link_status=$row['project_link_status'];	
	
	} 
//echo $id;die;
?>

