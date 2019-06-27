<?php
error_reporting(0);
include('db.php');

if(isset($_POST["country_id"]))
{
	$country_id=$_POST["country_id"];
	$sql = "SELECT * FROM states WHERE country_id  = '$country_id'";
	//echo $sql;
	$states = mysql_query($sql) or die("Error in Selection Query <br> ".$sql."<br>". mysql_error());
	//$num_rows = mysql_num_rows($result);
 //echo $select;
 
		while($row=mysql_fetch_array($states)){ 
			echo '<option value="'.$row['state_name'].'">'.$row['state_name'].'</option>';
		}
	
}

//--------------------------------------------------------------------------------------------------------------------------------

if(isset($_POST["user_email"]))
{
	$email=$_POST["user_email"];
	$sql = "SELECT email FROM ad_admin WHERE email = '$email'";
	//echo $sql;
	$result = mysql_query($sql) or die("Error in Selection Query <br> ".$sql."<br>". mysql_error());
	$num_rows = mysql_num_rows($result);
 //echo $select;
 
	if ($num_rows) {
		echo "<p style=color:red;> The email already exists. </p>";
	}
	else
	{
	echo "<p style=color:green;> sucess </p>";
	}
	exit();
}
//--------------------------------------------------------------------------------------------------------------------------------

/* if(isset($_POST["private_number"]))
{
	$private_number=$_POST["private_number"];
	$sql = "SELECT private_number FROM su_active_clgs WHERE private_number = '$private_number'";
	//echo $sql;
	$result = mysql_query($sql) or die("Error in Selection Query <br> ".$sql."<br>". mysql_error());
	$num_rows = mysql_num_rows($result);
 //echo $select;
 
	if ($num_rows) {
		echo "<p style=color:green;> Private Number Sucess </p>";
	}
	else
	{
	echo "<p style=color:red;> Error in Private Number </p>";
	}
	exit();
} */


//--------------------------------------------------------------------------------------------------------------------------------

if(isset($_POST["user_pass"]))
{
	$old_pass=md5($_POST["user_pass"]);
	$user_id=$_POST["ad_id"];
	$sql = "SELECT password FROM ad_admin WHERE password = '$old_pass' and id= '$user_id'";
	//echo $sql;
	$result = mysql_query($sql) or die("Error in Selection Query <br> ".$sql."<br>". mysql_error());
	$num_rows = mysql_num_rows($result);
 //echo $num_rows.",";
 
	if($num_rows) {
		//echo "<img src=images/confirm.png>";
		echo "0";
	}
	else
	{
	//echo "<img src=images/delete.png>";
		echo "1";
	}
	exit();
}

//--------------------------------------------------------------------------------------------------------------------------------


/* if(isset($_POST["details"]))
{
 	$user_id=$_POST["user_id"];
	$sql = "SELECT * FROM stu_student WHERE id = '$user_id'";
	//echo $sql;
	$result = mysql_query($sql) or die("Error in Selection Query <br> ".$sql."<br>". mysql_error());
	//$num_rows = mysql_num_rows($result);
    //echo $select; 
	$rows = array();
	   while($r = mysql_fetch_assoc($result)) {
		 $rows[] = $r;
	   }
print json_encode($rows);
exit();
//echo $_POST["user_id"];
}
 */
//--------------------------------------------------------------------------------------------------------------------------------


if(isset($_FILES['profile']))
{
	$user_id=$_POST["ad_id"];
	$img_name=$_POST["pro_img"];

		$file_names = $_FILES['profile']['name'];
		$file_sizes =$_FILES['profile']['size'];
		$file_tmps =$_FILES['profile']['tmp_name'];
		$file_types=$_FILES['profile']['type'];   
		//echo $file_names;

	$imgExt = strtolower(pathinfo($file_names,PATHINFO_EXTENSION)); // get image extension
			$valid_extensions = array('jpg', 'png'); // valid extensions

		if(in_array($imgExt, $valid_extensions))
		{	
				unlink("../$img_name");
		 
			if(move_uploaded_file($file_tmps,"../profile_img/$user_id-".$file_names)) 
			{
				$paths="profile_img/$user_id-".$file_names;
				$sql = "UPDATE ad_admin set profile_img='$paths' WHERE id = '$user_id'";
				$result = mysql_query($sql) or die("Error in Selection Query <br> ".$sql."<br>". mysql_error());
				echo "Image Updated Sucessfully.";
			}
			else{
			echo "Error in uploading file";
			}
		}
		else
		{
			echo "File Extension Not Valid.";
		}

}

//--------------------------------------------------------------------------------------------------------------------------------
//password change 
if(isset($_POST['old_pass']))
{
	$old_pass=md5($_POST['old_pass']);
	$new_pass=md5($_POST['new_pass']);
	$user_id=$_POST["ad_id"];
	
$table='ad_admin';
$whereCond="id='$user_id'";
$Query = 'select * from '.$table.' where '.$whereCond;
$Result = mysql_query($Query) or die("Error in Selection Query <br> ".$Query."<br>". mysql_error());
while($row=mysql_fetch_array($Result)) 
{
	$old_pass_db=$row['password']; 
}
	if($old_pass == $old_pass_db)
	{
		$sql = "UPDATE ad_admin set password='$new_pass' WHERE id = '$user_id'";
		$result = mysql_query($sql) or die("Error in Selection Query <br> ".$sql."<br>". mysql_error());
		//echo "<p style=color:green;font-size:20px;>Password Updated Sucessfully.</p>";
		echo "Password Updated Sucessfully.";
		
	}
	else
	{
		//echo "<p style=color:red;font-size:16px;>Enter valid Old Password !!</p>";
		echo "Enter valid Old Password !!";
	}
	exit();
}

//Update stu_student status UPDATE as active to inactive 
if(isset($_GET['active']))
{//echo "data";
	$stu_id=$_GET["data_id"];
	
		if($stu_id != '')
		{
		 $skill_del="update stu_student set status='active' where id='$stu_id'";
		 mysql_query($skill_del) or die(mysql_error());
		 echo "Record Activate Successfully";
		}
	exit();
}

if(isset($_GET['inactive']))
{// echo "data";
	$stu_id=$_GET["data_id"];
	
		if($stu_id != '')
		{
		 $skill_del="update stu_student set status='inactive' where id='$stu_id'";
		 mysql_query($skill_del) or die(mysql_error());
		 echo "Record Deactivate Successfully";
		}
	exit();
}


//Update stu_student Vedio Links active and inactive 
if(isset($_GET['active_link']))
{//echo "data";
	$stu_id=$_GET["data_id"];
	
		if($stu_id != '')
		{
		 $link_a="update stu_student set project_link_status='A' where id='$stu_id'";
		 mysql_query($link_a) or die(mysql_error());
		 echo "<p style='color:green'>Permission Granted !!</p>";
		}
	exit();
}

if(isset($_GET['inactive_link']))
{// echo "data";
	$stu_id=$_GET["data_id"];
	
		if($stu_id != '')
		{
		 $link_d="update stu_student set project_link_status='D' where id='$stu_id'";
		 mysql_query($link_d) or die(mysql_error());
		 echo "<p style='color:red'> Permission Denied !!</p>";
		}
	exit();
}

?>