<?php
error_reporting(0);
include('db.php');
/* include_once '../commonModel.php'; 
$commonModel  = new CommonModel();
 */
		$a=$_POST['fname'];
		$b=$_POST["email"];
		$c= $_POST['username'];
		$d=md5($_POST['password']);
		$e=$_POST['clg_name'];
		$f=$_POST['usn']; 
		$g=$_POST['mobile'];
		$h=$_POST['gender'];
		
		$i_data=$_POST['country']; //getting both value and name
		$j=$_POST['state'];
		$k=$_POST['curr_loc'];
		//$l=$_POST['resume_name'];
		$m=$_POST['term_con'];
		
		$country_value= explode(".",$i_data);// getting only name
		$i=$country_value[1];
		
		
	//echo $_POST['emaila'];	
//echo "$a,$b,$c,$d,$e,$f,$g,$h,$i,$j,$k,$l,$m"; 
	//echo $_FILES['resume_name']['name']."asd"; 
	
/* 		if(is_uploaded_file($_FILES['resume_name']['tmp_name'])) {
$sourcePath = $_FILES['resume_name']['tmp_name'];
$targetPath = "../resume_uploads/".$_FILES['resume_name']['name'];
move_uploaded_file($sourcePath,$targetPath);

echo $targetPath; die;

} */

if(isset($_FILES['resume_name'])){
			 
		$file_names = $_FILES['resume_name']['name'];
		$file_sizes =$_FILES['resume_name']['size'];
		$file_tmps =$_FILES['resume_name']['tmp_name'];
		$file_types=$_FILES['resume_name']['type'];   
		//echo $file_names;
		/* if($file_sizes > 3097152){
		$errors[]='File size must be excately 3 MB';
		}	 */			
	if($file_sizes < 3307152)
	{ 
			move_uploaded_file($file_tmps,"../resume_uploads/".$file_names);
			//echo "Success ";
			$paths="resume_uploads/".$file_names;
			//echo $paths;
			
								
			$table = 'stu_student';	
			$random='123123';
			$Query ="insert into $table (firstname,email,username,password,college_name,usn,mobile,gender,country,state,current_loc,resume_name,terms_cond,random_num_gen) 
			values('$a','$b','$c','$d','$e','$f','$g','$h','$i','$j','$k','$paths','$m','$random')";  

				//echo $Query;
						$Result = mysql_query($Query) or die("Error in Insertion Query <br>". mysql_error());
						
						if($Result)
						{
							$LastInsertedRow = mysql_insert_id();
							//	echo $LastInsertedRow;die;	
							///$status["LastInsertedRow"] = $LastInsertedRow;
							//echo json_encode($status);
							//echo "<script>window.location='../index.php';</script>";
							echo "Successfully Registered.. !!  You can login Now";
						}
						else {
							echo "Something went wrong, Please try again later.";
						}

	}//img size < 3MB
}// File Uploaded or not
else {
echo "Error Uploading Resume.";
}
		
	

?>