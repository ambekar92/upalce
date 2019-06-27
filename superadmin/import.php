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
	         while (($emapData = fgetcsv($file, 10000, ",")) !== FALSE)
	         {
			//It wiil insert a row to our subject table from our csv file`
	           $sql = "INSERT into colleges(`college_name`, `college_code`) 
	            	values('$emapData[0]','$emapData[1]')";
	         //we are using mysql_query function. it returns a resource on true else False on error
	          $result = mysql_query($sql);
				/* if(! $result )
				{
					echo "Invalid File:Please Upload CSV File.";
				} */
			}
	         fclose($file);
	         //throws a message if data successfully imported to mysql database from excel file
	         echo "File Successfully Uploaded.";
 
		 }
		else{
			echo "Error !! Please Try Again Letter.";
		}
		 
}	 
else{
			echo "Error !! Please Try Again Letter.";
		}
?>