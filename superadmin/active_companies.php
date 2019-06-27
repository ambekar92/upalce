<?php 
include('sup_files/slider.php'); 
include('sup_files/header.php'); 
include('links.php');
//error_reporting(0);
include('sup_files/db.php');

/* Fetching the initial data */
$table='su_active_companies';
/* $whereCond="fk_stu_id='$stu_id'";	 */
$Query = 'select * from '.$table;
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



/* Add the record to DATABASE */
if(isset($_POST['submit_data']))
{
	$clg_name_data = $_POST['clg_name'];
	$clg_name_value= explode("|",$clg_name_data);// getting only name
		$company_id=$clg_name_value[0];
		$company_name=$clg_name_value[1];
		
	$private_number='COMP'.rand(1111111111,9999999999);
 
	if($company_id !='')
	{		
		//mysql_query("update STU_STUDENT set cover_letter='$cover' where id='$user_id'") or die("error !!");	
		//$table = stu_active_companies;	
		$Query ="insert into $table (company_id,company_name,private_number,status) values('$company_id','$company_name','$private_number','inactive')";  
	
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


?>

<script type = "text/javascript" language = "javascript">

function reload12()
{	<!-- function is call to header.php (Bootstrap model popup)-->
	window.location='active_companies.php';
}


function Delete(data)
{
	//alert(data);
	$(document).ready(function(){
		$("#commondelete").modal({backdrop:'static'});
		$("#seldelete").html('<a href=active_companies.php?delete='+data+'>'
		+'<input type=button class="btn btn-default" style="height:25px;padding-left: 12px;padding-right: 12px;padding-top: 0px;padding-bottom: 1px;" value="YES"/></a>'
		+'<input type="button" class="btn btn-default" data-dismiss="modal" onclick="reload12();" style="height:25px;padding-left: 12px;padding-right: 12px;padding-top: 0px;padding-bottom: 1px;" value="NO"/>');	
	});
}

function active(id)
{
	   $.ajax({
		   type: 'post',
		   url: 'sureg/active_de.php',
		   data: {
		   comp_activate:"active",
		   company_id:id,
		   },
		   success: function (response) {
			// alert(response);
		
			  $("#commondialog").modal({backdrop:'static'});
				$("#getCode").html(response);	
		
		
		 }
	   });
}

function inactive(id)
{
	   $.ajax({
		   type: 'post',
		   url: 'sureg/active_de.php',
		   data: {
		   comp_inactive:"inactive",
		   company_id:id,
		   },
		   success: function (response) {
			  //alert(response);
			$("#commondialog").modal({backdrop:'static'});
			$("#getCode").html(response);	
	
		 }
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
                    <h2>Activete Company</h2>
                    <ul class="nav navbar-right panel_toolbox" style="min-width:0 !important;">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
				   <div class="x_content">
				  <br />
				  
				<div class="col-md-3">
				</div>
				
				<div class="col-md-6">
				<form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" action="active_companies.php" method="post" enctype="multipart/form-data">
					<!--<input type="hidden"  name="user_id" value="<?php// echo $stu_id;?>"> --><!-- Get the User_ID Onloading the File-->
					<input type="hidden"  name="id" value="<?php echo $id;?>"> <!-- Get the ID from Update each record -->
						
					<div class="row">
						<label class="control-label col-md-3 col-sm-2 col-xs-12">Company Name<span class="required">*</span></label>
                         <?php 
						//Get all country data
						$get_clg = "SELECT * FROM companies ORDER BY comp_name ASC ";	
						$clg_d = mysql_query($get_clg) or die("Error in Selection Query <br> ".$Query."<br>". mysql_error());
						//echo $private_number='ADM'.rand(1111111111,9999999999);
						?>
                        <div class="col-md-12 col-sm-6 col-xs-12">
                          <select  name="clg_name" id="clg_name" class="form-control select2_single_country" tabindex="-1" required="required" data-placement="right" data-toggle="tooltip" title="This field is required.">
                            <option></option>
                            <?php
							
								while($row=mysql_fetch_array($clg_d)){ 
									echo '<option value="'.$row['id'].'|'.$row['comp_name'].'">'.$row['comp_name'].'</option>';
								}
							
							?>
                          </select>
                        </div>
                    </div> 
					<br>
					<div class="row">
					<div class="col-md-2 col-sm-3 col-xs-12">
					</div>
						<div class="col-md-4 col-sm-3 col-xs-6" id="add_skill_hide">
							<button type="submit" name="submit_data" id="submit_data" class="btn btn-primary" style="width:120px;">Add Company</button>
						</div>
						 
						 <div class="col-md-6 col-sm-3 col-xs-6" style="display:none;" id="update_skill_hide">
							<button type="submit" name="skill_update" id="skill_update" class="btn btn-success" style="width:120px;">Update</button>
						</div>
						
						<div class="col-md-3 col-sm-3 col-xs-6">
							<input type="submit" class="btn btn-primary" onclick="reload12();" value="Cancel" style="width:120px;">
							</div>
					</div>		
				</form>			  
				</div>
			
	            </div>
                </div>
              
			  <div class="x_panel">
                  <div class="x_title">
                    <h2>Active / Inactive Company List</small></h2>
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
						  <th>Company Name</th>
                          <th>Private Number</th>
                          <th>Status</th>
                          <th>Action</th>
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
						 </a> 
						 </td>
						<td><?php echo $row['company_name'];?></td>
						 <td style="font-size:18px;"><b><?php echo $row['private_number']; ?></b></td>                                            
						 <td align="center"> 
						    <?php
							//echo $row['status'];
							
							 if($row['status'] == 'active')
							 {
							?>
							<img src="images/active.png" style="width:35px;">
							</td> <td align="center">
							<button type="submit" name="deactivate" id="deactivate" onclick="inactive(<?php echo $row["id"];?>);" class="btn btn-danger" style="width:120px;">Deactivate</button>
	
							<?php
							 }else{
							 ?>
							<img src="images/inactive.png" style="width:35px;">
							</td> <td align="center">
								<button type="submit" name="activate" id="activate" onclick="active(<?php echo $row["id"];?>);" class="btn btn-info" style="width:120px;">Activate</button>
	
							<?php }?>
						 </td>                                            
		
						
						 </tr>
			 <!--href='active_companies.php?update=<?php //echo $row["id"];?>'-->

						<?php 
						   }
						 ?>
                        
                      
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
		//  alert();

        $(".select2_single_country").select2({
          placeholder: "Select a Company",
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