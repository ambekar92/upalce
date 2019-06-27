<?php
	
	//$conn=mysql_connect("fdb6.biz.nf","1448629_sjb","sjbit123456789");
	//mysql_select_db("1448629_sjb");
 include('sup_files/db.php');
	
if(isset($_FILES['resume_name']))
{	
 $filename=$_FILES["resume_name"]["tmp_name"];
 if($_FILES["resume_name"]["size"] > 0)
 {
	$file = fopen($filename, "r");
	$count = 0;
	 while (($emapData = fgetcsv($file, 10000, ",")) !== FALSE)
	 {
	   if ($count > 0)
 	   {
		$check_sql='SELECT * FROM `ad_placed_stu` WHERE stu_usn="'.$emapData[0].'" GROUP BY stu_usn HAVING ( COUNT(stu_usn) > 0 )'; 
		$chk_duplicate = mysql_query($check_sql);
		if(mysql_num_rows($chk_duplicate) > 0){
			$update_sql = 'UPDATE ad_placed_stu SET comp_1 = "'.$emapData[6].'", comp_2 = "'.$emapData[7].'", comp_3 = "'.$emapData[8].'" ,comp_4 = "'.$emapData[9].'", total_comp = '.$emapData[10].' WHERE stu_usn="'.$emapData[0].'"';
			$update_result = mysql_query($update_sql);
			$res_stat="Updated Successfully.";
		}else{
			//It wiil insert a row to our subject table from our csv file`
			$sql = "INSERT into ad_placed_stu(`ad_admin_id`, `stu_usn`, `stu_name`, `stu_mobile`, `email_id`, `stu_branch`, `stu_passing_year`, `comp_1`,`comp_2`, `comp_3`, `comp_4`, `total_comp`) values('$ad_id','$emapData[0]','$emapData[1]','$emapData[2]','$emapData[3]','$emapData[4]','$emapData[5]','$emapData[6]','$emapData[7]',
					'$emapData[8]','$emapData[9]','$emapData[10]')";
			//we are using mysql_query function. it returns a resource on true else False on error
			$result = mysql_query($sql);
			$res_stat="File Successfully Uploaded.";
		}	
		}		
	  $count++;				
	}
	 fclose($file);
	 //throws a message if data successfully imported to mysql database from excel file
	 echo $res_stat;

 }
else{
	echo "Error !! Please Try Again Letter.";
}
		 
}	 
else{
			echo "Error !! Please Try Again Letter.";
		}
?>