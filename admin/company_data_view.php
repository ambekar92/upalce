<?php 
include('sup_files/common_db.php');
include('links_old.php');

$ad_id=$_GET['data_id'];
$clg_id=$_GET['clg_id'];




$curr_url= $_SERVER['HTTP_HOST'].$_SERVER["REQUEST_URI"];
//echo $curr_url;

/* Fetching the initial data */
$table='data_for_comp';
$whereCond="id='$ad_id' and status='active'";	
$query = 'select * from '.$table.' where '.$whereCond;
$data_info = mysql_query($query) or die("Error in Selection Query <br> ".$query."<br>". mysql_error());

	while ($row=mysql_fetch_array($data_info)) 
	{
		$data_id=$row["id"];
		$value=$row["data"];
		$status=$row["status"];
		$duration=$row["duration"];
		$modified=$row["modified"];
	}	
	
	//echo substr($modified,-6);
$sub = substr($modified, 0, 10);
$date=date_create($sub);
date_add($date,date_interval_create_from_date_string("$duration days"));

$end_date= date_format($date,"Y-m-d");	
$current_date= date("Y-m-d");

//echo $end_date."-".$current_date."<br>";	

$end_date1=strtotime($end_date);
$current_date1=strtotime($current_date);

//echo $end_date1."-".$current_date1;		
//$value;
		//$data = mysql_query("$value ORDER BY secured DESC");
		//$data_2 = mysql_query("$value ORDER BY secured DESC");
		
		//$count=mysql_num_rows($data);
		
			if($current_date1 > $end_date1){
					echo "<script> $(document).ready(function() {
					$('#duration').show();
					});</script>";
					mysql_query("update data_for_comp set status='inactive',duration=0 where id=$data_id") or die('error');
			}

			
?>

