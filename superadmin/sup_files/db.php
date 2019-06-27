<?php
error_reporting(0);
session_start(); 


include('../common_db.php'); 
$connection=mysql_connect("$server_host_name","$server_username","$server_password") or DIE('connection failed');
mysql_select_db("$server_db_name") or DIE('Database name is not available!');



if (!isset($_SESSION['super_email'])) {
	echo "<script> window.location='logout.php';</script>";
}
else{
$email=$_SESSION['super_email'];

	$table='su_admin';
	$whereCond="email='$email'";
	//$whereCond='id=1';	
$Query = 'select * from '.$table.' where '.$whereCond;
$Result = mysql_query($Query) or die("Error in Selection Query <br> ".$Query."<br>". mysql_error());
while($row=mysql_fetch_array($Result)) 
	{
		$su_id=$row['id']; 
		$su_profile_img=$row['profile_img']; 
		$su_email=$row['email']; 
		$su_mobile=$row['mobile']; 
		$su_username=$row['username']; 
		
	} 
}
//echo $id;die;
?>
