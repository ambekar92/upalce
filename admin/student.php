
<head><title>Student </title></head>

<style>
.align-center{
text-align:center;
}

tfoot input {
        width: 100%;
        padding: 3px;
        box-sizing: border-box;
    }

.thumb {
  display: flex;
  justify-content: center;
}
.thumb img {
  height: 100%;
  width: auto;
}
.thumb img {
    width: 40px !important;
    height: 40px !important;
    border-radius: 50%;
}
</style>

<?php 
include('sup_files/db.php');
include('sup_files/slider.php'); 
include('sup_files/header.php'); 
include('links.php');



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
						$("#commondialogStu").modal({backdrop:'static'});
						$("#getCodeStu").html('<p style=color:red;>Record Successfully Deleted !!</p>');	
					});
			</script> <!-- hide the add_skill btn and display update btn -->
		<?php
		 //$skill_del ="DELETE FROM $table WHERE id='$delete'";
		 $skill_del="update stu_student set status='inactive' where id='$delete'";
		 mysql_query($skill_del) or die(mysql_error());
		}
		
}


?>

<script type = "text/javascript" language = "javascript">
	
$(document).ready(function() {
debugger;	
	
	$("#search2").hide();
	$("#search3").hide();
	
	$( "#placed" ).change(function() {
		if($("#placed").val()=='unplaced'){
			$("#search").hide();
			$("#search3").hide();
			$("#search2").show();
		}else if($("#placed").val()=='placed')
		{
			$("#search").hide();
			$("#search2").hide();
			$("#search3").show();	
		}
		else{
			$("#search").show();
			$("#search2").hide();
			$("#search3").hide();		
		}
	});

});

function reload12()
{	<!-- function is call to header.php (Bootstrap model popup)-->
	window.location='student.php';
}


function active_status(data)
{
var url ='adminreg/condition.php?data_id='+data+'&active=active';
 $.ajax({
	type:'POST',
	url:url,
	success:function(data){
	//alert(data);
	getvalues();
	$("#commondialogStu").modal();
	$("#getCodeStu").html(data);	
	
	} 
});	 
}

function inactive_status(data)
{
var url ='adminreg/condition.php?data_id='+data+'&inactive=inactive';
 $.ajax({
	type:'POST',
	url:url,
	success:function(data){
	//alert(data);
	getvalues();
	$("#commondialogStu").modal();
	$("#getCodeStu").html(data);	
	
	} 
});	 
}

function active_link(data)
{
var url ='adminreg/condition.php?data_id='+data+'&active_link=A';
 $.ajax({
	type:'POST',
	url:url,
	success:function(data){
	//alert(data);
	getvalues();
	$("#commondialogStu").modal();
	$("#getCodeStu").html(data);	
	
	} 
});	 
}

function inactive_link(data)
{
var url ='adminreg/condition.php?data_id='+data+'&inactive_link=D';
 $.ajax({
	type:'POST',
	url:url,
	success:function(data){
	//alert(data);
	getvalues();
	$("#commondialogStu").modal();
	$("#getCodeStu").html(data);	
	
	} 
});	 
}

//<a href="stu_view_profile.php?stu_id=<?php echo $row["id"]; ?>" target="_blank"></a>
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
		}
		else{
		//window.open("http://<?php echo $_SERVER['HTTP_HOST'];?>/admin/stu_view_profile.php?stu_id="+id, "MsgWindow", params);
		var url="http://<?php echo $_SERVER['HTTP_HOST'];?>/admin/stu_view_profile.php?stu_id="+id;
		
		var win = window.open("about:blank","",params);
		win.document.write('<iframe src='+url+' style="height: 92%;width: 100%;border: none;overflow:hidden;"></iframe>');
		
	}
}

