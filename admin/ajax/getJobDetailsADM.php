<?php
include('../adminreg/db.php');
/*
   Get Company, JOB , Student list
*/ 

/* Insert Function*/ 
function mysql_insert_array($table, $data, $exclude = array()) {
    $fields = $values = array();
    if( !is_array($exclude) ) $exclude = array($exclude);
    foreach( array_keys($data) as $key ) {
        if( !in_array($key, $exclude) ) {
            $fields[] = "`$key`";
            
            if($data[$key] == 'NULL'){
                $values[] =$data[$key];
            }else{
                $values[] ="'" .$data[$key]. "'";
            }
            
            //$values[] = "'" .$data[$key]. "'";
        }
    }
    $fields = implode(",", $fields);
    $values = implode(",", $values);
    
    $sql="INSERT INTO `$table` ($fields) VALUES ($values) ";
    return $sql;
}

/*Update Function*/
function mysql_update_array($table, $data, $exclude = array(),$cond) {
    $fields = $values = array();
    if( !is_array($exclude) ) $exclude = array($exclude);
    foreach( array_keys($data) as $key ) {
        if( !in_array($key, $exclude) ) {
            
            if($data[$key] == 'NULL'){
                $dataA[]=$key."=".$data[$key];
            }else{
                $dataA[]=$key."='" .$data[$key]. "'";
            }
        }
    }
    $dataA = implode(",", $dataA);
    
    $updateSql = "UPDATE $table SET $dataA where $cond";
    return $updateSql;
}


function getDbDateTimeFormat($input) {
	//$Datetime = date("Y-m-d H:i:s", strtotime($input));
    $only_date =date("d-m-Y", strtotime($input));
    // "DateTime" => $Datetime,
	 return  $only_date;
}

/* get all Saved Company */
if(isset($_POST['getSavedJobDetails'])){

  $college_id=$_POST['college_id'];

  $getSql="SELECT count(*) as totaljobs,c.id as company_id,profile_img,comp_id,comp_name,email,indus_type,contact_person_1, designation_1, mobile_number_1,email_1,country,state,current_location 
  FROM co_job_posted jp,ad_companies c 
  WHERE jp.reg_comp_id=c.id and jp.type <> 'E' and jp.publish=1 and (clg_id like '%".$college_id."%' OR clg_id='[]') GROUP BY company_id;";
    
  $jobDetails=mysql_query($getSql) or die('Error:'.mysql_error());
  
  while($row=mysql_fetch_array($jobDetails)){

        $company_id=$row['company_id'];
        $profile_img=$row['profile_img'];
        $comp_name=$row['comp_name'];
        $email=$row['email'];
        $indus_type=$row['indus_type'];
        $contact_person_1=$row['contact_person_1'];
        $designation_1=$row['designation_1'];
        $mobile_number_1=$row['mobile_number_1'];
        $email_1=$row['email_1'];
        $country=$row['country'];
        $state=$row['state'];
        $current_location=$row['current_location'];
        $totaljobs=$row['totaljobs'];

        
            $innerSql="select count(tj.id) as approvedJobs
            FROM track_job tj,co_job_posted jp
            Where tj.job_id=jp.id and jp.reg_comp_id=".$company_id." and tj.college_id=".$college_id;
            
            $innerSqlRes=mysql_query($innerSql) or die('Error:'.mysql_error());
            while($row=mysql_fetch_array($innerSqlRes)){
                $approvedJobs=$row['approvedJobs'];
            }

            

        $getJobDetails[]=array('company_id' =>"$company_id",
            'profile_img' =>"$profile_img",
            'comp_name' =>"$comp_name",
            'email' =>"$email",
            'indus_type' =>"$indus_type",
            'contact_person_1' =>"$contact_person_1",
            'designation_1' =>"$designation_1",
            'mobile_number_1' => "$mobile_number_1",
            'email_1' => "$email_1",
            'country' => "$country",
            'state' => "$state",
            'current_location' => "$current_location",
            'totaljobs' => "$totaljobs",
            'approvedJobs' => "$approvedJobs",
        );
        
    }

    $status['loadJobDetails'] = $getJobDetails;
    echo json_encode($status);
    mysqli_close($con);
}

