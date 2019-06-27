<?php 
include('sup_files/db.php');
include('sup_files/slider.php'); 
include('sup_files/header.php'); 
include('links.php');
//error_reporting(0);


/* Fetching the initial data */
$table='colleges';
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
	window.location='experience.php';
}


function Delete(data)
{
	//alert(data);
	$(document).ready(function(){
		$("#commondelete").modal({backdrop:'static'});
		$("#seldelete").html('<a href=experience.php?delete='+data+'>'
		+'<input type=button class="btn btn-default" style="height:25px;padding-left: 12px;padding-right: 12px;padding-top: 0px;padding-bottom: 1px;" value="YES"/></a>'
		+'<input type="button" class="btn btn-default" data-dismiss="modal" onclick="reload12();" style="height:25px;padding-left: 12px;padding-right: 12px;padding-top: 0px;padding-bottom: 1px;" value="NO"/>');	
	});
}

//<a href="stu_view_profile.php?stu_id=<?php echo $row["id"]; ?>" target="_blank"></a>
function view(id)
{
	params  = 'width='+window.outerWidth;
	params += ', height='+window.outerHeight;
	params += ', top=0, left=0'
	params += ', fullscreen=yes';
	 
	//alert('<?php echo $_SERVER['HTTP_HOST'];?>');
	if('<?php echo $_SERVER['HTTP_HOST'];?>'=='localhost:8088'){
	window.open("http://<?php echo $_SERVER['HTTP_HOST'];?>/2016/superadmin/stu_view_profile.php?stu_id="+id, "MsgWindow", params);
	}else{
	window.open("http://<?php echo $_SERVER['HTTP_HOST'];?>/superadmin/stu_view_profile.php?stu_id="+id, "MsgWindow", params);
	}
}


