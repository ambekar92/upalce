<?php 
 include('../adminreg/db.php');
 //date_default_timezone_set('Asia/Kolkata');


if(isset($_POST['loadCompaData'])){

$sql2="SELECT id as id,comp_name as comp_name from companies";
$getName2 = mysql_query($sql2) or die("Error :".mysql_error());
        
        //echo  $sql2;
    while ($row=mysql_fetch_array($getName2)) 
    {
       $id=$row['id'];
       $comp_name=$row['comp_name']; 
       $getAllComp[]=array('id' =>"$id",'comp_name' =>"$comp_name");
    }

        $status["CompData"] =$getAllComp;
        $final_data=$status;
        echo json_encode($final_data);  

}


if(isset($_POST['loadIndusData'])){

$sql2="SELECT id as id,industry_name as industry_name from industry_type";
$getName2 = mysql_query($sql2) or die("Error :".mysql_error());
        
        //echo  $sql2;
    while ($row=mysql_fetch_array($getName2)) 
    {
       $id=$row['id'];
       $industry_name=$row['industry_name'];
       $getAllindustry[]=array('id' =>"$id",'industry_name' =>"$industry_name");
    }

        $status["industryData"] =$getAllindustry;
        $final_data=$status;
        echo json_encode($final_data);  

}


if(isset($_POST['checkemail'])){

  $email=$_POST["email"];
  $sql = "SELECT email FROM ad_companies WHERE email = '$email'";
  //echo $sql;
  $result = mysql_query($sql) or die("Error in Selection Query <br> ".$sql."<br>". mysql_error());
  $num_rows = mysql_num_rows($result);
 //echo $select;
 
  if ($num_rows) {
    $res= "<p class='errorMsg'> The email already exists. </p>";
  }
  else
  {
    $res= "<p class='errorMsg'> Sucess </p>";
  }

        $status["mailDesc"] =$res;
        $final_data=$status;
        echo json_encode($final_data);  

}



if(isset($_POST['overviewReport'])){

  $comp_id=$_POST["comp_id"];

    $sql = "SELECT
            COUNT(case when type='F' then type end) as fresher,
			      COUNT(case when type='F' and publish=1 then type end) as fresher_publish,
            COUNT(case when type='I' then type end) as internship,
            COUNT(case when type='I' and publish=1 then type end) as internship_publish
            from co_job_posted where reg_comp_id=".$comp_id;

    //echo $sql;
    $result = mysql_query($sql);// or die("Error in Selection Query <br> ".$sql."<br>". mysql_error());
    $num_rows = mysql_num_rows($result);
  
    while ($row=mysql_fetch_array($result)) 
    {
       $fresher=$row['fresher'];
       $internship=$row['internship'];
       $fresher_publish=$row['fresher_publish'];
       $internship_publish=$row['internship_publish'];

       $obj=array(
                    'fresher' =>$fresher,
                    'internship' =>$internship,
                    'fresher_publish' =>$fresher_publish,
                    'internship_publish' =>$internship_publish
                      );
    }

        $status["data"] =$obj;
        $final_data=$status;
        echo json_encode($final_data);  
  
  }



  




?>