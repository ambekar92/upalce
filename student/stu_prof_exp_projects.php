<?php 
include('sup_files/slider.php'); 
include('sup_files/header.php'); 
include('links.php');
//error_reporting(0);
include('sup_files/db.php');



$info_company_id=$_GET['info_company_id'];
$company_name=$_GET['company_name'];

//echo $info_company_id;
/* Fetching the initial data */
$table='stu_prof_exp_projects';
$whereCond="fk_stu_id='$stu_id' and fk_prof_exp_id='$info_company_id'";	
$Query = 'select * from '.$table.' where '.$whereCond;
$stu_prof_exp_projects = mysql_query($Query) or die("Error in Selection Query <br> ".$Query."<br>". mysql_error());


/* Delete the record by id */
if(isset($_GET['delete']))
{
 $delete =$_GET['delete'];
		if($delete != '')
		{
		?>
		<script type="text/javascript">
			$(document).ready(function(){
				$("#del").modal({backdrop:'static'});
				$("#dele").html('<p style=color:red;>Record Successfully Deleted !!</p>');	
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
		$project_name=$row['project_name']; 
		$duration_from=$row['duration_from']; 
		$duration_to=$row['duration_to']; 
		$project_location=$row['project_location']; 
		$team_size=$row['team_size']; 
		$skills=$row['skills']; 
		$tools=$row['tools']; 
		$project_details=$row['project_details']; 
	}
}


/* Show Project Details IN Popup Model */
if(isset($_POST['info_data_project']))
{
	$user_id = $_POST['user_id'];
	$id = $_POST['info_project_id'];
	
	if($user_id !='')
	{		

		//$table='stu_projects';
		$whereCond="fk_stu_id='$user_id' and id='$id' and fk_prof_exp_id='$info_company_id'";	
		$Query = 'select * from '.$table.' where '.$whereCond;
		$stu_projects = mysql_query($Query) or die("Error in Selection Query <br> ".$Query."<br>". mysql_error());

		while($row=mysql_fetch_array($stu_projects)) 
		{
			$id_a=$row['id']; 
			$project_name=$row['project_name']; 
			$project_location=$row['project_location']; 
			$duration_from=$row['duration_from']; 
			$duration_to=$row['duration_to']; 
			$project_details=$row['project_details']; 
			$team_size=$row['team_size']; 
			$skills=$row['skills']; 
			$tools=$row['tools']; 
		}
	
		?>
		<script type="text/javascript">
			$(document).ready(function(){
				$("#commondialog_project").modal({backdrop:'static'});
				$("#getCode_project").html('<p style=color:black;><b>Project Name :</b> '
				+"<?php echo $project_name; ?>"
				+'</p>  <p style=color:black;><b>Company Name : </b>'
				+"<?php echo $company_name; ?>"
				+'</p>  <p style=color:black;><b>Tools : </b>'
				+"<?php echo $tools; ?>"
				+'<b>, Skills : </b>'
				+"<?php echo $skills; ?>"
				+'</p> <p style="text-align:justify;word-wrap: break-word;border: 1px solid black;padding:10px;border-radius:6px;color:black;"> '
				+'<b>Project Description :</b><br>'+"<?php echo $project_details; ?>"+'</span></p>');	
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
	$project_name = $_POST['project_name'];
	$project_location = $_POST['project_location'];
	$duration_from = $_POST['duration_from'];
	$duration_to = $_POST['duration_to'];
	$project_details = $_POST['project_details'];
	$team_size = $_POST['team_size'];
	$skills = $_POST['skills'];
	$tools = $_POST['tools'];

	$user_id = $_POST['user_id'];
	$info_company_id = $_POST['info_company_id'];
	
	
	if($project_name !='')
	{		
		//mysql_query("update STU_STUDENT set cover_letter='$cover' where id='$user_id'") or die("error !!");	
		//$table = STU_SKILLS;	
		$Query ="insert into $table (fk_stu_id,fk_prof_exp_id,project_name,project_location,duration_from,duration_to,project_details,team_size,skills,tools) 
		values('$user_id','$info_company_id','$project_name','$project_location','$duration_from','$duration_to','$project_details','$team_size','$skills','$tools')";  
	
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
	$project_name = $_POST['project_name'];
	$project_location = $_POST['project_location'];
	$duration_from = $_POST['duration_from'];
	$duration_to = $_POST['duration_to'];
	$project_details = $_POST['project_details'];
	$team_size = $_POST['team_size'];
	$skills = $_POST['skills'];
	$tools = $_POST['tools'];

	$user_id = $_POST['user_id'];
	$id = $_POST['id'];
	$info_company_id = $_POST['info_company_id'];
	
	if($project_name !='')
	{		
		//mysql_query("update STU_STUDENT set cover_letter='$cover' where id='$user_id'") or die("error !!");	
		//$table = STU_SKILLS;	
		$Query = "UPDATE $table set project_name='$project_name',project_location='$project_location',duration_from='$duration_from',duration_to='$duration_to',
			project_details='$project_details',team_size='$team_size',skills='$skills',tools='$tools'
		WHERE id = '$id' and fk_stu_id='$user_id' and fk_prof_exp_id='$info_company_id'";
					
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



<script type = "text/javascript">
function reload12()
{	<!-- function is reload page -->
	window.location=window.location.href;
}


function reload()
{	<!-- function is reload after delete -->
	//window.location=window.location.href;
	var str=window.location.href;
	var url=str.slice(0,-9)
	//alert(url);
	window.location=url;
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
		$("#seldelete").html('<a href=<?php echo $_SERVER['REQUEST_URI'];?>&delete='+data+'>'
		+'<input type=button class="btn btn-default" style="height:25px;padding-left: 12px;padding-right: 12px;padding-top: 0px;padding-bottom: 1px;" value="YES"/></a>'
		+'<input type="button" class="btn btn-default" data-dismiss="modal" onclick="reload12();" style="height:25px;padding-left: 12px;padding-right: 12px;padding-top: 0px;padding-bottom: 1px;" value="NO"/>');	
	});
}

/* function process(date){
   var parts = date.split("/");
   return new Date(parts[2], parts[1] - 1, parts[0]);
} */

</script>

<!-- Extra JavaScript/CSS added manually in "Settings" tab -->
<!-- Include jQuery -->
<link rel="stylesheet" href="./comm/bootstrap-iso.css" />
<!--<script type="text/javascript" src="./comm/jquery-1.11.3.min.js"></script>-->
<script type="text/javascript" src="./comm/bootstrap-datepicker.min.js"></script>
<link rel="stylesheet" href="./comm/bootstrap-datepicker3.css"/>



 <div class="modal fade" id="del" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
		   <div class="modal-header">
			<!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>-->
			 <h5 class="modal-title" id="myModalLabel">Message</h5>
		   </div>
				 <div class="modal-body" id="dele">
				  <!-- passing value form script-->
				 </div>
		  <div class="modal-footer" style="margin-bottom: -10px;padding: 12px;">
			<input type="button" class="btn btn-default" data-dismiss="modal" onclick="reload();" 
	style="height:25px;padding-left: 12px;padding-right: 12px;padding-top: 0px;padding-bottom: 1px;" value="Close"/>
			<!--<input type="button" class="btn btn-primary"  value="Save changes" />-->
		  </div>
    </div>
  </div>
</div>

 <div class="modal fade" id="commondialog_project" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
  <div class="modal-dialog modal-md" role="document">
    <div class="modal-content">
		   <div class="modal-header">
			<!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>-->
			 <h5 class="modal-title" id="myModalLabel">Project Details</h5>
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





            <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
          
            <div class="clearfix"></div>

		
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
             
                   <div class="x_title">
                    <h2>
					<a href="stu_prof_experience.php">
					<button class="btn btn-primary" style="width:90px;"><i class="fa fa-reply" aria-hidden="true"></i>&nbsp;&nbsp; Back</button> </a>
					<h2 style="margin-left:50px;"><?php echo $company_name; ?> Projects</h2></h2>
                    <ul class="nav navbar-right panel_toolbox" style="min-width:0 !important;">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
				   <div class="x_content">
				  <br />
				  
				  
				<form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="post" enctype="multipart/form-data">
					<input type="hidden"  name="user_id" value="<?php echo $stu_id;?>"> <!-- Get the User_ID Onloading the File-->
					<input type="hidden"  name="info_company_id" value="<?php echo $info_company_id;?>"> <!-- Get the ID from Update each record -->
					<input type="hidden"  name="id" value="<?php echo $id;?>"> <!-- Get the ID from Update each record -->
					
					<div class="form-group">
                        <label class="control-label col-md-2 col-sm-2 col-xs-12">Project Name<span class="required">*</span>
                        </label>
                        <div class="col-md-3 col-sm-2 col-xs-12">
                          <input type="text" value="<?php echo $project_name; ?>" name="project_name" required="required" placeholder="Name" class="form-control col-md-7 col-xs-12" autofocus>
                        </div>
						
						<label class="control-label col-md-2 col-sm-2 col-xs-12">Project Location<span class="required">*</span>
                        </label>
                        <div class="col-md-3 col-sm-2 col-xs-12">
                          <select name="project_location"  id="project_location" class="form-control" style="width:100% !important;" required="required">
                            <option value="<?php echo $project_location; ?>"><?php echo $project_location; ?></option>
                            <option value="Onsite">Onsite</option>
                            <option value="Offsite">Offsite</option>
                          </select>
						<div id="error"></div>
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
                        <label class="control-label col-md-2 col-sm-2 col-xs-12">Team Size<span class="required">*</span>
                        </label>
                        <div class="col-md-3 col-sm-2 col-xs-12">
                          <input type="number" value="<?php echo $team_size; ?>" name="team_size" required="required" placeholder="Team Size" class="form-control col-md-7 col-xs-12">
                        </div>
						
						<label class="control-label col-md-2 col-sm-2 col-xs-12">Tools
                        </label>
                        <div class="col-md-3 col-sm-2 col-xs-12">
                          <input type="text" value="<?php echo $tools; ?>" name="tools" placeholder="Tools" class="form-control col-md-7 col-xs-12">
                        </div>
						
					</div>	
						
					<div class="form-group">	
						
						<label class="control-label col-md-2 col-sm-2 col-xs-12">Skills
                        </label>
                        <div class="col-md-3 col-sm-2 col-xs-12">
                          <input type="text" value="<?php echo $skills; ?>" name="skills" placeholder="Skills" class="form-control col-md-7 col-xs-12">
                        </div>
						
						<label class="control-label col-md-2 col-sm-2 col-xs-12">Project Details<span class="required">*</span>
                        </label>
                        <div class="col-md-4 col-sm-2 col-xs-12">
                      	<textarea name="project_details" required="required" class="form-control" placeholder="Enter Project Details Discription" style="height:80px;" maxlength="1000"><?php echo $project_details; ?></textarea>
                        </div>
					</div>
					
					
					 <br>
					 
	<div class="form-group">
	<div class="col-md-4 col-sm-3 col-xs-12">
	</div>
		<div class="col-md-2 col-sm-3 col-xs-12" id="add_skill_hide">
			<button type="submit" name="submit_data" id="submit_data" class="btn btn-primary" style="width:150px;">Add Project</button>
		</div>
		 
		 <div class="col-md-2 col-sm-3 col-xs-12" style="display:none;" id="update_skill_hide">
			<button type="submit" name="project_update" id="project_update" class="btn btn-success" style="width:150px;">Update Record</button>
		</div>
		
		<div class="col-md-3 col-sm-3 col-xs-12">
		<?php
		$str_url=$_SERVER['REQUEST_URI'];
		$url_data=substr($str_url,0,-10);
		//echo $url_data;
		//echo $_GET['update'];
		if($_GET['update']== NULL) {?>
			<input type="submit" class="btn btn-primary" onclick="reload12();" value="Cancel" style="width:150px;">
		<?php } else {?>
			<a href="<?php echo $url_data; ?>"><input class="btn btn-primary" value="Cancel" style="width:150px;"></a>
		<?php } ?>	
			</div>
	  </div>
					  
                      <div class="ln_solid"></div>
				
				</form>
				  
                </div>
                </div>
              
			  <div class="x_panel">
                  <div class="x_title">
                    <h2>Details of Experience </small></h2>
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
					
                                         
                    <table id="datatable" class="table table-striped table-bordered" style="width:1200px;">
                      <thead>
                        <tr style="background-color:#2a3f54;color:#d7dcde;">
                          <!--<th><input type="checkbox" id="check-all" class="flat"></th>-->
					<!--	  <th>Delete</th>-->
                          <th width="12%">Action</th>
						  <th>Project Details</th>
                          <th>Project Name</th>
                          <th>Duration From</th>
                          <th>Duration To</th>
                          <th>Project Location</th>
                          <th>Team Size</th>
						  <th>Skills</th>
						  <th>Tools</th>
						 
                          
                        </tr>
                      </thead>


                      <tbody>

					<?php
						 while ($row=mysql_fetch_array($stu_prof_exp_projects)) 
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
 <a title="Update" href='<?php echo $_SERVER['REQUEST_URI'];?>&update=<?php echo $row["id"];?>'>
 <button class="btn btn-warning">
 <i class="glyphicon glyphicon-pencil"></i>
 </button>
 </a></td>
   <td align="center">
	  
	  <form method="post" id="project_details_info" action="<?php echo $_SERVER['REQUEST_URI']; ?>" >
		<input type="hidden"  name="user_id" id="info_user_id" value="<?php echo $stu_id;?>"> <!-- Get the User_ID Onloading the File-->
		<input type="hidden"  name="info_project_id" id="info_project_id" value="<?php echo $row["id"];?>"> <!-- Get the ID from Update each record -->
		
		<button type="submit" name="info_data_project"  class="btn btn-warning" style="width:100px;">View Details</button>
	  </form>
	
	<!--<textarea name="project_details" required="required" class="form-control" placeholder="Enter Project Details Discription" style="height:80px;" maxlength="1000" readonly> <?php echo $row['project_details']; ?> </textarea>-->
	  </td>
						 <td><?php echo $row['project_name']; ?></td>                                            
						 <td><?php echo $row['duration_from']; ?></td>
						 <td><?php echo $row['duration_to']; ?></td>
						 <td><?php echo $row['project_location']; ?></td>
						 <td><?php echo $row['team_size']; ?></td>
						 <td><?php echo $row['skills']; ?></td>
						 <td><?php echo $row['tools']; ?></td>
	
						 
			 <!--href='skills.php?update=<?php //echo $row["id"];?>'-->

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