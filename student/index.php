
<?php
 include('sup_files/db.php');
 include('sup_files/slider.php');
 include('sup_files/header.php'); 
 include('links.php'); 
 
 
 
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


/* Fetching the initial data */
$table_links='stu_projects_links';
$whereCond_links="fk_stu_id='$stu_id'";	
$query_links = 'select * from '.$table_links.' where '.$whereCond_links;
$projects_link = mysql_query($query_links) or die("Error in Selection Query <br> ".$Query."<br>". mysql_error());
 

?>


  <!-- page content -->
        <div class="right_col" role="main">
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

            
				<div class="x_content">
					<?php if($stu_status == 'active') { ?>
					<div class="alert alert-success alert-dismissible fade in" role="alert">
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					  </button>
					  <strong>Success!</strong> Your Account is Activated.
					</div>  
					<?php } else {	 ?>
					<div class="alert alert-danger">
					  <strong>Warning !</strong> Your Account is Deactivated, Please Contact the Admin !!
					</div>  
					<?php } ?>
				</div>
			
			
            <div class="x_panel">
                  <div class="x_title">
                    <h2>Personal Details</small></h2>
                   <ul class="nav navbar-right panel_toolbox" style="min-width:0 !important;">
				     <li><a href="profile.php">
				  <button class="btn btn-warning" style="width:90px;"><i class="fa fa-edit" aria-hidden="true"></i>&nbsp;&nbsp; Edit</button> </a>
					</li>
					  <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
					  </li>
					</ul>
                    <div class="clearfix"></div>
                  </div>
			<div class="x_content">
               
			   <div class="col-md-12">
                     <div class="row">
						 <div class="col-md-3">
						 <?php if($stu_profile_img != '') { ?>
						  <img class="img-responsive avatar-view img-thumbnail" src="<?php echo $stu_profile_img; ?>" alt="profile_img" style="height:180px;width:180px;border-radius:20px;">
						  
						 <?php } else {	 ?>
						  <img class="img-responsive avatar-view img-thumbnail" src="images/1.jpg" alt="profile_img" style="height:180px;width:180px;border-radius:20px;">
						 <?php } ?>
						  </div>
			<style>
			.main{
				color:black;
				margin-bottom:8px;
			
				font-weight: bold;
				
			}
			.main1{
				color:black;
				margin-bottom:8px;
				text-transform:uppercase;
				font-weight: bold;
			}

			
			.notify{
				max-height: 388px;
				overflow-y:auto; 
			}
			
			
			.list_data:hover{
			background-color:#d6dbdc;
			}
			</style>
			
			<div class="col-md-7" style="font-size:16px;">
				<div class="row">
				<div class="col-md-3 col-xs-12">Name</div>
				<div class="col-md-6 col-xs-12 main"> <?php echo $stu_firstname;?> </div>
				</div>
				
				<div class="row">
				<div class="col-md-3 col-xs-12">Gender</div>
				<div class="col-md-6 col-xs-12 main"> <?php echo $stu_gender;?> </div>
				</div>

				<div class="row">
				<div class="col-md-3 col-xs-12">Date Of Birth</div>
				<div class="col-md-6 col-xs-12 main"> <?php echo $dob;?> </div>
				</div>
				
				<div class="row">
				<div class="col-md-3 col-xs-12">Email ID</div>
				<div class="col-md-6 col-xs-12 main"> <?php echo $stu_email; ?></div>
				</div>
				
				<div class="row">
				<div class="col-md-3 col-xs-12">Mobile Number</div>
				<div class="col-md-6 col-xs-12 main"> <?php echo $stu_mobile; ?></div>
				</div>
	
				<div class="row">
				<div class="col-md-3 col-xs-12">Current Location</div>
				<div class="col-md-6 col-xs-12 main"> <?php echo "$stu_current_loc, $stu_state, $stu_country"; ?></div>
				</div>
				
				<div class="row">
				<div class="col-md-3 col-xs-12">College Name</div>
				<div class="col-md-9 col-xs-12 main1"> <?php echo $stu_college_name;?> </div>
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
     			  
                   <ul class="nav navbar-right panel_toolbox" style="min-width:0 !important;">
				    <li><a href="profile_summary.php">
				  <button class="btn btn-warning" style="width:90px;"><i class="fa fa-edit" aria-hidden="true"></i>&nbsp;&nbsp; Edit</button> </a>
					</li>
				 <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
					  </li>
					</ul>
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
                    <ul class="nav navbar-right panel_toolbox" style="min-width:0 !important;">
