<?php
error_reporting(0);
include('db.php');

if(isset($_POST['activate']))
{
	$status = $_POST['activate'];
	$clg_id = $_POST['college_id'];
//echo $clg_id;
	if($status !='')
	{		
		mysql_query("update su_active_clgs set status='$status' where id='$clg_id'") or die("error !!");	
		echo "College Activate Successfully";
	}
	else
	{
		//echo "<p style=color:red;font-size:16px;>Enter valid Old Password !!</p>";
		echo "<p style=color:red;>Please try after some time !!</p>";
	}
	
	exit();

}

if(isset($_POST['inactive']))
{
	$status = $_POST['inactive'];
	$clg_id = $_POST['college_id'];
//echo $clg_id;
	if($status !='')
	{		
		mysql_query("update su_active_clgs set status='$status' where id='$clg_id'") or die("error !!");	
		echo "College Deactivate Successfully";
	}
	else
	{
		echo "<p style=color:red;>Please try after some time !!</p>";
	}
	
	exit();

}



if(isset($_POST['comp_activate']))
{
	$status = $_POST['comp_activate'];
	$clg_id = $_POST['company_id'];
//echo $clg_id;
	if($status !='')
	{		
		mysql_query("update su_active_companies set status='$status' where id='$clg_id'") or die("error !!");	
		echo "Company Activate Successfully";
	}
	else
	{
		//echo "<p style=color:red;font-size:16px;>Enter valid Old Password !!</p>";
		echo "<p style=color:red;>Please try after some time !!</p>";
	}
	
	exit();

}

if(isset($_POST['comp_inactive']))
{
	$status = $_POST['comp_inactive'];
	$clg_id = $_POST['company_id'];
//echo $clg_id;
	if($status !='')
	{		
		mysql_query("update su_active_companies set status='$status' where id='$clg_id'") or die("error !!");	
		echo "Company Deactivate Successfully";
	}
	else
	{
		echo "<p style=color:red;>Please try after some time !!</p>";
	}
	
	exit();

}

?>