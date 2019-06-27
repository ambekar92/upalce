<?php
error_reporting(0);
include('db.php');

function mysql_insert_array($table, $data, $exclude = array()) {
    $fields = $values = array();
    if( !is_array($exclude) ) $exclude = array($exclude);
    foreach( array_keys($data) as $key ) {
        if( !in_array($key, $exclude) ) {
            $fields[] = "`$key`";
            //$values[] = "'" . mysql_real_escape_string($data[$key]) . "'";
			$values[] = "'" .$data[$key]. "'";
        }
    }
    $fields = implode(",", $fields);
    $values = implode(",", $values);
    if( mysql_query("INSERT INTO `$table` ($fields) VALUES ($values)") ) {
        return array( "mysql_error" => false,
                      "mysql_insert_id" => mysql_insert_id(),
                      "mysql_affected_rows" => mysql_affected_rows(),
                      "mysql_info" => mysql_info(),
                      "res_info" => "Successfully Registered.. !!  You can login Now"
                    );
    } else {
        return array("mysql_error" => mysql_error() );
    }
}	



		$comp_name=$_POST['comp_name']; 
		$comp_name_value= explode("|",$comp_name);// getting only name
		$comp_id=$comp_name_value[0];
		$comp_name=$comp_name_value[1];

		$email=$_POST['email']; 
		$password=md5($_POST['password']); 
		$c_password=$_POST['c_password']; 
		$indus_type=$_POST['indus_type']; 
		$contact_person_1=$_POST['contact_person_1']; 
		$designation_1=$_POST['designation_1']; 
		$mobile_number_1=$_POST['mobile_number_1']; 
		$email_1=$_POST['email_1']; 
		$contact_person_2=$_POST['contact_person_2']; 
		$designation_2=$_POST['designation_2']; 
		$mobile_number_2=$_POST['mobile_number_2'];  
		$email_2=$_POST['email_2']; 
		$office_add=$_POST['office_add']; 

		$country=$_POST['country']; //getting both value and name
		$country_value= explode(".",$country);// getting only name
		$country=$country_value[1];

		$state=$_POST['state']; 
		$current_location=$_POST['current_location'];
		$pinCode=$_POST['pinCode']; 
		$private_number=$_POST['private_number'];
		$gst_val=$_POST['gst_val']; 
		$terms_cond=$_POST['terms_cond']; 
		$terms_cond1=$_POST['terms_cond_01']; 
		$terms_cond2=$_POST['terms_cond_02']; 
		$reg_number='COM_REG_'.rand(1111111111,9999999999);
		$status_com='A';
		
		$p_num = mysql_query("SELECT * FROM  su_active_companies WHERE company_id='$comp_id'") or 
					die("Error in Selection Query <br> ".$query."<br>". mysql_error());
		while($row=mysql_fetch_array($p_num)) 
		{
			$private_number_su=$row['private_number']; 
			$status=$row['status']; 
		}

		if($private_number_su==$private_number)
		{
			/*	$table = 'ad_admin';
				$query ="insert into $table (reg_number,off_email,private_number,clg_id,clg_name,email,password,mobile_number,country,state,current_location,terms_cond) 
				values('$reg_number','$off_email','$private_number','$clg_id','$clg_name','$email','$password','$mobile_number','$country','$state','$current_location','$term_con')"; 
				$Result = mysql_query($query) or die("$clg_name -- \"Already Registered\"");
							*/
				$table = 'ad_companies';
				$FinalMarge=array('profile_img'=>"",
								  'comp_id'=>$comp_id,
								  'comp_name' =>$comp_name,
								  'email' =>$email,
								  'password' =>$password,
								  'c_password' =>$c_password,
								  'indus_type' =>$indus_type,
								  'contact_person_1' =>$contact_person_1,
								  'designation_1' =>$designation_1,
								  'mobile_number_1' =>$mobile_number_1,
								  'email_1' =>$email_1,
								  'contact_person_2' =>$contact_person_2,
								  'designation_2' =>$designation_2,
								  'mobile_number_2' =>$mobile_number_2,
								  'email_2' =>$email_2,
								  'office_add' =>$office_add,
								  'country' =>$country,
								  'state' =>$state,
								  'current_location' =>$current_location,
								  'pinCode' =>$pinCode,
								  'private_number' =>$private_number,
								  'gst_val' =>$gst_val,
								  'terms_cond' =>$terms_cond,
								  'terms_cond1' =>$terms_cond1,
								  'terms_cond2' =>$terms_cond2,
								  'reg_number' =>$reg_number,
								  'status' =>$status_com,
								  );

				
				
				   $to =''.$email.'';
				   $subject = "uPLACE - Registered Successfully ";
				   $headers = "From: " . strip_tags('uplace_confirmation@uplace.in') . "\r\n";
				   $headers .= "Reply-To: ". strip_tags('contact@uplace.in') . "\r\n";
				   $headers .= "MIME-Version: 1.0\r\n";
				   $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
				   $message = '<html><body>
				   <h3>Dear Admin <br>'.$comp_name.'</h3>
				   <h4>Welcome to <a href="http://www.uplace.in">uPLACE</a>, <br> 
				   Your Login details are given below, please login with the below credentials.</h4>
				    <h4>
					    Registered ID: '.$reg_number.'<br><br>
						Email id : '.$email.'<br><br>
						Password : '.$c_password.'
					</h4>			
				   </body></html>';				  
					
				   if(mail($to, $subject, $message, $headers)){
					  $result = mysql_insert_array($table, $FinalMarge, "submit");

						if($result['mysql_error']){
							//$error= "Query Failed: " . $result['mysql_error'];
							$error="$comp_name -- \"Already Registered\"";
							$response['data']=$error;
						}
						else
						{
						  $response['data']=$result['res_info'];
						}
				   }else{
					  $error="Something went wrong, Please try again later.";
					  $response['data']=$error;
				   }
								
		}
		else {
			$error="Wrong Private Number. !!";
			$response['data']=$error;
		}

		echo json_encode($response);

?>