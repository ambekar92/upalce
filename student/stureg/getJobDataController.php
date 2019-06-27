<?php
include('db.php');


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



/* get all Saved JOB */
if(isset($_POST['getJobDetails'])){

  $comp_id=$_POST['comp_id'];
  $stu_id=$_POST['stu_id'];
  
  $getSql="SELECT jp.id,jp.reg_comp_id,jp.type,jp.publish,jp.job_id,jp.title,jp.descp,jp.requirement,jp.no_position,jp.location,jp.contact_email,jp.salary,jp.last_date,jp.modified,
	c.profile_img,c.comp_name,jp.comp_job_id  
	FROM co_job_posted jp,ad_companies c 
	WHERE type IN ('G','F') and publish=1 and jp.reg_comp_id=c.id and jp.id NOT IN (SELECT tj.job_id FROM track_job tj WHERE tj.student_id=".$stu_id.")";
    
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
        $last_date=date('d/	m/Y', strtotime($row['last_date']));
        $modified=$row['modified'];
        $publish=$row['publish'];
        $comp_name=$row['comp_name'];
        $profile_img=$row['profile_img'];
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
            'comp_name' => "$comp_name",
            'profile_img' => "$profile_img",
            'comp_job_id' => "$comp_job_id",
        );
        
    }

    $status['loadJobDetails'] = $getJobDetails;
    echo json_encode($status);
    mysqli_close($con);
}

/* get all Applied JOB */
if(isset($_POST['getAplliedJobDetails'])){

  $comp_id=$_POST['comp_id'];
  $stu_id=$_POST['stu_id'];
  
  $getSql="SELECT jp.id,jp.reg_comp_id,jp.type,jp.publish,jp.job_id,jp.title,jp.descp,jp.requirement,jp.no_position,jp.location,jp.contact_email,jp.salary,jp.last_date,jp.modified,
	c.profile_img,c.comp_name,jp.comp_job_id 
	FROM co_job_posted jp,ad_companies c 
	WHERE type IN ('G','F','I') and publish=1 and jp.reg_comp_id=c.id and jp.id IN (SELECT tj.job_id FROM track_job tj WHERE tj.student_id=".$stu_id." order by tj.id desc)";
    
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
        $last_date=date('d/	m/Y', strtotime($row['last_date']));
        $modified=$row['modified'];
        $publish=$row['publish'];
        $comp_name=$row['comp_name'];
        $profile_img=$row['profile_img'];
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
            'comp_name' => "$comp_name",
            'profile_img' => "$profile_img",
            'comp_job_id' => "$comp_job_id",
        );        
    }

    $status['loadJobDetails'] = $getJobDetails;
    echo json_encode($status);
    mysqli_close($con);
}


/* applyJob JOB */
if(isset($_POST['applyJob'])){

  $stu_college_id=$_POST['stu_college_id'];
  $stu_id=$_POST['stu_id'];
  $job_id=$_POST['job_id'];
  
        $DataMarge=array('job_id'=>$job_id,
                    'student_id'=>$stu_id,
                    'colleg_id'=>$stu_college_id,
                    'status'=>1
                );
        $table='track_job';
        // Function say generate complete query        
        $sqlQuery = mysql_insert_array($table, $DataMarge, "submit"); 
        //echo $sqlQuery;
        $res=mysql_query($sqlQuery); //or die('Error: ' . mysql_error($con));
        
        if(!$res) {
            $error="Server Error !!";
            $response['info']=$error;
            $response['infoRes']='E'; //Error
        }else {
            if(mysql_errno() != 1062){
                $response['info']="Job Applied Successfully";
                $response['infoRes']="S"; // success
                $response['mysqli_insert_id']=mysql_insert_id($con);
            }else{
                $error="Job Already Applied";
                $response['info']=$error;
                $response['infoRes']='E'; //Error
            }            
        }
        
        $status["data"] =$response;
        echo json_encode($status);  
}



/* get all Saved JOB */
if(isset($_POST['getInterJobDetails'])){

  $comp_id=$_POST['comp_id'];
  $stu_id=$_POST['stu_id'];
  
  $getSql="SELECT jp.id,jp.reg_comp_id,jp.type,jp.publish,jp.job_id,jp.title,jp.descp,jp.requirement,jp.no_position,jp.location,jp.contact_email,jp.salary,jp.last_date,jp.modified,
	c.profile_img,c.comp_name,jp.comp_job_id  
	FROM co_job_posted jp,ad_companies c 
	WHERE type IN ('I') and publish=1 and jp.reg_comp_id=c.id and jp.id NOT IN (SELECT tj.job_id FROM track_job tj WHERE tj.student_id=".$stu_id.")";
    
 // echo $getSql; 
   
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
        $last_date=date('d/	m/Y', strtotime($row['last_date']));
        $modified=$row['modified'];
        $publish=$row['publish'];
        $comp_name=$row['comp_name'];
        $profile_img=$row['profile_img'];
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
            'comp_name' => "$comp_name",
            'profile_img' => "$profile_img",
            'comp_job_id' => "$comp_job_id",
        );
        
    }

    $status['loadJobDetails'] = $getJobDetails;
    echo json_encode($status);
    mysqli_close($con);
}


?>