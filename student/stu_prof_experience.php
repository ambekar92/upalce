<?php 
include('sup_files/slider.php'); 
include('sup_files/header.php'); 
include('links.php');
//error_reporting(0);
include('sup_files/db.php');

/* Fetching the initial data */
$table='stu_prof_experience';
$whereCond="fk_stu_id='$stu_id'";	
$Query = 'select * from '.$table.' where '.$whereCond;
$stu_prof_experience = mysql_query($Query) or die("Error in Selection Query <br> ".$Query."<br>". mysql_error());


/* Delete the record by id */
if(isset($_GET['delete']))
{
 $delete =$_GET['delete'];
		if($delete != '')
		{
		?>
			<script type="text/javascript">
					$(document).ready(function(){
						$("#commondialog").modal({backdrop:'static'});
						$("#getCode").html('<p style=color:red;>Record Successfully Deleted !!</p>');	
					});
			</script> <!-- hide the add_skill btn and display update btn -->
		<?php
		 $del ="DELETE FROM $table WHERE id='$delete'";
		 mysql_query($del) or die(mysql_error());
		}
		
}


/* Update the record by id */
if(isset($_GET['update']))
{
 $update_id =$_GET['update'];
 
		if($update_id != '')
		{
		?>
			<script type="text/javascript">
					$(document).ready(function(){
						$("#add_skill_hide").hide(); 
						$("#update_skill_hide").show();	
					});
			</script> <!-- hide the add_skill btn and display update btn -->
		<?php
		}
		
 $q ="SELECT * FROM $table where id='$update_id'";
 $Result=mysql_query($q) or die(mysql_error());
 
	while($row=mysql_fetch_array($Result)) 
	{
		$id=$row['id']; 
		$company_name=$row['company_name']; 
		$duration_from=$row['duration_from']; 
		$duration_to=$row['duration_to']; 
		$designation=$row['designation']; 
		$emp_type=$row['emp_type']; 
		$job_description=$row['job_description']; 
	}
}

?>
 <div class="modal fade" id="commondialog_project" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
  <div class="modal-dialog modal-md" role="document">
    <div class="modal-content">
		   <div class="modal-header">
			<!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>-->
			 <h5 class="modal-title" id="myModalLabel">Company Details</h5>
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


<?php

/* Show Project Details IN Popup Model */
if(isset($_POST['info_data_project']))
{
	$user_id = $_POST['user_id'];
	$id = $_POST['info_project_id'];
	
	if($user_id !='')
	{		

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
	
		?>
		<script type="text/javascript">
			$(document).ready(function(){
				$("#commondialog_project").modal({backdrop:'static'});
				$("#getCode_project").html('<p style=color:black;><b>Company Name :</b> '
				+"<?php echo $company_name; ?>"
				+'</p>  <p style=color:black;><b>Designation : </b>'
				+"<?php echo $designation; ?>"
				+'</p>  <p style=color:black;><b>Duration From : </b>'
				+"<?php echo $duration_from; ?>"
				+'<b>, Duration To : </b>'
				+"<?php echo $duration_to; ?>"
				+'</p> <p style="text-align:justify;word-wrap: break-word;border: 1px solid black;padding:10px;border-radius:6px;color:black;"> '
				+'<b>Job Description :</b><br>'+"<?php echo $job_description; ?>"+'</span></p>');	
				//$("#getCode").html('<p>Successfully Inserted.</p>'+"<?php echo $tools; ?>");	
			});
		</script>		<!-- function is call to header.php (Bootstrap model popup)-->	
		<?php
	}
	else
	{
		//echo "<script> alert('Text Field is empty !')</script>";
		?>
		<script type="text/javascript">
			$(document).ready(function(){
				$("#commondialog").modal({backdrop:'static'});
				$("#getCode").html('<p>Text Field is empty !</p>');	
			});
		</script>	<!-- function is call to header.php (Bootstrap model popup)-->		
		<?php
	}
}



