<?php
error_reporting(0);
include('db.php');

	$user_id=$_POST["ad_id"];
	
	$ad_mobile=$_POST["ad_mobile"];
	$ad_email=$_POST["ad_email"];
	$off_email=$_POST["off_email"];

	$ad_contact_p_1=$_POST["ad_contact_p_1"];
	$ad_mobile_num_1=$_POST["ad_mobile_num_1"];
	$ad_email_id_1=$_POST["ad_email_id_1"];
	$ad_contact_p_2=$_POST["ad_contact_p_2"];
	$ad_mobile_num_2=$_POST["ad_mobile_num_2"];
	$ad_email_id_2=$_POST["ad_email_id_2"];
	
	
		$sql = "UPDATE ad_admin set mobile_number='$ad_mobile',off_email='$off_email',
			contact_person_1='$ad_contact_p_1',mobile_number_1='$ad_mobile_num_1',
			email_id_1='$ad_email_id_1',contact_person_2='$ad_contact_p_2',
			mobile_number_2='$ad_mobile_num_2',email_id_2='$ad_email_id_2' WHERE id = '$user_id'";
		$result = mysql_query($sql) or die("Error in Selection Query <br> ".$sql."<br>". mysql_error());
		
			if($result){
			echo "Successfully Updated.";
			}else{
			echo "Something Went Wrong !!";
			}
			
		
//}
//echo "something";

?>
