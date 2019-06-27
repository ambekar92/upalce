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

/* get all Saved Company */
if(isset($_POST['getSavedJobDetails'])){

  $college_id=$_POST['college_id'];

  $getSql="SELECT c.id as company_id,profile_img,comp_id,comp_name,email,indus_type,contact_person_1, designation_1, mobile_number_1,email_1,country,state,current_location 
  FROM track_job tj,co_job_posted jp,ad_companies c 
  WHERE tj.job_id=jp.id and jp.reg_comp_id=c.id and colleg_id=".$college_id." GROUP BY company_id";
    
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

  $getSql="SELECT jp.type,jp.id,jp.job_id,jp.title,jp.descp,jp.requirement,jp.no_position,jp.location,
  jp.salary,jp.last_date,jp.comp_job_id  
  FROM track_job tj,co_job_posted jp 
  WHERE tj.job_id=jp.id and jp.reg_comp_id=".$comp_id." and 
  tj.colleg_id=".$college_id." GROUP by jp.job_id";
    
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
        $last_date=$row['last_date'];
        $type=$row['type'];
        $comp_job_id=$row['comp_job_id'];

        $getJobDetails[]=array('job_id' =>"$job_id",
            'id' =>"$id",
            'title' =>"$title",
            'descp' =>"$descp",
            'requirement' =>"$requirement",
            'no_position' =>"$no_position",
            'location' =>"$location",
            'salary' => "$salary",
            'last_date' => "$last_date",          
            'type' => "$type",          
            'comp_job_id' => "$comp_job_id",          
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

  $getSql="SELECT jp.type,s.firstname,s.email,s.usn,s.gender,e.end_year,e.branch,e.secured FROM track_job tj,co_job_posted jp,stu_student s,stu_education e 
     WHERE tj.student_id=s.id and s.id=e.fk_stu_id and class='Graduation' and tj.job_id=".$job_id." 
     and jp.reg_comp_id=".$comp_id." and tj.colleg_id=".$college_id." GROUP BY tj.job_id, tj.student_id";
    
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

        $getJobDetails[]=array('type' =>"$type",
            'firstname' =>"$firstname",
            'email' =>"$email",
            'usn' =>"$usn",
            'gender' =>"$gender",
            'end_year' =>"$end_year",
            'branch' =>"$branch",
            'secured' => "$secured",        
        );
        
    }

    $status['loadJobDetails'] = $getJobDetails;
    echo json_encode($status);
    mysqli_close($con);
}
/* Publish JOB */
if(isset($_POST['publish'])){

  $rec_id=$_POST['rec_id'];
  $del ="UPDATE co_job_posted SET publish=1 WHERE id=".$rec_id;
  $jobDetailsDelete=mysql_query($del) or die('Error:'.mysql_error());

  if(!$jobDetailsDelete) {
        $error="Server Error !!";
        $response['info']=$error;
        $response['infoRes']='E'; //Error
    }else {
        $response['info']="Record Published Successfully";
        $response['infoRes']="S"; // success
    }
    
    $status['data'] = $response;
    echo json_encode($status);
    mysqli_close($con);
}




?>