<?php
error_reporting(0);
include('db.php');
/* include_once '../commonModel.php'; 
$commonModel  = new CommonModel();
 */
		$a=strtoupper($_POST['fname']);
		$b=$_POST["email"];
		$c= $_POST['username'];
		$c_pass=$_POST['password'];
		$d=md5($_POST['password']);
		$clg_data=$_POST['clg_name'];
		$f=strtoupper($_POST['usn']); 
		$g=$_POST['mobile'];
		$h=$_POST['gender'];
		
		$i_data=$_POST['country']; //getting both value and name
		$j=$_POST['state'];
		$k=$_POST['curr_loc'];
		//$l=$_POST['resume_name'];
		$m=$_POST['term_con'];
		
		$country_value= explode(".",$i_data);// getting only name
		$i=$country_value[1];
		
	$clg_value= explode("|",$clg_data);// getting only name
		$clg_id=$clg_value[0];
		$e=$clg_value[1];
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
	{ 		$resume_number='STU_RESUME_'.rand(111111,999999).'_';
			move_uploaded_file($file_tmps,"../resume_uploads/$resume_number".$file_names);
			//echo "Success ";
			
			$paths="resume_uploads/$resume_number".$file_names;
			//echo $paths;
			
								
			$table = 'stu_student';	
			//$random='123123';
			$random='STU_REG_'.rand(1111111111,9999999999);
			
			
			$query ="insert into $table (c_pass,firstname,email,username,password,college_id,college_name,usn,mobile,gender,country,state,current_loc,resume_name,terms_cond,random_num_gen,type) 
			values('$c_pass','$a','$b','$c','$d','$clg_id','$e','$f','$g','$h','$i','$j','$k','$paths','$m','$random','student')";  

				//echo $Query;
						$result = mysql_query($query) or die("$b <br> \"Already Registered\"");
						
						if($result)
						{
							$LastInsertedRow = mysql_insert_id();
							$resume_sql="insert into stu_resume (fk_stu_id,resume_name,set_value) values('$LastInsertedRow','$paths','active')";
							$r = mysql_query($resume_sql) or die("Error On Resume upload");
							
							
							   $to =''.$b.'';
							   $subject = "uPLACE - Registered Successfully ";
							   $headers = "From: " . strip_tags('uplace_confirmation@uplace.in') . "\r\n";
							   //$headers .= 'CC:'.$cust_email2.''."\r\n";
							   //$headers .= 'BCC: santhosh1@brillmindz.com' . "\r\n";
							   $headers .= "Reply-To: ". strip_tags('contact@uplace.in') . "\r\n";
							   $headers .= "MIME-Version: 1.0\r\n";
							   $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
							   $message = '<html><body>
							   <h3>Dear '.$a.'</h3>
							   <h4>Welcome to <a href="http://www.uplace.in">uPLACE</a>, <br> 
							   Your Application Login details are given below, please login with the below credentials.</h4>
							    <h4>
									Email id : '.$b.'<br><br>
									Password : '.$c_pass.'
								</h4>			
							   </body></html>';
							  
								
							   if(mail($to, $subject, $message, $headers))
							   {
								  echo "Successfully Registered.. !!  You can login Now";
							   }
							
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