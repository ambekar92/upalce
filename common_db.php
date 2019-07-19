<?php

error_reporting(0);
if ($_SERVER['HTTP_HOST'] == 'localhost:8088') {
$connection=mysql_connect("localhost","root","") or die('connection failed');
mysql_select_db("common_db") or die('Database name is not available!');
}
else{
$connection=mysql_connect("localhost","uplacein_admin","admin@123") or die('connection failed');
mysql_select_db("uplacein_common_db") or die('Database name is not available!');
}
	
$p_num = mysql_query("SELECT * FROM main_db") or die("Error in Selection Query <br> ".$Query."<br>". mysql_error());
while($row=mysql_fetch_array($p_num)) 
{
	$server_id=$row['id']; 
	$server_host_name=$row['host_name']; 
	$server_db_name=$row['db_name']; 
	$server_username=$row['username']; 
	$server_password=$row['password']; 
}


?>