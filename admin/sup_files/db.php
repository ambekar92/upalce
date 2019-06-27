<?php
error_reporting(0);
session_start(); 


include('../common_db.php'); 
$connection=mysql_connect("$server_host_name","$server_username","$server_password") or DIE('connection failed');
mysql_select_db("$server_db_name") or DIE('Database name is not available!');


if (!isset($_SESSION['admin_email'])) {
	echo "<script> window.location='logout.php';</script>";
}
else{
$email=$_SESSION['admin_email'];

$table='ad_admin';
$whereCond="email='$email'";
//$whereCond='id=1';	
$Query = 'select * from '.$table.' where '.$whereCond;
$Result = mysql_query($Query) or die("Error in Selection Query <br> ".$Query."<br>". mysql_error());
	while($row=mysql_fetch_array($Result)) 
	{
		$ad_id=$row['id']; 
		$ad_private_number=$row['private_number']; 
		$ad_profile_img=$row['profile_img']; 
		$ad_email=$row['email']; 
		$off_email=$row['off_email']; 
		$ad_password=$row['password']; 
		$ad_clg_name=$row['clg_name']; 
		$ad_mobile=$row['mobile_number']; 
		$ad_country=$row['country']; 
		$ad_state=$row['state']; 
		$ad_current_loc=$row['current_location'];
		$ad_clg_id=$row['clg_id'];
		
		$ad_contact_p_1=$row['contact_person_1'];
		$ad_mobile_num_1=$row['mobile_number_1'];
		$ad_email_id_1=$row['email_id_1'];
		$ad_contact_p_2=$row['contact_person_2'];
		$ad_mobile_num_2=$row['mobile_number_2'];
		$ad_email_id_2=$row['email_id_2'];
		
	} 
}
//echo $id;die;
?>
