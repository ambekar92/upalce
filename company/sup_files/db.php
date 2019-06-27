<?php
error_reporting(0);
session_start(); 


include('../common_db.php'); 
$connection=mysql_connect("$server_host_name","$server_username","$server_password") or DIE('connection failed');
mysql_select_db("$server_db_name") or DIE('Database name is not available!');


if (!isset($_SESSION['company_email'])) {
	echo "<script> window.location='logout.php';</script>";
}
else{
$email=$_SESSION['company_email'];

$table='ad_companies';
$whereCond="email='$email'";

$Query = "select * from ".$table." where email='".$email."'";
$Result = mysql_query($Query) or die("Error in Selection Query <br> ".$Query."<br>". mysql_error());
	while($row=mysql_fetch_array($Result)) 
	{
		  $ad_com_id= $row['id'];
		  $ad_com_profile_img= $row['profile_img'];
		  $ad_com_comp_id= $row['comp_id'];
		  $ad_com_comp_name= $row['comp_name'];
		  $ad_com_email= $row['email'];
		  $ad_com_password= $row['password'];
		  $ad_com_c_password= $row['c_password'];
		  $ad_com_indus_type= $row['indus_type'];

		  $ad_com_contact_person_1= $row['contact_person_1'];
		  $ad_com_designation_1= $row['designation_1'];
		  $ad_com_mobile_number_1= $row['mobile_number_1'];
		  $ad_com_email_1= $row['email_1'];

		  $ad_com_contact_person_2= $row['contact_person_2'];
		  $ad_com_designation_2= $row['designation_2'];
		  $ad_com_mobile_number_2= $row['mobile_number_2'];
		  $ad_com_email_2= $row['email_2'];

		  $ad_com_office_add= $row['office_add'];
		  $ad_com_country= $row['country'];
		  $ad_com_state= $row['state'];
		  $ad_com_current_location= $row['current_location'];
		  $ad_com_pinCode= $row['pinCode'];
		  
		  $ad_com_private_number= $row['private_number'];
		  $ad_com_gst_val= $row['gst_val'];
		  $ad_com_terms_cond= $row['terms_cond'];
		  $ad_com_terms_cond1= $row['terms_cond1'];
		  $ad_com_terms_cond2= $row['terms_cond2'];
		  $ad_com_reg_number= $row['reg_number'];
		  $ad_com_status= $row['status'];		
		  $ad_com_modified= $row['modified'];		
	} 

/*	$arrayName = array($ad_com_id,
						$ad_com_profile_img,
						$ad_com_comp_id,
						$ad_com_comp_name,
						$ad_com_email,
						$ad_com_password,
						$ad_com_c_password,
						$ad_com_indus_type,
						$ad_com_contact_person_1,
						$ad_com_designation_1,
						$ad_com_mobile_number_1,
						$ad_com_email_1,
						$ad_com_contact_person_2,
						$ad_com_designation_2,
						$ad_com_mobile_number_2,
						$ad_com_email_2,
						$ad_com_office_add,
						$ad_com_country,
						$ad_com_state,
						$ad_com_current_location,
						$ad_com_pinCode,
						$ad_com_private_number,
						$ad_com_gst_val,
						$ad_com_terms_cond,
						$ad_com_terms_cond1,
						$ad_com_terms_cond2,
						$ad_com_reg_number,
						$ad_com_status,
						$ad_com_modified
						 );		
						

	echo "<pre>"; 
	print_r($arrayName);
	die('asdasd');*/
}

?>
