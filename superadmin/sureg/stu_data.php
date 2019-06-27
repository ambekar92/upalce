<?php
error_reporting(0);
include('db.php');

	/* Fetching the initial data */
		
		
$table='stu_student';
//$whereCond="fk_stu_id='$stu_id'";	 */
$Query = 'select * from '.$table;
$skill_data = mysql_query($Query) or die("Error in Selection Query <br> ".$Query."<br>". mysql_error());

/* 			$data=Array();
 while ($row=mysql_fetch_array($skill_data)) 
{   
	$status["id"] = $row['id'];
	$status["college_name"] = $row['college_name'];
	array_push($data,$status);
}
	echo json_encode($data);    */
	
			while ($row=mysql_fetch_array($skill_data)) 
						   {  
					   ?>                            
						<tr>
						<td align="center" style="vertical-align: middle;">
						 <a title="Delete">
						 <button class="btn btn-danger" onclick="Delete(<?php echo $row["id"];?>);">
						 <i class="glyphicon glyphicon-trash"></i>
						  </button>
						 </a>
						 </td>
						<td><?php echo $row['firstname']; ?></td>
						 <td><?php echo $row['college_name']; ?></td>                                            
						 </tr>
						 
						 
			 <!--href='college.php?update=<?php //echo $row["id"];?>'-->

				<?php 

						  }?>



