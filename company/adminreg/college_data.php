<?php
error_reporting(0);
include('db.php');
	
	
//	$country_id=$_POST["country_id"];
	$sql = "SELECT * FROM su_active_clgs order by modified DESC";
	//echo $sql;
	$states = mysql_query($sql) or die("Error in Selection Query <br> ".$sql."<br>". mysql_error());
 
		while($row=mysql_fetch_array($states)){ 
			echo '<option value="'.$row['college_id'].'">'.$row['college_name'].'</option>';
		}
	
		?>