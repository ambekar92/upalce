<?php 
include('sup_files/slider.php'); 
include('sup_files/header.php'); 
include('links.php');
//error_reporting(0);
include('sup_files/db.php');

/* Fetching the initial data */
$table='ad_admin';
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

?>

<script type = "text/javascript" language = "javascript">

function reload12()
{	<!-- function is call to header.php (Bootstrap model popup)-->
	window.location='register_clg.php';
}


function Delete(data)
{
	//alert(data);
	$(document).ready(function(){
		$("#commondelete").modal({backdrop:'static'});
		$("#seldelete").html('<a href=register_clg.php?delete='+data+'>'
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
                    <h2>Register Colleges List</small></h2>
                    <ul class="nav navbar-right panel_toolbox" style="min-width:0 !important;">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
				  
                  <div class="x_content"  style="width:100%; overflow-x:scroll;">
                   <table id="datatable" class="table table-striped table-bordered" style="width:1700px;">
                      <thead>
                        <tr style="background-color:#2a3f54;color:#d7dcde;">
                          <th>Action</th>
                          <th>Reg Number</th>
            						  <th>Private Number</th>
            						  <th>Image</th>
            						  <th>College Name</th>
                          <th>Email-ID</th>
                          <th>Mobile Number</th>
                          <th>Country</th>
                          <th>State</th>
                          <th>Current Location</th>
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
						 <td><?php echo $row['reg_number']; ?></td>                                            
						 <td><?php echo $row['private_number']; ?></td>   
						 <td align="center">
						 <?php 
						 if($row['profile_img'] != '')
						 {
						 ?>
						  <img class="img-responsive avatar-view img-thumbnail" src="../admin/<?php echo $row['profile_img']; ?>" alt="found" style="width:50px;height: 50px;">
						 <?php
						 }else{
						?>
						 <img class="img-responsive avatar-view img-thumbnail" src="images/empty.jpg" alt="Image Not Found" style="width:50px;height: 50px;">
						<?php		
						 }
						?>	 
						 </td>                                            
						 <td><?php echo $row['clg_name']; ?></td>                                            
						 <td><?php echo $row['email']; ?></td>                                            
						 <td><?php echo $row['mobile_number']; ?></td>                                         
						 <td><?php echo $row['country']; ?></td>                                            
						 <td><?php echo $row['state']; ?></td>                                            
						 <td><?php echo $row['current_location']; ?></td>                                            
						 
						 
						 
			 <!--href='register_clg.php?update=<?php //echo $row["id"];?>'-->

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