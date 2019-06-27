<?php
error_reporting(0);
include('db.php');
		$private_number=$_POST['private_number'];
		$clg_name_data=$_POST["clg_name"];
		$email= $_POST['email'];
		$off_email= $_POST['off_email'];
		$password=md5($_POST['password']);
		$c_pass=$_POST['password'];
		$mobile_number=$_POST['mobile_number'];
		$i_data=$_POST['country']; //getting both value and name
		
		$state=$_POST['state'];
		$current_location=$_POST['current_location'];
		$term_con=$_POST['term_con'];
		
		$country_value= explode(".",$i_data);// getting only name
		$country=$country_value[1];
		
		$clg_name_value= explode("|",$clg_name_data);// getting only name
		$clg_id=$clg_name_value[0];
		$clg_name=$clg_name_value[1];
		
		$reg_number='ADMIN_REG_'.rand(1111111111,9999999999);
			
		//echo "$clg_id";
		$p_num = mysql_query("SELECT * FROM su_active_clgs WHERE college_id='$clg_id'") or die("Error in Selection Query <br> ".$query."<br>". mysql_error());
		while($row=mysql_fetch_array($p_num)) 
		{
			$private_number_su=$row['private_number']; 
			$status=$row['status']; 
		}
			//echo $private_number_su; 
		
		if($private_number_su==$private_number)
		{
			/* if($status=='active')
			{ */
				$table = 'ad_admin';
				$query ="insert into $table (reg_number,off_email,private_number,clg_id,clg_name,email,password,mobile_number,country,state,current_location,terms_cond) 
				values('$reg_number','$off_email','$private_number','$clg_id','$clg_name','$email','$password','$mobile_number','$country','$state','$current_location','$term_con')"; 
				$Result = mysql_query($query) or die("$clg_name -- \"Already Registered\"");
							
							if($Result)
							{
							   $to =''.$email.'';
							   $subject = "uPLACE - Registered Successfully ";
							   $headers = "From: " . strip_tags('uplace_confirmation@uplace.in') . "\r\n";
							   //$headers .= 'CC:'.$cust_email2.''."\r\n";
							   //$headers .= 'BCC: santhosh1@brillmindz.com' . "\r\n";
							   $headers .= "Reply-To: ". strip_tags('contact@uplace.in') . "\r\n";
							   $headers .= "MIME-Version: 1.0\r\n";
							   $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
							   $message = '<html><body>
							   <h3>Dear Admin <br>'.$clg_name.'</h3>
							   <h4>Welcome to <a href="http://www.uplace.in">uPLACE</a>, <br> 
							   Your Login details are given below, please login with the below credentials.</h4>
							    <h4>
								    Registered ID: '.$reg_number.'<br><br>
									Email id : '.$email.'<br><br>
									Password : '.$c_pass.'
								</h4>			
							   </body></html>';
							  
								
							   if(mail($to, $subject, $message, $headers))
							   {
								  echo "Successfully Registered.. !!  You can login Now";
							   }
								//echo "Successfully Registered.. !!  <br>You can login Now";
							}
							else {
								echo "Something went wrong, Please try again later.";
							}
			/* }else {
			echo "Your Account is not Activated";
			} */
		}
		else {
			echo "Wrong Private Number. !!";
		}


?>