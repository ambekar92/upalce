<?php
 include('db.php');
/* Show Project Details IN Popup Model */
if(isset($_POST['project_id']))
{
	$user_id = $_POST['stu_id'];
	$id = $_POST['project_id'];
	
		$table='stu_projects';
		$whereCond="fk_stu_id='$user_id' and id='$id'";	
		$Query = 'select * from '.$table.' where '.$whereCond;
		$stu_projects = mysql_query($Query) or die("Error in Selection Query <br> ".$Query."<br>". mysql_error());

		while($row=mysql_fetch_array($stu_projects)) 
		{
			$id_a=$row['id']; 
			$project_name_a=$row['project_name']; 
			$entity_name_a=$row['entity_name']; 
			$duration_from_a=$row['duration_from']; 
			$duration_to_a=$row['duration_to']; 
			$project_details_a=$row['project_details']; 
			$team_size_a=$row['team_size']; 
			$skills_a=$row['skills']; 
			$tools_a=$row['tools']; 
		}
	
		echo 
			"<p style=color:black;><b>Project Name :</b> $project_name_a</p>  
			<p style=color:black;><b>Company Name : </b> $entity_name_a</p>
			<p style=color:black;><b>Tools : </b> $tools_a<b>, Skills : </b> $skills_a </p> 
			<p style='text-align:justify;word-wrap: break-word;border: 1px solid black;padding:10px;border-radius:6px;color:black;'>
			<b>Project Description :</b><br>$project_details_a</p>";	
}

if(isset($_POST['exp_id']))
{
	$user_id = $_POST['stu_id'];
	$id = $_POST['exp_id'];
	
		$table='stu_prof_experience';
		$whereCond="fk_stu_id='$user_id' and id='$id'";	
		$Query = 'select * from '.$table.' where '.$whereCond;
		$stu_prof_experience = mysql_query($Query) or die("Error in Selection Query <br> ".$Query."<br>". mysql_error());

		while($row=mysql_fetch_array($stu_prof_experience)) 
		{
			$id=$row['id']; 
			$company_name=$row['company_name']; 
			$duration_from=$row['duration_from']; 
			$duration_to=$row['duration_to']; 
			$designation=$row['designation']; 
			$emp_type=$row['emp_type']; 
			$job_description=$row['job_description']; 
		}
	
	
		echo "<p style=color:black;><b>Company Name :</b>
				$company_name
				</p>  <p style=color:black;><b>Designation : </b>
				$designation
				</p>  <p style=color:black;><b>Duration From : </b>
				$duration_from
				<b>, Duration To : </b>
				$duration_to;
				</p> <p style='text-align:justify;word-wrap: break-word;border: 1px solid black;padding:10px;border-radius:6px;color:black;'> 
				<b>Job Description :</b><br> $job_description</p>";
}
?>