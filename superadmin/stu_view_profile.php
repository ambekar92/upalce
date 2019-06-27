
<?php
 include('sup_files/db.php');
//include('sup_files/slider.php');
// include('sup_files/header.php'); 
 include('links_old.php'); 
 
 $stu_id =$_GET['stu_id']; 

$whereCond="id='$stu_id'";	
$Query = 'select * from stu_student where '.$whereCond;
$stu_student = mysql_query($Query) or die("Error in Selection Query <br> ".$Query."<br>". mysql_error());
while ($row=mysql_fetch_array($stu_student)) 
{ 
	//$id_10=$row['id'];
	$stu_profile_img = $row['profile_img'];
	$stu_firstname = $row['firstname'];
	$stu_gender = $row['gender'];
	$stu_email = $row['email'];
	$stu_mobile = $row['mobile'];
	$stu_current_loc = $row['current_loc'];
	$stu_state = $row['state'];
	$stu_country = $row['country'];
	$stu_profile_summary = $row['profile_summary'];
	
	
} 
 
 
/* Fetching the initial data */
$whereCond="fk_stu_id='$stu_id' and class=10";	
$Query = 'select * from stu_education where '.$whereCond;
$stu_education_10 = mysql_query($Query) or die("Error in Selection Query <br> ".$Query."<br>". mysql_error());
while ($row=mysql_fetch_array($stu_education_10)) 
{ 
	$id_10=$row['id'];
	$class_10 = $row['class'];
	$end_year_10 = $row['end_year'];
	$college_name_10 = $row['college_name'];
	$university_10 = $row['university'];
	$secured_10 = $row['secured'];
}

$whereCond="fk_stu_id='$stu_id' and class=12";	
$Query = 'select * from stu_education where '.$whereCond;
$stu_education_12 = mysql_query($Query) or die("Error in Selection Query <br> ".$Query."<br>". mysql_error());
while ($row=mysql_fetch_array($stu_education_12)) 
{ 
	$id_12=$row['id'];
	$class_12 = $row['class'];
	$end_year_12 = $row['end_year'];
	$college_name_12 = $row['college_name'];
	$university_12 = $row['university'];
	$secured_12 = $row['secured'];
}


//Get values for Table
$whereCond="fk_stu_id='$stu_id' and value_select=13";	
$Query = 'select * from stu_education where '.$whereCond;
$stu_education_13 = mysql_query($Query) or die("Error in Selection Query <br> ".$Query."<br>". mysql_error());
 

/* Fetching the initial data */
$whereCond="fk_stu_id='$stu_id'";	
$Query = 'select * from stu_projects where '.$whereCond;
$stu_projects = mysql_query($Query) or die("Error in Selection Query <br> ".$Query."<br>". mysql_error());


/* Fetching the initial data */
$whereCond="fk_stu_id='$stu_id'";	
$Query = 'select * from stu_skills where '.$whereCond;
$skill_data = mysql_query($Query) or die("Error in Selection Query <br> ".$Query."<br>". mysql_error());

/* Fetching the initial data */
$whereCond="fk_stu_id='$stu_id'";	
$Query = 'select * from stu_prof_experience where '.$whereCond;
$stu_prof_experience = mysql_query($Query) or die("Error in Selection Query <br> ".$Query."<br>". mysql_error());


?>

 <div class="modal fade" id="commondialog_project" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
  <div class="modal-dialog modal-md" role="document">
    <div class="modal-content">
		   <div class="modal-header">
			<!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>-->
			 <h5 class="modal-title" id="myModalLabel">Details</h5>
		   </div>
				 <div class="modal-body" id="getCode_project">
				  <!-- passing value form script-->
				 </div>
		  <div class="modal-footer" style="margin-bottom: -10px;padding: 12px;">
			<input type="button" class="btn btn-default" data-dismiss="modal" onclick="reload12();" 
	style="height:25px;padding-left: 12px;padding-right: 12px;padding-top: 0px;padding-bottom: 1px;" value="Close"/>
			<!--<input type="button" class="btn btn-primary"  value="Save changes" />-->
		  </div>
    </div>
  </div>
</div>