<script type = "text/javascript" language = "javascript">
$(document).ready(function() {
//alert(<?php echo $clg_id;?>);

dataTableForComp();

});
  
 function dataTableForComp()
{
//alert('<?php echo $value; ?>');
var data_chk ='<?php echo $value; ?>';

if(data_chk != ''){
var url ='adminreg/stu_comp_json.php?clg_id='+<?php echo $clg_id;?>+'&condition='+'<?php echo $value; ?>';
$.ajax({
	type:'POST',
	url:url,
	success:function(data){
	//alert(data);
	debugger;
			if(data!=0){
					$('#good').show();
			}else{
					$('#bad').show();
			}
	} 
});
}else{	
	$('#bad').show();	
}	 

 var stu_DataInfo = $('#datatable').DataTable( {
			//dom: '<"H"<"pull-left"BR><flr>><t><"F"ip>',
			dom:'lBRfrtip',
            buttons: [
                {
                  extend: "copy",
                  className: "btn-sm"
                },
               
                {
                  extend: "excel",
                  className: "btn-sm"
                },
               /*  {
                  extend: "pdfHtml5",
                  className: "btn-sm"
                }, */
                
              ],
             
		destroy: true,
		ajax: url,
		columns	 : [
		{
			"data":null,"orderable": false,className: "align-center"
		},
		{
			 "data":null,"sortable": false,
			 "render": function ( data, type, row, meta ) {
				 return '<button class="btn btn-primary btn-xs" onclick="view('+row.stu_id+');">View Profile</button>'
					+'<a href=../student/'+row.resume_name+' target="_blank" title="Resume"> <button class="btn btn-warning btn-xs">'
					+'Resume </button> </a>';	
			 }
        },
		{ "data": "firstname" },
		{ "data": "gender" },
		{ "data": "branch" },
		{ "data": "dob",
			render: function (data, type, row, meta) {
				return checkEmpty(row.dob);
			}
		},
		{ "data": "secured_10",className: "text-right",
			render: function (data, type, row, meta) {
				return getDecimalVal(row.secured_10);
			}
		},
		{ "data": "end_year_10",
			render: function (data, type, row, meta) {
				return checkEmpty(row.end_year_10);
			}
		},
		{ "data": "university_10",
			render: function (data, type, row, meta) {
				return checkEmpty(row.university_10);
			}
		},
		{ "data": "secured_12",
			render: function (data, type, row, meta) {
				return getDecimalVal(row.secured_12);
			}
		},
		{ "data": "end_year_12",
			render: function (data, type, row, meta) {
				return checkEmpty(row.end_year_12);
			} 
		},
		{ "data": "university_12",
			render: function (data, type, row, meta) {
				return checkEmpty(row.university_12);
			} 
		},
		{ "data": "sem1",className: "text-right",
			render: function (data, type, row, meta) {
				return getDecimalVal(row.sem1);
			}
		},
		{ "data": "sem2",className: "text-right",
			render: function (data, type, row, meta) {
				return getDecimalVal(row.sem2);
			}
		},
		{ "data": "sem3",className: "text-right",
			render: function (data, type, row, meta) {
				return getDecimalVal(row.sem3);
			}
		},
		{ "data": "sem4",className: "text-right",
			render: function (data, type, row, meta) {
				return getDecimalVal(row.sem4);
			}
		},
		{ "data": "sem5",className: "text-right",
			render: function (data, type, row, meta) {
				return getDecimalVal(row.sem5);
			}
		},
		{ "data": "sem6",className: "text-right",
			render: function (data, type, row, meta) {
				return getDecimalVal(row.sem6);
			}
		},
		{ "data": "sem7" ,className: "text-right",
			render: function (data, type, row, meta) {
				return getDecimalVal(row.sem7);
			}
		},
		{ "data": "sem8" ,className: "text-right",
			render: function (data, type, row, meta) {
				return getDecimalVal(row.sem8);
			}
		},
		{ "data": "secured",className: "text-right",
			render: function (data, type, row, meta) {
				return getDecimalVal(row.secured);
			}
		},
		{ "data": "end_year" },
		{ "data": "college_name" },
		{ "data": "university" },
		{ "data": "mobile" },
		{ "data": "alternate_mobile",
			render: function (data, type, row, meta) {
				return checkEmpty(row.alternate_mobile);
			}
		},
		{ "data": "email" },
							
		]
    });
	
	stu_DataInfo.on( 'order.dt search.dt', function () {
		stu_DataInfo.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
			cell.innerHTML = i+1;
		} );
	} ).draw();
	

	
		
	$('#datatable_print').DataTable( {
		destroy: true,
		paging: false,
		ordering: false,
        info: false,
		searching: false,
		ajax: url,
		columns	 : [
		{
			"data": "null",className: "align-center",
			 render: function (data, type, row, meta) {
				 return meta.row + meta.settings._iDisplayStart + 1;
			 }
		},
		{ "data": "firstname" },
		{ "data": "gender" },
		{ "data": "branch" },
		{ "data": "dob",
			render: function (data, type, row, meta) {
				return checkEmpty(row.dob);
			}
		},
		{ "data": "secured_10",className: "text-right",
			render: function (data, type, row, meta) {
				return getDecimalVal(row.secured_10);
			}
		},
		{ "data": "end_year_10",
			render: function (data, type, row, meta) {
				return checkEmpty(row.end_year_10);
			}
		},
		{ "data": "university_10",
			render: function (data, type, row, meta) {
				return checkEmpty(row.university_10);
			}
		},
		{ "data": "secured_12",
			render: function (data, type, row, meta) {
				return getDecimalVal(row.secured_12);
			}
		},
		{ "data": "end_year_12",
			render: function (data, type, row, meta) {
				return checkEmpty(row.end_year_12);
			} 
		},
		{ "data": "university_12",
			render: function (data, type, row, meta) {
				return checkEmpty(row.university_12);
			} 
		},
		{ "data": "sem1",className: "text-right",
			render: function (data, type, row, meta) {
				return getDecimalVal(row.sem1);
			}
		},
		{ "data": "sem2",className: "text-right",
			render: function (data, type, row, meta) {
				return getDecimalVal(row.sem2);
			}
		},
		{ "data": "sem3",className: "text-right",
			render: function (data, type, row, meta) {
				return getDecimalVal(row.sem3);
			}
		},
		{ "data": "sem4",className: "text-right",
			render: function (data, type, row, meta) {
				return getDecimalVal(row.sem4);
			}
		},
		{ "data": "sem5",className: "text-right",
			render: function (data, type, row, meta) {
				return getDecimalVal(row.sem5);
			}
		},
		{ "data": "sem6",className: "text-right",
			render: function (data, type, row, meta) {
				return getDecimalVal(row.sem6);
			}
		},
		{ "data": "sem7" ,className: "text-right",
			render: function (data, type, row, meta) {
				return getDecimalVal(row.sem7);
			}
		},
		{ "data": "sem8" ,className: "text-right",
			render: function (data, type, row, meta) {
				return getDecimalVal(row.sem8);
			}
		},
		{ "data": "secured",className: "text-right",
			render: function (data, type, row, meta) {
				return getDecimalVal(row.secured);
			}
		},
		{ "data": "end_year" },
		{ "data": "college_name" },
		{ "data": "university" },
		{ "data": "mobile" },
		{ "data": "alternate_mobile",
			render: function (data, type, row, meta) {
				return checkEmpty(row.alternate_mobile);
			}
		},
		{ "data": "email" },
							
		]
    });

}
	 
 


