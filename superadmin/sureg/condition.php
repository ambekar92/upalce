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



if(isset($_POST["user_email"]))
{
	$email=$_POST["user_email"];
	$sql = "SELECT email FROM stu_student WHERE email = '$email'";
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

if(isset($_POST["user_pass"]))
{
	$old_pass=$_POST["user_pass"];
	$su_id=$_POST["su_id"];
	$sql = "SELECT password FROM su_admin WHERE password = '$old_pass' and id= '$su_id'";
	//echo $sql;
	$result = mysql_query($sql) or die("Error in Selection Query <br> ".$sql."<br>". mysql_error());
	$num_rows = mysql_num_rows($result);
 //echo $select;
 
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

if(isset($_FILES['profile']))
{
	$su_id=$_POST["su_id"];
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
		 
			if(move_uploaded_file($file_tmps,"../profile_img/$su_id-".$file_names)) 
			{
				$paths="profile_img/$su_id-".$file_names;
				$sql = "UPDATE su_admin set profile_img='$paths' WHERE id = '$su_id'";
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

//password change 
if(isset($_POST['old_pass']))
{
	$old_pass=$_POST['old_pass'];
	$new_pass=$_POST['new_pass'];
	$su_id=$_POST["su_id"];
	
$table='su_admin';
$whereCond="id='$su_id'";
$Query = 'select * from '.$table.' where '.$whereCond;
$Result = mysql_query($Query) or die("Error in Selection Query <br> ".$Query."<br>". mysql_error());
while($row=mysql_fetch_array($Result)) 
{
	$old_pass_db=$row['password']; 
}
	if($old_pass == $old_pass_db)
	{
		$sql = "UPDATE su_admin set password='$new_pass' WHERE id = '$su_id'";
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

?>