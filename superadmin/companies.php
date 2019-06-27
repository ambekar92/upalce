<?php 
include('sup_files/slider.php'); 
include('sup_files/header.php'); 
include('links.php');
//error_reporting(0);
include('sup_files/db.php');

/* Fetching the initial data */
$table='companies';
/* $whereCond="fk_stu_id='$stu_id'";	 */
$Query = 'select * from '.$table;
$company_data = mysql_query($Query) or die("Error in Selection Query <br> ".$Query."<br>". mysql_error());


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
			</script> <!-- hide the add_company btn and display update btn -->
		<?php
		 $company_del ="DELETE FROM $table WHERE id='$delete'";
		 mysql_query($company_del) or die(mysql_error());
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
						$("#add_company_hide").hide(); 
						$("#update_company_hide").show();	
					});
			</script> <!-- hide the add_company btn and display update btn -->
		<?php
		}
		
 $company_del ="SELECT * FROM $table where id='$update_id'";
 $company_Result=mysql_query($company_del) or die(mysql_error());
 
	while($row=mysql_fetch_array($company_Result)) 
	{
		$id=$row['id']; 
		$company_name=$row['comp_name']; 
		

		 
	}
}

/* Add the record to DATABASE */
if(isset($_POST['submit_data']))
{
	$company_name = $_POST['company_name'];
	

	if($company_name !='')
	{		
		//mysql_query("update STU_STUDENT set cover_letter='$cover' where id='$user_id'") or die("error !!");	
		//$table = stu_company;	
		$Query ="insert into $table (comp_name) values('$company_name')";  
	
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
if(isset($_POST['company_update']))
{
	$company_name = $_POST['company_name'];
	$id = $_POST['id'];
	
	if($company_name !='')
	{		
		//mysql_query("update STU_STUDENT set cover_letter='$cover' where id='$user_id'") or die("error !!");	
		//$table = stu_company;	
		$Query = "UPDATE $table set comp_name='$company_name' WHERE id = '$id'";
					
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
$(document).ready(function() {	
	
	$.ajax({
    url: 'sureg/add_companies_json.php',
    type: 'POST',
    success: function (returndata) {
		//alert(returndata);
		 
    }
  });
  
	 var table = $('#datatable').DataTable( {
		
		ajax: "sureg/add_companies_json.php",
	
		columns	 : [
		{
			 sortable: false,
			 "render": function ( data, type, full, meta ) {
				 return '<a title="Delete"> <button class="btn btn-danger" onclick="Delete('+full[0]+');"> <i class="glyphicon glyphicon-trash"></i> </button> </a>'
			 }
        },
		{
			 sortable: false,
			 "render": function ( data, type, full, meta ) {
				 return '<a title="Delete" href="companies.php?update='+full[0]+'"> <button class="btn btn-warning"> <i class="glyphicon glyphicon-pencil"></i> </button> </a>'
			 }
        },
		
		
		{'data':'0'},
		{'data':'2'}
		
		]

    });

//alert();	
/*  $.ajax({
url: 'sureg/company_data.php',
success: function (returndata) {
	var s= JSON.parse(returndata)
	alert(s[5].company_name);

	
}
});  */

//img upload func
$("form#upload_data").submit(function(event){
	//alert('asd'); 
 $(".progress").show();
	 var formData = new FormData($(this)[0]);
	$.ajax({
    url: 'import.php',
    type: 'POST',
    data: formData,
    //async: false,
    cache: false,
    contentType: false,
    processData: false,
    success: function (returndata) {
		//alert(returndata);
		 $(".progress").hide();
    <!-- function is call to header.php (Bootstrap model popup)-->
	$("#getCode").html(returndata);
    $("#commondialog").modal({backdrop:'static'});
	//window.location.reload(true);
   
    }
  });
 
  return false;
});	

});	
function reload12()
{	<!-- function is call to header.php (Bootstrap model popup)-->
	window.location='companies.php';
}


function Delete(data)
{
	//alert(data);
	$(document).ready(function(){
		$("#commondelete").modal({backdrop:'static'});
		$("#seldelete").html('<a href=companies.php?delete='+data+'>'
		+'<input type=button class="btn btn-default" style="height:25px;padding-left: 12px;padding-right: 12px;padding-top: 0px;padding-bottom: 1px;" value="YES"/></a>'
		+'<input type="button" class="btn btn-default" data-dismiss="modal" onclick="reload12();" style="height:25px;padding-left: 12px;padding-right: 12px;padding-top: 0px;padding-bottom: 1px;" value="NO"/>');	
	});
}


function AlertFilesize()
{		
	var sizeinbytes = document.getElementById('resume_name').files[0].size;
	var fSExt = new Array('Bytes', 'KB', 'MB', 'GB');
	
		
	fSize = sizeinbytes; i=0;while(fSize>900){fSize/=1024;i++;}
	//alert((Math.round(fSize*100)/100)+' '+fSExt[i]);
	var size=((Math.round(fSize*100)/100));//+' '+fSExt[i]);
	//alert(size);
	if(fSExt[i] =='KB'){
	$('#size').html("<p style='color:green;font-size:14;'><b> File size :"+size+" "+fSExt[i]+"<b></p>");
	}
	else if(size < 3 && fSExt[i] =='MB'){
	$('#size').html("<p style='color:green;font-size:14;'><b> File size :"+size+" "+fSExt[i]+"<b></p>");
	}
	else{
	$('#size').html("<p style='color:red;font-size:14;'><b>File size : "+size+" "+fSExt[i]+" , ( File size must be excately 3 MB )<b></p>");
	}
		
			var allowedFiles = [".csv"];
            var fileUpload = document.getElementById("resume_name");
            var lblError = document.getElementById("lblError");
            var regex = new RegExp("([a-zA-Z0-9\s_\\.\-:])+(" + allowedFiles.join('|') + ")$");
            if (!regex.test(fileUpload.value.toLowerCase())) {
                lblError.innerHTML = "Please upload <b>" + allowedFiles.join(', ') + "</b> file only.";
                return false;
            }
			else{
            lblError.innerHTML = "";
            return true;
			}
}



</script>

		
<div class="progress" style="width: 100%;
   height: 100%;
   top: 0;
   left: 0;
   position: fixed;
   display: block;
   opacity: 0.7;
   background-color: #004C8C;
   z-index: 9045;
   text-align: center;
   display:none;">
   
   <div style="position: relative; 
   width: 100%;">
   <img src="images/loader.gif" style="margin-top:18%;width:100px;">
   
   <h2 style="position: absolute; 
   top: 350px; 
   left: 0; 
   width: 100%;
   color:white;
   font-size:16px;">please wait..</h2>
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
                    <h2>Company</h2>
                    <ul class="nav navbar-right panel_toolbox" style="min-width:0 !important;">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
				   <div class="x_content">
				  <br />
				  
				<div class="col-md-8">
				<form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" action="companies.php" method="post" enctype="multipart/form-data">
					<!--<input type="hidden"  name="user_id" value="<?php// echo $stu_id;?>"> --><!-- Get the User_ID Onloading the File-->
					<input type="hidden"  name="id" value="<?php echo $id;?>"> <!-- Get the ID from Update each record -->
						
					<div class="row">
						<label class="control-label col-md-3 col-sm-2 col-xs-12">Company Name<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-2 col-xs-12">
                          <input type="text" value="<?php echo $company_name; ?>"  name="company_name" required="required" placeholder="Company Name" class="form-control col-md-7 col-xs-12">
						  
                        </div>
                    </div> 
					<br>
					<div class="row">
					<div class="col-md-1 col-sm-3 col-xs-12">
					</div>
						<div class="col-md-4 col-sm-3 col-xs-6" id="add_company_hide">
							<button type="submit" name="submit_data" id="submit_data" class="btn btn-primary" style="width:120px;">Add Company</button>
						</div>
						 
						 <div class="col-md-6 col-sm-3 col-xs-6" style="display:none;" id="update_company_hide">
							<button type="submit" name="company_update" id="company_update" class="btn btn-success" style="width:150px;">Update Company</button>
						</div>
						
						<div class="col-md-3 col-sm-3 col-xs-6">
							<input type="submit" class="btn btn-primary" onclick="reload12();" value="Cancel" style="width:120px;">
							</div>
					</div>		
				</form>			  
				</div>
			
			<!-- Upload Excel page-->	
			<!-- <div class="col-md-6">
				<form id="upload_data" data-parsley-validate class="form-horizontal form-label-left" method="post" name="upload_excel" enctype="multipart/form-data">
					<input type="hidden"  name="id" value="<?php //echo $id;?>"> 
						
					<div class="row">
					 <label for="middle-name" class="control-label col-md-4 col-sm-3 col-xs-12">Upload Data</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
						  
					<input type="file" name="resume_name" value="<?php //echo $stu_resume_name; ?>"  id="resume_name" class="form-control col-md-7 col-xs-12" onchange="AlertFilesize();"/>
						<span>(upload only .csv file)  </span>
							 <div id="size"></div>
							  <span id="lblError" style="color:red;font-size:13px;"></span>
                        </div>
                    </div> 
					<br>
					<div class="row">
					<div class="col-md-4 col-sm-3">
					</div>
						<div class="col-md-4 col-sm-3 col-xs-6">
							<button type="submit" name="import" id="import" class="btn btn-primary" style="width:180px;">Upload</button>
						</div>
												
						
					</div>		
				</form>			  
				</div> -->

                </div>
                </div>
              
			  <div class="x_panel">
                  <div class="x_title">
                    <h2>Company List</small></h2>
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
                          <th>Delete</th>
                          <th>Update</th>
						   <th>Code</th>
                          <th>Company Name</th>
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


