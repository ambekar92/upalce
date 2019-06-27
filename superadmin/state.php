<?php 
include('sup_files/slider.php'); 
include('sup_files/header.php'); 
include('links.php');
//error_reporting(0);
include('sup_files/db.php');

$value= $_GET['countryID'];
$country_val= explode(".",$value);// getting only name

	if($value != '')
	{//echo "t";
		?>
		<script type="text/javascript">
		$(document).ready(function() {	
			$("#state_name").prop('disabled', false);
		});	
		</script>
<?php	}
/* Fetching the initial data */
$table='states';
$whereCond="country_id='$country_val[0]'";
$Query = 'select * from '.$table.' where '.$whereCond;
//echo $Query;
$skill_dataa = mysql_query($Query) or die("Error in Selection Query <br> ".$Query."<br>". mysql_error());


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
		 $skill_del ="DELETE FROM $table WHERE country_id='$delete'";
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
							$("#state_name").prop('disabled', false);
					});
			</script> <!-- hide the add_skill btn and display update btn -->
		<?php
		}
		
 $skill_del ="SELECT * FROM $table where state_id='$update_id'";
 $Skill_Result=mysql_query($skill_del) or die(mysql_error());
 
	while($row=mysql_fetch_array($Skill_Result)) 
	{
		$state_id=$row['state_id']; 
		$state_name=$row['state_name']; 
	}
}

/* Add the record to DATABASE */
if(isset($_POST['submit_data']))
{
	$state_name = $_POST['state_name'];
	

	if($state_name !='')
	{		
		//mysql_query("update STU_STUDENT set cover_letter='$cover' where id='$user_id'") or die("error !!");	
		//$table = stu_country;	
		$Query ="insert into $table (state_name) values('$state_name')";  
	
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
	$state_name = $_POST['state_name'];
	$state_id = $_POST['state_id'];
	
	if($state_name !='')
	{		
		//mysql_query("update STU_STUDENT set cover_letter='$cover' where id='$user_id'") or die("error !!");	
		//$table = stu_country;	
		$Query = "UPDATE $table set state_name='$state_name' WHERE state_id = '$state_id'";
					
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
	window.location='state.php';
}


function Delete(data)
{
	//alert(data);
	$(document).ready(function(){
		$("#commondelete").modal({backdrop:'static'});
		$("#seldelete").html('<a href=state.php?delete='+data+'>'
		+'<input type=button class="btn btn-default" style="height:25px;padding-left: 12px;padding-right: 12px;padding-top: 0px;padding-bottom: 1px;" value="YES"/></a>'
		+'<input type="button" class="btn btn-default" data-dismiss="modal" onclick="reload12();" style="height:25px;padding-left: 12px;padding-right: 12px;padding-top: 0px;padding-bottom: 1px;" value="NO"/>');	
	});
}

$(document).ready(function() {
 $('#country').on('change',function(){
	// alert('s');
    var countryID = $(this).val();
  window.location.href = "state.php?countryID=" + countryID; 
		});		
});	
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
                    <h2>States</h2>
                    <ul class="nav navbar-right panel_toolbox" style="min-width:0 !important;">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
				   <div class="x_content">
				  <br />
				<form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" action="state.php" method="post" enctype="multipart/form-data">
					<!--<input type="hidden"  name="user_id" value="<?php// echo $stu_id;?>"> --><!-- Get the User_ID Onloading the File-->
					<input type="hidden"  name="state_id" value="<?php echo $state_id;?>"> <!-- Get the ID from Update each record -->
					
					<div class="col-md-2 col-sm-2 col-xs-12">
					</div>
					<div class="form-group">
                 						
						<label class="control-label col-md-2 col-sm-2 col-xs-12">Country Name<span class="required">*</span>
                        </label>
                        <div class="col-md-5 col-sm-5 col-xs-12">
                          <select  name="country" id="country" class="form-control select2_single_country" tabindex="-1" data-placement="right" data-toggle="tooltip" title="This field is required." style="width:100%;">
                            <option></option>
                            <?php
					
						//Get all country data
						$get_con = "SELECT * FROM countries  ORDER BY country_name ASC ";	
						$country_data = mysql_query($get_con) or die("Error in Selection Query <br> ".$Query."<br>". mysql_error());
						while($row=mysql_fetch_array($country_data)){ 
									echo '<option value="'.$row['country_id'].'.'.$row['country_name'].'">'.$row['country_name'].'</option>';
								}
							
							?>
                          </select>
                        </div>
                      </div>
					  <div class="col-md-2 col-sm-2 col-xs-12">
					</div>
					
					<div class="form-group">
                 						
						<label class="control-label col-md-2 col-sm-2 col-xs-12">State Name<span class="required">*</span>
                        </label>
                        <div class="col-md-5 col-sm-5 col-xs-12">
                          <input type="text" value="<?php echo $state_name; ?>" disabled="disabled"  id="state_name" name="state_name" placeholder="State Name" class="form-control col-md-7 col-xs-12">
						  
                        </div>
                      </div>
					 <br>
					 
<div class="form-group">
<div class="col-md-4 col-sm-3 col-xs-12">
</div>
	<div class="col-md-2 col-sm-3 col-xs-12" id="add_skill_hide">
		<button type="submit" name="submit_data" id="submit_data" class="btn btn-primary" style="width:150px;">Add State</button>
	</div>
	 
	 <div class="col-md-2 col-sm-3 col-xs-12" style="display:none;" id="update_skill_hide">
		<button type="submit" name="skill_update" id="skill_update" class="btn btn-success" style="width:150px;">Update State</button>
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
                    <h2><?php echo $country_val[1]; ?>: State List</small></h2>
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
                          <th>State id</th>
                          <th>State Name</th>
                         
                          
                        </tr>
                      </thead>


                      <tbody>

					<?php
						 while ($row=mysql_fetch_array($skill_dataa)) 
						   {   
					   ?>                            
<tr>
<td align="center" style="vertical-align: middle;">
 <a title="Delete">
 <button class="btn btn-danger" onclick="Delete(<?php echo $row["state_id"];?>);">
 <i class="glyphicon glyphicon-trash"></i>
  </button>
 </a><!--</td>
 <td align="center" style="vertical-align: middle;">-->
 <a title="Update" href='state.php?update=<?php echo $row["state_id"];?>'>
 <button class="btn btn-warning">
 <i class="glyphicon glyphicon-pencil"></i>
 </button>
 </a></td>
						 <td><?php echo $row['state_id']; ?></td>                                            
						 <td><?php echo $row['state_name']; ?></td>
						 
						 
			 <!--href='country.php?update=<?php //echo $row["id"];?>'-->

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
		
     $(".select2_single_country").select2({
          placeholder: "Select a Country",
          allowClear: true
        });
        $(".select2_group").select2({});
        $(".select2_multiple").select2({
          maximumSelectionLength: 4,
          placeholder: "With Max Selection limit 4",
          allowClear: true
        });
  
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