<li><a href="stu_education.php">
				  <button class="btn btn-warning" style="width:90px;"><i class="fa fa-edit" aria-hidden="true"></i>&nbsp;&nbsp; Edit</button> </a>
					</li>                     
					 <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
				   <div class="x_content" style="width:100%;overflow-x:auto;">
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
				 
				 <table id="datatable" class="table table-striped table-bordered nowrap" style="width:1700px;">
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
                          <th>SEM 1</th>
                          <th>SEM 2</th>
                          <th>SEM 3</th>
                          <th>SEM 4</th>
                          <th>SEM 5</th>
                          <th>SEM 6</th>
                          <th>SEM 7</th>
                          <th>SEM 8</th>
						  <th>Aggregate</th>
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
						 <td><?php echo $row['sem1']; ?></td>
						 <td><?php echo $row['sem2']; ?></td>
						 <td><?php echo $row['sem3']; ?></td>
						 <td><?php echo $row['sem4']; ?></td>
						 <td><?php echo $row['sem5']; ?></td>
						 <td><?php echo $row['sem6']; ?></td>
						 <td><?php echo $row['sem7']; ?></td>
						 <td><?php echo $row['sem8']; ?></td>
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
		<ul class="nav navbar-right panel_toolbox" style="min-width:0 !important;">
		 <li><a href="stu_projects.php">
		  <button class="btn btn-warning" style="width:90px;"><i class="fa fa-edit" aria-hidden="true"></i>&nbsp;&nbsp; Edit</button> </a>
			</li>
		  <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
		  </li>
		</ul>
		<div class="clearfix"></div>
	  </div>
	  
	  <div class="x_content"  style="width:100%;overflow-x:auto;">
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
	  
	  <form method="post" id="project_details_info" action="stu_projects.php">
		<input type="hidden"  name="user_id" id="info_user_id" value="<?php echo $stu_id;?>"> <!-- Get the User_ID Onloading the File-->
		<input type="hidden"  name="info_project_id" id="info_project_id" value="<?php echo $row["id"];?>"> <!-- Get the ID from Update each record -->
		
		<button type="submit" name="info_data_project"  class="btn btn-primary" style="width:100px;">View Details</button>
	  </form>
	
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
                    <ul class="nav navbar-right panel_toolbox" style="min-width:0 !important;">
					<li><a href="skills.php">
					  <button class="btn btn-warning" style="width:90px;"><i class="fa fa-edit" aria-hidden="true"></i>&nbsp;&nbsp; Edit</button> </a>
						</li>
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
				  
                  <div class="x_content"  style="width:100%; overflow-x:auto;">
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
                    <ul class="nav navbar-right panel_toolbox" style="min-width:0 !important;">
					<li><a href="stu_prof_experience.php">
					  <button class="btn btn-warning" style="width:90px;"><i class="fa fa-edit" aria-hidden="true"></i>&nbsp;&nbsp; Edit</button> </a>
						</li>
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
				  
                  <div class="x_content"  style="width:100%;overflow-x:auto;">
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
						  <th>Projects</th>
                          
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
	  
	  <form method="post" id="project_details_info" action="stu_prof_experience.php">
		<input type="hidden"  name="user_id" id="info_user_id" value="<?php echo $stu_id;?>"> <!-- Get the User_ID Onloading the File-->
		<input type="hidden"  name="info_project_id" id="info_project_id" value="<?php echo $row["id"];?>"> <!-- Get the ID from Update each record -->
		
		<button type="submit" name="info_data_project"  class="btn btn-warning" style="width:100px;">View Details</button>
	  </form>
	
	<!--<textarea name="project_details" required="required" class="form-control" placeholder="Enter Project Details Discription" style="height:80px;" maxlength="1000" readonly> <?php echo $row['project_details']; ?> </textarea>-->
	  </td>
		 <td align="center">
	  
	  
	  <!-- redirect to another page stu_prof_exp_projects-->
	  <form method="GET" id="project_details_info" action="stu_prof_exp_projects.php">
		<input type="hidden"  name="user_id" id="info_user_id" value="<?php echo $stu_id;?>"> <!-- Get the User_ID Onloading the File-->
		<input type="hidden"  name="info_company_id" id="info_company_id" value="<?php echo $row["id"];?>"> <!-- Get the ID from Update each record -->
		<input type="hidden"  name="company_name" id="company_name" value="<?php echo $row["company_name"];?>"> <!-- Get the ID from Update each record -->
		
		<button type="submit" class="btn btn-primary" style="width:100px;">Add Projects</button>
	  </form>
	
	<!--<textarea name="project_details" required="required" class="form-control" placeholder="Enter Project Details Discription" style="height:80px;" maxlength="1000" readonly> <?php echo $row['project_details']; ?> </textarea>-->
	  </td>
	  </tr>
				<?php 

						   }?>
                        
                      
                      </tbody>
                    </table>
                  </div>
                </div>			
				
				
		<!-- --------------------------------- -------------------------------- --------------------------- ------------------------------ --> 
		 <!-- Links -->			

	<div class="x_panel">
                  <div class="x_title">
                    <h2>Invention / Project Links</small></h2>
                    <ul class="nav navbar-right panel_toolbox" style="min-width:0 !important;">
					<li><a href="links_projects.php">
					  <button class="btn btn-warning" style="width:90px;"><i class="fa fa-edit" aria-hidden="true"></i>&nbsp;&nbsp; Edit</button> </a>
						</li>
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
				  
                  <div class="x_content"  style="width:100%;overflow-x:auto;">
					 <table id="datatable" class="table table-striped table-bordered">
                      <thead>
                        <tr style="background-color:#2a3f54;color:#d7dcde;">
                          <!--<th><input type="checkbox" id="check-all" class="flat"></th>-->
						<!--  <th>Delete</th-->
                          
                          <th>Link Name</th>
                          <th>Link Discription</th>
                                                  
                        </tr>
                      </thead>


                      <tbody>

					<?php
						 while ($row=mysql_fetch_array($projects_link)) 
						   {   
					   ?>                            
							<tr>
						 <td align="center">
						<?php 
						$filename=$row['link_name']; 
						$vedio_name=substr($filename,32);
						//echo $vedio_name;
							?>
						 <iframe width="150" height="100" src="https://www.youtube.com/embed/<?php echo $vedio_name; ?>" frameborder="0" allowfullscreen></iframe>
						 </td>                                            
						 <td>
<textarea class="col-md-12" name="project_details" class="form-control" placeholder="Discription" style="height:100px;" maxlength="1000" readonly><?php echo $row['link_discription']; ?></textarea>
                        						 
						 </td>
					
						 
			 <!--href='links_projects.php?update=<?php //echo $row["id"];?>'-->

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
