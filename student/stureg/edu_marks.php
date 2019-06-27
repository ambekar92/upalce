<?php
error_reporting(0);
include('db.php');


//password change 
if(isset($_POST['class']))
{
	$class = $_POST['class'];
	$end_year = $_POST['end_year'];
	$college_name = $_POST['college_name'];
	$university = $_POST['university'];
	$secured = $_POST['secured'];
	
	
	$user_id = $_POST['user_id'];
	
	if($secured !='')
	{		
		//mysql_query("update STU_STUDENT set cover_letter='$cover' where id='$user_id'") or die("error !!");	
		//$table = STU_SKILLS;	
		$Query ="insert into $table (fk_stu_id,class,end_year,college_name,university,secured) 
		values('$user_id','$class','$end_year','$college_name','$university','$secured')";  
	
		mysql_query($Query) or die("Error in Insertion Query <br> ".$Query."<br>". mysql_error());
		echo "Successfully Updated.";
	}
	else
	{
		//echo "<p style=color:red;font-size:16px;>Enter valid Old Password !!</p>";
		echo "Enter valid Old Password !!";
	}
	
	
	exit();

}

?>