function getvalues()
{
	
	$('#print_div').show();
var branchs ='';
var end_years='';
var percent='';
var colleges='';
	branchs = $('#branchs').val();
	end_years = $('#end_years').val();
	percent = $('#percent').val();
	
	colleges=$('#colleges').val();
	//alert(end_years);
	var url ='sureg/exp_srch_json.php?branchs='+branchs+'&end_years='+end_years+'&percent='+percent+'&colleges='+colleges;
	//alert(url);

 	  $.ajax({
	type:'POST',
	url:url,
	success:function(data){
	//	alert(data);
	
	if(data==0){
	$('#status').show().html("<b> Record Not Found </b>");
	}else{
		$('#status').hide();
	}
	
	} 
});	 

	 var table = $('#datatable').DataTable( {
		 dom: 'lBRfrtip',
            buttons: [
                {
                  extend: "copy",
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
                
              ],
            //  responsive: true,
		  destroy: true,
		  Processing: true,
		ajax: url,
		columns	 : [
		{
			 sortable: false,
			 "render": function ( data, type, full, meta ) {
			 return '<a title="Delete"> <button class="btn btn-danger" onclick="Delete('+full[0]+');"> <i class="glyphicon glyphicon-trash"></i> </button> </a>'
			 }
        },
		{'data':'1'},
		{'data':'2'},
		{'data':'3'},
		{'data':'4'},
		{'data':'5'},
		{'data':'6'},
		{'data':'7'},
		{'data':'8'},
		{'data':'9'},
		{
			 sortable: false,
			 "render": function ( data, type, full, meta ) {
			 return '<a href="../student/'+full[10]+'" target="_blank"><img src="images/pdf.png" style="height:30px; width:30px;"> View</a>'
			 }
        },
		{
			 sortable: false,
			 "render": function ( data, type, full, meta ) {
			 return '<button class="btn btn-warning" onclick="view('+full[0]+');">View Profile</button>'
			 }
        }
						
		]
    });


	$('#datatable_print').DataTable( {
		destroy: true,
		paging: false,
		ordering: false,
        info: false,
		searching: false,
		ajax: url,
		columns	 : [
		
		{'data':'1'},
		{'data':'2'},
		{'data':'3'},
		{'data':'4'},
		{'data':'5'},
		{'data':'6'},
		{'data':'7'},
		{'data':'8'},
		{'data':'9'}						
		]
    });
}


</script>
<!-- >>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>><<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<< -->


            <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title hidden-print">
          
            <div class="clearfix"></div>

		
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Search Students</h2>
                    <ul class="nav navbar-right panel_toolbox" style="min-width:0 !important;">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
				   <div class="x_content">
				  <br />
				  
				<div class="col-md-12 col-sm-12 col-xs-12">
				<form id="stu_srch" data-parsley-validate class="form-horizontal form-label-left" action="student.php" method="post" enctype="multipart/form-data">
					<!--<input type="hidden"  name="user_id" value="<?php// echo $stu_id;?>"> --><!-- Get the User_ID Onloading the File-->
					<!--<input type="hidden"  name="id" value="<?php//echo $id;?>">--> <!-- Get the ID from Update each record -->
						
					<div class="row">
					<div class="col-md-12 col-xs-12"> 
                        <label class="col-md-12 col-sm-12 col-xs-12">Select Colleges</label>
                        <div class="col-md-12 col-sm-12 col-xs-12">
                          <select multiple="multiple" name="colleges[]" id="colleges" class="form-control select_college" tabindex="-1" data-placement="right" data-toggle="tooltip" style="width:100% !important;">
                           <!-- Data is fetching form Ajax call (colleges)-->
                          </select>
                        </div> 
                   </div> 
                   <div class="col-md-12 col-xs-12"> 
				   &nbsp;</div>
					<div class="col-md-4 col-xs-12">
					 <label class="col-md-12 col-sm-12 col-xs-12">Select Branchs</label>
                        <div class="col-md-12 col-sm-12 col-xs-12">
                           <select multiple="multiple" name="branchs[]" id="branchs" class="form-control select_college" tabindex="-1" data-placement="right" data-toggle="tooltip" style="width:100% !important;">
                           <!-- Data is fetching form Ajax call (Branchs)-->
                          </select>
                        </div> 
					</div>	
					
					<div class="col-md-4 col-xs-12">
					 <label class="col-md-8 col-sm-12 col-xs-12">Select Passing Year</label>
                        <div class="col-md-8 col-sm-12 col-xs-12">
                          <select  multiple="multiple" name="end_years[]" id="end_years" class="form-control select_branch" data-placement="right" data-toggle="tooltip" title="This field is required." style="width:100% !important;">
                           	<option value="2010">2010</option>
                           	<option value="2011">2011</option>
                           	<option value="2012">2012</option>
                           	<option value="2013">2013</option>
                           	<option value="2014">2014</option>
                           	<option value="2015">2015</option>
                           	<option value="2016">2016</option>
                           	<option value="2017">2017</option>
                           	<option value="2018">2018</option>
                           	<option value="2019">2019</option>
                           	<option value="2020">2020</option>
                           	<option value="2021">2021</option>
                           	<option value="2022">2022</option>
                           	<option value="2023">2023</option>
                           	<option value="2024">2024</option>
                           	<option value="2025">2025</option>
							
                          </select>
                        </div> 
					</div>	
					
					<div class="col-md-4 col-xs-12">
					 <label class="col-md-12 col-sm-12 col-xs-12">Select Percentage %</label>
                        <div class="col-md-12 col-sm-12 col-xs-12">
                          <select  name="percent" id="percent" class="form-control select_percent" data-placement="right" data-toggle="tooltip" style="width:100% !important;">
								<option value="null">Select a Percentage</option>
                            	<option value=">=80"> > = 80</option>
								<option value=">=70"> > = 70</option>
								<option value=">=60"> > = 60</option>
								<option value=">=50"> > = 50</option>
								<option value=">= 50 | <= 60"> > = 50 TO < = 60</option>
								<option value=">= 60 | <= 70"> > = 60 TO < = 70</option>
                          </select>
                        </div> 
					</div>	
					
                    </div> 
					<br>
					
					<div class="row">
									
						<div class="col-md-2 col-sm-3 col-xs-12 col-md-offset-3" id="add_skill_hide">
							<button type="button" name="search" id="search" onclick="getvalues();" class="btn btn-primary" style="width:100%;">Search</button>
						</div>
									
						<div class="col-md-2 col-sm-2 col-xs-12">
							<input type="button" class="btn btn-primary" onclick="reload12();" value="Cancel" style="width:100%;">
						</div>
						<div class="col-md-2 col-sm-3 col-xs-12" style="display:none;" id="print_div">
							<button type="button" onClick="window.print()" class="btn btn-default" style="width:100%;">
							Print Data&nbsp;&nbsp; <i class="fa fa-print"></i></button>
						</div>
					</div>		
				</form>			  
				 </div>
			
	

                </div>
                </div>
              
			  <div class="x_panel">
                  <div class="x_title">
                    <h2>Student List</small></h2>
					
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
					
					<div id="status" style="text-align:center;color:red;font-size:15px;display:none;"></div>
					
                   <table id="datatable" class="table table-striped table-bordered" style="width:1400px;">
                      <thead>
                        <tr style="background-color:#2a3f54;color:#d7dcde;">
                          <!--<th><input type="checkbox" id="check-all" class="flat"></th>-->
						<!--  <th>Delete</th-->
                          <th>Action</th>
						<th>Student Name</th>
						<th>USN</th>
						<th>Email ID</th>
						<th>Mobile</th>
						<th>Gender</th>
                        <th>College Name</th>
                        <th>Branch</th>
                        <th>Passed Year</th>
                        <th>Percentage %</th>
                       <!-- <th>Current Location</th>-->
                        <th>Resume</th>
                        <th>Function</th>
                         
                          
                        </tr>
                      </thead>


                    </table>
                  </div>
			  
			  </div> <!-- col-12 -->
            </div>
          </div>
        </div>
        <!-- /page content -->
		<br/>&nbsp;

		<table id="datatable_print" border="1" class="visible-print-block" style="width:100%;">
                      <thead>
                        <tr>
                         
						<th>Name</th>
						<th>USN</th>
						<th>Email ID</th>
						<th>Mobile</th>
						<th>Gender</th>
                        <th>College</th>
                        <th>Branch</th>
                        <th>Passed Year</th>
                        <th>Percent %</th>
                      </tr>
                      </thead>

                    </table>
					
		        <!-- footer content -->
<?php include('sup_files/footer.php'); ?>
        <!-- /footer content -->
      </div>
    </div>

	

	
	
	 <!-- Datatables -->
    <script>
      $(document).ready(function() {
		  
		  
$.ajax({
	type:'POST',
	url:'sureg/college_data.php',
	success:function(data){
	//	alert(data);
		$('#colleges').html(data);
	}
});

<!-- fetching Branch list-->
$.ajax({
	type:'POST',
	url:'sureg/branch_data.php',
	success:function(data){
	//	alert(data);
		$('#branchs').html(data);
	}
});

		  
		  
		$(".select2_single_country").select2({
          placeholder: "Select a College",
          allowClear: true
        });
       
		$(".select_branch").select2({
          maximumSelectionLength: 4,
          placeholder: "Select a Branchs",
          allowClear: true
        });
	
		$(".select_percent").select2({
          maximumSelectionLength: 4,
          placeholder: "Select a Percentage",
          allowClear: true
        });
	  
       
		$(".select_college").select2({
          maximumSelectionLength: 4,
          placeholder: "Select a Colleges",
          allowClear: true
        });
	
	
  
        TableManageButtons = function() {
          "use strict";
          return {
            init: function() {
              handleDataTableButtons();
            }
          };
        }();

         $('#datatable').dataTable({
		  destroy:true
	  });


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


