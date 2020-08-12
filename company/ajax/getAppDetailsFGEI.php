<?php
include('../adminreg/db.php');
/*
    JOB Type
  * F - Fresher 
  * E - Experience 
  * G - Graduated 
  * I - Internship
*/ 



/* get all Saved JOB */
if(isset($_POST['getJobDetails'])){

  $comp_id=$_POST['comp_id'];
  $type=$_POST['type'];  

  // $getSql="SELECT id,reg_comp_id,type,job_id,title,descp,requirement,no_position,location,contact_email,
  //   salary,last_date,modified,publish,comp_job_id FROM co_job_posted WHERE reg_comp_id=".$comp_id." and publish=1 order by last_date DESC" ;

  $getSql="SELECT jp.id,jp.reg_comp_id,jp.type,jp.job_id,jp.title,jp.descp,jp.requirement,jp.no_position,jp.location,jp.contact_email,contact_name,contact_number,
  jp.salary,jp.last_date,jp.modified,jp.publish,count(tj.college_id) as college_count,
  (length(tj.student_id) - length(replace(tj.student_id, ',', '')) + 1) as stu_count
  FROM co_job_posted jp,track_job tj
  WHERE jp.id=tj.job_id and jp.reg_comp_id=".$comp_id." and jp.publish=1 and tj.clg_to_hr_status=1  
  group by jp.id order by jp.last_date DESC" ;
    
  $jobDetails=mysql_query($getSql) or die('Error:'.mysql_error());
  
  while($row=mysql_fetch_array($jobDetails)){
        $id=$row['id'];
        $reg_comp_id=$row['reg_comp_id'];
        $type=$row['type'];
        $job_id=$row['job_id'];
        $title=$row['title'];
        $descp=$row['descp'];
        $requirement=$row['requirement'];
        $no_position=$row['no_position'];
        $location=$row['location'];
        $contact_name=$row['contact_name'];
        $contact_number=$row['contact_number'];
        $contact_email=$row['contact_email'];
        $salary=$row['salary'];
        $last_date=date('d/m/Y', strtotime($row['last_date']));
        $modified=$row['modified'];
        $publish=$row['publish'];
        $college_count=$row['college_count'];
        $stu_count=$row['stu_count'];

        if($stu_count==0){
          $stu_count=0;
        }else{
          $stu_count=$stu_count-1;
        }

        $getJobDetails[]=array('id' =>"$id",
            'reg_comp_id' =>"$reg_comp_id",
            'type' =>"$type",
            'job_id' =>"$job_id",
            'title' =>"$title",
            'descp' =>"$descp",
            'requirement' =>"$requirement",
            'no_position' => "$no_position",
            'location' => "$location",
            'contact_name' => "$contact_name",
            'contact_number' => "$contact_number",
            'contact_email' => "$contact_email",
            'salary' => "$salary",
            'last_date' => "$last_date",
            'modified' => "$modified",
            'publish' => "$publish",
            'college_count' => "$college_count",
            'stu_count' => "$stu_count"
        );
        
    }

    $status['loadJobDetails'] = $getJobDetails;
    echo json_encode($status);
    mysqli_close($con);
}



/* get all College List */
if(isset($_POST['getCollegeList'])){

  $comp_id=$_POST['comp_id'];
  $job_id=$_POST['job_id'];  

 $getSql="SELECT jp.title,jp.job_id,tj.id as id,aa.clg_id as clg_id,clg_name,email,mobile_number,current_location,state,contact_person_1,mobile_number_1,email_id_1,(length(student_id) - length(replace(student_id, ',', '')) + 1) as stu_count
 FROM track_job tj,ad_admin aa,co_job_posted jp
WHERE tj.job_id=".$job_id." and tj.clg_to_hr_status=1 and tj.college_id=aa.clg_id group by tj.college_id";
    
  $jobDetails=mysql_query($getSql) or die('Error:'.mysql_error());
  
  while($row=mysql_fetch_array($jobDetails)){
        $id=$row['id'];
        $clg_id=$row['clg_id'];
        $clg_name=$row['clg_name'];
        $email=$row['email'];
        $mobile_number=$row['mobile_number'];
        $current_location=$row['current_location'];
        $state=$row['state'];
        $contact_person_1=$row['contact_person_1'];
        $mobile_number_1=$row['mobile_number_1'];
        $email_id_1=$row['email_id_1'];
        $stu_count=$row['stu_count'];
        $title=$row['title'];
        $job_id=$row['job_id'];

        if($stu_count==0){
            $stu_count=0;
        }else{
            $stu_count=$stu_count-1;
        }

        $getJobDetails[]=array('clg_name' =>"$clg_name",
            'id' =>"$id",
            'clg_id' =>"$clg_id",
            'email' =>"$email",
            'mobile_number' =>"$mobile_number",
            'current_location' =>"$current_location",
            'state' =>"$state",
            'contact_person_1' =>"$contact_person_1",
            'mobile_number_1' =>"$mobile_number_1",
            'email_id_1' => "$email_id_1",
            'stu_count' => "$stu_count",
            'title' => "$title",
            'job_id' => "$job_id",
        );
        
    }

    $status['loadClgDetails'] = $getJobDetails;
    echo json_encode($status);
    mysqli_close($con);
}


