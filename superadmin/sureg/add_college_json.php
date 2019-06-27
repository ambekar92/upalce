<?php
error_reporting(0);
include('db.php');
$table='colleges';
/* $whereCond="fk_stu_id='$stu_id'";	 */
$Query = 'select * from '.$table;
$skill_data = mysql_query($Query) or die("Error in Selection Query <br> ".$Query."<br>". mysql_error());



/* while ($row=mysql_fetch_array($srch_data)) 
{
	$row["id"];
}	 */
	while($row=mysql_fetch_array($skill_data)){ 
			$id=$row['id'];
			$college_name=$row['college_name'];	
			$final[]=array($id,$id,$college_name);
		}
				
				//$final=array($id,$college_name);
				$status["data"] = array_values($final);
			
				echo json_encode($status);
				
?>
