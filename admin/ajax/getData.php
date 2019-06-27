<?php
 //include('../../common_db.php'); 
 include('../adminreg/db.php');
 //date_default_timezone_set('Asia/Kolkata');

if(isset($_POST['getTotal'])){
	/*$sql="select COUNT(invoice_no) as invoice_no,SUM(income) as income, SUM(gross_value) as gross_value, 
            SUM(REPLACE(`gross_value_incl`, ',', '')) as gross_value_incl from chart_info";*/
    $clg_id=$_POST['clg_id'];
    $fk_clg_id=$_POST['fk_clg_id'];
    $year=$_POST['year'];
    $getClass=$_POST["className"];

$sql="select distinct (select count(s.id) as student_count from stu_student s,stu_education e where s.college_id=".$clg_id." and e.class='".$getClass."' and e.fk_stu_id=s.id and e.end_year='".$year."') as student_count, 

(select count(n.id) as notify_count from notifications n where n.fk_clg_id=".$fk_clg_id.") as notify_count,

(select count(s.id) as male_count from stu_student s,stu_education e where s.college_id=".$clg_id." and gender='male' and e.class='".$getClass."' and e.fk_stu_id=s.id and e.end_year='".$year."' ) as male_count,

(select count(s.id) as female_count from stu_student s,stu_education e where s.college_id=".$clg_id." and gender='female' and e.class='".$getClass."' and e.fk_stu_id=s.id and e.end_year='".$year."') as female_count,

(select count(s.id) as inactive_count from stu_student s,stu_education e where s.college_id=".$clg_id." and status='inactive' and e.class='".$getClass."' and e.fk_stu_id=s.id and e.end_year='".$year."') as inactive_count,

(select count(s.id) as perm_count from stu_student s,stu_education e where s.college_id=".$clg_id." and project_link_status='A' and e.class='".$getClass."' and e.fk_stu_id=s.id and e.end_year='".$year."') as perm_count
from stu_student";       
 	$fetch_data = mysql_query($sql);
 	if($fetch_data){

            $value = mysql_fetch_object($fetch_data);
            $student_count = $value->student_count;
            $notify_count = $value->notify_count;
            $male_count = $value->male_count;
            $female_count = $value->female_count;
            $inactive_count = $value->inactive_count;
            $perm_count = $value->perm_count;
            
            $getTotal[]=array('student_count' =>"$student_count",'notify_count' =>"$notify_count",
                'male_count'=>"$male_count",'female_count'=>"$female_count",'inactive_count'=>"$inactive_count",'perm_count'=>"$perm_count");

            $status = array_values($getTotal);
	 		$fin_json["data"]=$status;
	 		echo $json_final = json_encode($fin_json);

 	}else{
		die('Error: ' . mysql_error());
	}
}

if(isset($_POST['loadReport1'])){
    $year=$_POST["year"];
    $ad_clg_id=$_POST["ad_clg_id"];
    $getClass=$_POST["className"];
    $getPercent=$_POST["getPercent"];

    $secured=" and e.secured".$getPercent;

    $sql2="SELECT br.branch_code, count(br.branch_code) as branchCount,count(e.secured) as eligible,e.secured as secured from branchs br, stu_education e,stu_student s where br.id=e.branch_id and e.fk_stu_id=s.id and s.college_id=".$ad_clg_id." and e.class='".$getClass."' and e.end_year=".$year." ". $secured." group by br.branch_code";

        $getName2 = mysql_query($sql2) or die("Error :".mysql_error());
        
        //echo  $sql2;
        while ($row=mysql_fetch_array($getName2)) 
        {
           $branch_code=$row['branch_code'];
           $branch_arr[]=$branch_code;
           //$data[]=floatval($branchCount);

           $eligible=$row['eligible'];
           $eligibleSUM+=$row['eligible'];
           $eligibleData[]=floatval($eligible);
        }

        foreach($branch_arr as $result) {
           $sql2 = "SELECT br.branch_code, count(br.branch_code) as branchCount,count(e.secured) as eligible,e.secured as secured from branchs br, stu_education e,stu_student s where br.id=e.branch_id and e.fk_stu_id=s.id and s.college_id=".$ad_clg_id." and e.class='".$getClass."' and e.end_year=".$year." and br.branch_code='".$result."'";

           $getName = mysql_query($sql2) or die(mysql_error());

           while ($row=mysql_fetch_array($getName)) 
            {
                $branchCount=$row['branchCount'];
                $branchCountSUM+=$row['branchCount'];
                $data[]=floatval($branchCount);
            } 
        }


    if(sizeof($branch_arr)!=0){ 
        $stu_rec[]=array('name'=>'Branches','data' =>$data);
        $stu_rec[]=array('name'=>'Eligible','data' =>$eligibleData);

        $status["Branch"] = $branch_arr;
        $status["Students"] =$stu_rec;
        $status["eligibleSUM"] =$eligibleSUM;
        $status["branchCountSUM"] =$branchCountSUM;
        $final_data=$status;
        echo json_encode($final_data);  
    }else{
        $status['data'] = 0;   
        echo json_encode($status);
    }

}

if(isset($_POST['getDetailedReport'])){
    $year=$_POST["year"];
    $ad_clg_id=$_POST["ad_clg_id"];
    $getClass=$_POST["className"];
    $getPercent=$_POST["getPercent"];

    $secured=" and e.secured".$getPercent;

$sql2="SELECT s.firstname as firstname,s.email as email,s.usn as usn,s.mobile as mobile,s.gender as gender,br.branch_name as branch_name,e.class as class,e.secured as secured  from branchs br, stu_education e,stu_student s where br.id=e.branch_id and e.fk_stu_id=s.id and s.college_id=".$ad_clg_id." and e.class='".$getClass."' and e.end_year=".$year." ". $secured." order by secured DESC";

        $getName2 = mysql_query($sql2) or die("Error :".mysql_error());
        
        //echo  $sql2;
        while ($row=mysql_fetch_array($getName2)) 
        {
           $usn=$row['usn'];
           $firstname=$row['firstname'];
           $email=$row['email'];
           $mobile=$row['mobile'];
           $gender=$row['gender'];
           $class=$row['class'];           
           $branch_name=$row['branch_name'];
           $secured=$row['secured'];

  $getAllStu[]=array('usn' =>"$usn",'firstname' =>"$firstname",'email'=>"$email",'mobile'=>"$mobile",'gender'=>"$gender",'class'=>"$class",'branch_name'=>"$branch_name",'secured'=>"$secured");
        }


        $status["stuData"] =$getAllStu;
        $final_data=$status;
        echo json_encode($final_data);  

}

?>