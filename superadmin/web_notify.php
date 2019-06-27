
<?php
	
 include('sup_files/db.php');
 include('sup_files/slider.php');
 include('sup_files/header.php'); 

  include('links.php'); 
 
 
/* Fetching the initial data */
/* $whereCond="fk_stu_id='$stu_id' and class=10";	
$Query = 'select * from stu_education where '.$whereCond;
$stu_education_10 = mysql_query($Query) or die("Error in Selection Query <br> ".$Query."<br>". mysql_error());
while ($row=mysql_fetch_array($stu_education_10)) 
{ 
	$id_10=$row['id'];
	$class_10 = $row['class'];
	$end_year_10 = $row['end_year'];
	$college_name_10 = $row['college_name'];
	$university_10 = $row['university'];
	$secured_10 = $row['secured'];
}

 */
?>

<style>
.notify_uplace_update{
	max-height: 388px;
	overflow-y:auto; 
}


.list_data_uplace_update:hover{
background-color:#d6dbdc;
}
</style>

			
<div class="modal fade" id="commondialog_project" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
  <div class="modal-dialog modal-md" role="document">
    <div class="modal-content">
		   <div class="modal-header">
			<!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>-->
			 <h5 class="modal-title" id="myModalLabel">Notification Details</h5>
		   </div>
				 <div class="modal-body" id="getCode_project">
				  <!-- passing value form script-->
				 </div>
		  <div class="modal-footer" style="margin-bottom: -10px;padding: 12px;">
		 
			<input type="button" class="btn btn-default" data-dismiss="modal" onclick="reload12();" 
	style="height:25px;padding-left: 12px;padding-right: 12px;padding-top: 0px;padding-bottom: 1px;" value="Close"/>
			<!--<input type="button" class="btn btn-primary"  value="Save changes" />-->
		  </div>
    </div>
  </div>
</div>

  <!-- page content -->
        <div class="right_col" role="main" style="background-color: #d6dbdc !important;">
          <div class="">

                 <!--<div class="row top_tiles">
                        
                      <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                            <div class="tile-stats">
                                <div class="icon"><i class="fa fa-cube"></i>
                                </div>
                                <div class="count">179</div>

                                <h3>Devices</h3>
                                <p>Number of Devices</p>
                            </div>
                        </div>
                        <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                            <div class="tile-stats">
                                <div class="icon"><i class="fa fa-cube"></i>
                                </div>
                                <div class="count">179</div>

                                <h3>Devices</h3>
                                <p>Number of Devices</p>
                            </div>
                        </div>
                       
                    </div>-->

    <div class="clearfix"></div>
	 <!--<h2>Overview of Profile</small></h2>-->

            <div class="x_panel">
                    <h2 style="text-align:center;text-transform:uppercase;color:black;">uPLACE Updates</h2>
			</div><!-- End one -->
		
		
		<div class="row">
		 <div class="col-md-6 col-xs-12">
              <div class="x_panel">
                  <div class="x_title">
                    <h2>Send Notification to Exp Candidates</small></h2>
                   <ul class="nav navbar-right panel_toolbox" style="min-width:0 !important;">
						<li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
					</ul>
                    <div class="clearfix"></div>
                  </div>
				<div class="x_content">
				
					<form id="notify_form_uplace_update" class="form-horizontal form-label-left" method="post">
					
							
							<div class="form-group">
							 <div class="row">
								<label class="col-md-12 col-sm-12 col-xs-12">Subject
								</label>
								<div class="col-md-12 col-sm-12 col-xs-12">
								  <input type="text" name="notify_subject_uplace_update" id="notify_subject_uplace_update" required="required" placeholder="Notification Subject" class="form-control col-md-7 col-xs-12">
								</div>
							</div>
							<div class="row">
								<label class="col-md-12 col-sm-12 col-xs-12">Message  (200 Words Only)
								</label>	
								<div class="col-md-12 col-sm-12 col-xs-12">
								<textarea name="notify_msg_uplace_update" id="notify_msg_uplace_update" class="form-control" placeholder="Enter Message Discription" style="height:200px;" maxlength="1000"></textarea>
								</div>
							</div>	
							
							</div>
							<span id="status_uplace_update"></span>
					 <div class="ln_solid"></div>
						<div class="form-group">
							<div class="col-md-12 col-sm-6 col-xs-12 col-md-offset-4 col-xs-offset-3">
					  			   <button type="button" class="btn btn-primary" name="notify_submit_uplace_update" id="notify_submit_uplace_update"><i class="fa fa-check"></i>&nbsp;&nbsp;Publish Notification</button>
							</div>
						</div>

				</form>
				
					
				</div>	
	</div>
