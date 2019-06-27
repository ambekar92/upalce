<?php
 include('db.php');
/* Show Project Details IN Popup Model */
if(isset($_GET['save_link']))
{
	$admin_id = $_GET['admin_id'];
	$link_name = $_GET['link_name'];
	
	$get_srch_q = "SELECT query from admin_search WHERE fk_ad_admin_id=$admin_id";
	$srch_data= mysql_query($get_srch_q);
	while($row_data=mysql_fetch_array($srch_data)) 
	{
		$value= $row_data['query'];
	}
	
	$data= addslashes($value);
	//echo $value;
	if($value != ''){
		$query ="insert into data_for_comp(fk_admin_id,data,link_name) values('$admin_id','$data','$link_name')"; 
		$result = mysql_query($query) or die("Probelm in Network Q !!".mysql_error());
		if($result){
			echo "Link Saved Successfully";
		}else{
			echo "Probelm in Network R !!";
		}
	}else{
	echo "Probelm in Network M !!";
	}		
}


if(isset($_GET['select']))
{
	$ad_id=$_GET['admin_id'];

		$table='data_for_comp';
		$whereCond="fk_admin_id='$ad_id'";	
		$Query = 'select * from '.$table.' where '.$whereCond;
		$placed_data = mysql_query($Query) or die("Error in Selection Query <br> ".$Query."<br>". mysql_error());

			while($row=mysql_fetch_array($placed_data)){ 
					$id=$row['id'];
					$link_name=$row['link_name']; 
					$data=$row['data'];                                    
					$status=$row['status'];                                       
					$duration=$row['duration'];                                      
					
				$final[]=array($id,$link_name,$data,$status,$duration);
			}
				
				//$final=array($id,$college_name);
				$status["data"] = $final;
			
				//print_r();
				$json_final = json_encode($final);
				echo $json_final;
				
			/* 	if($json_final != '{"data":null}'){
					echo $json_final;
				}else{
					echo "0";
				} */
}



if(isset($_GET['update']))
{
	$admin_id = $_GET['admin_id'];
	$link_name = $_GET['link_name'];
	
	$get_srch_q = "SELECT query from admin_search WHERE fk_ad_admin_id=$admin_id";
	$srch_data= mysql_query($get_srch_q);
	while($row_data=mysql_fetch_array($srch_data)) 
	{
		$value= $row_data['query'];
	}
	
	$data= addslashes($value);
	//echo $value;
	if($value != ''){
		$query ="insert into data_for_comp(fk_admin_id,data,link_name) values('$admin_id','$data','$link_name')"; 
		$result = mysql_query($query) or die("Probelm in Network Q !!".mysql_error());
		if($result){
			echo "Link Saved Successfully";
		}else{
			echo "Probelm in Network R !!";
		}
	}else{
	echo "Probelm in Network M !!";
	}		
}



?>