function data_tables(url){

 $.ajax({
	type:'POST',
	url:url,
	success:function(data){
	//alert(data);
	debugger;
	if(data==0){
	$('#status').show().html("<b> Record Not Found </b>");
	}else{
		$('#status').hide();
	}
	
	} 
});	 

	 var stu_DataInfo = $('#stu_datatable').DataTable( {
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
		order: [[ 1, "asc" ]],
		columns	 : [
		{
			"data":null,"orderable": false,className: "align-center"
		},
		{
			 "data":null,"sortable": false,
			 "render": function ( data, type, row, meta ) {
				 if(row.status=='active'){
					var data_rtn = '<a title="Deactivate"> <button class="btn btn-primary btn-sm" onclick="inactive_status('+row.stu_id+');"><i class="fa fa-check"></i> </button> </a>';
				 }else{
					data_rtn = '<a title="Activate"> <button class="btn btn-danger btn-sm" onclick="active_status('+row.stu_id+');"> <i class="fa fa-ban"></i> </button> </a>';
				 }
				 var view ='<button class="btn btn-info btn-xs" onclick="view('+row.stu_id+');"><i class="fa fa-eye"></i> View</button>';
				 var resume='<a href="../student/'+row.resume_name+'" target="_blank" title="Resume"><button class="btn btn-warning btn-xs">	<i class="fa fa-file-text" aria-hidden="true"></i> Resume </button> </a>';	
				 var link;
				 if(row.project_link_status=='A'){
					var link = '<button class="btn btn-warning btn-sm" title="Click to Inactive" onclick="inactive_link('+row.stu_id+');"><i class="fa fa-video-camera"></i> </button>';
				 }else{
					link = '<button class="btn btn-danger btn-sm" title="Click to Active" onclick="active_link('+row.stu_id+');"> <i class="fa fa-video-camera"></i> </button> ';
				 }
				 return data_rtn+''+resume+''+view+''+link;
			 }
        },
		{ "data": "usn",
			render: function (data, type, row, meta) {
				return '<span style="font-weight: bold;color: darkviolet;">'+row.usn+'</span>';
			}
		},		
        { "data": "class",
			render: function (data, type, row, meta) {
				return getClassName(row);
			}
		},
		{ "data": "profile_img",
			render: function (data, type, row, meta) {
				if(row.profile_img != ""){
					return '<div class="thumb"><img src="../student/'+row.profile_img+'"></div>';
				}else{
					return '<div class="thumb"><img src="images/1.jpg"></div>';
				}
			}
		},
		{ "data": "firstname" },
		{ "data": "gender" },
		{ "data": "mobile" },
		{ "data": "alternate_mobile",
			render: function (data, type, row, meta) {
				return checkEmpty(row.alternate_mobile);
			}
		},
		{ "data": "email" },
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
		{ "data": "comp_1",
			"render": function ( data, type, row, meta ) {
				return '<span style="color:blue;font-weight:bold;">'+row.comp_1+'</span>';
			}
		},
		{ "data": "comp_2",
			"render": function ( data, type, row, meta ) {
				return '<span style="color:blue;font-weight:bold;">'+row.comp_2+'</span>';
			}
		},
		{ "data": "comp_3",
			"render": function ( data, type, row, meta ) {
				return '<span style="color:blue;font-weight:bold;">'+row.comp_3+'</span>';
			}
		},
		{ "data": "comp_4" ,
			"render": function ( data, type, row, meta ) {
				return '<span style="color:blue;font-weight:bold;">'+row.comp_4+'</span>';
			}
		},
		{ "data": "total_comp",
			"render": function ( data, type, row, meta ) {
				return '<span style="color:blue;font-weight:bold;">'+row.total_comp+'</span>';
			}
		},
							
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
		{ "data": "usn"},
		{ "data": "firstname" },
		{ "data": "gender" },
		{ "data": "mobile" },
		{ "data": "alternate_mobile",
			render: function (data, type, row, meta) {
				return checkEmpty(row.alternate_mobile);
			}
		},
		{ "data": "email" },
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
		
							
		]
    });

}