</div> <!-- 6 row ends-->
            		
		<div class="col-md-6 col-xs-12">
              <div class="x_panel">
                  <div class="x_title">
                    <h2>List of Exp Candidates Notification Sent</h2>

					<span class="badge bg-blue" style="margin-left:1%;"><span id="notify_count_uplace_update" style="color:yellow;"></span></span>
                  
					<ul class="nav navbar-right panel_toolbox" style="min-width:0 !important;">
						<li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
					</ul>
                    <div class="clearfix"></div>
                  </div>
			<div class="x_content" style="height:394px;">
				<div class="row">
					<div class="animated fadeIn col-lg-12 col-md-12 col-sm-8 col-xs-12">
						 <div class="notify_uplace_update">        
							  <ul id="menu1" class="list-unstyled msg_list" role="menu">
								<div id="notify_list_uplace_update"></div>
							  </ul>
						</div> 					 
					</div>
				</div>
            </div>
        </div>
        </div>
			
        </div> <!--level one-->
		
		         
            		
		
				
	<?php include('sup_files/footer.php'); ?>

    </div>
    </div>
	
<script>


function delete_notify_uplace_update(data){
$.ajax({
    url: 'sureg/uplace_update.php?delete_notify=data123&notify_id='+data,
    type: 'GET',
    success: function (returndata) {
	//alert(returndata);
    <!-- function is call to header.php (Bootstrap model popup)-->
	$("#getCode_project").html(returndata);
    $("#commondialog_project").modal({backdrop:'static'});
			
				$.ajax({
					url: 'sureg/uplace_update.php?notify_list=data',
					type: 'GET',
					success: function (returndata) {
					//	alert(returndata);
					<!-- function is call to header.php (Bootstrap model popup)-->
					$("#notify_list_uplace_update").html(returndata);
					
					}
				  });
    }
  });
}


function list_data_get_uplace_update(data){
//alert(data)
$.ajax({
    url: 'sureg/uplace_update.php?load_data=loaded&notify_id='+data,
    type: 'GET',
    success: function (returndata) {
		//alert(returndata);	 
    <!-- function is call to header.php (Bootstrap model popup)-->
	$("#getCode_project").html(returndata);
    $("#commondialog_project").modal({backdrop:'static'});
	  
    }
  });
}

$(document).ready(function() {
//alert('asd');

load_notify_uplace_update();

//Sent Notification Lists
function load_notify_uplace_update(){
$.ajax({
    url: 'sureg/uplace_update.php?notify_list=data',
    type: 'GET',
    success: function (returndata) {
	//	alert(returndata);
    <!-- function is call to header.php (Bootstrap model popup)-->
	$("#notify_list_uplace_update").html(returndata);
  
    }
  });
}

//Send Notification func
 $("#notify_submit_uplace_update").on('click',function(event){
var sub=$('#notify_subject_uplace_update').val();
var msg=$('#notify_msg_uplace_update').val();

if(sub != '' && msg !='')
{
	$.ajax({
    url: 'sureg/uplace_update.php?subject='+sub+'&message='+msg,
    type: 'GET',
    success: function (returndata) {
//		alert(returndata);	 
load_notify_uplace_update();

$('#notify_subject_uplace_update').val('');
$('#notify_msg_uplace_update').val('');
    <!-- function is call to header.php (Bootstrap model popup)-->
	$("#getCode").html(returndata);
    $("#commondialog").modal({backdrop:'static'});
	  
    }
  });
 
  return false; 
}else{
	$("#status_uplace_update").html('<p style="color:red;font-size:12px;"><b>*Text field is Mandatory</b></p>');
}
  
  
});	 

});	

</script>
</body>

</html>
