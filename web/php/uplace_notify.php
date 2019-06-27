<?php
error_reporting(0);
if ($_SERVER['HTTP_HOST'] == 'localhost:8088') {
$connection=mysql_connect("localhost","root","") or DIE('connection failed');
mysql_select_db("project_2016_01") or DIE('Database name is not available!');
}
else{
mysql_connect("localhost","uplacvyo_admin","admin@123") or DIE('connection failed');
mysql_select_db("uplacvyo_common_db") or DIE('Database name is not available!');
}

$table='uplace_update';
//$whereCond="ad_admin_id='$ad_id'";	
$Query = 'select * from '.$table;
$placed_data = mysql_query($Query) or die("Error in Selection Query <br> ".$Query."<br>". mysql_error());

	while($row=mysql_fetch_array($placed_data)){ 
			$id=$row['id'];
			$subject=$row['subject']; 
			$message=$row['message'];                                    
			$modified=$row['modified'];                                    
		
		$final[]=array('id'=>$id,'subject'=>$subject,'message'=>$message,'modified'=>$modified);
		}
				
				//$final=array($id,$college_name);
				$status["data"] = $final;
			
				//echo json_encode($status);
				$json_final = json_encode($status);
				if($json_final != '{"data":null}'){
					echo $json_final;
				}else{
					echo "0";
				}
?>
