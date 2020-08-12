<?php
include('../adminreg/db.php');
/*
    JOB Type
  * F - Fresher 
  * E - Experience 
  * G - Graduated 
  * I - Internship
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

/* Save JOB */
if(isset($_POST['saveJob'])){

    $comp_id=$_POST['comp_id'];
    $job_type=$_POST['job_type'];

    $record_id=$_POST['record_id'];

    $selDate= explode("/",$_POST['last_date']);// getting only Dateval
    $last_date= $selDate[2].'-'.$selDate[1].'-'.$selDate[0];

    $job_title=$_POST['job_title'];
    $no_position=$_POST['no_position'];
    $requirement=$_POST['requirement'];
    $descp=$_POST['descp'];
    $location=$_POST['location'];
    $contact_name=$_POST['contact_name'];
    $contact_number=$_POST['contact_number'];
    $contact_email=$_POST['contact_email'];
    $salary=$_POST['salary'];
    $comp_job_id=$_POST['job_id'];
    
    $colleges=$_POST['colleges'];
    
    if($colleges==''){
        $colleges='[]';   
    }else{
        $colleges= serialize($_POST['colleges']);
    }
    

    // echo $colleges;
    // die;

    //serialize([Array]);
    //unserialize([Serialized value]);
    //echo "<pre>";
    //print_r(serialize($colleges));
    //echo "</pre>";

    //echo "<pre>";
    //print_r(unserialize($colleges));
    //echo "</pre>";


    $job_id = 'JOB_REG_'.rand(1111111111,9999999999);
    $table = 'co_job_posted';

//echo $last_date;

    if($record_id == ""){

        $DataMarge=array('reg_comp_id'=>$comp_id,
                    'type'=>$job_type,
                    'job_id'=>$job_id,
                    'title'=>$job_title,
                    'descp'=>$descp,
                    'requirement'=>$requirement,
                    'no_position'=>$no_position,
                    'location'=>$location,
                    'contact_name'=>$contact_name,
                    'contact_number'=>$contact_number,
                    'contact_email'=>$contact_email,
                    'salary'=>$salary,
                    'last_date'=>$last_date,
                    'comp_job_id'=>$comp_job_id,
                    'clg_id'=>$colleges
                );
        
        // Function say generate complete query        
        $sqlQuery = mysql_insert_array($table, $DataMarge, "submit"); 
        //die();
        $res=mysql_query($sqlQuery); //or die('Error: ' . mysql_error($con));
        
        if(!$res) {
            $error="Server Error !!";
            $response['info']=$error;
            $response['infoRes']='E'; //Error
        }else {
            if(mysql_errno() != 1062){
                $response['info']="Record Successfully";
                $response['infoRes']="S"; // success
                $response['mysqli_insert_id']=mysql_insert_id($con);
            }else{
                $error="Record Already Exists";
                $response['info']=$error;
                $response['infoRes']='E'; //Error
            }            
        }
      }else{
       $DataMarge=array('reg_comp_id'=>$comp_id,
                    'type'=>$job_type,
                    'job_id'=>$job_id,
                    'title'=>$job_title,
                    'descp'=>$descp,
                    'requirement'=>$requirement,
                    'no_position'=>$no_position,
                    'location'=>$location,
                    'contact_name'=>$contact_name,
                    'contact_number'=>$contact_number,
                    'contact_email'=>$contact_email,
                    'salary'=>$salary,
                    'last_date'=>$last_date,
                    'comp_job_id'=>$comp_job_id,
                    'clg_id'=>$colleges
                );

        $cond=' id='.$record_id;
        $sqlQuery = mysql_update_array($table, $DataMarge, "submit",$cond); // Function say generate complete query
        // echo $sqlQuery;
        // die();
        
        $res=mysql_query($sqlQuery); //or die('Error: ' . mysql_error($con));
        
        if(!$res) {
            $error="Server Error !!";
            $response['info']=$error;
            $response['infoRes']='E'; //Error
        }else {
            if(mysql_errno() != 1062){
                $response['info']="Record Successfully";
                $response['infoRes']="S"; // success
                $response['mysqli_insert_id']=mysql_insert_id($con);
            }else{
                $error="Record Already Exists";
                $response['info']=$error;
                $response['infoRes']='E'; //Error
            }            
        }
      }

        $status["data"] =$response;
        echo json_encode($status);  
}


/* get all Saved JOB */
if(isset($_POST['getSavedJobDetails'])){

  $comp_id=$_POST['comp_id'];
  $type=$_POST['type'];
  
  $getSql="SELECT id,reg_comp_id,type,job_id,title,descp,requirement,no_position,location,contact_name,contact_number,contact_email,salary,last_date,modified,publish,comp_job_id,clg_id FROM co_job_posted WHERE reg_comp_id=".$comp_id." and type='".$type."'";
    
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
        $comp_job_id=$row['comp_job_id'];
        $clg_id=$row['clg_id'];

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
            'comp_job_id' => "$comp_job_id",
            'clg_id' => unserialize($clg_id),
        );
        
    }

    $status['loadJobDetails'] = $getJobDetails;
    echo json_encode($status);
    mysqli_close($con);
}

/* Delete JOB */
if(isset($_POST['deleteJob'])){

  $delete_id=$_POST['delete_id'];
  $del ="DELETE FROM co_job_posted WHERE id=".$delete_id;
  $jobDetailsDelete=mysql_query($del) or die('Error:'.mysql_error());

  if(!$jobDetailsDelete) {
        $error="Server Error !!";
        $response['info']=$error;
        $response['infoRes']='E'; //Error
    }else {
        $response['info']="Record Deleted Successfully";
        $response['infoRes']="S"; // success
    }
    
    $status['data'] = $response;
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