function getDecimalVal(value){
	var val;
	if(value!=" " && value != 0){
	val = parseFloat(value).toFixed(2);
	}else{
	val = "<span class='label label-primary pull-right'> No Answer </span>";
	
	}
	return val;
}

function checkEmpty(value){
	var val;
	if(value!="" && value!=" "){
	val = value
	}else{
	val = "<span class='label label-primary pull-right'> No Answer </span>";
	
	}
	return val;
}


 function view(id)
{
	params  = 'width='+window.outerWidth;
	params += ', height='+window.outerHeight;
	params += ', top=0, left=0'
	params += ', fullscreen=yes,scrollbars: 0';
	 
	//alert('<?php echo $_SERVER['HTTP_HOST'];?>');
	if('<?php echo $_SERVER['HTTP_HOST'];?>'=='localhost:8088'){
		
		var url="http://<?php echo $_SERVER['HTTP_HOST'];?>/2016/admin/stu_view_profile.php?stu_id="+id;
		
		var win = window.open("about:blank","",params);
		win.document.write('<iframe src='+url+' style="height: 92%;width: 100%;border: none;overflow:hidden;"></iframe>');
		
	//window.open("http://<?php echo $_SERVER['HTTP_HOST'];?>/2016/admin/stu_view_profile.php?stu_id="+id, "MsgWindow", params);
	}else{
	//window.open("http://<?php echo $_SERVER['HTTP_HOST'];?>/admin/stu_view_profile.php?stu_id="+id, "MsgWindow", params);
		var url="http://<?php echo $_SERVER['HTTP_HOST'];?>/admin/stu_view_profile.php?stu_id="+id;
		
		var win = window.open("about:blank","",params);
		win.document.write('<iframe src='+url+' style="height: 92%;width: 100%;border: none;overflow:hidden;"></iframe>');
		
	}
}

</script>
<!-- >>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>><<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<< -->

	  <style>
  /* Let's get this party started */
::-webkit-scrollbar {
    width: 10px;
    height: 10px;
}
 
/* Track */
::-webkit-scrollbar-track {
    -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3); 
    -webkit-border-radius: 10px;
    border-radius: 10px;
}
 
/* Handle */
::-webkit-scrollbar-thumb {
    -webkit-border-radius: 10px;
    border-radius: 10px;
    background: rgba(56, 116, 228, 0.8); 
    -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.5); 
}
::-webkit-scrollbar-thumb:window-inactive {
	background: rgba(255,0,0,0.4); 
}	

tbody{
	font-size: 13px;
}