/* Add the record to DATABASE */
if(isset($_POST['submit_data']))
{
	$company_name = $_POST['company_name'];
	$duration_from = $_POST['duration_from'];
	$duration_to = $_POST['duration_to'];
	$designation = $_POST['designation'];
	$emp_type = $_POST['emp_type'];
	$job_description = $_POST['job_description'];

	$user_id = $_POST['user_id'];
	
	if($company_name !='')
	{		
		//mysql_query("update STU_STUDENT set cover_letter='$cover' where id='$user_id'") or die("error !!");	
		//$table = STU_SKILLS;	
		$Query ="insert into $table (fk_stu_id,company_name,duration_from,duration_to,designation,emp_type,job_description) 
		values('$user_id','$company_name','$duration_from','$duration_to','$designation','$emp_type','$job_description')";  
	
		mysql_query($Query) or die("Error in Insertion Query <br> ".$Query."<br>". mysql_error());
		
		?>
		<script type="text/javascript">
			$(document).ready(function(){
				$("#commondialog").modal({backdrop:'static'});
				$("#getCode").html('<p>Successfully Added.</p>');	
				//$("#getCode").html('<p>Successfully Inserted.</p>'+"<?php echo $tools; ?>");	
			});
		</script>		<!-- function is call to header.php (Bootstrap model popup)-->	
		<?php
	}
	else
	{
		//echo "<script> alert('Text Field is empty !')</script>";
		?>
		<script type="text/javascript">
			$(document).ready(function(){
				$("#commondialog").modal({backdrop:'static'});
				$("#getCode").html('<p>Text Field is empty !</p>');	
			});
		</script>	<!-- function is call to header.php (Bootstrap model popup)-->		
		<?php
	}
}

/* Update the record in DATABASE */
if(isset($_POST['project_update']))
{
	$company_name = $_POST['company_name'];
	$duration_from = $_POST['duration_from'];
	$duration_to = $_POST['duration_to'];
	$designation = $_POST['designation'];
	$emp_type = $_POST['emp_type'];
	$job_description = $_POST['job_description'];
	
	$id = $_POST['id'];
	$user_id = $_POST['user_id'];
	
	if($company_name !='')
	{		
		//mysql_query("update STU_STUDENT set cover_letter='$cover' where id='$user_id'") or die("error !!");	
		//$table = STU_SKILLS;	
		$Query = "UPDATE $table set company_name='$company_name',duration_from='$duration_from',duration_to='$duration_to',
			designation='$designation',emp_type='$emp_type',job_description='$job_description'
		WHERE id = '$id' and fk_stu_id='$user_id'";
					
		mysql_query($Query) or die("Error in Insertion Query <br> ".$Query."<br>". mysql_error());
		
		?>
		<script type="text/javascript">
			$(document).ready(function(){
				$("#commondialog").modal({backdrop:'static'});
				$("#getCode").html('<p>Successfully Updated.</p>');	
			});
		</script>		<!-- function is call to header.php (Bootstrap model popup)-->	
		<?php
	}
	else
	{
		//echo "<script> alert('Text Field is empty !')</script>";
		?>
		<script type="text/javascript">
			$(document).ready(function(){
				$("#commondialog").modal({backdrop:'static'});
				$("#getCode").html('<p>Text Field is empty !</p>');	
			});
		</script>	<!-- function is call to header.php (Bootstrap model popup)-->		
		<?php
	}

}

?>

<script type = "text/javascript" language = "javascript">
function reload12()
{	<!-- function is call to header.php (Bootstrap model popup)-->
	window.location='stu_prof_experience.php';
}

function checkDuration()
{	//alert();
	var from_date=document.getElementById( "duration_from" ).value;
	var to_date=document.getElementById( "duration_to" ).value;
	//alert(to_date);
	//var fromdate=(from_date.replace("/","")).replace("/","");
    //var todate=(to_date.replace("/","")).replace("/","");
	//alert(todate);
	if(process(to_date) > process(from_date)){
         // alert(date2 + 'is later than ' + date1);
		$("#msg").html('<p style=color:green;></p>');
		$("#submit_data").prop('disabled', false);
		
    }
	else
	{
		$("#msg").html('<p style=color:red;>TO DATE Less than FROM DATE</p>');
		$("#submit_data").prop('disabled', true);
		
	}
	 

/* 	if(fromdate>todate)
	{ $("#msg").html('<p style=color:green;>Text Field is empty !</p>');}
	else
	{ $("#msg").html('<p style=color:red;>Text Field is empty !</p>');}
		 */
	
}

