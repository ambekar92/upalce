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

  $getSql="SELECT id,reg_comp_id,type,job_id,title,descp,requirement,no_position,location,contact_email,
    salary,last_date,modified,publish,comp_job_id FROM co_job_posted WHERE reg_comp_id=".$comp_id." and type='".$type."' and publish=1" ;
    
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
        $contact_email=$row['contact_email'];
        $salary=$row['salary'];
        $last_date=date('d/m/Y', strtotime($row['last_date']));
        $modified=$row['modified'];
        $publish=$row['publish'];
        $comp_job_id=$row['comp_job_id'];

        $getJobDetails[]=array('id' =>"$id",
            'reg_comp_id' =>"$reg_comp_id",
            'type' =>"$type",
            'job_id' =>"$job_id",
            'title' =>"$title",
            'descp' =>"$descp",
            'requirement' =>"$requirement",
            'no_position' => "$no_position",
            'location' => "$location",
            'contact_email' => "$contact_email",
            'salary' => "$salary",
            'last_date' => "$last_date",
            'modified' => "$modified",
            'publish' => "$publish",
            'comp_job_id' => "$comp_job_id",
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

 $getSql="SELECT tj.id as id,clg_id,clg_name,email,mobile_number,current_location,state,contact_person_1,mobile_number_1,email_id_1
 FROM track_job tj,ad_admin aa
WHERE job_id=".$job_id." and tj.colleg_id=aa.clg_id group by tj.colleg_id";
    
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

        $getJobDetails[]=array('clg_name' =>"$clg_name",
            'id' =>"$id",
            'clg_id' =>"$clg_id",
            'email' =>"$email",
            'mobile_number' =>"$mobile_number",
            'current_location' =>"$current_location",
            'state' =>"$state",
            'contact_person_1' =>"$contact_person_1",
            'mobile_number_1' =>"$mobile_number_1",
            'email_id_1' => "$email_id_1"
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
    
$getSql="SELECT ss.id as id,job_id,student_id,colleg_id,type,random_num_gen,firstname,se.class as class,
se.branch as branch,se.secured as be_perc,stu10.secured as 10s_perc,stu12.secured as 12s_perc 
from track_job tj,stu_student ss, stu_education se,stu_edu_10 stu10,stu_edu_12 stu12
where tj.job_id='".$job_id."' and colleg_id='".$college_id."' and tj.student_id=ss.id and se.fk_stu_id=ss.id and se.class Not IN (10,12) and ss.id=stu10.fk_stu_id and ss.id=stu12.fk_stu_id";   

  $jobDetails=mysql_query($getSql) or die('Error:'.mysql_error());
  
  while($row=mysql_fetch_array($jobDetails)){
        $id=$row['id'];
        $job_id=$row['job_id'];
        $student_id=$row['student_id'];
        $colleg_id=$row['colleg_id'];
        $type=$row['type'];
        $random_num_gen=$row['random_num_gen'];
        $firstname=$row['firstname'];
        $class=$row['class'];
        $branch=$row['branch'];
        $be_perc=$row['be_perc'];
        $_10s_perc=$row['10s_perc'];
        $_12s_perc=$row['12s_perc'];
       
        $getJobDetails[]=array('student_id' =>"$student_id",
            'id' =>"$id",
            'job_id' =>"$job_id",
            'colleg_id' =>"$colleg_id",
            'type' =>"$type",
            'random_num_gen' =>"$random_num_gen",
            'firstname' =>"$firstname",
            'class' =>"$class",
            'branch' =>"$branch",
            'be_perc' =>"$be_perc",
            '10s_perc' =>"$_10s_perc",
            '12s_perc' =>"$_12s_perc"           
        );
        
    }

    $status['loadStudentDetails'] = $getJobDetails;
    echo json_encode($status);
    mysqli_close($con);
}




?>