thead > tr{
	background-color:#2a3f54;
	color:#d7dcde;
	font-size:12px;"
}


  </style>

  <div id="bad" class="col-md-12 col-sm-12 col-xs-12" role="main" style="background-color:#f7f7f7;display:none;width: 100% !important;">
		<br>		
		<div class="x_panel">	
			<div class="col-md-6 col-xs-12">	
				<h1>404 !! Data Not Found <h4><!--Please Don't Hack the Site, Otherwise You will be Track and Punishable--> 
				Please Check with Admin !!</h4></h1>
			</div>
			<div class="col-md-6 col-xs-12">	
				<h2 class="pull-right">www.uplace.in</h2>
			</div>	
		</div>
  </div>

    <div id="duration" class="col-md-12 col-sm-12 col-xs-12" role="main" style="background-color:#f7f7f7;display:none;width: 100% !important;">
		<br>		
		<div class="x_panel">	
			<div class="col-md-6 col-xs-12">	
				<h3><b>Page Has Expired, Please Contact Administrator</b><h4><!--Please Don't Hack the Site, Otherwise You will be Track and Punishable--> 
				Today : <?php echo date("d-M-Y"); ?></h4></h3>
			</div>
			<div class="col-md-6 col-xs-12">	
				<h2 class="pull-right">www.uplace.in</h2>
			</div>	
		</div>
	</div>
  
            <!-- page content -->
        <div id="good" class="row hidden-print" role="main" style="background-color:#f7f7f7;display:none;width: 100% !important;">        
            <div class="page-title">
          
            <div class="clearfix"></div>

		
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
              
			  <div class="x_panel">
                  <div class="x_title col-md-12 col-sm-12 col-xs-12">
                    <h2>Student Infomation List </h2>
					<br><br>
					<p style="font-size:12px;font-wight:bold;color:red;">
					<b>Duration of Page (15 Days) : </b><?php echo date_format($date,"d-m-Y"); ?></p>
                  </div>
				<div class="clearfix"></div>
			
				<div class="x_content"  style="width:100%; overflow-x:scroll;">
         				
					 <table id="datatable" class="table table-striped table-bordered nowarp" style="width:360%;">
                      <thead>
                        <tr style="background-color:#2a3f54;color:#d7dcde;">
                        <th>Sl. No.</th>
						<th>Action</th>
						<th>Student Name</th>
						<th>Gender</th>
						<th>Branch</th>
						<th>DOB</th>
						<th>X th %</th>
						<th>Year Of Passing</th>
						<th>Board / University</th>
						<th>XII th % / Dip %</th>
						<th>Year Of Passing</th>
						<th>Board / University</th>
						<th>I SEM %</th>
						<th>II SEM %</th>
						<th>III SEM %</th>
						<th>IV SEM %</th>
						<th>V SEM %</th>
						<th>VI SEM %</th>
						<th>VII SEM %</th>
						<th>VIII SEM %</th>
						<th>Aggregate %</th>
						<th>Year Of Passing</th>
						<th>College</th>
						<th>University</th>
						<th>Mobile No</th>
						<th>Alternate No</th>
						<th>Email ID</th>
						
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

		 	<table id="datatable_print" border="1" class="visible-print-block nowarp" style="width:110%;">
              <thead>
                <tr>
                <th>Sl.No.</th>
				<th>Student Name</th>
				<th>Gender</th>
				<th>Branch</th>
				<th>DOB</th>
				<th>X th %</th>
				<th>Year Of Passing</th>
				<th>Board / University</th>
				<th>XII th % / Dip %</th>
				<th>Year Of Passing</th>
				<th>Board / University</th>
				<th>I SEM %</th>
				<th>II SEM %</th>
				<th>III SEM %</th>
				<th>IV SEM %</th>
				<th>V SEM %</th>
				<th>VI SEM %</th>
				<th>VII SEM %</th>
				<th>VIII SEM %</th>
				<th>Aggregate %</th>
				<th>Year Of Passing</th>
				<th>College</th>
				<th>University</th>
				<th>Mobile No</th>
				<th>Alternate No</th>
				<th>Email ID</th>
				</tr>
              </thead>

            </table>
	
					<?php include('sup_files/footer.php'); ?>

					</div>
			    </div>

		 <!-- Datatables -->
    <script>
		$(document).ready(function() {
//alert();

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