/* get all Saved JOB */
if(isset($_POST['getCompJobsList'])){

  $college_id=$_POST['college_id'];
  $comp_id=$_POST['comp_id'];

  
$getSql="SELECT jp.type,jp.id,jp.job_id,jp.title,jp.descp,jp.requirement,jp.no_position,jp.location,jp.salary,jp.last_date,jp.comp_job_id, tj.clg_approval,(length(student_id) - length(replace(student_id, ',', '')) + 1) as stu_count,clg_to_hr_status,jp.contact_name,jp.contact_number,jp.contact_email 
FROM co_job_posted jp left join (select * from track_job tj where tj.college_id=".$college_id.") tj on tj.job_id=jp.id WHERE  jp.reg_comp_id=".$comp_id." and jp.type<>'E' and jp.publish=1 and (clg_id like '%".$college_id."%' OR clg_id='[]') order by jp.last_date DESC";

    
  $jobDetails=mysql_query($getSql) or die('Error:'.mysql_error());
  
  while($row=mysql_fetch_array($jobDetails)){
        $id=$row['id'];
        $job_id=$row['job_id'];
        $title=$row['title'];
        $descp=$row['descp'];
        $requirement=$row['requirement'];
        $no_position=$row['no_position'];
        $location=$row['location'];
        $salary=$row['salary'];
        $last_date=getDbDateTimeFormat($row['last_date']);
        $type=$row['type'];
        $comp_job_id=$row['comp_job_id'];
        $clg_approval=$row['clg_approval'];
        $stu_count=$row['stu_count'];
        $clg_to_hr_status=$row['clg_to_hr_status'];
        $contact_name=$row['contact_name'];
        $contact_number=$row['contact_number'];
        $contact_email=$row['contact_email'];

        if($stu_count==0){
            $stu_count=0;
        }else{
            $stu_count=$stu_count-1;
        }

        $getJobDetails[]=array('job_id' =>"$job_id",
            'id' =>$id,
            'title' =>$title,
            'descp' =>$descp,
            'requirement' =>$requirement,
            'no_position' =>$no_position,
            'location' =>$location,
            'salary' => $salary,
            'last_date' => $last_date,          
            'type' => $type,          
            'comp_job_id' => $comp_job_id,          
            'clg_approval' => $clg_approval,          
            'stu_count' => (int)$stu_count,        
            'clg_to_hr_status' => $clg_to_hr_status,        
            'contact_name' => $contact_name,        
            'contact_number' => $contact_number,        
            'contact_email' => $contact_email        
        );
        
    }

    $status['loadJobDetails'] = $getJobDetails;
    echo json_encode($status);
    mysqli_close($con);
}

