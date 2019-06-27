
<?php
error_reporting(0);
include('db.php');

$clg_data=Array();

	//$ad_admin_id=$_GET['admin_id'];
	
	$condition=$_GET['condition'];
	$clg_id=$_GET['clg_id'];
	

	
		$query = "select e.id as edu_id,s.id,s.type,s.status,s.random_num_gen,s.college_id,s.firstname,s.email,s.usn,s.mobile,s.gender,s.country,s.resume_name,
		s.state,s.current_loc,s.profile_summary,s.dob,s.father_name,s.mother_name,s.alternate_mobile,e.course_type,e.class,e.start_year,
		e.end_year,e.college_name,e.university,e.branch,e.secured,e.edu_summary,e.sem1,e.sem2,e.sem3,e.sem4,e.sem5,e.sem6,e.sem7,e.sem8,e.total_sem,
		e10.secured as secured_10,e10.end_year as end_year_10, e10.university as university_10,
		e12.secured as secured_12,e12.end_year as end_year_12, e12.university as university_12
		from stu_student s, stu_education e ,stu_edu_10 e10, stu_edu_12 e12 where s.id=e.fk_stu_id and s.id=e10.fk_stu_id and s.id=e12.fk_stu_id and 
		e.class='Graduation' and e10.class='10' and e12.class='12' and s.type='student' and s.college_id=$clg_id and $condition";
	
		
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
			
			
			$main_info[]=array('stu_id' =>"$id",'ten_per' =>"$ten_per",'ten_passyear' =>"$ten_passyear",'ten_university' =>"$ten_university",'resume_name' =>"$resume_name",'type' =>"$type",'status' =>"$status",'alternate_mobile' =>"$alternate_mobile",'random_num_gen' =>"$random_num_gen",'college_id' =>"$college_id",'college_name' =>"$college_name",
			'firstname' =>"$firstname",'usn' =>"$usn",'mobile' =>"$mobile",'gender' =>"$gender",'country' =>"$country",'email' =>"$email",
			'state' =>"$state",'current_loc' =>"$current_loc",'profile_summary' =>"$profile_summary",'dob' =>"$dob",'father_name' =>"$father_name",
			'mother_name' =>"$mother_name",'course_type' =>"$course_type",'class' =>"$class",'start_year' =>"$start_year",'end_year' =>"$end_year",
			'university' =>"$university",'branch' =>"$branch",'secured' =>"$secured",'edu_summary' =>"$edu_summary",
			'sem1' =>"$sem1",'sem2' =>"$sem2",'sem3' =>"$sem3",'sem4' =>"$sem4",'sem5' =>"$sem5",'sem6' =>"$sem6",
			'sem7' =>"$sem7",'sem8' =>"$sem8",'total_sem' =>"$total_sem",'secured_10' =>"$secured_10",'end_year_10' =>"$end_year_10",'university_10' =>"$university_10",
			'secured_12' =>"$secured_12",'end_year_12' =>"$end_year_12",'university_12' =>"$university_12");
			
			//$stu_id_arr[]=array($id);
			
		}	
				
		
				$status = array_values($main_info);
		 		$fin_json["data"]=$status;
				$data= addslashes($query);
			 			 
			 //print_r($status);
				$json_final = json_encode($fin_json);
				
				if($json_final != '{"data":null}'){
					echo $json_final;
				}else{
					echo "0";
				}

				
?>	