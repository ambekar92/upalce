<?php
error_reporting(0);
include('db.php');

if(isset($_POST["graph_one"]))
{
	$year=$_POST["year"];
	$ad_clg_id=$_POST["ad_clg_id"];

	$sql = "SELECT branch_code,id FROM branchs WHERE id  IN (SELECT e.branch_id FROM stu_education e, stu_student s where e.class='Graduation' and e.end_year='".$year."' and 
			e.fk_stu_id=s.id and s.college_id='".$ad_clg_id."')";
	$br_code = mysql_query($sql) or die("Error in Selection Query <br> ".$sql."<br>". mysql_error());
	
	$count_brCode=mysql_num_rows($br_code);	
	if($count_brCode>0){
	//$branch_arr=Array();
		while($row=mysql_fetch_array($br_code)){ 
			$branch_arr[]=$row['branch_code'];
			$branch_arr_id[]=$row['id'];	
		}
	//print_r($branch_arr);
		
		for($i=0;$i<sizeof($branch_arr);$i++)
		{
	 	$sql = "SELECT count(e.branch_id) from stu_education e, stu_student s 
		where  s.id=e.fk_stu_id and e.branch_id=$branch_arr_id[$i] and e.class='Graduation' and s.college_id=$ad_clg_id and e.end_year=$year "  ;
		$br_code_data = mysql_query($sql);
		$data[]=mysql_result($br_code_data , 0);
		}
	//print_r($data);
	
			for($j=0;$j<sizeof($branch_arr);$j++)
			{
				$status["Branch"] = $branch_arr[$j];
				$status["Students"] = $data[$j];
				$final_data[]=$status;
			}
		echo json_encode($final_data);	
	}else{
		echo '0';
	}
 } 

if(isset($_POST["getYears"]))
{
	$year=$_POST["year"];
	//$year=2017;
	$c_y=$year;
	$c_yy=$year;
     for($i=1;$i<=8;$i++){
     	 $c_y=$c_y+1;
     	 $next_years[]=$c_y;
     }

     for($i=1;$i<=8;$i++){
     	 $c_yy=$c_yy-1;
     	 $past_years[]=$c_yy;
     }
     array_push($past_years,$year);
		asort($next_years);
		asort($past_years);
	    $final_data=array_merge($past_years,$next_years);
	  

	  //print_r($final_data);

      $status['years']=$final_data;
      echo json_encode($status);
}
//--------------------------------------------------------------------------------------------------------------------------------

?>