/* get all Student List */
if(isset($_POST['getStudentList'])){

  $college_id=$_POST['college_id'];
  $job_id=$_POST['job_id'];  

//$getSql="SELECT ss.id as id,job_id,student_id,colleg_id,type,random_num_gen,firstname 
//from track_job tj,stu_student ss
//where tj.job_id='".$job_id."' and colleg_id='".$college_id."' and tj.student_id=ss.id";
    
// $getSql="SELECT ss.id as id,job_id,student_id,colleg_id,type,random_num_gen,firstname,se.class as class,
// se.branch as branch,se.secured as be_perc,stu10.secured as 10s_perc,stu12.secured as 12s_perc 
// from track_job tj,stu_student ss, stu_education se,stu_edu_10 stu10,stu_edu_12 stu12
// where tj.job_id='".$job_id."' and tj.clg_approval=1 and colleg_id='".$college_id."' and tj.student_id=ss.id and se.fk_stu_id=ss.id and se.class Not IN (10,12) and ss.id=stu10.fk_stu_id and ss.id=stu12.fk_stu_id";   

$getStu="select student_id from track_job where job_id=".$job_id." and college_id=".$college_id;
$getStuRes=mysql_query($getStu) or die('Error:'.mysql_error());

  while($row=mysql_fetch_array($getStuRes)){
    $student_id=$row['student_id'];
  }

$getSql="SELECT s.resume_name,s.id as stu_id,tj.clg_approval,tj.id,tj.job_id as job_id,tj.college_id,tj.student_id,jp.type,
s.firstname,s.email,s.usn,s.gender,e.end_year,
MAX(if(e.class='10',e.secured,'-')) as 10s_perc,
MAX(if(e.class='12',e.secured,'-')) as 12s_perc,
MAX(if(e.class='Graduation',e.secured,'-')) as be_perc,
MAX(if(e.class='Graduation',e.branch,'-')) as branch 
FROM track_job tj,co_job_posted jp,stu_student s,stu_education e 
WHERE s.id IN (".$student_id.") and s.id=e.fk_stu_id and tj.job_id=".$job_id."  
and tj.college_id=".$college_id." GROUP BY s.id";   

  $jobDetails=mysql_query($getSql) or die('Error:'.mysql_error());
  
  while($row=mysql_fetch_array($jobDetails)){
        $id=$row['id'];
        $job_id=$row['job_id'];
        $student_id=$row['stu_id'];
        $type=$row['type'];
        $firstname=$row['firstname'];
        $branch=$row['branch'];
        $be_perc=$row['be_perc'];
        $_10s_perc=$row['10s_perc'];
        $_12s_perc=$row['12s_perc'];
        $usn=$row['usn'];
        $resume_name=$row['resume_name'];
        $sl_no=$sl_no+1;
       
        $getJobDetails[]=array('student_id' =>"$student_id",
            'id' =>"$id",
            'job_id' =>"$job_id",
            'colleg_id' =>"$colleg_id",
            'type' =>"$type",
            'firstname' =>"$firstname",
            'branch' =>"$branch",
            'be_perc' =>"$be_perc",
            '10s_perc' =>"$_10s_perc",
            '12s_perc' =>"$_12s_perc",           
            'usn' =>"$usn",           
            'sl_no' =>"$sl_no",           
            'resume_name' =>"$resume_name",           
        );
        
    }

    $status['loadStudentDetails'] = $getJobDetails;
    echo json_encode($status);
    mysqli_close($con);
}




?>