<script>
function project(project_id)
{
	//alert(project_id);
	$.ajax({
			   type: 'post',
			   url: 'sureg/stu_view_profile.php',
			   data: {
			  stu_id:'<?php echo $stu_id ?>', 
			  project_id:project_id,
			   },
			   success: function (response) {
			//	alert(response);
				$("#commondialog_project").modal({backdrop:'static'});
				$("#getCode_project").html(response);
		     
             }
		   });

}

function exp(exp_id)
{
	//alert(exp_id);
	$.ajax({
			   type: 'post',
			   url: 'sureg/stu_view_profile.php',
			   data: {
			  stu_id:'<?php echo $stu_id ?>', 
			  exp_id:exp_id,
			   },
			   success: function (response) {
				//alert(response);
				$("#commondialog_project").modal({backdrop:'static'});
				$("#getCode_project").html(response);
		     
             }
		   });

}

</script>

  <!-- page content -->
        <div class="right_col" role="main" style="background-color: #d6dbdc !important;">
          <div class="">

                 <!--<div class="row top_tiles">
                        
                      <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                            <div class="tile-stats">
                                <div class="icon"><i class="fa fa-cube"></i>
                                </div>
                                <div class="count">179</div>

                                <h3>Devices</h3>
                                <p>Number of Devices</p>
                            </div>
                        </div>
                        <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                            <div class="tile-stats">
                                <div class="icon"><i class="fa fa-cube"></i>
                                </div>
                                <div class="count">179</div>

                                <h3>Devices</h3>
                                <p>Number of Devices</p>
                            </div>
                        </div>
                       
                    </div>-->

    <div class="clearfix"></div>
	 <!--<h2>Overview of Profile</small></h2>-->

            <div class="x_panel">
                  <div class="x_title">
                    <h2>Personal Details</small></h2>
                  <!-- <ul class="nav navbar-right panel_toolbox" style="min-width:0 !important;">
				     <li><a href="profile.php">
				  <button class="btn btn-warning" style="width:90px;"><i class="fa fa-edit" aria-hidden="true"></i>&nbsp;&nbsp; Edit</button> </a>
					</li>
					  <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
					  </li>
					</ul>-->
                    <div class="clearfix"></div>
                  </div>
			<div class="x_content">
               
			   <div class="col-md-12">
                     <div class="row">
						 <div class="col-md-3">
						 <?php if($stu_profile_img != '') { ?>
						  <img class="img-responsive avatar-view img-thumbnail" src="../student/<?php echo $stu_profile_img; ?>" alt="profile_img" style="height:180px;width:180px;border-radius:20px;">
						  
						 <?php } else {	 ?>
						  <img class="img-responsive avatar-view img-thumbnail" src="images/1.jpg" alt="profile_img" style="height:180px;width:180px;border-radius:20px;">
						 <?php } ?>
						  </div>
			<style>
			.main{
				color:black;
				margin-bottom:8px;
				text-transform:uppercase;
			}
			</style>

			<div class="col-md-7" style="font-size:16px;">
				<div class="row">
				<div class="col-md-4">Name</div>
				<div class="col-md-6 main">: <?php echo $stu_firstname;?> </div>
				</div>
				
				<div class="row">
				<div class="col-md-4">Gender</div>
				<div class="col-md-6 main">: <?php echo $stu_gender;?> </div>
				</div>

				<div class="row">
				<div class="col-md-4">Email ID</div>
				<div class="col-md-6 main">: <?php echo $stu_email; ?></div>
				</div>
				
				<div class="row">
				<div class="col-md-4">Mobile Number</div>
				<div class="col-md-6 main">: <?php echo $stu_mobile; ?></div>
				</div>
	
				<div class="row">
				<div class="col-md-4">Location</div>
				<div class="col-md-6 main">: <?php echo "$stu_current_loc, $stu_state, $stu_country"; ?></div>
				</div>
			</div>
                    
					</div>
		       </div>   
            </div>
        </div><!-- End one -->
		
         <!-- --------------------------------- -------------------------------- --------------------------- ------------------------------ --> 
		 <!-- Profile Summary -->
		 <div class="x_panel">
                  <div class="x_title">
                   <h2>Profile Summary</h2>
     			  
                  <!-- <ul class="nav navbar-right panel_toolbox" style="min-width:0 !important;">
				    <li><a href="profile_summary.php">
				  <button class="btn btn-warning" style="width:90px;"><i class="fa fa-edit" aria-hidden="true"></i>&nbsp;&nbsp; Edit</button> </a>
					</li>
				 <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
					  </li>
					</ul>-->
                    <div class="clearfix"></div>
                  </div>
			<div class="x_content">
               		<div class="form-group">
						<div class="col-md-2 col-sm-2 col-xs-12">
						</div>
						<div class="col-md-8 col-sm-6 col-xs-12">
							<textarea name="profile_summary" class="form-control" placeholder="Profile Summary Discription" style="height:200px;" maxlength="1000" readonly><?php echo $stu_profile_summary;?></textarea>
						</div>
					</div>
					<br>
            </div>
        </div>
		
		 <!-- --------------------------------- -------------------------------- --------------------------- ------------------------------ --> 
		 <!-- Education -->
		 
	<div class="x_panel" id="hide_panel_10_12">
             
                   <div class="x_title">
                    <h2>Education</h2>
                    <!--<ul class="nav navbar-right panel_toolbox" style="min-width:0 !important;">
