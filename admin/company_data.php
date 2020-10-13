<?php 
include('sup_files/db.php');
include('sup_files/slider.php'); 
include('sup_files/header.php'); 
include('links.php');


/* Fetching the initial data */
$table='data_for_comp';
$whereCond="fk_admin_id='$ad_id'";	
$query = 'select * from '.$table.' where '.$whereCond.'ORDER BY id DESC';
$data = mysql_query($query) or die("Error in Selection Query <br> ".$query."<br>". mysql_error());




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
<script src="js/copyme.js"></script>
<script type = "text/javascript" language = "javascript">

function Delete(data)
{
	//alert(data);
	$(document).ready(function() {
		$("#commondelete").modal({backdrop:'static'});
		$("#seldelete").html('<a href=company_data.php?delete='+data+'>'
		+'<input type=button class="btn btn-default" style="height:25px;padding-left: 12px;padding-right: 12px;padding-top: 0px;padding-bottom: 1px;" value="YES"/></a>'
		+'<input type="button" class="btn btn-default" data-dismiss="modal" onclick="reload12();" style="height:25px;padding-left: 12px;padding-right: 12px;padding-top: 0px;padding-bottom: 1px;" value="NO"/>');	
	});

}
function active(id)
{
	   $.ajax({
		   type: 'post',
		   url: 'adminreg/active_de.php',
		   data: {
		   activate:"active",
		   data_id:id,
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
		   url: 'adminreg/active_de.php',
		   data: {
		   inactive:"inactive",
		   data_id:id,
		   },
		   success: function (response) {
			  //alert(response);
			$("#commondialog").modal({backdrop:'static'});
			$("#getCode").html(response);	
	
		 }
	   });
}	

function reload12()
{	<!-- function is call to header.php (Bootstrap model popup)-->
	window.location='company_data.php';

}




//<a href="stu_view_profile.php?stu_id=<?php echo $row["id"]; ?>" target="_blank"></a>
function sql(data_id){
	//alert(<?php echo $ad_clg_id; ?>);
	
	params  = 'width='+window.outerWidth;
	params += ', height='+window.outerHeight;
	params += ', top=0, left=0'
	params += ', fullscreen=yes,scrollbars: 0';
	 
	//alert('<?php echo $_SERVER['HTTP_HOST'];?>');
	if('<?php echo $_SERVER['HTTP_HOST'];?>'=='localhost:8088'){	
	
		var url="http://<?php echo $_SERVER['HTTP_HOST'];?>/uplace/admin/company_data_view.php?data_id="+data_id+"&clg_id="+<?php echo $ad_clg_id; ?>;
		//document.getElementById("url_id").value = url;
		var win = window.open("about:blank","",params);
		win.document.write('<iframe src='+url+' style="height: 92%;width: 100%;border: none;overflow:hidden;"></iframe>');
		
	}else{
		
		var url="https://<?php echo $_SERVER['HTTP_HOST'];?>/admin/company_data_view.php?data_id="+data_id+"&clg_id="+<?php echo $ad_clg_id; ?>;
		//document.getElementById("url_id").value = url;
		var win = window.open("about:blank","",params);
		win.document.write('<iframe src='+url+' style="height: 92%;width: 100%;border: none;overflow:hidden;"></iframe>');
	}
	
}
function view(id)
{
	params  = 'width='+window.outerWidth;
	params += ', height='+window.outerHeight;
	params += ', top=0, left=0'
	params += ', fullscreen=yes,scrollbars: 0';
	 
	//alert('<?php echo $_SERVER['HTTP_HOST'];?>');
	if('<?php echo $_SERVER['HTTP_HOST'];?>'=='localhost:8088'){	
	
		var url="http://<?php echo $_SERVER['HTTP_HOST'];?>/uplace/admin/stu_view_profile.php?stu_id="+id;
		var win = window.open("about:blank","",params);
		win.document.write('<iframe src='+url+' style="height: 92%;width: 100%;border: none;overflow:hidden;"></iframe>');
		
	}else{
		
		var url="http://<?php echo $_SERVER['HTTP_HOST'];?>/admin/stu_view_profile.php?stu_id="+id;		
		var win = window.open("about:blank","",params);
		win.document.write('<iframe src='+url+' style="height: 92%;width: 100%;border: none;overflow:hidden;"></iframe>');
	}
}


</script>
<!-- >>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>><<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<< -->

 <div class="modal fade" id="commondialog1" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
		   <div class="modal-header">
			<!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>-->
			 <h5 class="modal-title" id="myModalLabel">Message</h5>
		   </div>
				 <div class="modal-body">
					<!-- passing value form script-->
					<input name="getCode1" id="getCode1" class="form-control col-md-12 col-xs-12" type="text" readonly>
					<br><br>
				 </div>
		  <div class="modal-footer" style="margin-bottom: -10px;padding: 12px;">
			<input type="button" class="btn btn-default" data-dismiss="modal"
	style="height:25px;padding-left: 12px;padding-right: 12px;padding-top: 0px;padding-bottom: 1px;" value="Close"/>
		<input type="button" class="btn btn-warning" id="copy" style="height:25px;padding-left: 12px;padding-right: 12px;padding-top: 0px;padding-bottom: 1px;" value="Copy Link"/>
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
				
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
			
				<div class="x_content" style="width:100%; overflow-x:scroll;">
                    <!--<p class="text-muted font-13 m-b-30">
                      DataTables has most features enabled by default, so all you need to do to use it with your own tables is to call the construction function: <code>$().DataTable();</code>
                    </p>table table-striped jambo_table bulk_action                    style="width:1700px;" -->
				
					<div id="status" style="text-align:center;color:red;font-size:15px;display:none;"></div>
							
					<table id="datatable" class="table table-striped table-bordered">
                      <thead>
                        <tr style="background-color:#2a3f54;color:#d7dcde;">
                          <!--<th><input type="checkbox" id="check-all" class="flat"></th>-->
						<!--  <th>Delete</th-->
                        <th>Action</th>
						<th>Link Name</th>
						<th>Profile Link</th>
						<th>Status</th>
						</tr>
                      </thead>


                      <tbody>

					<?php
						 while ($row=mysql_fetch_array($data)) 
						   {   
					   ?>                            
						<tr>
						<td align="center" style="vertical-align: middle;">
						 <a title="Delete">
						 <button class="btn btn-danger btn-sm" onclick="Delete(<?php echo $row["id"];?>);">
						 <i class="glyphicon glyphicon-trash"></i>
						  </button>
						 </a> 
						 </td>
						 <td><?php echo $row["link_name"]; ?></td>                                            
						 <td style="vertical-align: middle;">
						 <?php
						 if($row["status"] == 'active')
						 {
						 ?>
						 <button id="view_profile" class="btn btn-warning btn-sm col-md-offset-2 col-md-4 col-xs-12" onclick="sql('<?php echo $row["id"]; ?>');">View Profile</button>
						  <button id="copy_link" class="btn btn-primary btn-sm col-md-4 col-xs-12" onclick="generate_link('<?php echo $row["id"]; ?>');">Generate Link</button>
						 </td>                                            
						 <?php
						 }
						 ?>
						 <td align="center" style="vertical-align: middle;"> 
						    <?php
							 if($row["status"] == 'active')
							 {
							?>
							<img src="images/active.png" style="width:30px;">
							<!--</td> <td align="center">-->
							<button type="submit" name="deactivate" id="deactivate" onclick="inactive(<?php echo $row["id"];?>);" class="btn btn-danger btn-sm" style="width:120px;">Deactivate</button>
	
							<?php
							 }else{
							 ?>
							<img src="images/inactive.png" style="width:30px;">
							<!--</td> <td align="center">-->
								<button type="submit" name="activate" id="activate" onclick="active(<?php echo $row["id"];?>);" class="btn btn-info btn-sm" style="width:120px;">Activate</button>
	
							<?php }?>
						 </td>                                            
		
						
						 </tr>
			 <!--href='active_clg.php?update=<?php //echo $row["id"];?>'-->

						<?php 
						   }
						 ?>
                        
                      
                      </tbody>
                    </table>
					
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
	
	
	function generate_link(data_id){
		if('<?php echo $_SERVER['HTTP_HOST'];?>'=='localhost:8088'){	
			
				var url="http://<?php echo $_SERVER['HTTP_HOST'];?>/uplace/admin/company_data_view.php?data_id="+data_id+"&clg_id="+<?php echo $ad_clg_id; ?>;
				$(document).ready(function() {
					 $("#commondialog1").modal({backdrop:'static'});
						$("#getCode1").val(url);	
				});
			}else{
				
				var url="http://<?php echo $_SERVER['HTTP_HOST'];?>/admin/company_data_view.php?data_id="+data_id+"&clg_id="+<?php echo $ad_clg_id; ?>;
				$(document).ready(function() {
					 $("#commondialog1").modal({backdrop:'static'});
						$("#getCode1").val(url);	
				});
			}
			
		
	}
	  function copy_link(data_id){
			//alert('<?php echo $_SERVER['HTTP_HOST'];?>');
			if('<?php echo $_SERVER['HTTP_HOST'];?>'=='localhost:8088'){	
			
				var url="http://<?php echo $_SERVER['HTTP_HOST'];?>/2016/admin/company_data_view.php?data_id="+data_id+"&clg_id="+<?php echo $ad_clg_id; ?>;
				$(document).ready(function() {
					//alert(url); 
					//$('#url_id').html(url);	
					$('#url_id').copyme();
				});
			}else{
				
				var url="http://<?php echo $_SERVER['HTTP_HOST'];?>/admin/company_data_view.php?data_id="+data_id+"&clg_id="+<?php echo $ad_clg_id; ?>;
				$(document).ready(function() {
					//alert(url); 
					//$('#url_id').html(url);	
					$('#url_id').copyme();
				});
			}
			
			
			
		}
		
      $(document).ready(function() {
		 
		  $('#copy').click(function(){
			  $('#getCode1').copyme();
			  
			  setTimeout(function(){ $('#success-alert').fadeOut(); }, 3000);
			});

		  $(".branchs").select2({
          placeholder: "Select a Branch",
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


