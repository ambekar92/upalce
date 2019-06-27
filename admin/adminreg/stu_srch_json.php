
<?php
error_reporting(0);
include('db.php');

$clg_data=Array();

	$ad_admin_id=$_GET['admin_id'];
	
	$data_placed=$_GET['data_placed'];
	$clg_id=$_GET['clg_id'];
	
	$clg_data=$_GET['colleges'];

	//$branch_data=Array();
	$branch_data=$_GET['branchs'];

	//$end_years_data=Array();
	$end_years_data=$_GET['end_years'];
	
	
	$percent_data=$_GET['percent'];
	$percent_value= explode("|",$percent_data);// getting only name

	$percent_data_10=$_GET['percent_10'];
	$percent_value_10= explode("|",$percent_data_10);// getting only name

	$percent_data_12=$_GET['percent_12'];
	$percent_value_12= explode("|",$percent_data_12);// getting only name

	$classType=$_GET['classType'];
	
/* 	$clg_list = implode(",", $clg_data);
	$branch_list = implode(",", $branch_data);
	$end_years_list = implode(",", $end_years_data);
	 */
	
if($data_placed == 'placed')
{
	if($data_placed !='null' && $branch_data != 'null' && $end_years_data != 'null')
	{
		$condition = "e.branch_id in ($branch_data) and e.end_year in ($end_years_data) and 
					 s.usn in (select stu_usn from ad_placed_stu where status='placed')";
	}
	else if($data_placed !='null' && $branch_data != 'null')
	{
		$condition = "e.branch_id in ($branch_data) and 
					 s.usn in (select stu_usn from ad_placed_stu where status='placed')";
	}
	else if($data_placed !='null' && $end_years_data != 'null')
	{
		$condition = "e.end_year in ($end_years_data)  and 
					 s.usn in (select stu_usn from ad_placed_stu where status='placed')";
	}
	else{
		$condition = "s.usn in (select stu_usn from ad_placed_stu where status='placed') ";
	}
	
}	//placed if ends

else if($data_placed == 'unplaced')
{
	if($data_placed !='null' && $branch_data != 'null' && $end_years_data != 'null')
	{
		$condition = "e.branch_id in ($branch_data) and e.end_year in ($end_years_data) and 
					 s.usn not in (select stu_usn from ad_placed_stu where status='placed')";
	}
	else if($data_placed !='null' && $branch_data != 'null')
	{
		$condition = "e.branch_id in ($branch_data) and 
					 s.usn not in (select stu_usn from ad_placed_stu where status='placed')";
	}
	else if($data_placed !='null' && $end_years_data != 'null')
	{
		$condition = "e.end_year in ($end_years_data)  and 
					 s.usn not in (select stu_usn from ad_placed_stu where status='placed')";
	}
	else{
		$condition = "s.usn not in (select stu_usn from ad_placed_stu where status='placed') ";
	}
}//Unplaced if ends