function Delete(data)
{
	//alert(data);
	$(document).ready(function(){
		$("#commondelete").modal({backdrop:'static'});
		$("#seldelete").html('<a href=stu_prof_experience.php?delete='+data+'>'
		+'<input type=button class="btn btn-default" style="height:25px;padding-left: 12px;padding-right: 12px;padding-top: 0px;padding-bottom: 1px;" value="YES"/></a>'
		+'<input type="button" class="btn btn-default" data-dismiss="modal" onclick="reload12();" style="height:25px;padding-left: 12px;padding-right: 12px;padding-top: 0px;padding-bottom: 1px;" value="NO"/>');	
	});
}

function process(date){
   var parts = date.split("/");
   return new Date(parts[2], parts[1] - 1, parts[0]);
}

</script>

<!-- Extra JavaScript/CSS added manually in "Settings" tab -->
<!-- Include jQuery -->
<link rel="stylesheet" href="./comm/bootstrap-iso.css" />
<!--<script type="text/javascript" src="./comm/jquery-1.11.3.min.js"></script>-->
<script type="text/javascript" src="./comm/bootstrap-datepicker.min.js"></script>
<link rel="stylesheet" href="./comm/bootstrap-datepicker3.css"/>



            <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
          
            <div class="clearfix"></div>

		
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
             
                   <div class="x_title">
                    <h2>Professional Experience</h2>
                    <ul class="nav navbar-right panel_toolbox" style="min-width:0 !important;">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
				   <div class="x_content">
				  <br />
				<form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" action="stu_prof_experience.php" method="post" enctype="multipart/form-data">
					<input type="hidden"  name="user_id" value="<?php echo $stu_id;?>"> <!-- Get the User_ID Onloading the File-->
					<input type="hidden"  name="id" value="<?php echo $id;?>"> <!-- Get the ID from Update each record -->
					
					<div class="form-group">
                        <label class="control-label col-md-2 col-sm-2 col-xs-12">Employer / Company<span class="required">*</span>
                        </label>
                        <div class="col-md-3 col-sm-2 col-xs-12">
                          <input type="text" value="<?php echo $company_name; ?>" name="company_name" required="required" placeholder="Name" class="form-control col-md-7 col-xs-12" autofocus>
                        </div>
				    </div>
					  
					<div class="form-group">
                        <label class="control-label col-md-2 col-sm-2 col-xs-12">Duration From<span class="required">*</span>
                        </label>
                        <div class="col-md-3 col-sm-2 col-xs-12">
                          <input type="text" onchange="checkDuration();" value="<?php echo $duration_from; ?>" name="duration_from" id="duration_from" required="required" placeholder="Duration From" class="form-control col-md-7 col-xs-12">
                        </div>
						
						<label class="control-label col-md-2 col-sm-2 col-xs-12">Duration To<span class="required">*</span>
                        </label> 
                        <div class="col-md-3 col-sm-2 col-xs-12">
                          <input type="text" onchange="checkDuration();" value="<?php echo $duration_to; ?>" name="duration_to" id="duration_to" required="required" placeholder="Duration To" class="form-control col-md-7 col-xs-12">
                        <span id="msg"></span>
						</div>
					</div>
					
					<div class="form-group">
                        <label class="control-label col-md-2 col-sm-2 col-xs-12">Designation<span class="required">*</span>
                        </label>
                        <div class="col-md-3 col-sm-2 col-xs-12">
                          <input type="text" value="<?php echo $designation; ?>" name="designation" required="required" placeholder="Designation" class="form-control col-md-7 col-xs-12">
                        </div>
						
						<label class="control-label col-md-2 col-sm-2 col-xs-12">Employement Type<span class="required">*</span>
                        </label>
                        <div class="col-md-3 col-sm-2 col-xs-12">
                          <select name="emp_type"  id="emp_type" class="form-control" style="width:100% !important;" required="required">
                            <option value="<?php echo $emp_type; ?>"><?php echo $emp_type; ?></option>
                            <option value="Full Time">Full Time</option>
                            <option value="Part Time">Part Time</option>
                            <option value="Correspondence">Contract</option>
                            <option value="Internship">Internship</option>
                          </select>
						<div id="error"></div>
						</div>
						
						
					</div>	
						
					<div class="form-group">	
						<label class="control-label col-md-2 col-sm-2 col-xs-12">Job Description<span class="required">*</span>
                        </label>
                        <div class="col-md-8 col-sm-2 col-xs-12">
                      	<textarea name="job_description" required="required" class="form-control" placeholder="Enter Your Job Description" style="height:80px;" maxlength="1000"><?php echo $job_description; ?></textarea>
                        </div>
					</div>
					
					 <br>
					 
	<div class="form-group">
	<div class="col-md-4 col-sm-3 col-xs-12">
	</div>
		<div class="col-md-2 col-sm-3 col-xs-12" id="add_skill_hide">
			<button type="submit" name="submit_data" id="submit_data" class="btn btn-primary" style="width:150px;">Add Company</button>
		</div>
		 
		 <div class="col-md-2 col-sm-3 col-xs-12" style="display:none;" id="update_skill_hide">
			<button type="submit" name="project_update" id="project_update" class="btn btn-success" style="width:150px;">Update Record</button>
		</div>
		
		<div class="col-md-3 col-sm-3 col-xs-12">
			<input type="submit" class="btn btn-primary" onclick="reload12();" value="Cancel" style="width:150px;">
			</div>
	  </div>
					  
                      <div class="ln_solid"></div>
				
				</form>
				  
                </div>
                </div>
              
			  <div class="x_panel">
                  <div class="x_title">
                    <h2>Experience Details</small></h2>
                    <ul class="nav navbar-right panel_toolbox" style="min-width:0 !important;">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                    </ul>
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
                          <th width="12%">Action</th>
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
<td align="center" style="vertical-align: middle;">
 <a title="Delete">
 <button class="btn btn-danger" onclick="Delete(<?php echo $row["id"];?>);">
 <i class="glyphicon glyphicon-trash"></i>
  </button>
 </a><!--</td>	
 <td align="center" style="vertical-align: middle;">-->
 <a title="Update" href='stu_prof_experience.php?update=<?php echo $row["id"];?>'>
 <button class="btn btn-warning">
 <i class="glyphicon glyphicon-pencil"></i>
 </button>
 </a></td>
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
				<?php 

						   }?>
                        
                      
                      </tbody>
                    </table>
                  </div>
                </div>
			  
			  </div> <!-- col-12 -->
            </div>
          </div>
        </div>
        <!-- /page content -->
		<br/>&nbsp;

		        <!-- footer content -->
