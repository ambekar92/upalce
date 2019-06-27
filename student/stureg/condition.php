<?php
error_reporting(0);
include('db.php');


function begin(){
    mysql_query("BEGIN");
}

function commit(){
    mysql_query("COMMIT");
}

function rollback(){
    mysql_query("ROLLBACK");
}

if(isset($_POST["set_default_a"]))
{
//echo $_POST["status"];
//echo $_POST["record_id"];
//echo $_POST["stu_id"];
//echo $_POST["res_name"];


	$v1_value=$_POST["status"];
	$v2_id=$_POST["record_id"];
	$v3_res_name=$_POST["res_name"];
	$stu_id=$_POST["stu_id"];
	
		$sql_a = "UPDATE stu_resume set set_value='inactive' WHERE fk_stu_id = $stu_id";
		$sql_b = "UPDATE stu_resume set set_value='active' WHERE id = $v2_id and fk_stu_id = '$stu_id'";
		$sql_c = "UPDATE stu_student set resume_name='$v3_res_name' WHERE id = $stu_id";
		
		//$sql = "insert into stu_resume (fk_stu_id,resume_name,set_value) values('$stu_id','$paths','inactive')";
		
		begin();
		$result_a = mysql_query($sql_a);
		$result_b = mysql_query($sql_b);
		$result_c = mysql_query($sql_c);
		
		if(!$result_a && !$result_b && !$result_c){
			rollback();
			echo "Error";	
			exit;
		}else{
			 commit();
			echo "Successfully Updated";		
		}	
}



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
	$old_pass=md5($_POST["user_pass"]);
	$user_id=$_POST["user_id"];
	$sql = "SELECT password FROM stu_student WHERE password = '$old_pass' and id= '$user_id'";
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


if(isset($_POST["details"]))
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


if(isset($_FILES['profile']))
{
	$user_id=$_POST["user_id"];
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
				$sql = "UPDATE stu_student set profile_img='$paths' WHERE id = '$user_id'";
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
	$old_pass=md5($_POST['old_pass']);
	$new_pass=md5($_POST['new_pass']);
	$user_id=$_POST["user_id"];
	
$table='stu_student';
$whereCond="id='$user_id'";
$Query = 'select * from '.$table.' where '.$whereCond;
$Result = mysql_query($Query) or die("Error in Selection Query <br> ".$Query."<br>". mysql_error());
while($row=mysql_fetch_array($Result)) 
{
	$old_pass_db=$row['password']; 
}
	if($old_pass == $old_pass_db)
	{
		$sql = "UPDATE stu_student set password='$new_pass' WHERE id = '$user_id'";
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