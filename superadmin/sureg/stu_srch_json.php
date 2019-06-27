
<?php
error_reporting(0);
include('db.php');

$clg_data=Array();
	$colleges=$_GET['colleges'];
	
	$clg_data=$_GET['colleges'];

	//$branch_data=Array();
	$branch_data=$_GET['branchs'];

	//$end_years_data=Array();
	$end_years_data=$_GET['end_years'];
	
	
	$percent_data=$_GET['percent'];
	$percent_value= explode("|",$percent_data);// getting only name

/* 	$clg_list = implode(",", $clg_data);
	$branch_list = implode(",", $branch_data);
	$end_years_list = implode(",", $end_years_data);
	 */
	
	//echo $percent_value[0];
	if($colleges != 'null' && $branch_data != 'null' && $end_years_data != 'null' && $percent_data != 'null')
	{
		$Query = "select DISTINCT s.id,s.firstname,s.usn,s.email,s.gender,s.college_name,s.resume_name,e.branch,e.end_year,e.secured from stu_student s 
		JOIN stu_education e ON s.id=e.fk_stu_id
		Where s.college_id in ($colleges) and e.branch_id in ($branch_data) and e.end_year in ($end_years_data) and 
		secured $percent_value[0] and secured $percent_value[1] and class='Graduation' and s.type='student'";
		//echo $Query;die;
		//$skill_data = mysql_query($Query) or die("Error in Selection Query <br> ".$Query."<br>". mysql_error());
		$srch_data = mysql_query($Query) or die("Error in Selection Query <br> ".$Query."<br>". mysql_error());
	}
	else if($colleges != 'null' && $percent_data != 'null' && $branch_data != 'null')
	{
		$Query = "select DISTINCT s.id,s.firstname,s.usn,s.email,s.gender,s.mobile,s.college_name,s.resume_name,e.branch,e.end_year,e.secured from stu_student s 
		JOIN stu_education e ON s.id=e.fk_stu_id
		where s.college_id in ($colleges) and e.branch_id in ($branch_data) and e.secured $percent_value[0] and e.secured $percent_value[1] and e.class='Graduation' and s.type='student'";
		//echo $Query;die;
		$srch_data = mysql_query($Query) or die("Error in Selection Query <br> ".$Query."<br>". mysql_error());
	}
	else if($colleges != 'null' && $end_years_data != 'null' && $branch_data != 'null')
	{
		$Query = "select DISTINCT s.id,s.firstname,s.usn,s.email,s.gender,s.mobile,s.college_name,s.resume_name,e.branch,e.end_year,e.secured from stu_student s 
		JOIN stu_education e ON s.id=e.fk_stu_id
		Where s.college_id in ($colleges) and e.branch_id in ($branch_data) and e.end_year in ($end_years_data) and e.class='Graduation' and s.type='student'";
		$srch_data = mysql_query($Query) or die("Error in Selection Query <br> ".$Query."<br>". mysql_error());
	}
	else if($colleges != 'null' && $percent_data != 'null' && $end_years_data != 'null')
	{
		$Query = "select DISTINCT s.id,s.firstname,s.usn,s.email,s.gender,s.mobile,s.college_name,s.resume_name,e.branch,e.end_year,e.secured from stu_student s 
		JOIN stu_education e ON s.id=e.fk_stu_id
		where s.college_id in ($colleges) and e.secured $percent_value[0] and e.secured $percent_value[1] and e.class='Graduation' and s.type='student' and e.end_year in ($end_years_data)";
		//echo $Query;die;
		$srch_data = mysql_query($Query) or die("Error in Selection Query <br> ".$Query."<br>". mysql_error());
	}
	else if($colleges != 'null' && $branch_data != 'null')
	{
		$Query = "select distinct s.id,s.firstname,s.usn,s.email,s.gender,s.mobile,s.college_name,s.resume_name,e.branch,e.end_year,e.secured from stu_student s 
		join stu_education e on s.id=e.fk_stu_id
		where s.college_id in ($colleges) and e.branch_id in ($branch_data) and e.class='Graduation' and s.type='student'";
		$srch_data = mysql_query($Query) or die("Error in Selection Query <br> ".$Query."<br>". mysql_error());
	}
	else if($colleges != 'null' && $end_years_data != 'null')
	{
		$Query = "select DISTINCT s.id,s.firstname,s.usn,s.email,s.gender,s.mobile,s.college_name,s.resume_name,e.branch,e.end_year,e.secured from stu_student s 
		JOIN stu_education e ON s.id=e.fk_stu_id
		Where s.college_id in ($colleges) and e.end_year in ($end_years_data) and e.class='Graduation' and s.type='student'";
		$srch_data = mysql_query($Query) or die("Error in Selection Query <br> ".$Query."<br>". mysql_error());
	} 
	else if($colleges != 'null' && $percent_data != 'null')
	{
		$Query = "select DISTINCT s.id,s.firstname,s.usn,s.email,s.gender,s.mobile,s.college_name,s.resume_name,e.branch,e.end_year,e.secured from stu_student s 
		JOIN stu_education e ON s.id=e.fk_stu_id
		where s.college_id in ($colleges) and e.secured $percent_value[0] and e.secured $percent_value[1] and e.class='Graduation' and s.type='student'";
		//echo $Query;die;
		$srch_data = mysql_query($Query) or die("Error in Selection Query <br> ".$Query."<br>". mysql_error());
	}
	
	
	
	else if($branch_data != 'null' && $end_years_data != 'null' && $percent_data != 'null')
	{
		$Query = "select DISTINCT s.id,s.firstname,s.usn,s.email,s.gender,s.mobile,s.college_name,s.resume_name,e.branch,e.end_year,e.secured from stu_student s 
		JOIN stu_education e ON s.id=e.fk_stu_id
		Where e.branch_id in ($branch_data) and e.end_year in ($end_years_data) and 
		secured $percent_value[0] and secured $percent_value[1] and class='Graduation' and s.type='student'";
		//echo $Query;die;
		//$skill_data = mysql_query($Query) or die("Error in Selection Query <br> ".$Query."<br>". mysql_error());
		$srch_data = mysql_query($Query) or die("Error in Selection Query <br> ".$Query."<br>". mysql_error());
	}
		
	else if($percent_data != 'null' && $branch_data != 'null')
	{
		$Query = "select DISTINCT s.id,s.firstname,s.usn,s.email,s.gender,s.mobile,s.college_name,s.resume_name,e.branch,e.end_year,e.secured from stu_student s 
		JOIN stu_education e ON s.id=e.fk_stu_id
		where e.branch_id in ($branch_data) and e.secured $percent_value[0] and e.secured $percent_value[1] and e.class='Graduation' and s.type='student'";
		//echo $Query;die;
		$srch_data = mysql_query($Query) or die("Error in Selection Query <br> ".$Query."<br>". mysql_error());
	}
	else if($end_years_data != 'null' && $branch_data != 'null')
	{
		$Query = "select DISTINCT s.id,s.firstname,s.usn,s.email,s.gender,s.mobile,s.college_name,s.resume_name,e.branch,e.end_year,e.secured from stu_student s 
		JOIN stu_education e ON s.id=e.fk_stu_id
		Where e.branch_id in ($branch_data) and e.end_year in ($end_years_data) and e.class='Graduation' and s.type='student'";
		$srch_data = mysql_query($Query) or die("Error in Selection Query <br> ".$Query."<br>". mysql_error());
	}
	
	
	else if($percent_data != 'null' && $end_years_data != 'null')
	{
		$Query = "select DISTINCT s.id,s.firstname,s.usn,s.email,s.gender,s.mobile,s.college_name,s.resume_name,e.branch,e.end_year,e.secured from stu_student s 
		JOIN stu_education e ON s.id=e.fk_stu_id
		where e.secured $percent_value[0] and e.secured $percent_value[1] and e.class='Graduation' and s.type='student' and e.end_year in ($end_years_data)";
		//echo $Query;die;
		$srch_data = mysql_query($Query) or die("Error in Selection Query <br> ".$Query."<br>". mysql_error());
	}

	

	else if($colleges != 'null')
	{
		$Query = "select DISTINCT s.id,s.firstname,s.usn,s.email,s.gender,s.mobile,s.college_name,s.resume_name,e.branch,e.end_year,e.secured from stu_student s 
		JOIN stu_education e ON s.id=e.fk_stu_id
		where s.college_id in ($colleges) and e.class='Graduation' and s.type='student'";
		//echo $Query;die;
		$srch_data = mysql_query($Query) or die("Error in Selection Query <br> ".$Query."<br>". mysql_error());
	} 
	else if($branch_data != 'null')
	{
		$Query = "select distinct s.id,s.firstname,s.usn,s.email,s.gender,s.mobile,s.college_name,s.resume_name,e.branch,e.end_year,e.secured from stu_student s 
		join stu_education e on s.id=e.fk_stu_id
		where e.branch_id in ($branch_data) and e.class='Graduation' and s.type='student'";
		$srch_data = mysql_query($Query) or die("Error in Selection Query <br> ".$Query."<br>". mysql_error());
	}
	else if($end_years_data != 'null')
	{
		$Query = "select DISTINCT s.id,s.firstname,s.usn,s.email,s.gender,s.mobile,s.college_name,s.resume_name,e.branch,e.end_year,e.secured from stu_student s 
		JOIN stu_education e ON s.id=e.fk_stu_id
		Where e.end_year in ($end_years_data) and e.class='Graduation' and s.type='student'";
		$srch_data = mysql_query($Query) or die("Error in Selection Query <br> ".$Query."<br>". mysql_error());
	} 
	else if($percent_data != 'null')
	{
		$Query = "select DISTINCT s.id,s.firstname,s.usn,s.email,s.gender,s.mobile,s.college_name,s.resume_name,e.branch,e.end_year,e.secured from stu_student s 
		JOIN stu_education e ON s.id=e.fk_stu_id
		where e.secured $percent_value[0] and e.secured $percent_value[1] and e.class='Graduation' and s.type='student'";
		//echo $Query;die;
		$srch_data = mysql_query($Query) or die("Error in Selection Query <br> ".$Query."<br>". mysql_error());
	}

	else
	{
		$Query = "select DISTINCT s.id,s.firstname,s.usn,s.email,s.gender,s.mobile,s.college_name,s.resume_name,e.branch,e.end_year,e.secured from stu_student s 
		JOIN stu_education e ON s.id=e.fk_stu_id where e.class='Graduation' and s.type='student'";
		//echo $Query;die;
		$srch_data = mysql_query($Query) or die("Error in Selection Query <br> ".$Query."<br>". mysql_error());
	}
	
	
		while ($row=mysql_fetch_array($srch_data)) 
		{ 
			$id=$row['id'];
			$firstname=$row['firstname'];
			$usn=$row['usn']; 
			$email=$row['email'];                                    
			$mobile=$row['mobile'];                                       
			$gender=$row['gender'];                                      
			$college_name=$row['college_name'];                                           
			$branch=$row['branch'];                                   
			$end_year=$row['end_year'];                                      
			$secured=$row['secured']; 
			$resume_name=$row['resume_name'];
			
			$final[]=array($id,$firstname,$usn,$email,$mobile,$gender,$college_name,$branch,$end_year,$secured,$resume_name);
		}
				
				//$final=array($id,$college_name);
				$status["data"] = array_values($final);
			
				$json_final = json_encode($status);
				if($json_final != '{"data":null}'){
					echo $json_final;
				}else{
					echo "0";
				}
		
				
?>	