function getClassName(row){
	if(row.class=="Graduation"){
		var a='<p style="font-weight: bold;color: #48494e;">'+row.class+'</p>';
		var b='<p style="font-weight: bold;font-size:11px;color:green;margin-top:-10px;">'+row.class_type+'</p>';
		return a+''+b;
	}else
	{return '<span style="font-weight: bold;color: #48494e;">'+row.class+'</span>';} 
}

function getDecimalVal(value){
	var val;
	if(isNaN(value) == true){value=0;}

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

function getvalues()
{
	$('#export_div').show();
	$('#save_link_div').show();
	$('#print_div').show();
var branchs ='';
var end_years='';
var percent='';
var percent_10='';
var percent_12='';
var clg_id='';
var classType='';
	branchs = $('#branchs').val();
	end_years = $('#end_years').val();
	percent = $('#percent').val();
	percent_10 = $('#percent_10').val();
	percent_12 = $('#percent_12').val();
	classType = $('#classType').val();
	
	clg_id=$('#clg_id').val();
	//alert(end_years);
	var url ='adminreg/stu_srch_json.php?classType='+classType+'&branchs='+branchs+'&end_years='+end_years+'&percent='+percent+'&percent_10='+percent_10+'&percent_12='+percent_12+'&clg_id='+clg_id+'&admin_id='+<?php echo $ad_id;?>;
	//alert(url);
	data_tables(url);
}

function getvalues2()
{//placed function

$('#export_div').show();
$('#save_link_div').show();
$('#print_div').show();
var branchs ='';
var end_years='';
var percent='';
var clg_id='';
var	data_placed = $('#placed').val();
	
	branchs = $('#branchs').val();
	end_years = $('#end_years').val();
	percent = $('#percent').val();
	
	clg_id=$('#clg_id').val();
	var classType = $('#classType').val();
	//alert(end_years);
	var url ='adminreg/stu_srch_json.php?classType='+classType+'&branchs='+branchs+'&end_years='+end_years+'&percent='+percent+'&clg_id='+clg_id+'&data_placed='+data_placed+'&admin_id='+<?php echo $ad_id;?>;
	//alert(url);
	data_tables(url);
}
function getvalues3() 
{//unplaced function

$('#export_div').show();
//$('#save_link_div').show();
$('#print_div').show();
var branchs ='';
var end_years='';
var percent='';
var clg_id='';
var	data_placed = $('#placed').val();
	branchs = $('#branchs').val();
	end_years = $('#end_years').val();
	percent = $('#percent').val();
	clg_id=$('#clg_id').val();
	percent_10 = $('#percent_10').val();
	percent_12 = $('#percent_12').val();
	var classType = $('#classType').val();
	//alert(end_years);
//var url ='adminreg/stu_srch_json.php?branchs='+branchs+'&end_years='+end_years+'&percent='+percent+'&clg_id='+clg_id+'&data_placed='+data_placed+'&admin_id='+<?php echo $ad_id;?>;
var url ='adminreg/stu_srch_json.php?classType='+classType+'&branchs='+branchs+'&end_years='+end_years+'&percent='+percent+'&percent_10='+percent_10+'&percent_12='+percent_12+'&clg_id='+clg_id+'&data_placed='+data_placed+'&admin_id='+<?php echo $ad_id;?>;
	
	//alert(url);
   data_tables(url);
}

function export_xls()
{
	window.location='adminreg/export.php?admin_id='+<?php echo $ad_id;?>;
}

function save_link()
{
	var link_name=$('#link_name').val();
//	window.location='adminreg/export.php?admin_id='+<?php echo $ad_id;?>;
 var url ='adminreg/data_for_comp.php?save_link=data&link_name='+link_name+'&admin_id='+<?php echo $ad_id;?>;
	if(link_name != ''){
		$.ajax({
			type:'GET',
			url:url,
			success:function(data){
				//alert(data);
				$('#link_name').val('');
				$('#save_data').modal('hide');
				$("#getCode").html(data);
				$("#commondialog").modal();
				getvalues();
			}  
		});	 
	}else{
		$("#text").html('<p>*Mandatory Fields</p>');
	}
	
}
</script>
<!-- >>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>><<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<< -->


<!--  <div class="modal fade" id="commondialog1" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
		   <div class="modal-header">
			 <h5 class="modal-title" id="myModalLabel">Message</h5>
		   </div>
				 <div class="modal-body" id="getCode1">
				 </div>
		  <div class="modal-footer" style="margin-bottom: -10px;padding: 12px;">
			<input type="button" class="btn btn-default" data-dismiss="modal" onclick="reload12();"
	style="height:25px;padding-left: 12px;padding-right: 12px;padding-top: 0px;padding-bottom: 1px;" value="Close"/>
		  </div>
    </div>
  </div>
</div> -->



 <div class="modal fade" id="save_data" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
   <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
		   <div class="modal-header">
			<!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>-->
			 <h5 class="modal-title" id="myModalLabel">Message</h5>
		   </div>
				  <div class="modal-body">
				  <div class="form-group">
                        <label class="control-label col-md-12 col-sm-3 col-xs-12">Link Name :</label>
                     
                          <input name="link_name" id="link_name" required="required" class="form-control col-md-12 col-xs-12" type="text" placeholder="Enter Name to Save" autofocus>
                       
                      </div>
				<br>
				<br>
				<br>
				 <span id="text"></span>
					
				
				 </div>
				 
		  <div class="modal-footer" style="margin-bottom: -10px;padding: 12px;">
		  <input type="button" class="btn btn-primary" onclick="save_link();"
	style="height:25px;padding-left: 12px;padding-right: 12px;padding-top: 0px;padding-bottom: 1px;" value="SAVE"/>
	
			<input type="button" class="btn btn-default" data-dismiss="modal"
	style="height:25px;padding-left: 12px;padding-right: 12px;padding-top: 0px;padding-bottom: 1px;" value="Close"/>
			<!--<input type="button" class="btn btn-primary"  value="Save changes" />-->
		  </div>
    </div>
  </div>
</div>



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
				  
				<div class="col-md-12 col-xs-12">
				<form id="stu_srch" data-parsley-validate class="form-horizontal form-label-left"  method="post" enctype="multipart/form-data">
					<!-- action="student.php" <input type="hidden"  name="user_id" value="<?php// echo $stu_id;?>"> --><!-- Get the User_ID Onloading the File-->
				<input type="hidden"  name="clg_id" id="clg_id" value="<?php echo $ad_clg_id;?>"> <!-- Get the ID from Update each record -->
						
				<div class="row">
					<div class="col-md-4 col-xs-12">
					
					 <label class="col-md-12 col-xs-12">10th % or GPA</label>
                        <div class="col-md-12 col-xs-12">
                          <select  name="percent_10" id="percent_10" class="form-control select_year" data-placement="right" data-toggle="tooltip" style="width:100% !important;">
                            	<option value="null">Select % or GPA</option>
								<option value=">=80"> > = 80</option>
								<option value=">=70"> > = 70</option>
								<option value=">=60"> > = 60</option>
								<option value=">=50"> > = 50</option>
								<option value=">= 50 | <= 60"> > = 50 TO < = 60</option>
								<option value=">= 60 | <= 70"> > = 60 TO < = 70</option>
                          </select>
                        </div> 
					</div>
					
						<div class="col-md-4 col-xs-12">
					
					 <label class="col-md-12 col-xs-12">12th / Diploma % or GPA</label>
                        <div class="col-md-12 col-xs-12">
                          <select  name="percent_12" id="percent_12" class="form-control select_year" data-placement="right" data-toggle="tooltip" style="width:100% !important;">
                            	<option value="null">Select % or GPA</option>
								<option value=">=80"> > = 80</option>
								<option value=">=70"> > = 70</option>
								<option value=">=60"> > = 60</option>
								<option value=">=50"> > = 50</option>
								<option value=">= 50 | <= 60"> > = 50 TO < = 60</option>
								<option value=">= 60 | <= 70"> > = 60 TO < = 70</option>
                          </select>
                        </div> 
					</div>
					
					
					<div class="col-md-4 col-xs-12">
					
					 <label class="col-md-12 col-xs-12">Degree % or GPA</label>
                        <div class="col-md-12 col-xs-12">
                          <select  name="percent" id="percent" class="form-control select_year" data-placement="right" data-toggle="tooltip" style="width:100% !important;">
                            	<option value="null">Select % or GPA</option>
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
					<div class="col-md-3 col-xs-12">
					 <label class="col-md-12 col-xs-12">Branch</label>
                        <div class="col-md-12 col-xs-12">
                           <select multiple="multiple" name="branchs[]" id="branchs" class="form-control select_branch" tabindex="-1" data-placement="right" data-toggle="tooltip" style="width:100% !important;">
                           <!-- Data is fetching form Ajax call (Branchs)-->
                          </select>
                        </div> 
					</div>	
					
					<div class="col-md-3 col-xs-12">
					 <label class="col-md-12 col-xs-12">Passing Year</label>
                        <div class="col-md-12 col-xs-12">
                          <select  multiple="multiple" name="end_years[]" id="end_years" class="form-control select_year" data-placement="right" data-toggle="tooltip" title="This field is required." style="width:100% !important;">
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
						
					
					<div class="col-md-3 col-xs-12">
					 <label class="col-md-12 col-xs-12">Placed / Not Placed</label>
                        <div class="col-md-12 col-xs-12">
                          <select  name="placed" id="placed" class="form-control select_place" data-placement="right" data-toggle="tooltip" style="width:100% !important;">
                            	<option value="both">Both</option>
								<option value="placed">Placed</option>
								<option value="unplaced">Not Placed</option>
						
                          </select>
                        </div> 
					</div>
					

			<div class="col-md-3 col-xs-12">
			 <label class="col-md-12 col-xs-12">Select Degree</label>
                <div class="col-md-12 col-xs-12">
              <select name="classType"  id="classType" class="form-control select_place" data-placement="right" data-toggle="tooltip" style="width:100% !important;">
              	<option value="Graduation">Graduation</option>
                <option value="Post Graduation">Post Graduation</option>                
                <option value="Diploma">Diploma</option>
                <option value="Post Graduation Diploma">Post Graduation Diploma</option>
                <option value="Doctorate">Doctorate</option>
              </select>

                </div> 
			</div>

                    </div> 
					
					
					<br><br>
					
					<div class="row">
					
						<div class="col-md-3 col-sm-3 col-xs-12" id="add_skill_hide">
						
							<button type="button" name="search" id="search" onclick="getvalues();" class="btn btn-primary" style="width:100%;">
							<span class="glyphicon glyphicon-search"></span>&nbsp;&nbsp;Search</button>
							
							<button type="button" name="search2" id="search2" onclick="getvalues2();" class="btn btn-primary" style="width:100%;">
							<span class="glyphicon glyphicon-search"></span>&nbsp;&nbsp;Search</button>
							
							<button type="button" name="search3" id="search3" onclick="getvalues3();" class="btn btn-primary" style="width:100%;">
							<span class="glyphicon glyphicon-search"></span>&nbsp;&nbsp;Search</button>
							
						</div>
									
						<div class="col-md-3 col-sm-3 col-xs-12">
							<button type="button" class="btn btn-danger" onclick="reload12();" style="width:100%;">
							<span class="glyphicon glyphicon-refresh"></span>&nbsp;&nbsp;Refresh</button>
						</div>
						
						<!--<div class="col-md-2 col-sm-3 col-xs-12" style="display:none;" id="export_div">
							<button type="button" name="export" id="export" onclick="export_xls();" class="btn btn-default" style="width:80%;">
							Export to xls &nbsp; <i class="fa fa-sign-out"></i></button>
						</div>-->
						
						<div class="col-md-3 col-sm-3 col-xs-12" style="display:none;" id="save_link_div">
							<button type="button" name="save_link" id="save_link" data-toggle="modal" data-target="#save_data" class="btn btn-default" style="width:100%;">
							SAVE LINK &nbsp;&nbsp;&nbsp; <i class="fa fa-floppy-o"></i></button>
						</div>
						
						
						<div class="col-md-3 col-sm-3 col-xs-12" style="display:none;" id="print_div">
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
					
                   <table id="stu_datatable" class="table table-striped table-bordered nowarp" style="width:450%;">
                      <thead>
                        <tr style="background-color:#2a3f54;color:#d7dcde;">
                          <!--<th><input type="checkbox" id="check-all" class="flat"></th>-->
						<!--  <th>Delete</th-->
                        <th>Sl. No.</th>
						<th width="6%">Action</th>
						<th>USN</th>
						<th width="3%">Degree</th>
						<th>Student Photo</th>
						<th>Student Name</th>
						<th>Gender</th>
						<th>Mobile No</th>
						<th>Alternate No</th>
						<th>Email ID</th>
						<th style="width:6% !important;">Branch</th>
						<th>DOB</th>
						<th>X th % or GPA </th>
						<th>Year Of Passing</th>
						<th>Board / University</th>
						<th>XII th / Dip % or GPA</th>
						<th>Year Of Passing</th>
						<th>Board / University</th>
						<th>I SEM % or GPA</th>
						<th>II SEM % or GPA</th>
						<th>III SEM % or GPA</th>
						<th>IV SEM % or GPA</th>
						<th>V SEM % or GPA</th>
						<th>VI SEM % or GPA</th>
						<th>VII SEM % or GPA</th>
						<th>VIII SEM % or GPA</th>
						<th>Aggregate % or GPA</th>
						<th>Year Of Passing</th>
						<th>College</th>
						<th>University</th>
						<th>Company 1</th>
						<th>Company 2</th>
						<th>Company 3</th>
						<th>Company 4</th>
						<th>Total Selected</th>
						
						
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
                        <th>Sl. No.</th>
						<th>USN</th>
						<th>Student Name</th>
						<th>Gender</th>
						<th>Mobile No</th>
						<th>Alternate No</th>
						<th>Email ID</th>
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
						</tr>
                      </thead>

                    </table>
					
		        <!-- footer content -->
<?php include('sup_files/footer.php'); ?>
        <!-- /footer content -->
      </div>

    </div>

	

<div class="modal fade" id="commondialogStu" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
		   <div class="modal-header">
			<!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>-->
			 <h5 class="modal-title" id="myModalLabel">Message</h5>
		   </div>
				 <div class="modal-body" id="getCodeStu">
				  <!-- passing value form script-->
				 </div>
		  <div class="modal-footer" style="margin-bottom: -10px;padding: 12px;">
			<input type="button" class="btn btn-default" data-dismiss="modal"
	style="height:25px;padding-left: 12px;padding-right: 12px;padding-top: 0px;padding-bottom: 1px;" value="Close"/>
			<!--<input type="button" class="btn btn-primary"  value="Save changes" />-->
		  </div>
    </div>
  </div>
</div>
	
	
	 <!-- Datatables -->
    <script>
      $(document).ready(function() {
		  
 $.ajax({
	type:'POST',
	url:'adminreg/branch_data.php',
	success:function(data){
		//alert(data);
		$('#branchs').html(data);
	}
  });


		$(".select2_single_country").select2({
          placeholder: "Select a College",
          allowClear: true
        });
       
		$(".select_branch").select2({
          maximumSelectionLength: 4,
          placeholder: "Select a Branch",
          allowClear: true
        });
	
		$(".select_year").select2({
          maximumSelectionLength: 4,
           placeholder: "Select a Year",
          allowClear: true
        });
	  
       
		$(".select_college").select2({
          maximumSelectionLength: 4,
          placeholder: "Select a Colleges",
          allowClear: true
        });
		
		$(".select_place").select2({
          maximumSelectionLength: 4,
          /* placeholder: "Select a Colleges", */
          allowClear: true
        });
	



      $('#stu_datatable').dataTable({
		  destroy:true
	  });

 

     });
    </script>
    <!-- /Datatables -->
</body>

</html>


