<?php
error_reporting(0);
include('db.php');

if(isset($_POST['activate']))
{
	$status = $_POST['activate'];
	$data_id = $_POST['data_id'];
//echo $data_id;
	if($status !='')
	{		
		mysql_query("update data_for_comp set status='$status', duration='15' where id='$data_id'") or die("error !!");	
		echo "Activate Successfully";
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
	$data_id = $_POST['data_id'];
//echo $data_id;
	if($status !='')
	{		
		mysql_query("update data_for_comp set status='$status',duration='0' where id='$data_id'") or die("error !!");	
		echo "Deactivate Successfully";
	}
	else
	{
		echo "<p style=color:red;>Please try after some time !!</p>";
	}
	
	exit();

}

?>