<?php 
include('sup_files/slider.php'); 
include('sup_files/header.php'); 
include('links.php');
//error_reporting(0);
include('sup_files/db.php');

/* Fetching the initial data */
$table='stu_skills';
$whereCond="fk_stu_id='$stu_id'";	
$Query = 'select * from '.$table.' where '.$whereCond;
$skill_data = mysql_query($Query) or die("Error in Selection Query <br> ".$Query."<br>". mysql_error());


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
		 $skill_del ="DELETE FROM $table WHERE id='$delete'";
		 mysql_query($skill_del) or die(mysql_error());
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
		
 $skill_del ="SELECT * FROM $table where id='$update_id'";
 $Skill_Result=mysql_query($skill_del) or die(mysql_error());
 
	while($row=mysql_fetch_array($Skill_Result)) 
	{
		$id=$row['id']; 
		$skill_name=$row['skill_name']; 
		$version=$row['version']; 
		$total_exp=$row['total_experience']; 
		$rate_skill=$row['rate_skill']; 
		 
	}
}

/* Add the record to DATABASE */
if(isset($_POST['submit_data']))
{
	$skill_name = $_POST['skill_name'];
	$version = $_POST['version'];
	$total_exp = $_POST['total_exp'];
	$rate_skill = $_POST['rate_skill'];

	$user_id = $_POST['user_id'];
	
	if($rate_skill !='')
	{		
		//mysql_query("update STU_STUDENT set cover_letter='$cover' where id='$user_id'") or die("error !!");	
		//$table = stu_skills;	
		$Query ="insert into $table (fk_stu_id,skill_name,version,total_experience,rate_skill) 
		values('$user_id','$skill_name','$version','$total_exp','$rate_skill')";  
	
		mysql_query($Query) or die("Error in Insertion Query <br> ".$Query."<br>". mysql_error());
		
		?>
		<script type="text/javascript">
			$(document).ready(function(){
				$("#commondialog").modal({backdrop:'static'});
				$("#getCode").html('<p>Successfully Added.</p>');	
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
if(isset($_POST['skill_update']))
{
	$skill_name = $_POST['skill_name'];
	$version = $_POST['version'];
	$total_exp = $_POST['total_exp'];
	$rate_skill = $_POST['rate_skill'];

	$user_id = $_POST['user_id'];
	$id = $_POST['id'];
	
	if($rate_skill !='')
	{		
		//mysql_query("update STU_STUDENT set cover_letter='$cover' where id='$user_id'") or die("error !!");	
		//$table = stu_skills;	
		$Query = "UPDATE $table set skill_name='$skill_name',version='$version',total_experience='$total_exp',rate_skill='$rate_skill'
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
	window.location='skills.php';
}


function Delete(data)
{
	//alert(data);
	$(document).ready(function(){
		$("#commondelete").modal({backdrop:'static'});
		$("#seldelete").html('<a href=skills.php?delete='+data+'>'
		+'<input type=button class="btn btn-default" style="height:25px;padding-left: 12px;padding-right: 12px;padding-top: 0px;padding-bottom: 1px;" value="YES"/></a>'
		+'<input type="button" class="btn btn-default" data-dismiss="modal" onclick="reload12();" style="height:25px;padding-left: 12px;padding-right: 12px;padding-top: 0px;padding-bottom: 1px;" value="NO"/>');	
	});
}

</script>




            <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
          
            <div class="clearfix"></div>

		
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Skills</h2>
                    <ul class="nav navbar-right panel_toolbox" style="min-width:0 !important;">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
				   <div class="x_content">
				  <br />
				<form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" action="skills.php" method="post" enctype="multipart/form-data">
					<input type="hidden"  name="user_id" value="<?php echo $stu_id;?>"> <!-- Get the User_ID Onloading the File-->
					<input type="hidden"  name="id" value="<?php echo $id;?>"> <!-- Get the ID from Update each record -->
					
					<div class="form-group">
                        <label class="control-label col-md-2 col-sm-2 col-xs-12">Skill Name<span class="required">*</span>
                        </label>
                        <div class="col-md-3 col-sm-2 col-xs-12">
                          <input type="text" value="<?php echo $skill_name; ?>" name="skill_name" required="required" placeholder="Skill Name" class="form-control col-md-7 col-xs-12" autofocus>
                        </div>
						
						<label class="control-label col-md-2 col-sm-2 col-xs-12">Version<span class="required">*</span>
                        </label>
                        <div class="col-md-3 col-sm-2 col-xs-12">
                          <input type="text" value="<?php echo $version; ?>"  name="version" required="required" placeholder="Version" class="form-control col-md-7 col-xs-12">
						  
                        </div>
                      </div>
					  
					  <div class="form-group">
                        <label class="control-label col-md-2 col-sm-2 col-xs-12">Total Experience<span class="required">*</span>
                        </label>
                        <div class="col-md-3 col-sm-2 col-xs-12">
                          <input type="text" value="<?php echo $total_exp; ?>" name="total_exp" required="required" placeholder="Total Experience" class="form-control col-md-7 col-xs-12">
                        </div>
						
						<label class="control-label col-md-2 col-sm-2 col-xs-12">Rate your skill<span class="required">*</span>
                        </label>
                        <div class="col-md-3 col-sm-2 col-xs-12">
                          <select name="rate_skill"  id="rate_skill" class="form-control" style="width:100% !important;" required="required">
                            <option value="<?php echo $rate_skill; ?>"><?php echo $rate_skill; ?></option>
                            <option value="Beginner">Beginner</option>
                            <option value="Intermediate">Intermediate</option>
                            <option value="Expert">Expert</option>
                          </select>
						  <div id="error"></div>
						 </div>
						
                      </div>
					 <br>
					 
<div class="form-group">
<div class="col-md-4 col-sm-3 col-xs-12">
</div>
	<div class="col-md-2 col-sm-3 col-xs-12" id="add_skill_hide">
		<button type="submit" name="submit_data" id="submit_data" class="btn btn-primary" style="width:150px;">Add Skill</button>
	</div>
	 
	 <div class="col-md-2 col-sm-3 col-xs-12" style="display:none;" id="update_skill_hide">
		<button type="submit" name="skill_update" id="skill_update" class="btn btn-success" style="width:150px;">Update Skill</button>
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
                    <h2>Skills Added by <?php echo $stu_firstname; ?></small></h2>
                    <ul class="nav navbar-right panel_toolbox" style="min-width:0 !important;">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                    </ul>
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
                          <th>Action</th>
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
<td align="center" style="vertical-align: middle;">
 <a title="Delete">
 <button class="btn btn-danger" onclick="Delete(<?php echo $row["id"];?>);">
 <i class="glyphicon glyphicon-trash"></i>
  </button>
 </a><!--</td>
 <td align="center" style="vertical-align: middle;">-->
 <a title="Update" href='skills.php?update=<?php echo $row["id"];?>'>
 <button class="btn btn-warning">
 <i class="glyphicon glyphicon-pencil"></i>
 </button>
 </a></td>
						 <td><?php echo $row['skill_name']; ?></td>                                            
						 <td><?php echo $row['version']; ?></td>
						 <td><?php echo $row['total_experience']; ?></td>
						 <td><?php echo $row['rate_skill']; ?></td>
						 
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