<li><a href="stu_education.php">
				  <button class="btn btn-warning" style="width:90px;"><i class="fa fa-edit" aria-hidden="true"></i>&nbsp;&nbsp; Edit</button> </a>
					</li>                     
					 <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                    </ul>-->
                    <div class="clearfix"></div>
                  </div>
				   <div class="x_content" style="width:100%;overflow-x:scroll;">
    <h2>Secondary Education - <small>(10th and 12th Marks)</small></h2>				 
				 <br />

				<table id="datatablea" class="table table-striped table-bordered">
                      <thead>
                        <tr style="background-color:#2a3f54;color:#d7dcde;">
                          <!--<th><input type="checkbox" id="check-all" class="flat"></th>-->
                          <th>Class</th>
                          <th>Year of Completion</th>
                          <th>School/College Name</th>
                          <th>Education Board</th>
                          <th>% Secured</th>
                         </tr>
                      </thead>
            <tbody>
				<tr id="update_hide_10">
				<td> 
				<b>10th </b>
				</td>	
				<td> 
				<?php echo $end_year_10; ?>
				</td>
				<td> 
				<?php echo $college_name_10; ?>
				</td>
				<td> 
				<?php echo $university_10; ?>
				</td>
				<td> 
				<?php echo $secured_10; ?>
				</td>
				</tr>

				<tr id="update_hide_12">
				<td> 
				<b>12th </b>
				</td>	
				<td> 
				<?php echo $end_year_12; ?>
				</td>
				<td> 
				<?php echo $college_name_12; ?>
				</td>
				<td> 
				<?php echo $university_12; ?>
				</td>
				<td> 
				<?php echo $secured_12; ?>
				</td>
				</tr>
			</tbody>
        </table>
  	       		<!--	<p>Note : If you completed diploma no need to update 12 marks </p>-->
				<br />
			 <div class="ln_solid"></div>
			 
			 <br />
			   <h2>Higher Education - <small>(Diploma, Graduation, Post Graduation, Doctorate)</small></h2>				 
				 <br />
				 
				 <table id="datatable" class="table table-striped table-bordered" style="width:100%;">
                      <thead>
                        <tr style="background-color:#2a3f54;color:#d7dcde;">
                          <!--<th><input type="checkbox" id="check-all" class="flat"></th>-->
						  <!--<th width="2%">Delete</th>-->
                         
                          <th>Degree</th>
                          <th>Course Type</th>
                          <th>Started Year</th>
                          <th>End Year</th>
                          <th>College Name</th>
                          <th>University</th>
                          <th>Branch</th>
						  <th>Secured</th>
						  <th>Education Summary</th>
                        
                        </tr>
                      </thead>


                      <tbody>

					<?php
						 while ($row=mysql_fetch_array($stu_education_13)) 
						   {   
					   ?>   
		<!--href='stu_education.php?delete=<?php //echo $row["id"];?>'	-->			   				   
						 <tr>
						 <td><?php echo $row['class']; ?></td>                                            
						 <td><?php echo $row['course_type']; ?></td>
						 <td><?php echo $row['start_year']; ?></td>
						 <td><?php echo $row['end_year']; ?></td>
						 <td><?php echo $row['college_name']; ?></td>
						 <td><?php echo $row['university']; ?></td>
						 <td><?php echo $row['branch']; ?></td>
						 <td><?php echo $row['secured']."%"; ?></td>
						 <td>
<textarea name="edu_summary" style="height:70px;width:250px;" readonly><?php echo $row['edu_summary']; ?></textarea> 						 
						 </td>
								 
			 <!--href='skills.php?update=<?php //echo $row["id"];?>'-->

				<?php 

						   }?>
                        
                      
                      </tbody>
                    </table>
				 
                </div>
    </div>