/* get all Saved JOB */
if(isset($_POST['getJobsStudentList'])){

  $college_id=$_POST['college_id'];
  $comp_id=$_POST['comp_id'];
  $job_id=$_POST['job_id'];
  
  $getStu="select student_id from track_job where job_id=".$job_id." and college_id=".$college_id;
  $getStuRes=mysql_query($getStu) or die('Error:'.mysql_error());

    while($row=mysql_fetch_array($getStuRes)){
      $student_id=$row['student_id'];
    }

    //$arr1 = array_merge($arr1,$arr2);
    //   $student_arr = explode(",",$student_id);
    //   $stuArr = implode(",",$student_arr);
    //   print_r($stuArr);

            
//   $getSql="SELECT tj.clg_approval,tj.job_id,tj.colleg_id,tj.student_id,jp.type,s.firstname,s.email,s.usn,s.gender,e.end_year,e.branch,e.secured 
//      FROM track_job tj,co_job_posted jp,stu_student s,stu_education e 
//      WHERE tj.student_id=s.id and s.id=e.fk_stu_id and class='Graduation' and tj.job_id=".$job_id." 
//      and jp.reg_comp_id=".$comp_id." and tj.colleg_id=".$college_id." GROUP BY tj.job_id, tj.student_id";
    
$getSql="SELECT s.id as stu_id,tj.clg_approval,tj.job_id,tj.college_id,tj.student_id,jp.type,s.firstname,s.email,s.usn,s.gender,e.end_year,e.branch,e.secured,resume_name 
FROM track_job tj,co_job_posted jp,stu_student s,stu_education e 
WHERE s.id IN (".$student_id.") and s.id=e.fk_stu_id and e.class='Graduation' and tj.job_id=".$job_id." 
and tj.college_id=".$college_id." GROUP BY s.id";

  $jobDetails=mysql_query($getSql) or die('Error:'.mysql_error());
  
  while($row=mysql_fetch_array($jobDetails)){
        $type=$row['type'];
        $firstname=$row['firstname'];
        $email=$row['email'];
        $usn=$row['usn'];
        $gender=$row['gender'];
        $end_year=$row['end_year'];
        $branch=$row['branch'];
        $sasecuredlary=$row['secured'];
        $id=$row['id'];
        $job_id=$row['job_id'];
        $colleg_id=$row['colleg_id'];
        $student_id=$row['stu_id'];
        $clg_approval   =$row['clg_approval'];
        $resume_name   =$row['resume_name'];

        $getJobDetails[]=array('type' =>$type,
            'firstname' =>$firstname,
            'email' =>$email,
            'usn' =>$usn,
            'gender' =>$gender,
            'end_year' =>$end_year,
            'branch' =>$branch,
            'secured' => $secured,
            'job_id' => (int)$job_id,        
            'colleg_id' => (int)$colleg_id,        
            'student_id' => (int)$student_id,
            'clg_approval' => (int)$clg_approval,
            'resume_name' => $resume_name
        );
        
    }

    $status['loadJobDetails'] = $getJobDetails;
    echo json_encode($status);
    mysqli_close($con);
}


/* Approve JOBS */
if(isset($_POST['approve'])){

  $rec_id=$_POST['rec_id'];
  $college_id=$_POST['college_id'];
  $code=$_POST['code'];
  
    if($code != 101){

        $table='track_job';
        $DataMarge=array( 'job_id'=>$rec_id,
                            'college_id'=>$college_id,
                            'status'=>1,
                            'clg_approval'=>1,
                            'student_id'=>0                    
                        );        
        // Function say generate complete query        
        $sqlQuery = mysql_insert_array($table, $DataMarge, "submit");
        $jobDetailsDelete=mysql_query($sqlQuery) or die('Error:'.mysql_error());

            if(!$jobDetailsDelete) {
                $error="Server Error !!";
                $response['info']=$error;
                $response['infoRes']='E'; //Error
            }else {
                $response['info']="Job Approved Successfully";
                $response['infoRes']="S"; // success
            }

    }else{

        $table='track_job';
        $DataMarge=array( 'job_id'=>$rec_id,
                          'college_id'=>$college_id,
                          'clg_to_hr_status'=>1             
                        );        
        // Function say generate complete query        
        //$sqlQuery = mysql_insert_array($table, $DataMarge, "submit");     

        $cond = ' job_id='.$rec_id.' and college_id='.$college_id;
        $sqlQuery = mysql_update_array($table, $DataMarge, "submit",$cond); 
        $jobDetailsDelete=mysql_query($sqlQuery) or die('Error:'.mysql_error());


            if(!$jobDetailsDelete) {
                $error="Server Error !!";
                $response['info']=$error;
                $response['infoRes']='E'; //Error
            }else {
                $response['info']="Job Approved Successfully";
                $response['infoRes']="S"; // success
            }
        
    }

    
    $status['data'] = $response;
    echo json_encode($status);
    mysqli_close($con);
}



?>