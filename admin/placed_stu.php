<?php 
include('sup_files/slider.php'); 
include('sup_files/header.php'); 

//error_reporting(0);
include('sup_files/db.php');
include('links.php');
/* Fetching the initial data */
$table='ad_placed_stu';
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

if(isset($_POST['delete_all']))
{
 $cnt=array();
 $cnt=count($_POST['select_all']);
 for($i=0;$i<$cnt;$i++)
  {
     $del_id=$_POST['select_all'][$i];
     $query="delete from $table where id=".$del_id;
     mysql_query($query);
  }
}



?>

<script type = "text/javascript" language = "javascript">


$(document).ready(function() {	

 $('#select_all').click(function(event) { 
    if(this.checked) {
        // Iterate each checkbox
        $(':checkbox').each(function() {
            this.checked = true;    
			//$('#delete_btn').show();		
        });
    }else{
		$(':checkbox').each(function() {
            this.checked = false;   
			//$('#delete_btn').hide();	
        });
	}
}); 


/*    $.ajax({
		type:'POST',
		url:'adminreg/placed_stu_data_json.php?admin_id='+<?php echo $ad_id;?>,
		success:function(data){
			debugger;
			alert(data);
		} 
	});	   */
	
 $('#datatable').DataTable( {
		destroy: true,
		Processing: true,
		ajax: 'adminreg/placed_stu_data_json.php?admin_id='+<?php echo $ad_id;?>,
		order: [[ 1, "asc" ]],
		dom:'lBRfrtip',
		 buttons: [
                {
                  extend: "copy",
                  className: "btn-sm"
                },
		],		
		columns	 : [
		{
			 sortable: false,
			 "render": function ( data, type, row, meta ) {
			 return '<input type="checkbox" name="select_all[]" value="'+row.stu_id+'"/> <a title="Delete"> <span class="btn btn-danger btn-xs" onclick="Delete('+row.stu_id+');"> <i class="glyphicon glyphicon-trash"></i> </span> </a>'
			 }
        },
		{'data':'stu_usn',
			"render": function ( data, type, row, meta ) {
				return '<span style="color:blue;font-weight:bold;">'+row.stu_usn+'</span>';
			 }
		},
		{'data':'stu_name'},
		{'data':'stu_mobile'},
		{'data':'stu_branch'},
		{'data':'stu_passing_year'},				
		{'data':'stu_email_id'},				
		{'data':'comp_1',
			"render": function ( data, type, row, meta ) {
				return '<span style="color:blue;font-weight:bold;">'+row.comp_1+'</span>';
			 }
		},				
		{'data':'comp_2',
			"render": function ( data, type, row, meta ) {
				return '<span style="color:blue;font-weight:bold;">'+row.comp_2+'</span>';
			 }
		},				
		{'data':'comp_3',
			"render": function ( data, type, row, meta ) {
				return '<span style="color:blue;font-weight:bold;">'+row.comp_3+'</span>';
			 }
		},				
		{'data':'comp_4',
			"render": function ( data, type, row, meta ) {
				return '<span style="color:blue;font-weight:bold;">'+row.comp_4+'</span>';
			 }
		},				
		{'data':'total_comp'},				
		]
    });


//img upload func
$("form#upload_data").submit(function(event){
	//alert('asd'); 
 $(".progress123").show();
	 var formData = new FormData($(this)[0]);
	$.ajax({
    url: 'import_placed_stu.php',
    type: 'POST',
    data: formData,
    async: true,
    cache: false,
    contentType: false,
    processData: false,
    success: function (returndata) {
		//alert(returndata);
		 $(".progress123").hide();
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
	window.location='placed_stu.php';
}



function Delete(data)
{
	//alert(data);

		$("#commondelete").modal({backdrop:'static'});
		$("#seldelete").html('<a href=placed_stu.php?delete='+data+'>'
		+'<input type=button class="btn btn-default" style="height:25px;padding-left: 12px;padding-right: 12px;padding-top: 0px;padding-bottom: 1px;" value="YES"/></a>'
		+'<input type="button" class="btn btn-default" data-dismiss="modal" onclick="reload12();" style="height:25px;padding-left: 12px;padding-right: 12px;padding-top: 0px;padding-bottom: 1px;" value="NO"/>');	

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
	$('#import').prop('disabled', false);
	}
	else if(size < 3 && fSExt[i] =='MB'){
	$('#size').html("<p style='color:green;font-size:14;'><b> File size :"+size+" "+fSExt[i]+"<b></p>");
	$('#import').prop('disabled', false);
	}
	else{
	$('#size').html("<p style='color:green;font-size:14;'><b>File size : "+size+" "+fSExt[i]);
	$('#import').prop('disabled', false);
	}
		
			var allowedFiles = [".csv"];
            var fileUpload = document.getElementById("resume_name");
            var lblError = document.getElementById("lblError");
            var regex = new RegExp("([a-zA-Z0-9\s_\\.\-:])+(" + allowedFiles.join('|') + ")$");
            if (!regex.test(fileUpload.value.toLowerCase())) {
                lblError.innerHTML = "Please upload <b>" + allowedFiles.join(', ') + "</b> file only.";
				$('#import').prop('disabled', true);
                return false;
            }
			else{
            lblError.innerHTML = "";
            return true;
			}
}



</script>

		
<div class="progress123" style="width: 100%;
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
                    <h2>Upload Placed Students (.csv)</h2>
                    <ul class="nav navbar-right panel_toolbox" style="min-width:0 !important;">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                    </ul>
					  <div class="pull-right">
				   <a href="doc/demo.csv" target="_blank"  data-toggle="tooltip" data-placement="bottom" title="Download the demo file to Upload Placed Student data.">
					<button class="btn btn-success btn-xs"> Demo File &nbsp;<i class="fa fa-download" aria-hidden="true"></i> </button>
					</a>
					</div>
					<div class="clearfix"></div>
                  </div>
				   <div class="x_content">
				 
				  <br />
		
			
			<!-- Upload Excel page-->	
			<div class="col-md-12">
				<form id="upload_data" data-parsley-validate class="form-horizontal form-label-left" method="post" name="upload_excel" enctype="multipart/form-data">
					<input type="hidden"  name="id" value="<?php echo $id;?>"> <!-- Get the ID from Update each record -->
						
					<div class="row">
					 <label for="middle-name" class="control-label col-md-4 col-sm-3 col-xs-12">Upload Data</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                	  
					<input type="file" name="resume_name" value="<?php echo $stu_resume_name; ?>"  id="resume_name" class="form-control col-md-7 col-xs-12" onchange="AlertFilesize();"/>
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
				</div>

                </div>
                </div>
              
			  <div class="x_panel">
                  <div class="x_title">
                    <h2>Placed Student List</small></h2>
                    <ul class="nav navbar-right panel_toolbox" style="min-width:0 !important;">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
					<form method="post" action="placed_stu.php">
		<div class="x_content"  style="width:100%; overflow-x:scroll;">
	
		
			<table id="datatable"  class="nowrap table table-striped table-bordered" style="width:100%;">
				<thead>
					<tr style="background-color:#2a3f54;color:#d7dcde;">
					
						<th width="12%">
						
						<input type="checkbox" name="select_all[]" id="select_all" /> 
						<span id="delete_btn"><button type="submit" name="delete_all" class="btn btn-danger btn-xs"> <i class="glyphicon glyphicon-trash"></i> </button></span>
						
						</th>
						<th>USN</th>
						<th>Name</th>
						<th>Mobile</th>
						<th>Branch</th>
						<th>Passed Year</th>
						<th>Email ID</th>
						<th>Comp 1</th>
						<th>Comp 2</th>
						<th>Comp 3</th>
						<th>Comp 4</th>
						<th>Total Comp</th>
					</tr>
				</thead>
			</table>
			
			
                  </div>
			  </form>
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

        $('#example').dataTable(
		{
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