<!-- --------------------------------- -------------------------------- --------------------------- ------------------------------ --> 
		 <!-- Projects -->
		 
	<div class="x_panel">
	  <div class="x_title">
		<h2>Projects</h2>
		<!--<ul class="nav navbar-right panel_toolbox" style="min-width:0 !important;">
		 <li><a href="stu_projects.php">
		  <button class="btn btn-warning" style="width:90px;"><i class="fa fa-edit" aria-hidden="true"></i>&nbsp;&nbsp; Edit</button> </a>
			</li>
		  <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
		  </li>
		</ul>-->
		<div class="clearfix"></div>
	  </div>
	  
	  <div class="x_content"  style="width:100%;overflow-x:scroll;">
		<!--<p class="text-muted font-13 m-b-30">
		  DataTables has most features enabled by default, so all you need to do to use it with your own tables is to call the construction function: <code>$().DataTable();</code>
		</p>table table-striped jambo_table bulk_action                    style="width:1700px;" -->
	   <table id="datatable" class="table table-striped table-bordered">
		  <thead>
			<tr style="background-color:#2a3f54;color:#d7dcde;">
			  <!--<th><input type="checkbox" id="check-all" class="flat"></th>-->
		<!--	  <th>Delete</th>-->
			  
			  <th>Project Name</th>
			  <th>Entity Name</th>
			  <th>Duration From</th>
			  <th>Duration To</th>
			  <th>Team Size</th>
			  <th>Skills</th>
			  <th>Tools</th>
			  <th>Project Details</th>
			  
			</tr>
		  </thead>


		  <tbody>

		<?php
			 while ($row=mysql_fetch_array($stu_projects)) 
			   {   
		   ?>                            
			 <tr>
			 <td><?php echo $row['project_name']; ?></td>                                            
			 <td><?php echo $row['entity_name']; ?></td>
			 <td><?php echo $row['duration_from']; ?></td>
			 <td><?php echo $row['duration_to']; ?></td>
			 <td><?php echo $row['team_size']; ?></td>
			 <td><?php echo $row['skills']; ?></td>
			 <td><?php echo $row['tools']; ?></td>
	  <td align="center">
	<!--  
	  <form method="post" id="project_details_info" action="stu_projects.php">
		<input type="hidden"  name="user_id" id="info_user_id" value="<?php //echo $stu_id;?>"> <!-- Get the User_ID Onloading the File
		<input type="hidden"  name="info_project_id" id="info_project_id" value="<?php //echo $row["id"];?>"> <!-- Get the ID from Update each record
		-->
		<button type="submit" name="info_data_project" onclick="project(<?php echo $row["id"];?>);" class="btn btn-warning" style="width:100px;">View Details</button>
	<!--  </form>-->
	
	<!--<textarea name="project_details" required="required" class="form-control" placeholder="Enter Project Details Discription" style="height:80px;" maxlength="1000" readonly> <?php echo $row['project_details']; ?> </textarea>-->
	  </td>
						 
			 <!--href='skills.php?update=<?php //echo $row["id"];?>'-->
</tr>
				<?php 

						   }?>
                        
                      
                      </tbody>
                    </table>
                  </div>
                </div>	 
		 
				
	<!-- --------------------------------- -------------------------------- --------------------------- ------------------------------ --> 
		 <!-- Skills -->			
		<div class="x_panel">
                  <div class="x_title">
                    <h2>Skills</h2>
                   <!-- <ul class="nav navbar-right panel_toolbox" style="min-width:0 !important;">
					<li><a href="skills.php">
					  <button class="btn btn-warning" style="width:90px;"><i class="fa fa-edit" aria-hidden="true"></i>&nbsp;&nbsp; Edit</button> </a>
						</li>
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                    </ul>-->
                    <div class="clearfix"></div>
                  </div>
				  
                  <div class="x_content"  style="width:100%; overflow-x:scroll;">
                    <!--<p class="text-muted font-13 m-b-30">
                      DataTables has most features enabled by default, so all you need to do to use it with your own tables is to call the construction function: <code>$().DataTable();</code>
                    </p>table table-striped jambo_table bulk_action                    style="width:1700px;" -->
                   <table id="datatable" class="table table-striped table-bordered">
                      <thead>
                        <tr style="background-color:#2a3f54;color:#d7dcde;">
                          <!--<th><input type="checkbox" id="check-all" class="flat"></th>-->
						<!--  <th>Delete</th-->
                          <th>Skill Name</th>
                          <th>Version</th>
                          <th>Total Experience</th>
                          <th>Rate your skill</th>
                          
                        </tr>
                      </thead>


                      <tbody>

					<?php
						 while ($row=mysql_fetch_array($skill_data)) 
						   {   
					   ?>                            
						<tr>
						 <td><?php echo $row['skill_name']; ?></td>                                            
						 <td><?php echo $row['version']; ?></td>
						 <td><?php echo $row['total_experience']; ?></td>
						 <td><?php echo $row['rate_skill']; ?></td>
						 </tr>
			 <!--href='skills.php?update=<?php //echo $row["id"];?>'-->

				<?php 

						   }?>
                        
                      
                      </tbody>
                    </table>
                  </div>
                </div>
				
				
		<!-- --------------------------------- -------------------------------- --------------------------- ------------------------------ --> 
		 <!-- Prof Experience -->			

	<div class="x_panel">
                  <div class="x_title">
                    <h2>Experience Details</small></h2>
                    <!--<ul class="nav navbar-right panel_toolbox" style="min-width:0 !important;">
					<li><a href="stu_prof_experience.php">
					  <button class="btn btn-warning" style="width:90px;"><i class="fa fa-edit" aria-hidden="true"></i>&nbsp;&nbsp; Edit</button> </a>
						</li>
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                    </ul>-->
                    <div class="clearfix"></div>
                  </div>
				  
                  <div class="x_content"  style="width:100%;overflow-x:scroll;">
                    <!--<p class="text-muted font-13 m-b-30">
                      DataTables has most features enabled by default, so all you need to do to use it with your own tables is to call the construction function: <code>$().DataTable();</code>
                    </p>table table-striped jambo_table bulk_action                    style="width:1700px;" -->
					
                   <table id="datatable" class="table table-striped table-bordered">
                      <thead>
                        <tr style="background-color:#2a3f54;color:#d7dcde;">
                          <!--<th><input type="checkbox" id="check-all" class="flat"></th>-->
					<!--	  <th>Delete</th>-->
                          <th>Company Name</th>
                          <th>Duration From</th>
                          <th>Duration To</th>
                          <th>Designation</th>
                          <th>Employement Type</th>
                          <th>Job Description</th>
						 <!-- <th>Projects</th>-->
                          
                        </tr>
                      </thead>


                      <tbody>

					<?php
						 while ($row=mysql_fetch_array($stu_prof_experience)) 
						   {   
					   ?>                            
				<tr>
						 <td><?php echo $row['company_name']; ?></td>                                            
						 <td><?php echo $row['duration_from']; ?></td>
						 <td><?php echo $row['duration_to']; ?></td>
						 <td><?php echo $row['designation']; ?></td>
						 <td><?php echo $row['emp_type']; ?></td>
						 
						  <td align="center">
						  
	<button type="submit" name="info_data_project_exp" onclick="exp(<?php echo $row["id"];?>);" class="btn btn-warning" style="width:100px;">View Details</button>
	
						<!--<textarea name="project_details" required="required" class="form-control" placeholder="Enter Project Details Discription" style="height:80px;" maxlength="1000" readonly> <?php echo $row['project_details']; ?> </textarea>-->
						  </td>

				</tr>
				<?php 

						   }?>
                        
                      
                      </tbody>
                    </table>
                  </div>
                </div>			
				
	<?php include('sup_files/footer.php'); ?>

    </div>
    </div>
	

</body>

</html>
