<?php
error_reporting(0);
include('db.php');
/* include_once '../commonModel.php'; 
$commonModel  = new CommonModel();
 */
		
		$firstname=strtoupper($_POST['fname']);
		$email=$_POST["email"];
		$username= $_POST['username'];
		$c_pass=$_POST['password'];
		$password=md5($_POST['password']);
		//$clg_data=$_POST['clg_name'];
		//$f=strtoupper($_POST['usn']); 
		$mobile=$_POST['mobile'];
		$gender=$_POST['gender'];
		
		$i_data=$_POST['country']; //getting both value and name
		$state=$_POST['state'];
		$current_loc=$_POST['curr_loc'];
		$terms_cond=$_POST['term_con'];
		
		$country_value= explode(".",$i_data);// getting only name
		$i=$country_value[1];
		
		/* $clg_value= explode("|",$clg_data);// getting only name
		$clg_id=$clg_value[0];
		$e=$clg_value[1]; */
		
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
	{ 		$resume_number='EXP_RESUME_'.rand(111111,999999).'_';
			move_uploaded_file($file_tmps,"../resume_uploads/$resume_number".$file_names);
			//echo "Success ";
			
			$paths="resume_uploads/$resume_number".$file_names;
			//echo $paths;
			
								
			$table = 'stu_student';	
			//$random='123123';
			$random='EXP_REG_'.rand(1111111111,9999999999);
			
			
			$query ="insert into $table (c_pass,firstname,email,username,password,mobile,gender,country,state,current_loc,resume_name,terms_cond,random_num_gen,type) 
			values('$c_pass','$firstname','$email','$username','$password','$mobile','$gender','$i','$state','$current_loc','$paths','$terms_cond','$random','experience')";  

				//echo $Query;
						$result = mysql_query($query) or die("$email <br> \"Already Registered\"");
						
						if($result)
						{
							$LastInsertedRow = mysql_insert_id();
							$resume_sql="insert into stu_resume (fk_stu_id,resume_name,set_value) values('$LastInsertedRow','$paths','active')";
							$r = mysql_query($resume_sql) or die("Error On Resume upload");
							
							 $to =''.$email.'';
							   $subject = "uPLACE - Registered Successfully ";
							   $headers = "From: " . strip_tags('uplace_confirmation@uplace.in') . "\r\n";
							   //$headers .= 'CC:'.$cust_email2.''."\r\n";
							   //$headers .= 'BCC: santhosh1@brillmindz.com' . "\r\n";
							   $headers .= "Reply-To: ". strip_tags('contact@uplace.in') . "\r\n";
							   $headers .= "MIME-Version: 1.0\r\n";
							   $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
							   $message = '<html><body>
							   <h3>Dear '.$firstname.'</h3>
							  <p>Thank you for Registered in <a href="http:www.uplace.in">uPLACE</a>, <br> 
			                            Your Application Login details are given below, please login with the below credentials.
								   <br><br>
								   Application ID :<b>'.$random.'</b> <br><br>
									Email id : <b>'.$email.'</b><br>
									Password : <b>'.$c_pass.'</b>
								</p>			
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