<?php include('sup_files/footer.php'); ?>
        <!-- /footer content -->
      </div>
    </div>

	

<script>
	$(document).ready(function(){
		var date_input=$('input[name="duration_from"],input[name="duration_to"]'); //our date input has the name "date"
		var container=$('.bootstrap-iso span').length>0 ? $('.bootstrap-iso span').parent() : "body";
		date_input.datepicker({
			format: 'dd/mm/yyyy',
			container: container,
			todayHighlight: true,
			autoclose: true,
		})
	})
</script>
	
	 <!-- Datatables -->
    <script>
      $(document).ready(function() {
        var handleDataTableButtons = function() {
          if ($("#datatable-buttons").length) {
            $("#datatable-buttons").DataTable({
              dom: "Bfrtip",
              buttons: [
                {
                  extend: "copy",
                  className: "btn-sm"
                },
                {
                  extend: "csv",
                  className: "btn-sm"
                },
                {
                  extend: "excel",
                  className: "btn-sm"
                },
                {
                  extend: "pdfHtml5",
                  className: "btn-sm"
                },
                {
                  extend: "print",
                  className: "btn-sm"
                },
              ],
              responsive: true
            });
          }
        };

        TableManageButtons = function() {
          "use strict";
          return {
            init: function() {
              handleDataTableButtons();
            }
          };
        }();

        $('#datatable').dataTable();

        $('#datatable-keytable').DataTable({
          keys: true
        });

        $('#datatable-responsive').DataTable();

        $('#datatable-scroller').DataTable({
          ajax: "js/datatables/json/scroller-demo.json",
          deferRender: true,
          scrollY: 380,
          scrollCollapse: true,
          scroller: true
        });

        $('#datatable-fixed-header').DataTable({
          fixedHeader: true
        });

        var $datatable = $('#datatable-checkbox');

        $datatable.dataTable({
          'order': [[ 1, 'asc' ]],
          'columnDefs': [
            { orderable: false, targets: [0] }
          ]
        });
        $datatable.on('draw.dt', function() {
          $('input').iCheck({
            checkboxClass: 'icheckbox_flat-green'
          });
        });

        TableManageButtons.init();
      });
    </script>
    <!-- /Datatables -->
	
	

</body>

</html>