<?php
error_reporting(0);
include('db.php');

$ad_id=$_GET['admin_id'];

$table='ad_placed_stu';
$whereCond="ad_admin_id='$ad_id'";	
$Query = 'select * from '.$table.' where '.$whereCond;
$placed_data = mysql_query($Query) or die("Error in Selection Query <br> ".$Query."<br>". mysql_error());

	while($row=mysql_fetch_array($placed_data)){ 
			$id=$row['id'];
			$ad_admin_id=$row['ad_admin_id']; 
			$stu_usn=$row['stu_usn'];                                    
			$stu_name=$row['stu_name'];                                       
			$stu_mobile=$row['stu_mobile'];                                      
			$stu_branch=$row['stu_branch'];                                            
			$stu_passing_year=$row['stu_passing_year'];     
			
			$email_id=$row['email_id'];     
			$comp_1=$row['comp_1'];     
			$comp_2=$row['comp_2'];     
			$comp_3=$row['comp_3'];     
			$comp_4=$row['comp_4'];     
			$total_comp=$row['total_comp'];     
	
			
			$final[]=array('stu_id' =>$id,'ad_admin_id' =>$ad_admin_id,'stu_usn' =>$stu_usn,'stu_name' =>$stu_name,'stu_mobile' =>$stu_mobile,'stu_branch' =>$stu_branch,
							'stu_passing_year' =>$stu_passing_year,'stu_email_id' =>$email_id,'comp_1' =>$comp_1,'comp_2' =>$comp_2,'comp_3' =>$comp_3,'comp_4' =>$comp_4,
							'total_comp' =>$total_comp);
		}
				
				//$final=array($id,$college_name);
				$status["data"] = array_values($final);
			
				//echo json_encode($status);
				$json_final = json_encode($status);
				if($json_final != '{"data":null}'){
					echo $json_final;
				}else{
					echo "0";
				}
?>
