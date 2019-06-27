<?php 
include('sup_files/slider.php'); 
include('sup_files/header.php'); 
include('links.php');
//error_reporting(0);
include('sup_files/db.php');

/* Fetching the initial data */
$table='stu_projects_links';
$whereCond="fk_stu_id='$stu_id'";	
$Query = 'select * from '.$table.' where '.$whereCond;
$projects_link = mysql_query($Query) or die("Error in Selection Query <br> ".$Query."<br>". mysql_error());


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
		$link_name=$row['link_name']; 
		$link_discription=$row['link_discription']; 	 
	}
}

/* Add the record to DATABASE */
if(isset($_POST['submit_data']))
{
	$link_name = $_POST['link_name'];
	$link_discription = $_POST['link_discription'];

	$user_id = $_POST['user_id'];
	
	if($link_name !='')
	{		
		//mysql_query("update STU_STUDENT set cover_letter='$cover' where id='$user_id'") or die("error !!");	
		//$table = stu_projects_links;	
		$Query ="insert into $table (fk_stu_id,link_name,link_discription) 
		values('$user_id','$link_name','$link_discription')";  
	
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
	$link_name = $_POST['link_name'];
	$link_discription = $_POST['link_discription'];

	$user_id = $_POST['user_id'];
	$id = $_POST['id'];
	
	if($link_name !='')
	{		
		//mysql_query("update STU_STUDENT set cover_letter='$cover' where id='$user_id'") or die("error !!");	
		//$table = stu_projects_links;	
		$Query = "UPDATE $table set link_name='$link_name',link_discription='$link_discription'
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
	window.location='links_projects.php';
}


function Delete(data)
{
	//alert(data);
	$(document).ready(function(){
		$("#commondelete").modal({backdrop:'static'});
		$("#seldelete").html('<a href=links_projects.php?delete='+data+'>'
		+'<input type=button class="btn btn-default" style="height:25px;padding-left: 12px;padding-right: 12px;padding-top: 0px;padding-bottom: 1px;" value="YES"/></a>'
		+'<input type="button" class="btn btn-default" data-dismiss="modal" onclick="reload12();" style="height:25px;padding-left: 12px;padding-right: 12px;padding-top: 0px;padding-bottom: 1px;" value="NO"/>');	
	});
}


function validate_url()
{
 	var url_data=document.getElementById("link_name").value;
	
	var matches = url_data.match(/https:\/\/(?:www\.)?youtube.*watch\?v=([a-zA-Z0-9\-_]+)/);
	if (matches) {
	$('#status_name').html('<p style=color:green;>Success</p>');
	} else {
	$('#status_name').html('<p style=color:red>Mention the Valid link</p>'); 
	}
}
function checkPermission()
	{
		var project_link_status = '<?php echo "$project_link_status"; ?>';
		if(project_link_status == 'D')
		{
			$('#inactive_link').show();
			$('#active_link').hide();

			$('#skill_update').prop('disabled', true);
			$('#submit_data').prop('disabled', true);
			$('#cancel').prop('disabled', true);
			$('#link_discription').prop('disabled', true);
			$('#link_name').prop('disabled', true);
		}else{
			$('#active_link').show();
			$('#inactive_link').hide();

			$('#skill_update').prop('disabled', false);
			$('#submit_data').prop('disabled', false);
			$('#cancel').prop('disabled', false);
			$('#link_discription').prop('disabled', false);
			$('#link_name').prop('disabled', false);
		}
	}

$(document).ready(function(){
	checkPermission();
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
                    <h2>Invention / Project Link</h2>
                    <ul class="nav navbar-right panel_toolbox" style="min-width:0 !important;">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
				   <div class="x_content">
				  <br />
<div class="alert alert-danger" id="inactive_link">
  <strong>Access Denied !</strong> Please Contact Admin to Access it.
</div>

<div class="alert alert-success" id="active_link">
  <strong>Success !</strong> You Have a Permission to Access it.
</div>
				<form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" action="links_projects.php" method="post" enctype="multipart/form-data">
					<input type="hidden"  name="user_id" value="<?php echo $stu_id;?>"> <!-- Get the User_ID Onloading the File-->
					<input type="hidden"  name="id" value="<?php echo $id;?>"> <!-- Get the ID from Update each record -->
					
					<div class="col-md-1">
					</div>
					<div class="form-group">
                        <label class="control-label col-md-2 col-sm-2 col-xs-12">Link Name<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-2 col-xs-12">
<input type="text" onchange="validate_url();" value="<?php echo $link_name; ?>" name="link_name" id="link_name"  required="required" placeholder="https:// [Copy and Paste Youtube URL link]" class="form-control col-md-7 col-xs-12" autofocus>
                        <h5>Note: Only Facebook and Youtube link </h5>
						<span id="status_name"></span>
						</div>
						
					</div>
					<br>
					  <div class="col-md-1">
					</div>
					<div class="form-group">
                        <label class="control-label col-md-2 col-sm-2 col-xs-12">Link Discription<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-2 col-xs-12">
                    <textarea name="link_discription" id="link_discription" required="required" class="form-control" placeholder="Enter Link Description" style="height:80px;" maxlength="1000"><?php echo $link_discription; ?></textarea>					</div>
					</div>	
					
					<br>
					 
<div class="form-group">
<div class="col-md-4 col-sm-3 col-xs-12">
</div>
	<div class="col-md-2 col-sm-3 col-xs-12" id="add_skill_hide">
		<button type="submit" name="submit_data" id="submit_data" class="btn btn-primary" style="width:150px;">Add Link</button>
	</div>
	 
	 <div class="col-md-2 col-sm-3 col-xs-12" style="display:none;" id="update_skill_hide">
		<button type="submit" name="skill_update" id="skill_update" class="btn btn-success" style="width:150px;">Update Link</button>
	</div>
	
	<div class="col-md-3 col-sm-3 col-xs-12">
		<input type="submit" id="cancel" class="btn btn-primary" onclick="reload12();" value="Cancel" style="width:150px;">
		</div>
  </div>
					  
                      <div class="ln_solid"></div>
				
				</form>
				  
                </div>
                </div>
              
			  <div class="x_panel">
                  <div class="x_title">
                    <h2>Project Links</h2>
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
                          <th>link_name</th>
                          <th>link_discription</th>
                                                  
                        </tr>
                      </thead>


                      <tbody>

					<?php
						 while ($row=mysql_fetch_array($projects_link)) 
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
 <a title="Update" href='links_projects.php?update=<?php echo $row["id"];?>'>
 <button class="btn btn-warning">
 <i class="glyphicon glyphicon-pencil"></i>
 </button>
 </a></td>
						 <td align="center">
						<?php 
						$filename=$row['link_name']; 
						$vedio_name=substr($filename,32);
						//echo $vedio_name;
							?>
						 <iframe width="350" height="250" src="https://www.youtube.com/embed/<?php echo $vedio_name; ?>" frameborder="0" allowfullscreen></iframe>
						 </td>                                            
						 <td>
<textarea class="col-md-12" name="project_details" class="form-control" placeholder="Discription" style="height:200px;;" maxlength="1000" readonly><?php echo $row['link_discription']; ?></textarea>
                        						 
						 </td>
					
						 
			 <!--href='links_projects.php?update=<?php //echo $row["id"];?>'-->

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