else
{
	//echo $ad_admin_id;
	
	//Added for 12th
	if($branch_data != 'null' && $end_years_data != 'null' && $percent_data != 'null' && $percent_data_10 != 'null' && $percent_data_12 != 'null')
	{
		$condition = "e.branch_id in ($branch_data) and e.end_year in ($end_years_data) and
		e10.secured $percent_value_10[0] and e10.secured $percent_value_10[1] and e12.secured $percent_value_12[0] and e12.secured $percent_value_12[1] and
		e.secured $percent_value[0] and e.secured $percent_value[1]";
	}
	else if($percent_data != 'null' && $branch_data != 'null' && $percent_data_10 != 'null' && $percent_data_12 != 'null')
	{
		$condition = "e.branch_id in ($branch_data) and e10.secured $percent_value_10[0] and e10.secured $percent_value_10[1] and
		e12.secured $percent_value_12[0] and e12.secured $percent_value_12[1]
		and e.secured $percent_value[0] and e.secured $percent_value[1]";
	}
	else if($end_years_data != 'null' && $branch_data != 'null' && $percent_data_10 != 'null' && $percent_data_12 != 'null')
	{
		$condition = "e.branch_id in ($branch_data) and e.end_year in ($end_years_data) and 
		e12.secured $percent_value_12[0] and e12.secured $percent_value_12[1] and
		e10.secured $percent_value_10[0] and e10.secured $percent_value_10[1]";
	}
	else if($percent_data != 'null' && $end_years_data != 'null' && $percent_data_10 != 'null' && $percent_data_12 != 'null')
	{
		$condition = "e.secured $percent_value[0] and e10.secured $percent_value_10[0] and e10.secured $percent_value_10[1] and
		e12.secured $percent_value_12[0] and e12.secured $percent_value_12[1]
		and e.secured $percent_value[1] and e.end_year in ($end_years_data)";
	}
	
	//Added for 10th
	else if($branch_data != 'null' && $end_years_data != 'null' && $percent_data != 'null' && $percent_data_10 != 'null')
	{
		$condition = "e.branch_id in ($branch_data) and e.end_year in ($end_years_data) and
		e10.secured $percent_value_10[0] and e10.secured $percent_value_10[1] and 
		e.secured $percent_value[0] and e.secured $percent_value[1]";
	}
	else if($percent_data != 'null' && $branch_data != 'null' && $percent_data_10 != 'null')
	{
		$condition = "e.branch_id in ($branch_data) and e10.secured $percent_value_10[0] and e10.secured $percent_value_10[1]
		and e.secured $percent_value[0] and e.secured $percent_value[1]";
	}
	else if($end_years_data != 'null' && $branch_data != 'null' && $percent_data_10 != 'null')
	{
		$condition = "e.branch_id in ($branch_data) and e.end_year in ($end_years_data) and 
		e10.secured $percent_value_10[0] and e10.secured $percent_value_10[1]";
	}
	else if($percent_data != 'null' && $end_years_data != 'null' && $percent_data_10 != 'null')
	{
		$condition = "e.secured $percent_value[0] and e10.secured $percent_value_10[0] and e10.secured $percent_value_10[1]
		and e.secured $percent_value[1] and e.end_year in ($end_years_data)";
	}

	//added for 12
	else if($percent_data != 'null' && $branch_data != 'null' && $percent_data_12 != 'null')
	{
		$condition = "e.branch_id in ($branch_data) and 
		e12.secured $percent_value_12[0] and e12.secured $percent_value_12[1] and
		e.secured $percent_value[0] and e.secured $percent_value[1]";
	}
	else if($end_years_data != 'null' && $branch_data != 'null' && $percent_data_12 != 'null')
	{
		$condition = "e.branch_id in ($branch_data) and e.end_year in ($end_years_data) and
		e12.secured $percent_value_12[0] and e12.secured $percent_value_12[1]";
	}
	else if($percent_data != 'null' && $end_years_data != 'null' && $percent_data_12 != 'null')
	{
		$condition = "e.secured $percent_value[0] and e.secured $percent_value[1] and 
		e12.secured $percent_value_12[0] and e12.secured $percent_value_12[1]
		and e.end_year in ($end_years_data)";
	}
	
	//added 12
	else if($branch_data != 'null' && $percent_data_10 != 'null' && $percent_data_12 != 'null')
	{
		$condition = "e.branch_id in ($branch_data) and e12.secured $percent_value_12[0] and e12.secured $percent_value_12[1]
		and e10.secured $percent_value_10[0] and e10.secured $percent_value_10[1]";
	}
	else if($end_years_data != 'null' && $percent_data_10 != 'null' && $percent_data_12 != 'null')
	{
		$condition = "e.end_year in ($end_years_data) and e12.secured $percent_value_12[0] and e12.secured $percent_value_12[1]
		and e10.secured $percent_value_10[0] and e10.secured $percent_value_10[1]";
	} 
	else if($percent_data != 'null' && $percent_data_10 != 'null' && $percent_data_12 != 'null')
	{
		$condition = "e.secured $percent_value[0] and e12.secured $percent_value_12[0] and e12.secured $percent_value_12[1]
		and e.secured $percent_value[1] and e10.secured $percent_value_10[0] and e10.secured $percent_value_10[1]";
	}
	
	
	else if($branch_data != 'null' && $end_years_data != 'null' && $percent_data != 'null')
	{
		$condition = "e.branch_id in ($branch_data) and e.end_year in ($end_years_data) and e.secured $percent_value[0] and e.secured $percent_value[1]";
	}
	else if($percent_data != 'null' && $branch_data != 'null')
	{
		$condition = "e.branch_id in ($branch_data) and e.secured $percent_value[0] and e.secured $percent_value[1]";
	}
	else if($end_years_data != 'null' && $branch_data != 'null')
	{
		$condition = "e.branch_id in ($branch_data) and e.end_year in ($end_years_data)";
	}
	else if($percent_data != 'null' && $end_years_data != 'null')
	{
		$condition = "e.secured $percent_value[0] and e.secured $percent_value[1] and e.end_year in ($end_years_data)";
	}

	
	
	//added for 10th	
	else if($branch_data != 'null' && $percent_data_10 != 'null')
	{
		$condition = "e.branch_id in ($branch_data) and e10.secured $percent_value_10[0] and e10.secured $percent_value_10[1]";
	}
	else if($end_years_data != 'null' && $percent_data_10 != 'null')
	{
		$condition = "e.end_year in ($end_years_data) and e10.secured $percent_value_10[0] and e10.secured $percent_value_10[1]";
	} 
	else if($percent_data != 'null' && $percent_data_10 != 'null')
	{
		$condition = "e.secured $percent_value[0] and e.secured $percent_value[1] and e10.secured $percent_value_10[0] and e10.secured $percent_value_10[1]";
	}
	
	
	//added 12
	else if($branch_data != 'null' && $percent_data_12 != 'null')
	{
		$condition = "e.branch_id in ($branch_data) and e12.secured $percent_value_12[0] and e12.secured $percent_value_12[1]";
	}
	else if($end_years_data != 'null' && $percent_data_12 != 'null')
	{
		$condition = "e.end_year in ($end_years_data) and e12.secured $percent_value_12[0] and e12.secured $percent_value_12[1]";
	} 
	else if($percent_data != 'null' && $percent_data_12 != 'null')
	{
		$condition = "e.secured $percent_value[0] and e.secured $percent_value[1] and
		e12.secured $percent_value_12[0] and e12.secured $percent_value_12[1]";
	}
	else if($percent_data_10 != 'null' && $percent_data_12 != 'null')
	{
		$condition = "e10.secured $percent_value_10[0] and e10.secured $percent_value_10[1] and
		e12.secured $percent_value_12[0] and e12.secured $percent_value_12[1]";
	}
	
	
	else if($branch_data != 'null')
	{
		$condition = "e.branch_id in ($branch_data)";
	}
	else if($end_years_data != 'null')
	{
		$condition = "e.end_year in ($end_years_data)";
	} 
	else if($percent_data != 'null')
	{
		$condition = "e.secured $percent_value[0] and e.secured $percent_value[1]";
	}
	else if($percent_data_10 != 'null')
	{
		$condition = "e10.secured $percent_value_10[0] and e10.secured $percent_value_10[1]";
	}
	else if($percent_data_12 != 'null')
	{
		$condition = "e12.secured $percent_value_12[0] and e12.secured $percent_value_12[1]";
	}
	else
	{
		$condition = "s.college_id=$clg_id";
	} 
}	


	$query = "SELECT e.class_type as class_type,s.project_link_status,e.id as edu_id,s.id,s.type,s.status,s.random_num_gen,s.college_id,s.firstname,s.email,s.usn,s.mobile,s.gender,s.country,s.resume_name,
	s.state,s.current_loc,s.profile_summary,s.dob,s.father_name,s.mother_name,s.alternate_mobile,e.course_type,e.class,e.start_year,
	e.end_year,e.college_name,e.university,e.branch,e.secured,e.edu_summary,e.sem1,e.sem2,e.sem3,e.sem4,e.sem5,e.sem6,e.sem7,e.sem8,e.total_sem,
	e10.secured as secured_10,e10.end_year as end_year_10, e10.university as university_10,s.profile_img,
	e12.secured as secured_12,e12.end_year as end_year_12, e12.university as university_12, 
	pl.comp_1 AS comp_1 ,pl.comp_2 AS comp_2,pl.comp_3 AS comp_3,pl.comp_4 AS comp_4,pl.total_comp AS total_comp   
	FROM stu_education e ,stu_edu_10 e10, stu_edu_12 e12,stu_student s 
	LEFT OUTER JOIN ad_placed_stu pl ON pl.stu_usn = s.usn
	where s.id=e.fk_stu_id and s.id=e10.fk_stu_id and 
	s.id=e12.fk_stu_id and e.class='".$classType."' and e10.class='10' and e12.class='12' and s.type='student' and s.college_id=$clg_id and $condition GROUP by s.usn";
		
		
		//die($query);
		$srch_data = mysql_query($query) or die("Error in Selection query <br> ".$query."<br>". mysql_error());
		while ($row=mysql_fetch_array($srch_data)) 
		{ 
			$id=$row['id'];
			$edu_id=$row['edu_id'];
			$ten_per=$row['ten_per'];
			$ten_passyear=$row['ten_passyear'];
			$ten_university=$row['ten_university'];
			$resume_name=$row['resume_name'];
			$type=$row['type'];
			$status=$row['status'];
			$random_num_gen=$row['random_num_gen']; 
			$college_id=$row['college_id'];                                    
			$college_name=$row['college_name'];                                       
			$firstname=$row['firstname'];                                      
			$email=$row['email'];                                      
			$usn=$row['usn'];                                           
			$mobile=$row['mobile'];                                   
			$gender=$row['gender'];                                      
			$country=$row['country']; 
			$state=$row['state'];
			$current_loc=$row['current_loc'];
			$profile_summary=$row['profile_summary'];
			$dob=$row['dob'];
			$father_name=$row['father_name'];
			$mother_name=$row['mother_name'];
			$alternate_mobile=$row['alternate_mobile'];
			$course_type=$row['course_type'];
			$class=$row['class'];
			$start_year=$row['start_year'];
			$end_year=$row['end_year'];
			$university=$row['university'];
			$branch=$row['branch'];
			$secured=$row['secured'];
			$edu_summary=$row['edu_summary'];
			$sem1=$row['sem1'];
			$sem2=$row['sem2'];
			$sem3=$row['sem3'];
			$sem4=$row['sem4'];
			$sem5=$row['sem5'];
			$sem6=$row['sem6'];
			$sem7=$row['sem7'];
			$sem8=$row['sem8'];
			$total_sem=$row['total_sem'];
			$secured_10=$row['secured_10'];
			$end_year_10=$row['end_year_10'];
			$university_10=$row['university_10'];
			$secured_12=$row['secured_12'];
			$end_year_12=$row['end_year_12'];
			$university_12=$row['university_12'];
			$class_type=$row['class_type'];
			
			$comp_1 =$row['comp_1'];
			$comp_2 =$row['comp_2'];
			$comp_3 =$row['comp_3'];
			$comp_4 =$row['comp_4'];
			$total_comp =$row['total_comp'];
			$profile_img=$row['profile_img'];
			$project_link_status=$row['project_link_status'];
			
			$main_info[]=array('class_type' =>"$class_type",'profile_img' =>"$profile_img",'comp_1' =>"$comp_1",'comp_2' =>"$comp_2",'comp_3' =>"$comp_3",'comp_4' =>"$comp_4",'total_comp' =>"$total_comp",'stu_id' =>"$id",'ten_per' =>"$ten_per",
			'ten_passyear' =>"$ten_passyear",'ten_university' =>"$ten_university",'resume_name' =>"$resume_name",'type' =>"$type",'status' =>"$status",
			'alternate_mobile' =>"$alternate_mobile",'random_num_gen' =>"$random_num_gen",'college_id' =>"$college_id",'college_name' =>"$college_name",
			'firstname' =>"$firstname",'usn' =>"$usn",'mobile' =>"$mobile",'gender' =>"$gender",'country' =>"$country",'email' =>"$email",
			'state' =>"$state",'current_loc' =>"$current_loc",'profile_summary' =>"$profile_summary",'dob' =>"$dob",'father_name' =>"$father_name",
			'mother_name' =>"$mother_name",'course_type' =>"$course_type",'class' =>"$class",'start_year' =>"$start_year",'end_year' =>"$end_year",
			'university' =>"$university",'branch' =>"$branch",'secured' =>"$secured",'edu_summary' =>"$edu_summary",
			'sem1' =>"$sem1",'sem2' =>"$sem2",'sem3' =>"$sem3",'sem4' =>"$sem4",'sem5' =>"$sem5",'sem6' =>"$sem6",
			'sem7' =>"$sem7",'sem8' =>"$sem8",'total_sem' =>"$total_sem",'secured_10' =>"$secured_10",'end_year_10' =>"$end_year_10",'university_10' =>"$university_10",
			'secured_12' =>"$secured_12",'end_year_12' =>"$end_year_12",'university_12' =>"$university_12",'project_link_status'=>"$project_link_status");
			
			//$stu_id_arr[]=array($id);
			
		} 
		   		
				$status = array_values($main_info);
		 		$fin_json["data"]=$status;
				$data= addslashes($query);
				$data_sql=mysql_query("select * from admin_search where fk_ad_admin_id=$ad_admin_id");
				
				$count=mysql_num_rows($data_sql);
			
		if($data_placed !='placed'){	
			if ($count == '0') {
				$save_query ="insert into admin_search(fk_ad_admin_id,query) values('$ad_admin_id','$condition')"; 
					mysql_query($save_query);
				
			} else {
				
				$update_query ='update admin_search set query="'.$condition.'" where fk_ad_admin_id='.$ad_admin_id; 
					mysql_query($update_query) or die("Error in Selection query <br> ".$update_query."<br>". mysql_error());
					
			}
		}		 			 
			 //print_r($status);
				$json_final = json_encode($fin_json);
				
				if($json_final != '{"data":null}'){
					echo $json_final;
				}else{
					echo "0";
				}

				
?>	